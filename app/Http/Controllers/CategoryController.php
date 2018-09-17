<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category_form(){

        $categories = Category::all();
        return view('dashboard.category & post.category',compact('categories'));

    }

    public function store(Request $request){

        $this->validate($request,[

            'name'=>'required'

        ]);

        $category = new Category();

        $category->name = $request['name'];

        $category->save();

        return redirect()->back();

    }
}
