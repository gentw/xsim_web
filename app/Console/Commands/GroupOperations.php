<?php

namespace App\Console\Commands;

use App\Models\Card;
use App\Models\CardStatusCronDetail;
use App\Models\Group;
use App\Models\UpdateCardCronDetail;
use Illuminate\Console\Command;

class GroupOperations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'group:operation {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Group related operations';

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
            case 'update':
                $this->updateGroups();
                break;

            case 'updateCard':
                $this->update_cards();
                break;

            case 'updateCardStatus':
                $this->update_card_status();
                break;
            
            default:
                # code...
                break;
        }
    }

    protected function updateGroups()
    {
        $command = "https://xml2.travelsim.com/tsim_xml/service/xmlgate?uname=KNp0SP7tw&upass=HZYrAWmWnb&plain=1&command=corp&aserviceid=4160";
        $result = $this->call_card_api($command);
        $groups = $result['group'];

        $group_ids = [];
        foreach ($groups as $key => $group) {
            Group::updateOrCreate(['group_id' => $group['corp_group']], ['group_id' => $group['corp_group'], 'group_name' => $group['corp_remark'], 'group_balance' => $group['corp_balance']]);
            $group_ids[] = $group['corp_group'];
        }
        Group::whereNotIn('group_id', $group_ids)->delete();
    }

    protected function update_cards()
    {
        $cron_detail = UpdateCardCronDetail::where('status', 'processing')->first();
        
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
            $check_cron = UpdateCardCronDetail::whereDate('start_date', date('Y-m-d'))->where(['status' => 'completed'])->first();

            if(!empty($check_cron)){
                return true;
            }

            $cron_detail = UpdateCardCronDetail::create(['start_date' => date('Y-m-d'), 'limit' => 200, 'offset' => 0]);
        }

        $cron_detail->cron_status = "processing";
        $cron_detail->save();

        $cards = Card::where('card_number', '<>', NULL)->where(['active' => 1])->limit($cron_detail->limit)->offset($cron_detail->offset)->get();
        $card_count = $cards->count();
        $i = 1;
        foreach ($cards as $card) {
            try{
                $command = "https://xml2.travelsim.com/tsim_xml/service/xmlgate?uname=KNp0SP7tw&upass=HZYrAWmWnb&plain=1&command=corp&onum=" . $card->card_number;
                $result = $this->call_card_api($command);

                if(empty($result['type'])){
                    $result_card = $result['card'];
                    $card_balance = (!empty($result_card['card_balance'])) ? $result_card['card_balance'] : NULL;
                    $corp_maxlimit = (!empty($result_card['corp_maxlimit'])) ? $result_card['corp_maxlimit'] : NULL;
                    $corp_minlimit = (!empty($result_card['corp_minlimit'])) ? $result_card['corp_minlimit'] : NULL;
                    $corp_transaction = (!empty($result_card['corp_transaction'])) ? $result_card['corp_transaction'] : NULL;
                    $corp_enabled = (!empty($result_card['corp_enabled']) && $result_card['corp_enabled'] == 'yes') ? 1 : 0;

                    if(!empty($result_card['corp_group'])){
                        $corp_group = Group::where('group_id', $result_card['corp_group'])->value('id');
                    }

                    if(!empty($corp_group)){
                        Card::where('id', $card->id)->update(['card_balance' => $card_balance, 'group_id' => $corp_group, 'corp_maxlimit' => $corp_maxlimit, 'corp_minlimit' => $corp_minlimit, 'corp_transaction' => $corp_transaction, 'corp_enabled' => $corp_enabled]);
                    }
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
            $cron_detail->status = 'completed';
            $cron_detail->end_date = date('Y-m-d');
            $cron_detail->save();
        }

        $cron_detail->cron_status = "completed";
        $cron_detail->save();
    }

    protected function update_card_status()
    {
        $cron_detail = CardStatusCronDetail::where('status', 'processing')->first();
        
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
            $check_cron = CardStatusCronDetail::whereDate('start_date', date('Y-m-d'))->where(['status' => 'completed'])->first();

            if(!empty($check_cron)){
                return true;
            }

            $cron_detail = CardStatusCronDetail::create(['start_date' => date('Y-m-d'), 'limit' => 200, 'offset' => 0]);
        }

        $cron_detail->cron_status = "processing";
        $cron_detail->save();

        $cards = Card::where('card_number', '<>', NULL)->where(['active' => 1])->limit($cron_detail->limit)->offset($cron_detail->offset)->get();
        $card_count = $cards->count();
        $i = 1;
        foreach ($cards as $card) {
            try{
                $command = "https://xml2.travelsim.com/tsim_xml/service/xmlgate?uname=KNp0SP7tw&upass=HZYrAWmWnb&plain=1&command=sblock&plain=1&block=c&onum=" . $card->card_number;
                $result = $this->call_card_api($command);

                if(empty($result['type'])){
                    
                    if(!empty($result['blocked']) && $result['blocked'] == 'false')
                        $card_status = 1;
                    else
                        $card_status = 0;

                    Card::where('id', $card->id)->update(['card_status' => $card_status]);
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
}
