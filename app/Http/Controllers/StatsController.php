<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\Stats_paymethods_travel;

class StatsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function getPaymethodTravel($user_id)
    {
        $stats = Stats_paymethods_travel::where('user_id', $user_id)->orderBy('travel_id', 'DESC')->get();
        return $stats;
    }

}
