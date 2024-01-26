<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use \Session;
use App\Models\User;

 
class AuthController extends Controller
{
    
    public function login(Request $request)
    {
        // ...
        $params = $request->post();

        // echo '<pre>';var_dump($params);die;

        $email = $params['email'] ?? NULL;
        $pwd1 = $params['pwd1'] ?? NULL;

        $user = User::where('deleted', 0)
            ->where('email', $email)
            ->first();

        if (Auth::attempt([
            'email' => $email,
            'password' => $pwd1,
        ], true)) {
            $user = Auth::user();

            if ($user) {
                    
                //message
                Session::put('MESSAGE', 'SUCCESS_LOGIN');

                return redirect('/tai-khoan');
            }

        }
    
        Session::put('ERR_EMAIL', $params['email']);
        Session::put('MESSAGE', 'FAILED_LOGIN');
        
        return redirect('/tai-khoan');
    }
    
    public function signup(Request $request)
    {
        // ...
        $params = $request->post();

        // echo '<pre>';var_dump($params);die;

        $email = $params['email'] ?? NULL;
        $pwd1 = $params['pwd1'] ?? NULL;

        $user = User::where('deleted', 0)
            ->where('email', $email)
            ->first();

        if (Auth::attempt([
            'email' => $email,
            'password' => $pwd1,
        ], true)) {
            $user = Auth::user();

            if ($user) {
                    
                //message
                Session::put('MESSAGE', 'SUCCESS_LOGIN');

                return redirect('/tai-khoan');
            }

        }
    
        Session::put('ERR_EMAIL', $params['email']);
        Session::put('MESSAGE', 'FAILED_LOGIN');
        
        return redirect('/tai-khoan');
    }


}