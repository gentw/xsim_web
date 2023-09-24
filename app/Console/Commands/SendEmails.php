<?php

namespace App\Console\Commands;

use App\Mail\CardExpiry;
use App\Mail\UnverifiedAccount;
use App\Models\Card;
use App\Models\CronDetail;
use App\Models\National_number;
use App\Models\TempExpiredCard;
use App\User;
use Carbon\Carbon;
use Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email to users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        switch ($this->argument('type')) {
            case 'inActive':
                $this->inActiveEmails();
                break;

            case 'cardExpiry':
                $this->cardExpiryEmails();
                break;
            

            case 'testMail':
                $this->testing_mail();
                break;
            
            default:
                # code...
                break;
        }
    }

    public function inActiveEmails()
    {
        $users = User::where(['active' => 0, ['activation_code', '!=', NULL], ['activation_code', '!=', '']])->where('created_at', '<', (Carbon::now())->toDateString())->get();

        foreach ($users as $user) {
            Mail::to($user->username)->send(new UnverifiedAccount(['activation_code' => $user->activation_code,'name' => $user->contact->firstname, 'username' => $user->username]));
        }
    }

    public function cardExpiryEmails()
    {
        $cron_detail = CronDetail::where('status', 'processing')->first();

        if(!empty($cron_detail) && $cron_detail->cron_status == 'processing'){
            if($cron_detail->updated_at->diffInMinutes(\Carbon\Carbon::now()) > 30){
                $cron_detail->cron_status = "completed";
                $cron_detail->save();
            }
            else{
                return true;
            }
        }

        if(empty($cron_detail)){
            $check_cron = CronDetail::whereDate('start_date', date('Y-m-d'))->where(['status' => 'completed'])->first();

            if(!empty($check_cron)){
                return true;
            }

            $cron_detail = CronDetail::create(['start_date' => date('Y-m-d'), 'limit' => 200, 'offset' => 0]);
        }

        $cron_detail->cron_status = "processing";
        $cron_detail->save();

        $cards = Card::where('card_number', '<>', NULL)->where(['active' => 1])->limit($cron_detail->limit)->offset($cron_detail->offset)->get();
        $card_count = $cards->count();
        $i = 1;
        foreach ($cards as $card) {
            try{
                $command = "https://xml2.travelsim.com/tsim_xml/service/xmlgate?uname=KNp0SP7tw&upass=HZYrAWmWnb&plain=1&command=rechargereport&started=" . date('Y-m-d', strtotime('-1 year')) . "&finished=" . date('Y-m-d') . "&onum=" . $card->card_number;
                $result = $this->call_card_api($command);

                if(empty($result['type']) && empty($result['money_transfer'])){
                    TempExpiredCard::updateOrCreate(['number' => $card->card_number], ['number' => $card->card_number]);
                }
                else{
                    $validity_time = 0;
                    if(!empty($result['money_transfer']['records'])){
                        if(!empty($result['money_transfer']['records']['record'])){
                            if(!empty($result['money_transfer']['records']['record'][0]['added'])){
                                $last_money_transfer = strtotime($result['money_transfer']['records']['record'][0]['added']);
                                if($validity_time < $last_money_transfer)
                                    $validity_time = $last_money_transfer;
                            }
                        }
                    }
                    if(!empty($result['automatic_transfer']['records'])){
                        if(!empty($result['automatic_transfer']['records']['record'])){
                            if(!empty($result['automatic_transfer']['records']['record'][0]['added'])){
                                $last_automatic_transfer = strtotime($result['automatic_transfer']['records']['record'][0]['added']);
                                if($validity_time < $last_automatic_transfer)
                                    $validity_time = $last_automatic_transfer;
                            }
                        }
                    }
                    if(!empty($result['web_recharge']['records'])){
                        if(!empty($result['web_recharge']['records']['record'])){
                            if(!empty($result['web_recharge']['records']['record'][0]['added'])){
                                $last_web_recharge = strtotime($result['web_recharge']['records']['record'][0]['added']);
                                if($validity_time < $last_web_recharge)
                                    $validity_time = $last_web_recharge;
                            }
                        }
                    }
                    if(!empty($result['pin_recharge']['records'])){
                        if(!empty($result['pin_recharge']['records']['record'])){
                            if(!empty($result['pin_recharge']['records']['record'][0]['added'])){
                                $last_pin_recharge = strtotime($result['pin_recharge']['records']['record'][0]['added']);
                                if($validity_time < $last_pin_recharge)
                                    $validity_time = $last_pin_recharge;
                            }
                        }
                    }
                    if(!empty($validity_time)){
                        Card::where(['id' => $card->id])->update(['card_validity' => date('Y-m-d', strtotime('+1 year', $validity_time))]);
                        TempExpiredCard::where(['number' => $card->card_number])->delete();
                    }
                }

                $national_numbers = [];
                $command = "https://xml2.travelsim.com/tsim_xml/service/xmlgate?uname=KNp0SP7tw&upass=HZYrAWmWnb&plain=1&command=shownum&num=" . $card->card_number;
                $response = $this->call_card_api($command);
                $result = json_decode($response['result']);
                if(!empty($result->primary_enum)){
                    $national_numbers[] = $result->primary_enum;
                    $primary_enum = $result->primary_enum;
                }
                if(!empty($result->secondary_enum)){
                    if(is_array($result->secondary_enum)){
                        $national_numbers = array_merge($national_numbers, $result->secondary_enum);
                    }
                    else{
                        $national_numbers[] = $result->secondary_enum;
                    }
                }

                if(count($national_numbers)){
                    National_number::whereIn('number', $national_numbers)->update(['allocated' => 1]);
                }
            }
            catch (\Exception $e){
                continue;
            }
            finally {
                if($i == $card_count){
                    $cron_detail->offset = $card->id;
                    $cron_detail->save();
                }
                ++$i;
            }
        }

        if(empty($card_count)){
            $sheet_array = TempExpiredCard::select(['number'])->where(['isSend' => 0])->get()->toArray();
            if(!empty($sheet_array)){
                Excel::create('ExpiredCards', function($excel) use($sheet_array) {
                    $excel->sheet('Expired Cards', function($sheet) use($sheet_array){
                        $sheet->setAllBorders('thin');
                        $sheet->fromArray($sheet_array ,null, 'A1', true, false);                 
                    });
                })->store('xlsx', public_path('files'));
                Mail::to('info@xxsim.com')->send(new CardExpiry(['attachment' => true]));
                Mail::to('kirtan@yudiz.com')->send(new CardExpiry(['attachment' => true]));
                TempExpiredCard::where(['isSend' => 0])->update(['isSend' => 1]);
            }
            else{
                Mail::to('info@xxsim.com')->send(new CardExpiry(['attachment' => false]));
                Mail::to('kirtan@yudiz.com')->send(new CardExpiry(['attachment' => false]));
            }
            $cron_detail->status = 'completed';
            $cron_detail->end_date = date('Y-m-d');
            $cron_detail->save();
        }

        $cron_detail->cron_status = "completed";
        $cron_detail->save();
    }

    protected function call_card_api($command = '')
    {
        if(!empty($command)){
            $result = file_get_contents($command);
            return XMLToArray($result);
        }
        else {
            return array();
        }
    }

    protected function testing_mail()
    {
        $user = User::find(7160);
        Mail::to('kirtan@yudiz.com')->send(new UnverifiedAccount(['activation_code' => $user->activation_code,'name' => $user->contact->firstname, 'username' => $user->username]));
    }

}
