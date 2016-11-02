<?php

namespace App\Http\Controllers;

use App\Pay_method;
use Illuminate\Http\Response;

class PayMethodController extends Controller
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
        // $user = new User;
        // $userLevel=$user::userLevel(); /*Get the user level, if is admin...*/
        // if($userLevel>0)
        // {
        //     $pay_methods = Pay_method::all();
        //     return View::make('pay_method.index')->with('pay_methods', $pay_methods);   
        // }
        // else{
        //     return Redirect::to('/dashboard');
        // }
    }

    public function delete($id)
    {
        $pay_method = Pay_method::find($id);
        if($pay_method != null){
            try
                {
                    $pay_method->delete();
                    return (new response($pay_method, 200));
                }
            catch(Exception $e)
                {
                    return $e->getMessage();
                }
        }else{
            return (new response($pay_method, 404));
        }
    }

    //
}
