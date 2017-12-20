<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\TravelController;

use App\Operation;

class OperationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index($user_id)
    {
        $operations = Operation::where('user_id', $user_id)->get();
        return $operations;
    }

    public function find($id)
    {
        $operation = Operation::find($id);
        
        if ($operation){
            return (new response($operation, 200));
        }
        else
        {
            return (new response($operation, 404));
        }
    }

    public function operationsByTravel($user_id, $cod_travel)
    {
        $operations = Operation::where('user_id', $user_id)->where('cod_travel', $cod_travel)->get();
        return $operations;
    }

    public function create(Request $request)
    {
        $validate = $this->validate($request, [
            'title' => 'required',
            'cost' => 'required|numeric',
            'date_op' => 'required',
            'type' => 'required|string',
            'cod_method' => 'required|numeric',
            'cod_travel' => 'required|numeric',
            'cod_category' => 'required|numeric',
            'user_id' => 'required|numeric',
        ]);

        $operation = new Operation;
        $operation->title = $request->input('title');
        $operation->cost = $request->input('cost');
        $operation->date_op = $request->input('date_op');
        $operation->type = $request->input('type');
        $operation->cod_method = $request->input('cod_method');
        $operation->cod_travel = $request->input('cod_travel');
        $operation->cod_category = $request->input('cod_category');
        $operation->user_id = $request->input('user_id');

        $saveOperation = $operation::saveOperation($operation);

        if($saveOperation){
            $savePaymethodStat = (new StatsController)->updatePaymethodTravel('create', $operation);
            $updateTravel = (new TravelController)->updateAfterOperation('create', $operation, []);

            if($operation->type === 'outcome'){
                $saveCategoryStat = (new StatsController)->updateCategoryTravel('create', $operation);
            }

            if($savePaymethodStat){
                return (new response($saveOperation, 201));
            }
        }
        else
        {
            return (new response($saveOperation, 404));
        }
    }


    public function update(Request $request, $operation_id)
    {
        $operation = Operation::find($operation_id);

        $validate = $this->validate($request, [
            'title' => 'required',
            'cost' => 'required|numeric',
            'date_op' => 'required',
            'type' => 'required|string',
            'cod_method' => 'required|numeric',
            'cod_travel' => 'required|numeric',
            'cod_category' => 'required|numeric',
            'user_id' => 'required|numeric',
        ]);

        $modelOperation = new Operation;
        $oldOperation = clone $operation;
        $operation->title = $request->input('title');
        $operation->cost = $request->input('cost');
        $operation->date_op = $request->input('date_op');
        $operation->type = $request->input('type');
        $operation->cod_method = $request->input('cod_method');
        $operation->cod_travel = $request->input('cod_travel');
        $operation->cod_category = $request->input('cod_category');
        $operation->user_id = $request->input('user_id');

        $saveOperation = $modelOperation::saveOperation($operation);

        if($saveOperation){
            $updateTravel = (new TravelController)->updateAfterOperation('delete', $oldOperation, []);
            $updateTravel = (new TravelController)->updateAfterOperation('create', $operation, []);
            $savePaymethodStat = (new StatsController)->updatePaymethodTravel('delete', $oldOperation);
            $savePaymethodStat = (new StatsController)->updatePaymethodTravel('create', $operation);
            $saveCategoryStat = (new StatsController)->updateCategoryTravel('delete', $oldOperation);
            $saveCategoryStat = (new StatsController)->updateCategoryTravel('create', $operation);
            return (new response($saveOperation, 201));
        }
        else
        {
            return (new response($saveOperation, 404));
        }
    }
    
    public function delete($id)
    {
        $operation = Operation::find($id);
        if($operation != null){
            try
                {
                    $operation->delete();
                    $savePaymethodStat = (new StatsController)->updatePaymethodTravel('delete', $operation);
                    $updateTravel = (new TravelController)->updateAfterOperation('delete', $operation, 0);
                    if($operation->type === 'outcome'){
                        $saveCategoryStat = (new StatsController)->updateCategoryTravel('delete', $operation);
                    }

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
