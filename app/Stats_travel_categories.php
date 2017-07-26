<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stats_travel_categories extends Model
{
    protected $table = 'stats_travel_categories';

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
