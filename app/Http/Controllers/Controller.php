<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //add for api
    public $response = array('data'=> null,'message'=>'');
    public $status = 422;
    public $statusArr = [ 'success'=>200, 'not_found'=>404, 'unauthorised'=>412, 'already_exist'=>409, 'validation'=>422, 'something_wrong'=>405 ];

    public function ApiValidator($fields, $rules){
        $validator = Validator::make($fields, $rules);

        if($validator->fails()){
            $errors = $validator->errors();
            //print_r($errors->messages());
            //send only first error message
            $r_message  = '';
            $i=1;
            foreach($errors->messages() as $key => $message){
                if($i==1){
                    $r_message = $message[0];
                } else {
                    break;
                }
                $i++;
            }
            $this->response['message']=$r_message;
            //$this->response['error'] = $validator->errors();

            return false;
        }

        return true;
    }

    public function return_response(){
        return response()->json($this->response, $this->status);
    }
    //end api

    public function ValidateForm($fields, $rules, $messages = []){
    	$validator = Validator::make($fields, $rules, $messages)->validate();
    }

    public function DTFilters($request){
        $filters = array(
            'draw' => $request['draw'],
            'offset' => $request['start'],
            'limit' => $request['length'],
            'sort_column' => $request['columns'][$request['order'][0]['column']]['data'],
            'sort_order' => $request['order'][0]['dir'],
            'search' => $request['search']['value']

        );
        return $filters;
    }

    public function call_card_api($command = '')
    {
        if(!empty($command)){
            try{
                $url = "https://xml2.travelsim.com/tsim_xml/service/xmlgate?uname=KNp0SP7tw&upass=HZYrAWmWnb&plain=1" . $command;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch);
                curl_close($ch);
                return XMLToArray($result);
                // $result = file_get_contents("https://xml2.travelsim.com/tsim_xml/service/xmlgate?uname=KNp0SP7tw&upass=HZYrAWmWnb&plain=1" . $command);
                // return XMLToArray($result);
            }
            catch (\Exception $e){
                return array();
            }
        }
        else {
            return array();
        }
    }

}
