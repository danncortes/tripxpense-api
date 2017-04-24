<?php

namespace App\Http\Controllers;

use App\Pay_method;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

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
    }

    public function create(Request $request)
    {
        $validate = $this->validate($request, [
            'name' => 'required|unique:pay_methods,name'
        ]);

        $pay_method = new Pay_method;
        $pay_method->name = $request->input('name');

        $savePayMethod = $pay_method::createPay_method($pay_method);

        if($savePayMethod){
            return (new response($savePayMethod, 201));
        }
        else
        {
            return (new response($savePayMethod, 404));
        }
    }

    public function find($id)
    {
        $pay_method = Pay_method::find($id);

        return $pay_method;
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
