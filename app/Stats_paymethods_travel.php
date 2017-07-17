<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stats_paymethods_travel extends Model
{
    protected $table = 'stats_paymethods_travel';

    public static function createStat($stat){
        try{
            $stat->save();
            return $stat;
        }
        catch(Exception $e)
        {
            return $e;
        }
    }

}
