<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\Category;

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

    public function create(Request $request)
    {
        $validate = $this->validate($request, [
            'name' => 'required|unique:pay_methods,name'
        ]);

        $category = new Category;
        $category->name = $request->input('name');
        //$category->pic = $request->input('pic');
        //$category->file = $request->input('file');

        $saveCategory = $category::createCategory($category);

        if($saveCategory){
            return (new response($saveCategory, 201));
        }
        else
        {
            return (new response($saveCategory, 404));
        }
    }


    //
}
