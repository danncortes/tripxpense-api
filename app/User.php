<?php

namespace App;

use Auth;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    /*VALIDATE USER*/
	public static function validateUser(){
		$rules = array(
			'name' => 'required',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|confirmed|min:6',
			'password_confirmation' => 'required|same:password'
		);

		$validator = Validator::make(Input::all(), $rules);
		return $validator;
	}


    /*CREATE USER*/
	public static function createUser($user){

		if($user->level==null){
			$user->level=0;
		}

		try{
			$user->save();
			Auth::login($user); /*creamos una variable de autenticación*/
		}
		catch(Exception $e)
		{
			return $e;
		}
	}
}
