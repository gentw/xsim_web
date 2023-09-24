<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardApiController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->content  = ['status' => 204, 'message' => "something went wrong"];
    }

    public function card_api(Request $request, $data = [])
    {
        
        if(!empty($request->data)){
            $data = $request->data;
        }
        else{
            $data = $data;
        }
    	
    	if(!empty($data['api_name'])){
    		$command = $extra = '';
    		$card = true;
    		$start = $end = $redirect_card = $amount = $curr = $orderid = $num = $enum = $aserviceid = $groupid = $activate = $packettype = $packetid = false;

    		switch ($data['api_name']) {
    			case 'get_balance':
    				$command = "gbalance";
    				break;

                case 'account_details':
                    $command = "account";
                    $card = false;
                    break;

                case 'reload':
                    $command = "sbalance";
                    $amount = $curr = $orderid = true;
                    break;

                case 'add_national_number':
                    $command = "enum";
                    $enum = true;
                    break;

                case 'enum_list':
                    $command = "shownum";
                    $card = false;
                    $num = true;
                    break;

                case 'reload_group':
                    $command = "sbalance";
                    $card = false;
                    $aserviceid = $groupid = $amount = $curr = $orderid = true;
                    break;

                case 'active_discount_package':
                    $command = "discount";
                    $activate = $packettype = $packetid = true;
                    break;
    			
    			default:
    				$card = false;
    				break;
    		}

    		$this->execute_api($data, $command, $card, $start, $end, $redirect_card, $amount, $curr, $orderid, $num, $enum, $aserviceid, $groupid, $activate, $packettype, $packetid, $extra);
    	}
    	else{
    		$this->content['message'] = "Something went wrong.";
    	}

        if($request->ajax()){
            return response()->json($this->content);    
        }
        else{
            return $this->content;
        }
    	
    }

	public function execute_api($data = array(), $command = '', $card = false, $start = false, $end = false, $redirect_card = false, $amount = false, $curr = false, $orderid = false, $num = false, $enum = false, $aserviceid = false, $groupid = false, $activate = false, $packettype = false, $packetid = false, $extra = '')
	{
		if(!empty($command)){
			$url = "&command=" . $command;

			if($card){
				if(!empty($data['card'])){
					$url .= "&onum=" . $data['card'];
				}
				else{
					$this->content['message'] = "Card number not selected.";
					return;
				}
			}

            if($curr){
                $url .= "&curr=EUR";
            }

            if($amount){
                if(!empty($data['amount'])){
                    $url .= "&amount=" . sprintf('%0.2f', $data['amount']);
                }
                else{
                    $this->content['message'] = "Amount not found.";
                    return;
                }
            }

            if($orderid){
                if(!empty($data['orderid'])){
                    $url .= "&orderid=" . $data['orderid'];
                }
                else{
                    $this->content['message'] = "Orderid not found.";
                    return;
                }
            }

            if($num){
                if(!empty($data['num'])){
                    $url .= "&num=" . $data['num'];
                }
                else{
                    $this->content['message'] = "Number not found.";
                    return;
                }
            }

            if($aserviceid){
                $url .= "&aserviceid=4160";
            }

            if($groupid){
                if(!empty($data['group_id'])){
                    $url .= "&groupid=" . $data['group_id'];
                }
                else{
                    $this->content['message'] = "Group id not found.";
                    return;
                }
            }

            if($enum){
                $url .= "&enum=" . urlencode($data['enum']);
            }

            if($activate){
                $url .= "&activate=yes";
            }

            if($packettype){
                if(!empty($data['packettype'])){
                    $url .= "&packettype=" . urlencode($data['packettype']);
                }
                else{
                    $this->content['message'] = "Packet type not found.";
                    return;
                }
            }

            if($packetid){
                if(!empty($data['packetid'])){
                    $url .= "&packetid=" . urlencode($data['packetid']);
                }
                else{
                    $this->content['message'] = "Packet id not found.";
                    return;
                }
            }
		}

		if(!empty($url)){
			$result = $this->call_card_api($url);
			if(!empty($result['type']) && $result['type'] == "ERROR"){
				$this->content['message'] = $result['text'];
                $this->content['status'] = 412;
                $this->content['result'] = null;
			}
			else{
				$this->content['status'] = 200;
				$this->content['message'] = "Success";
				$this->content['result'] = json_encode($result);
			}
		}
	}
}
