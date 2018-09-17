<?php

namespace App\Http\Controllers;

use App\LandscapePhotography;
use Illuminate\Http\Request;

class LandscapePhotographyController extends Controller
{

    public function index(){

        $landscape_photo = LandscapePhotography::orderBy('id','Desc')->get();

        foreach ($landscape_photo as $photo) {

            $photo->filename = json_decode($photo->filename);

            $filename = array();

            foreach ($photo->filename as $key => $value) {

                $value = asset('/photo_guide/landscape_photography/' . $value);

                $filename[$key] = $value;

            }

            $photo->filename = $filename;

        }

        return response()->json($landscape_photo);

    }

    public function get_landscape_photo_table(){

        $landscape_photos = LandscapePhotography::all();

        foreach ($landscape_photos as $photo) {

            $photo->filename = json_decode($photo->filename);

        }

        return view('dashboard.landscape.landscape_photo_table',compact('landscape_photos'));

    }


    public function get_create_landscape_photo(){

        return view('dashboard.landscape.create_landscape_photo');

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
                $image->move(public_path().'/photo_guide/landscape_photography',$name);
                $data[] = $name;

            }

        }

        $landscape_photo = new LandscapePhotography();

        $landscape_photo->name = $request['name'];
        $landscape_photo->description = $request['description'];
        $landscape_photo->filename = json_encode($data);

        $landscape_photo->save();

        return redirect(route('landscape_photo'))->with('success','Process Successfully.');

    }


    public function delete($id){


        $landscape_photo = LandscapePhotography::find($id);

        $file_names = json_decode($landscape_photo->filename);

        foreach ($file_names as $file_name) {

            unlink(public_path('/photo_guide/landscape_photography/').$file_name);

        }

        $landscape_photo->delete();

        return back()->with('success','Delete Successfully.');

    }


    public function edit($id){

        $landscape_photo = LandscapePhotography::find($id);

        return view('dashboard.landscape.edit_landscape_photo',compact('landscape_photo'));

    }


    public function update(Request $request){

        $landscape_photo =LandscapePhotography::find($request->id);

        $file_names = json_decode($landscape_photo->filename);

        $data = [];


        if($request->hasFile('filename')){

            foreach ($request->file('filename') as $photo) {

                $name = $photo->getClientOriginalName();

                $data[] = $name;

                $photo->move(public_path() . '/photo_guide/landscape_photography', $name);


            }

        }


        $landscape_photo->name = $request['name'] ? $request->name : $landscape_photo->name;

        $landscape_photo->description = $request['description'] ? $request->description : $landscape_photo->description;

        $data = array_merge($data,$file_names);

        $landscape_photo->filename = $request['filename'] ? json_encode($data) : $landscape_photo->filename;


        $landscape_photo->update();

        return redirect(route('landscape_photo'))->with('success','Update Successfully.');
    }


    public function removePhoto(Request $request){

        $landscape_photo = LandscapePhotography::find($request->id);

        $filenames = json_decode($landscape_photo->filename);

        foreach ($filenames as $key=>$value)
        {
            if($value === $request->name)
            {
                unset($filenames[$key]);

                array_values($filenames);

                unlink(public_path('/photo_guide/landscape_photography/').$value);
            }
        }

        $data = array_values($filenames);

        $landscape_photo->filename = json_encode($data);

        $landscape_photo->update();


        return response()->json($landscape_photo,200);
    }

}
