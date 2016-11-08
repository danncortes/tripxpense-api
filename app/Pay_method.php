<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pay_method extends Model
{

    public static function createPay_method($pay_method){
        try{
            $pay_method->save();
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
    }
}
