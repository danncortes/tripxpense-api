<?php

namespace App\Http\Controllers;

use App\Category;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $categories = Category::all();
        return $categories;
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

    //
}
