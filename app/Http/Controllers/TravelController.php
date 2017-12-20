<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\Travel;
use App\Stats_paymethods_travel;
use App\Pay_method;

class TravelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index($user_id)
    {
        $travels = Travel::where('user_id', $user_id)->orderBy('finish_date', 'DESC')->get();
        return $travels;
    }

    public function find($id)
    {
        $travels = Travel::find($id);
        
        if ($travels){
            return (new response($travels, 200));
        }
        else
        {
            return (new response($travels, 404));
        }
    }

    public function createStatPaymethodTravel($user_id, $travel_id, $pay_method){

        $new_stat = new Stats_paymethods_travel;
        $new_stat->user_id = $user_id;
        $new_stat->travel_id = $travel_id;
        $new_stat->paymethod_id = $pay_method->id;
        $new_stat->paymethod_tag_name = str_replace(" ","_", strtolower($pay_method->name));
        $new_stat->paymethod_name = $pay_method->name;
        $new_stat->spent = 0;
        $new_stat->income = 0;
        $new_stat->operations = 0;
        
        $saveStat = $new_stat::createStat($new_stat);

        return $saveStat;
    }

    public function create(Request $request)
    {
        $validate = $this->validate($request, [
            'name' => 'required',
            'start_date' => 'required',
            'finish_date' => 'required'
        ]);

        $travel = new Travel;
        $travel->name = $request->input('name');
        $travel->start_date = $request->input('start_date');
        $travel->finish_date = $request->input('finish_date');
        $travel->start_tdc_balance = $request->input('start_tdc_balance');
        $travel->start_tdd_balance = $request->input('start_tdd_balance');
        $travel->start_cash_balance = $request->input('start_cash_balance');
        $travel->current_tdc_balance = $request->input('start_tdc_balance');
        $travel->current_tdd_balance = $request->input('start_tdd_balance');
        $travel->current_cash_balance = $request->input('start_cash_balance');
        $travel->user_id = $request->input('user_id');

        $saveTravel = $travel::createTravel($travel);

        if($saveTravel){
            $pay_methods = Pay_method::all();
            $travel_id = $saveTravel->id;
            $user_id = $travel->user_id;

            $responses = array();

            foreach ($pay_methods as $pay_method ) {
                $createStat = $this->createStatPaymethodTravel($user_id, $travel_id, $pay_method);
                if(!$createStat){
                    return (new response($createStat, 404));
                }
            }
            return (new response($saveTravel, 201));
        }
        else
        {
            return (new response($saveTravel, 404));
        }
    }


    public function update(Request $request, $travel_id)
    {
        $travel = Travel::find($travel_id);

        $validate = $this->validate($request, [
            'name' => 'required',
            'start_date' => 'required',
            'finish_date' => 'required'
        ]);

        $newTravel = new Travel;
        $travel->name = $request->input('name');
        $travel->start_date = $request->input('start_date');
        $travel->finish_date = $request->input('finish_date');
        $travel->start_tdc_balance = $request->input('start_tdc_balance');
        $travel->start_tdd_balance = $request->input('start_tdd_balance');
        $travel->start_cash_balance = $request->input('start_cash_balance');
        $travel->current_tdc_balance = $request->input('start_tdc_balance');
        $travel->current_tdd_balance = $request->input('start_tdd_balance');
        $travel->current_cash_balance = $request->input('start_cash_balance');

		$updateTravel=$newTravel::updateTravel($travel);

        if($updateTravel){
            return (new response($updateTravel, 201));
        }
        else
        {
            return (new response($updateTravel, 404));
        }
    }

    function updateBalance($method, $cost, $travel){
        switch($method) {
            case 1:
                $travel->current_tdd_balance += $cost;
                break;
            case 2:
                $travel->current_tdc_balance += $cost;
                break;
            case 3:
                $travel->current_cash_balance += $cost;
                break;
        }

        return $travel;
    }

    public function updateAfterOperation($method, $newOperation, $previous_cost){
        
        $cost = $newOperation->cost;
        $travel = Travel::find($newOperation->cod_travel);

        if($method == 'delete' && $newOperation->type == 'income' || $method == 'create' && $newOperation->type == 'outcome'){
            $cost = -$newOperation->cost;
        }

        if($method == 'delete'){
            --$travel->operations;
        }
        else if($method == 'create'){
            ++$travel->operations;
        }

        $travel = $this->updateBalance($newOperation->cod_method, $cost, $travel);
        
        $newTravel = new Travel;
        $updateTravel=$newTravel::updateTravel($travel);

        return $updateTravel;
    }

    public function delete($id)
    {
        $travel = Travel::find($id);
        if($travel != null){
            try
                {
                    $travel->delete();
                    return (new response($travel, 200));
                }
            catch(Exception $e)
                {
                    return $e->getMessage();
                }
        }else{
            return (new response($travel, 404));
        }
    }

}
