<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index(){

        $posts = Post::orderBy('id','Desc')->with('category')->get();

        foreach ($posts as $post){

            $post->filename = json_decode($post->filename);

            $filename = array();

            foreach ($post->filename as $key=>$value){

                $value = asset('/photo_guide/post/' . $value);

                $filename[$key] = $value;

            }

            $post->filename = $filename;

        }

        return response()->json($posts);

    }


    public function get_post_table(){

        $posts = Post::orderBy('id','Desc')->get();

        $categories = Category::all();

        foreach ($posts as $photo) {

            $photo->filename = json_decode($photo->filename);

        }

        return view('dashboard.category & post.post_table',compact('posts','categories'));

    }

    public function post_form(){

        $categories = Category::all();

        return view('dashboard.category & post.create_post',compact('categories'));

    }

    public function store(Request $request){

        $this->validate($request,[

           'select_post'=>'required',
           'filename'=>'required',
           'filename.*'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);

        if($request->hasFile('filename')){

            foreach ($request->file('filename') as $image){

                $name = $image->getClientOriginalName();
                $image->move(public_path().'/photo_guide/post',$name);
                $data[] = $name;

            }
        }

        $posts = new Post();

        $posts->category_id = $request['select_post'];

        $posts->filename = json_encode($data);

        $posts->save();

        return redirect(route('post_table'))->with('success','Process Successfully.');

    }


    public function delete($id){


        $post = Post::find($id);

        $file_names = json_decode($post->filename);

        foreach ($file_names as $file_name) {

            unlink(public_path('/photo_guide/post/').$file_name);

        }

        $post->delete();

        return back()->with('success','Delete Successfully.');

    }


    public function edit($id){

        $category = Category::all();

        $post = Post::where('id',$id)->first();


        return view('dashboard.category & post.edit_post',compact('post','category'));

    }

    public function update(Request $request){

        $post = Post::find($request->id);

        $file_names = json_decode($post->filename);

        $data = [];


        if($request->hasFile('filename')){

            foreach ($request->file('filename') as $photo) {

                $name = $photo->getClientOriginalName();

                $data[] = $name;

                $photo->move(public_path() . '/photo_guide/post', $name);


            }

        }


        $post->category_id = $request['select_post'] ? $request['select_post'] : $post->category_id;

        $data = array_merge($data,$file_names);

        $post->filename = $request['filename'] ? json_encode($data) : $post->filename;


        $post->update();

        return redirect(route('post_table'))->with('success','Update Successfully.');
    }

    public function removePhoto(Request $request){

        $post = Post::find($request->id);

        $filenames = json_decode($post->filename);

        foreach ($filenames as $key=>$value)
        {
            if($value === $request->name)
            {
                unset($filenames[$key]);

                array_values($filenames);

                unlink(public_path('/photo_guide/post/').$value);
            }
        }

        $data = array_values($filenames);

        $post->filename = json_encode($data);

        $post->update();


        return response()->json($post,200);
    }

}
