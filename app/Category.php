<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    protected $table = 'categories';

    public static function createCategory($category){
        $filepath="assets/img/icons/categories/";
        $fileName = $category->pic;
        $category->pic = $filepath . $fileName;
        $file = $category->file;

        //Storage::move($file , 'public/' . $filepath . $fileName);

        try{
            $category->save();
            return $category;
        }
        catch(Exception $e)
        {
            return $e;
        }
    }
}
