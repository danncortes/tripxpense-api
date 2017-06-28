<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
    * All Categories
    */
    public function index()
    {
        $categories = Category::all();
        return $categories;
        
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if($category!= null){
            try
                {
                    $category->delete();
                    return (new response($category, 200));
                }
            catch(Exception $e)
                {
                    return $e->getMessage();
                }
        }else{
            return (new response($category, 404));
        }
    }


    //
}
