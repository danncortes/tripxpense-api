<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $pay_methods = Pay_method::all();
        return $pay_methods;
    }

    public function create(Request $request)
	{
        $validate = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|same:password'
        ]);

		$user = new User;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->level = $request->input('level');

        $createUser = $user::createUser($user);

        if($createUser){
            
            return (new response($createUser, 201));
            // sending a welcome email
            /*Mail::send('emails.welcome', array('key' => Input::get('name')), function($message)
            {
                $message->to(Input::get('email'), Input::get('name'))->subject('Welcome!');
            });*/

        }
        else
        {
            return (new response($createUser, 404));
        }
	}

    public function find($id)
    {
    }

    public function delete($id)
    {
    }

    //
}
