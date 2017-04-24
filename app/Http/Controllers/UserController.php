<?php

namespace App\Http\Controllers;

use App\Pay_method;
/*use Illuminate\Http\Response;
use Illuminate\Http\Request;*/

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

    public function create()
	{
		$user= new User;
		$returnValidate=$user::validateUser();
		if(! $returnValidate->fails())
		{
			$saveUser=$user::createUser($user);
			if($saveUser==true){
				
				// sending a welcome email
				Mail::send('emails.welcome', array('key' => Input::get('name')), function($message)
				{
				    $message->to(Input::get('email'), Input::get('name'))->subject('Welcome!');
				});

				//return Redirect::to('/dashboard');

			}
			else
			{
				//return Redirect::route('user.create')->withInput()->with('message', 'Error saving data!');
			}
		}
		else
		{
			//return Redirect::route('user.create')->withInput()->withErrors($returnValidate);
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
