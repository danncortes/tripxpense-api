<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\Stats_paymethods_travel;
use App\Stats_travel_categories;
use App\Category;

class StatsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function getPaymethodTravel($user_id, $travel_id)
    {
        $stats = Stats_paymethods_travel::where('user_id', $user_id)->where('travel_id', $travel_id)->get();
        return $stats;
    }

    public function getCategoryTravel($user_id, $travel_id)
    {
        $stats = Stats_travel_categories::where('user_id', $user_id)->where('travel_id', $travel_id)->get();
        $categories = Category::all();
        
        return $stats;
    }

}
