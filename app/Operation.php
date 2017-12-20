<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    public static function saveOperation($operation){
        try{
            $operation->save();
            return $operation;
        }
        catch(Exception $e)
        {
            return $e;
        }
    }

    public static function updateOperation($operation){
        try{
            $operation->save();
            return $operation;
        }
        catch(Exception $e)
        {
            return $e;
        }
    }


	public function pay_methods(){
		return $this->belongsTo('Pay_method', 'id');
	}
	public function travels(){
		return $this->belongsTo('Travel', 'id');
	}
}
