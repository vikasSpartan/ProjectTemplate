<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotification;

use App\Models\User;

class AuthController extends Controller
{

    public function index(){
        return view('auth.login');
    }

    public function registerView(){
        return view('auth.register');
    }

    public function fPasswordView(){
        return view('auth.forgotPassword');
    }

    public function loginUser(Request $request){
        $inputValidation = \Validator::make($request->all(), [
            "inputEmail" => 'required|email',
            "inputPassword" => 'required'
        ]);
        if($inputValidation->fails()){
            return redirect()->back()->with('errValidate', 'Please fill all the fields'); 
        }
        $remember_me = $request->has('rememberPass')?true:false;
        if(\Auth::attempt([

            'email' => $request->input('inputEmail'),
            'password' => $request->input('inputPassword')
        ], $remember_me)){
            if($remember_me){
                setcookie('login_email', $request->input('inputEmail'), time()+60*60*24*100);
                setcookie('login_pass', $request->input('inputPassword'), time()+60*60*24*100);
            }else{
                setcookie('login_email', $request->input('inputEmail'), 100);
                setcookie('login_pass', $request->input('inputPassword'), 100);
            }
            return redirect('dashboard')->with('loggedin', 1);
        }
        return redirect('login')->withError('Error');
    }

    public function registerUser(Request $request){

        $inputValidation = \Validator::make($request->all(), [
            "inputFirstName" => 'required',
            "inputLastName" => 'required',
            "inputEmail" => 'required|email|unique:users,email',
            "inputPhone" => 'required',
            "inputPassword" => 'required|confirmed',
        ]);
        if($inputValidation->fails()){
        
            $errors = $inputValidation->errors();
            $errMessage = '';
            
            if($errors->has('inputFirstName')){
                $errMessage .= 'Please enter your first name. ';
            }
            
            if($errors->has('inputLastName')){
                $errMessage .= 'Please enter your last name. ';
            }
            
            if($errors->has('inputEmail')){
                $errMessage .= 'Email Id already registered. ';
            }
            
            if($errors->has('inputPhone')){
                $errMessage .= 'Please enter your phone number. ';
            }
            
            if($errors->has('inputPassword')){
                $errMessage .= 'Please enter a password and confirm it. ';
            }
            return redirect()->back()->with('errValidate', $errMessage); 
        }

        User::create([
            "firstname" => $request->inputFirstName,
            "lastname" => $request->inputLastName,
            "email" => $request->inputEmail,
            "phone" => $request->inputPhone,
            "password" => \Hash::make($request->inputPassword)
        ]);

        if(\Auth::attempt([
            'email' => $request->input('inputEmail'),
            'password' => $request->input('inputPassword')
        ])){
            return redirect('dashboard');
        }

        return redirect('register')->withError('Error');
    }
    
    public function sendFPassEmail(Request $request){

        $inputValidation = \Validator::make($request->all(), [
            "email" => 'required|email'
        ]);
        if($inputValidation->fails()){
            return redirect()->back()->with('errValidate', 'Please fill Email'); 
        }
        $useremail = $request->email;
        if(User::where('email', '=', $useremail)->exists()){
            $data = [
                'title' => 'Email Title',
                'userName' => $useremail,
                'CompanyName' => 'Company Name',
                // 'linkSlug' => ''
            ];
            
            Mail::send('auth.forgotPassEmailTemp', $data, function ($message) use ($useremail){
                $message->from('testspartanbots@gmail.com', 'Email Sender');
                $message->to($useremail)->subject('Company Name - Password Reset');
            });

            return redirect('login')->with("emailsent", 1);
        }else{
            return redirect()->back()->with("error", "Entered email is not registered with us");
        }
        
    }

}