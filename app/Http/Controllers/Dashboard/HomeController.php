<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\UserWidgets;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application simple dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->active){
            if(session('last_page') == route('online_shop') || session('last_page') == route('online_shop', 'recharge')){
                session()->forget('last_page');
                return redirect()->route('online_shop', 'packages');
            }
            $user = User::find(Auth::id());
            
            $basic_widget = array('current_balance' => 1, 'history' => 1, 'add_sim' => 1, 'reload' => 1, 'refer_friend' => 1);
            
            $user_widgets = $user->widgets;
            foreach ($user_widgets as $user_widget) {
                $basic_widget[$user_widget->type] = $user_widget->active;
            }
            
            return view('pages.dashboard.home')->with('basic_widget', $basic_widget);
        }
        else{
            Auth::logout();
            flash('Your acount is blocked by admin');
            return redirect()->route('login');
        }
    }

    /**
     * Show the application advance dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    public function advance()
    {
        $user = User::find(Auth::id());
            
        $advance_widget = array('call_forward' => 1, 'gprs' => 1, 'activation' => 1, 'geolocalisation' => 1, 'auto_reload' => 1, 'statistics' => 1);
        
        $user_widgets = $user->widgets;
        foreach ($user_widgets as $user_widget) {
            $advance_widget[$user_widget->type] = $user_widget->active;
        }
        return view('pages.dashboard.advance_home')->with(['advance_view'=> 'y', 'advance_widget' => $advance_widget]);
    }

    public function sendSMS()
    {
        $message = urlencode("You have been invited by ".Auth::user()->full_name." for the event ".$event->title." at the ".$event->club->title.". Thanks, TGL");

        $content =  'action=sendsms'. 
                    '&user='.rawurlencode('om06m2rp'). 
                    '&password='.rawurlencode('TDz9r6pE'). 
                    '&to='.rawurlencode($email). 
                    '&from='.rawurlencode('TGL Dubai').
                    '&text='.rawurlencode($message);

        $response = file_get_contents('http://www.smsglobal.com.au/http-api.php?'.$content);
        print_r($response);
        exit;
    }

    /** add widget **/
    public function addWidget(Request $request)
    {
        $data = $request->widget;
        $widgetData = explode('-', $data);
        $type = $widgetData[0];
        $dashboard = $widgetData[1];

        $widget = UserWidgets::whereRaw('dashboard = ? AND type = ? AND user_id = ?', array($dashboard, $type, Auth::id()))->first();
        if($widget)
        {
            $widget->active = '1';
            if($widget->save())
            {
                flash('Your widget added successfully.')->success();
            }
            else{
                flash('Something went wrong')->error();
            }
        }
        else{
            $dataArray = array();
            $dataArray['user_id'] = Auth::id();
            $dataArray['dashboard'] = $widgetData[1];
            $dataArray['type'] = $widgetData[0];
            $dataArray['active'] = '1';
            $newWidget = UserWidgets::create($dataArray);
            if($newWidget)
            {
                flash('Your widget added successfully.')->success();
            }
            else{
                flash('Something went wrong')->error();
            }
        }
        $content['status'] = 200;
        $content['message'] = "Suceess";
        return response()->json($content);

    }

    /** remove widget **/
    public function removeWidget(Request $request)
    {
        $data = $request->widget;
        $widgetData = explode('-', $data);
        $type = $widgetData[0];
        $dashboard = $widgetData[1];
        $widget = UserWidgets::whereRaw('dashboard = ? AND type = ? AND user_id = ?', array($dashboard, $type, Auth::id()))->first();
        if($widget)
        {
            $widget->active = '0';
            if($widget->save())
            {
                flash('Your widget removed successfully.')->success();
            }
            else{
                flash('Something went wrong')->error();
            }
        }
        else{
            $dataArray = array();
            $dataArray['user_id'] = Auth::id();
            $dataArray['dashboard'] = $widgetData[1];
            $dataArray['type'] = $widgetData[0];
            $dataArray['active'] = '0';
            $newWidget = UserWidgets::create($dataArray);
            if($newWidget)
            {
                flash('Your widget removed successfully.')->success();
            }
            else{
                flash('Something went wrong')->error();
            }
        }
        $content['status'] = 200;
        $content['message'] = "Suceess";
        return response()->json($content);

    }
}
