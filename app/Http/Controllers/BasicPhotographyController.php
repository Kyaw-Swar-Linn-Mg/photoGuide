<?php

namespace App\Http\Controllers;

use App\BasicPhotography;
use Faker\Provider\File;
use Illuminate\Http\Request;

class BasicPhotographyController extends Controller
{

    public function index(){

        $basic_photo = BasicPhotography::orderBy('id','Desc')->get();


        foreach ($basic_photo as $photo) {

            $photo->filename = json_decode($photo->filename);

            $filename = array();

            foreach ($photo->filename as $key => $value) {

                $value = asset('/photo_guide/basic_photography/' . $value);

                $filename[$key] = $value;

            }

            $photo->filename = $filename;

        }

        return response()->json($basic_photo);

    }

    public function get_basic_photo_table(){

        $basic_photo = BasicPhotography::all();


        foreach ($basic_photo as $photo) {

            $photo->filename = json_decode($photo->filename);

        }


        return view('dashboard.basic.basic_photo_table',compact('basic_photo'));

    }

    public function get_create_basic_photo(){

        return view('dashboard.basic.create_basic_photo');

    }

    public function store(Request $request){

        $this->validate($request,[

            'name' => 'required',
            'description' => 'required',
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);

        if($request->hasFile('filename')){

            foreach($request->file('filename') as $image){

                $name = $image->getClientOriginalName();

                $image->move(public_path().'/photo_guide/basic_photography',$name);

                $data[] = $name;

            }

        }

        $basic_photo = new BasicPhotography();

        $basic_photo->name = $request['name'];
        $basic_photo->description = $request['description'];
        $basic_photo->filename = json_encode($data);

        $basic_photo->save();

        return redirect(route('basic_photo'))->with('success','Process Successfully.');

    }

    public function delete($id){


        $basic_photo = BasicPhotography::find($id);

        $file_names = json_decode($basic_photo->filename);

        foreach ($file_names as $file_name) {

            unlink(public_path('/photo_guide/basic_photography/').$file_name);

        }

        $basic_photo->delete();

        return back()->with('success','Delete Successfully.');

    }


    public function edit($id){

        $basic_photo = BasicPhotography::find($id);

        return view('dashboard.basic.edit_basic_photo',compact('basic_photo'));

    }

    public function update(Request $request){

        $basic_photo =BasicPhotography::find($request->id);

        $file_names = json_decode($basic_photo->filename);

        $data = [];


        if($request->hasFile('filename')){

            foreach ($request->file('filename') as $photo) {

                $name = $photo->getClientOriginalName();

                $data[] = $name;

                $photo->move(public_path() . '/photo_guide/basic_photography', $name);


            }

        }


        $basic_photo->name = $request['name'] ? $request->name : $basic_photo->name;

        $basic_photo->description = $request['description'] ? $request->description : $basic_photo->description;

        $data = array_merge($data,$file_names);

        $basic_photo->filename = $request['filename'] ? json_encode($data) : $basic_photo->filename;


        $basic_photo->update();

        return redirect(route('basic_photo'))->with('success','Update Successfully.');
    }

    public function removePhoto(Request $request){

        $basic_photo = BasicPhotography::find($request->id);

        $filenames = json_decode($basic_photo->filename);

        foreach ($filenames as $key=>$value)
        {
            if($value === $request->name)
            {
                unset($filenames[$key]);

                array_values($filenames);

                unlink(public_path('/photo_guide/basic_photography/').$value);
            }
        }

        $data = array_values($filenames);

        $basic_photo->filename = json_encode($data);

        $basic_photo->update();


        return response()->json($basic_photo,200);
    }

}
