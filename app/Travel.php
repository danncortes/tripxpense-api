<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $table = 'travels';

    public static function createTravel($travel){
        try{
            $travel->save();
            return $travel;
        }
        catch(Exception $e)
        {
            return $e;
        }
    }

    public static function updateTravel($travel){
        try{
            $travel->save();
            return $travel;
        }
        catch(Exception $e)
        {
            return $e;
        }
    }

}
