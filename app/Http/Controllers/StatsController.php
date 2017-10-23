<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\Stats_paymethods_travel;
use App\Stats_travel_categories;
use App\Pay_method;
use App\Category;

class StatsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function updatePaymethodTravel($operation){
        
        $user_id = $operation->user_id;
        $travel_id = $operation->cod_travel;
        $cod_paymethod = $operation->cod_method;
        
        $stat = Stats_paymethods_travel::where('user_id', $user_id)->where('travel_id', $travel_id)->where('paymethod_id', $cod_paymethod)->get();

        if(!count($stat) == 0){
            $stat = $stat[0];
        }
        else {
            $stat = new Stats_paymethods_travel;
            $stat->spent = 0;
            $stat->income = 0;
            $stat->operations = 0;
            $stat->user_id = $operation->user_id;
            $stat->travel_id = $operation->cod_travel;
            $stat->paymethod_id = $operation->cod_method;
            $pay_method = Pay_method::find($operation->cod_method);
            $stat->paymethod_tag_name = $pay_method->tag_name;
            $stat->paymethod_name = $pay_method->name;
        }

        if($operation->type === 'outcome'){
            $stat->spent += $operation->cost;
        }else{
            $stat->income += $operation->cost;
        }
        ++$stat->operations;
        $PaymethodStat = new Stats_paymethods_travel;
        $saveStat = $PaymethodStat::createStat($stat);
        return $saveStat;
    }

    public function updateCategoryTravel($operation){

        $user_id = $operation->user_id;
        $travel_id = $operation->cod_travel;
        $cod_category = $operation->cod_category;

        $stat = Stats_travel_categories::where('user_id', $user_id)->where('travel_id', $travel_id)->where('category_id', $cod_category)->get();

        if(!count($stat) == 0){
            $stat = $stat[0];
        }
        else {
            $stat = new Stats_travel_categories;
            $stat->spent = 0;
            $stat->operations = 0;
            $stat->user_id = $operation->user_id;
            $stat->travel_id = $operation->cod_travel;
            $stat->category_id = $operation->cod_category;
            $stat->category_name = Category::find($operation->cod_category)->name;
        }

        $stat->spent += $operation->cost;
        ++$stat->operations;

        $CategoryStat = new Stats_travel_categories;
        $saveStat = $CategoryStat::createStat($stat);
        return $saveStat;

    }

    public function getPaymethodTravel($user_id, $travel_id)
    {
        $stats = Stats_paymethods_travel::where('user_id', $user_id)->where('travel_id', $travel_id)->get();
        return $stats;
    }

    public function getCategoryTravel($user_id, $travel_id)
    {
        $stats = Stats_travel_categories::where('user_id', $user_id)->where('travel_id', $travel_id)->get();
        
        return $stats;
    }

}
