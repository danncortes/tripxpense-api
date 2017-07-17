<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pay_method extends Model
{
    public static function createPay_method($pay_method){
        try{
            $pay_method->save();
            return $pay_method;
        }
        catch(Exception $e)
        {
            return $e;
        }
    }

    public static function updatePay_method($pay_method){
        try{
            $pay_method->save();
            return $pay_method;
        }
        catch(Exception $e)
        {
            return $e;
        }
    }
}
