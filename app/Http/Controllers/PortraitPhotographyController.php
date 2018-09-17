<?php

namespace App\Http\Controllers;

use App\PortraitPhotography;
use Illuminate\Http\Request;

class PortraitPhotographyController extends Controller
{

    //for generate api

    public function index(){

        $portrait_photo = PortraitPhotography::orderBy('id','Desc')->get();

        foreach ($portrait_photo as $photo) {

            $photo->filename = json_decode($photo->filename);

            $filename = array();

            foreach ($photo->filename as $key => $value) {

                $value = asset('/photo_guide/portrait_photography/' . $value);

                $filename[$key] = $value;

            }

            $photo->filename = $filename;

        }

        return response()->json($portrait_photo);


    }

    public function get_portrait_photo_table(){

        $portrait_photos = PortraitPhotography::all();

        foreach ($portrait_photos as $photo) {

            $photo->filename = json_decode($photo->filename);

        }

        return view('dashboard.portrait.portrait_photo_table',compact('portrait_photos'));

    }

    public function get_create_portrait_photo(){

        return view('dashboard.portrait.create_portrait_photo');

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
                $image->move(public_path().'/photo_guide/portrait_photography',$name);
                $data[] = $name;

            }

        }

        $portrait_photo = new PortraitPhotography();

        $portrait_photo->name = $request['name'];
        $portrait_photo->description = $request['description'];
        $portrait_photo->filename = json_encode($data);

        $portrait_photo->save();

        return redirect(route('portrait_photo'))->with('success','Process Successfully.');


    }

    public function delete($id){


        $portrait_photo = PortraitPhotography::find($id);

        $file_names = json_decode($portrait_photo->filename);

        foreach ($file_names as $file_name) {

            unlink(public_path('/photo_guide/portrait_photography/').$file_name);

        }

        $portrait_photo->delete();

        return back()->with('success','Delete Successfully.');

    }


    public function edit($id){

        $portrait_photo = PortraitPhotography::find($id);

        return view('dashboard.portrait.edit_portrait_photo',compact('portrait_photo'));

    }


    public function update(Request $request){

        $portrait_photo =PortraitPhotography::find($request->id);

        $file_names = json_decode($portrait_photo->filename);

        $data = [];


        if($request->hasFile('filename')){

            foreach ($request->file('filename') as $photo) {

                $name = $photo->getClientOriginalName();

                $data[] = $name;

                $photo->move(public_path() . '/photo_guide/portrait_photography', $name);


            }

        }


        $portrait_photo->name = $request['name'] ? $request->name : $portrait_photo->name;

        $portrait_photo->description = $request['description'] ? $request->description : $portrait_photo->description;

        $data = array_merge($data,$file_names);

        $portrait_photo->filename = $request['filename'] ? json_encode($data) : $portrait_photo->filename;


        $portrait_photo->update();

        return redirect(route('portrait_photo'))->with('success','Update Successfully.');
    }


    public function removePhoto(Request $request){

        $portrait_photo = PortraitPhotography::find($request->id);

        $filenames = json_decode($portrait_photo->filename);

        foreach ($filenames as $key=>$value)
        {
            if($value === $request->name)
            {
                unset($filenames[$key]);

                array_values($filenames);

                unlink(public_path('/photo_guide/portrait_photography/').$value);
            }
        }

        $data = array_values($filenames);

        $portrait_photo->filename = json_encode($data);

        $portrait_photo->update();


        return response()->json($portrait_photo,200);
    }

}
