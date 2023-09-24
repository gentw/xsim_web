<?php

namespace App\Http\Controllers\Dashboard;

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
    		$start = $end = $redirect_card = $amount = $curr = $orderid = $anum = $bnum = $msg = $activate = $packettype = $packetid = $block = $enum = $aserviceid = $corp_group = $corp_remark = $corp_minlimit = $corp_maxlimit = $corp_transaction = $corp_enabled = $from = $timeframes = $num = $groupid = false;

    		switch ($data['api_name']) {
    			case 'get_balance':
    				$command = "gbalance";
    				break;
    			
    			case 'get_call_history':
    				$command = "gccdr";
    				$start = $end = true;
    				break;
    			
    			case 'gprs_service_status':
    				$command = "gprsauth";
    				$block = true;
    				break;
    			
    			/*case 'get_gprs_history':
    				$command = "gccdr";
    				$start = $end = true;
    				break;
    			
    			case 'get_card_activation_status':
    				$command = "svmail";
    				break;*/
    			
    			case 'call_forwading':
    				$command = "redirect";
    				$redirect_card = true;
    				break;
    			
    			case 'geolocation_status':
    				$command = "navstat3";
    				break;
                
                case 'geolocation':
                    $command = "getnav3";
                    break;
                
                case 'active_geolocation_service':
                    $command = "nav3";
                    $from = $timeframes = $packetid = true;
                    break;
                
                case 'account_details':
                    $command = "account";
                    $card = false;
                    break;
                
                case 'reload':
                    $command = "sbalance";
                    $amount = $curr = $orderid = true;
                    break;
                
                case 'recharge_history':
                    $command = "rechargereport";
                    $start = $end = true;
                    break;
                
                case 'internet_history':
                    $command = "gprscdr";
                    $start = $end = true;
                    break;
                
                case 'sms':
                    $command = "sms";
                    $card = false;
                    $anum = $bnum = $msg = true;
                    break;
                
                case 'active_discount_package':
                    $command = "discount";
                    $activate = $packettype = $packetid = true;
                    break;
                
                case 'card_status':
                    $command = "sblock";
                    $block = true;
                    break;
                
                case 'add_national_number':
                    $command = "enum";
                    $enum = true;
                    break;
                
                case 'add_secondary_national_number':
                    $command = "enumadd";
                    $enum = true;
                    break;
                
                case 'get_card_group_info':
                    $command = "corp";
                    break;
                
                case 'get_group_list':
                    $command = "corp";
                    $card = false;
                    $aserviceid = true;
                    break;
                
                case 'add_group':
                    $command = "corp";
                    $card = false;
                    $aserviceid = $corp_group = $corp_remark = true;
                    break;
                
                case 'get_group_cards':
                    $command = "corp";
                    $card = false;
                    $aserviceid = $corp_group = true;
                    break;
                
                case 'manage_card_to_group':
                    $command = "corp";
                    $aserviceid = $corp_group = $corp_minlimit = $corp_maxlimit = $corp_transaction = $corp_enabled = true;
                    break;
                
                case 'get_all_enum':
                    $command = "shownum";
                    $card = false;
                    $num = true;
                    break;
                
                case 'check_redirect':
                    $command = "redirect";
                    break;

                case 'remove_national_number':
                    $command = "enumdel";
                    $enum = true;
                    break;

                case 'add_card_balance_from_grp':
                    $command = "sbalance";
                    $amount = $curr = $orderid = $groupid = $aserviceid = true;
                    break;
    			
    			default:
    				$card = false;
    				break;
    		}

    		$this->execute_api($data, $command, $card, $start, $end, $redirect_card, $amount, $curr, $orderid, $anum, $bnum, $msg, $activate, $packettype, $packetid, $block, $enum, $aserviceid, $corp_group, $corp_remark, $corp_minlimit, $corp_maxlimit, $corp_transaction, $corp_enabled, $from, $timeframes, $num, $groupid, $extra);
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

	public function execute_api($data = array(), $command = '', $card = false, $start = false, $end = false, $redirect_card = false, $amount = false, $curr = false, $orderid = false, $anum = false, $bnum = false, $msg = false, $activate = false, $packettype = false, $packetid = false, $block = false, $enum = false, $aserviceid = false, $corp_group = false, $corp_remark = false, $corp_minlimit = false, $corp_maxlimit = false, $corp_transaction = false, $corp_enabled = false, $from = false, $timeframes = false, $num = false, $groupid = false, $extra = '')
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

			if($start){
				if(!empty($data['start'])){
					$url .= "&started=" . date('Y-m-d', strtotime("-1 day", strtotime($data['start'])));
				}
				else{
					$this->content['message'] = "Start date not selected.";
					return;
				}
			}

			if($end){
				if(!empty($data['end'])){
                    $url .= "&finished=" . date('Y-m-d', strtotime("+1 day", strtotime($data['end'])));
				}
				else{
					$this->content['message'] = "End date not selected.";
					return;
				}
			}

            if($redirect_card){
                if(!empty($data['redirect_card']) || $data['redirect_card'] == ''){
                    $url .= "&redirect=" . $data['redirect_card'];
                }
                else{
                    $this->content['message'] = "Redirect card number not found.";
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

            if($anum){
                if(!empty($data['anum'])){
                    $url .= "&anum=" . $data['anum'];
                }
                else{
                    $this->content['message'] = "Card number not found.";
                    return;
                }
            }

            if($bnum){
                if(!empty($data['bnum'])){
                    $url .= "&bnum=" . $data['bnum'];
                }
                else{
                    $this->content['message'] = "Card number not found.";
                    return;
                }
            }

            if($msg){
                if(!empty($data['msg'])){
                    $url .= "&msg=" . urlencode($data['msg']);
                }
                else{
                    $this->content['message'] = "Message not found.";
                    return;
                }
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

            if($block){
                if(!empty($data['block'])){
                    $url .= "&block=" . urlencode($data['block']);
                }
                else{
                    $this->content['message'] = "Block status not found.";
                    return;
                }
            }

            if($enum){
                $url .= "&enum=" . (!empty($data['enum']) ? urlencode($data['enum']) : '');
            }

			if($aserviceid){
				$url .= "&aserviceid=4160";
			}

            if($corp_group){
                if(!empty($data['corp_group'])){
                    $url .= "&corp_group=" . $data['corp_group'];
                }
                else{
                    $this->content['message'] = "Group number not found.";
                    return;
                }
            }

            if($corp_remark){
                if(!empty($data['corp_remark'])){
                    $url .= "&corp_remark=" . urlencode($data['corp_remark']);
                }
                else{
                    $this->content['message'] = "Group name not found.";
                    return;
                }
            }

            if($from){
                if(!empty($data['from'])){
                    $url .= "&from=" . $data['from'];
                }
                else{
                    $this->content['message'] = "Service start date not found.";
                    return;
                }
            }

            if($timeframes){
                if(!empty($data['timeframes'])){
                    $url .= "&timeframes=" . $data['timeframes'];
                }
                else{
                    $this->content['message'] = "Service activation period not found.";
                    return;
                }
            }

            if($num){
                if(!empty($data['num'])){
                    $url .= "&num=" . $data['num'];
                }
                else{
                    $this->content['message'] = "Card number not found.";
                    return;
                }
            }

            if($corp_minlimit){
                $url .= "&corp_minlimit=" . $data['corp_minlimit'];
            }

            if($corp_maxlimit){
                $url .= "&corp_maxlimit=" . $data['corp_maxlimit'];
            }

            if($corp_transaction){
                $url .= "&corp_transaction=" . $data['corp_transaction'];
            }

            if($corp_enabled){
                if(!empty($data['corp_enabled'])){
                    $url .= "&corp_enabled=" . $data['corp_enabled'];
                }
                else{
                    $this->content['message'] = "Card enable not found.";
                    return;
                }
            }

            if($groupid){
                if(!empty($data['groupid'])){
                    $url .= "&groupid=" . $data['groupid'];
                }
                else{
                    $this->content['message'] = "Group not found.";
                    return;
                }
            }

			if(!empty($extra)){
				$url .= "&" . $extra;
			}
		}
		if(!empty($url)){
			$result = $this->call_card_api($url);
			if(!empty($result['type']) && $result['type'] == "ERROR"){
                $this->content['status'] = 412;
				$this->content['message'] = $result['text'];
                $this->content['result'] = json_encode([]);
			}
			else{
				$this->content['status'] = 200;
				$this->content['message'] = "Success";
				$this->content['result'] = json_encode($result);
			}
		}
	}
}
