<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\Operation;

class OperationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $operations = Operation::all();
        return $operations;
    }

    // public function create(Request $request)
    // {
    //     $validate = $this->validate($request, [
    //         'name' => 'required|unique:pay_methods,name'
    //     ]);

    //     $pay_method = new Pay_method;
    //     $pay_method->name = $request->input('name');

    //     $savePayMethod = $pay_method::createPay_method($pay_method);

    //     if($savePayMethod){
    //         return (new response($savePayMethod, 201));
    //     }
    //     else
    //     {
    //         return (new response($savePayMethod, 404));
    //     }
    // }

    // public function find($id)
    // {
    //     $pay_method = Pay_method::find($id);

    //     if ($pay_method){
    //         return (new response($pay_method, 200));
    //     }
    //     else
    //     {
    //         return (new response($pay_method, 404));
    //     }
    // }

    // public function update(Request $request, $id)
    // {
    //     $pay_method = Pay_method::find($id);

    //     $validate = $this->validate($request, [
    //         'name' => 'required|unique:pay_methods,name'
    //     ]);

    //     $newPay_method = new Pay_method;
    //     $pay_method->name = $request->input('name');

	// 	$updatePay_method=$newPay_method::updatePay_method($pay_method);

    //     if($updatePay_method){
    //         return (new response($updatePay_method, 201));
    //     }
    //     else
    //     {
    //         return (new response($updatePay_method, 404));
    //     }
    // }

    public function delete($id)
    {
        $operation = Operation::find($id);
        if($operation != null){
            try
                {
                    $operation->delete();
                    return (new response($operation, 200));
                }
            catch(Exception $e)
                {
                    return $e->getMessage();
                }
        }else{
            return (new response($operation, 404));
        }
    }
}
