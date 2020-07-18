<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/rec-process';
    protected $username;
 
    /**
     * Create a new controller instance.
     */
    public function index()
    {
        return view('auth.login');
    }
    // public function new_login(Request $request)
    // {
    //     $request->validate(['username'=>'required','password'=>'required']);
    //     try {
    //         $url = 'https://dev.puninar.com:9008/api/login-app';
    //         $username = strtolower($request->username);
    //         $password = $request->password;

    //         $client = new \GuzzleHttp\Client([
    //             'headers'   => ['Content-type' => 'application/json'],
    //             'http_errors' => false
    //         ]);

    //         $response = $client->post($url,
    //             ['body' => json_encode(
    //                 [
    //                     'user_name' =>$username,
    //                     'password' => $password,
    //                     'app_id' => 33
    //                 ]
    //             )]
    //         );  
    //         $resp = json_decode($response->getBody());   


    //         // Cek jika ada error dari backend dan tidak mengeluarkan stat
    //         if(isset($resp->error)) { return redirect()->route('error')->with('msg', $resp->error); }

    //         // Kalo stat == 1 berarti login berhasil    
    //         if(isset($resp->stat)){
    //             if($resp->stat == 1){

    //                 //Simpan Session
    //                 $request->session()->put(['app_token' => $resp->app_token]);
    //                 $request->session()->put(['app_menu' => $resp->app_menu]);
    //                 $request->session()->put(['user' => json_encode($resp->user[0])]);
    //                 $request->session()->put(['role' => $resp->role]);

    //                 $dd = json_decode(Session::get('user'));
    //                 $request->session()->put(['user_name'=>$dd->user_name]);
    //                 $request->session()->put(['user_email'=>$dd->email]);
                    


    //                 $menu = array(Session::get('app_menu'));

    //                 return redirect()->route('rec-process');
    //             }else{
    //                 $request->session()->flash('statusMsg', $resp->msg);
    //                 return redirect()->route('login');
    //             }
    //         }else{
    //             $request->session()->flash('statusMsg', $resp->msg);
    //             return redirect()->route('login');
    //         }
    //     } catch (Exception $e) {
    //         return redirect()->route('login');
    //     }            
    // }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
 
        $this->username = $this->findUsername();
    }
 
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function findUsername()
    {
        $login = request()->input('login');
 
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
 
        request()->merge([$fieldType => $login]);
 
        return $fieldType;
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect('/login');
    }
 
    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }
}
