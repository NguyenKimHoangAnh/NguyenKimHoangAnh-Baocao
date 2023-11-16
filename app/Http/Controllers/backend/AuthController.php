<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;

use App\Models\User;




class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getlogin()
    {
       return view('backend.user.login');
    }

    public function postlogin(Request $request)
    {   
        $username=$request->username;
        $password=$request->password;
        $user=array('password'=>$password);
        if(filter_var($username, FILTER_VALIDATE_EMAIL)){
            $user['email']=$username;
        }
        else{
            $user['username']=$username;
        }
        
      

       if(Auth::attempt($user))
       {
        return redirect()->route('dashboard.index');
       }
       else
       {
        
        $error='Thông tin đăng nhập chưa chính xác';
        return view('backend.user.login',compact('error'));
        }
       
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.getlogin');
    }
}
