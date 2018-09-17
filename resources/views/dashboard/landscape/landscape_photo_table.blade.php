<? session_start() ?>
@extends('layouts.master')

@section('title') Basic_Photography @stop

@section('content')

<div class="content-wrapper" style="min-height: 501px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <span class="fa fa-dashboard"></span> Dashboard
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin Panel</a></li>
            <li class="active">Dashboard</li>
        </ol>
        <a href="{{ route('create_landscape_photo') }}"> <button type="button" class="btn btn-primary new-item" >Add New</button></a>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="col-xs-12">

                <div class="box">

                    <div class="box-header">
                        <h3 class="box-title"><span class="text text-blue">Landscape Photography Table</span> </h3>
                    </div>

                    <div class="box-body">

                        <table id="dataTable" class="table table-bordered table-striped dataTable">

                            <thead>

                            <tr>

                                <th>No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Photo</th>
                                <th>Action</th>

                            </tr>

                            </thead>

                            <tbody>

                            @foreach($landscape_photos as $photo)

                                <tr>
                                    <td>{{ $photo->id }}</td>
                                    <td>{{ $photo->name }}</td>
                                    <td>{{ $photo->description }}</td>
                                    <td>

                                        @foreach($photo->filename as $img)

                                            <a href="{{asset('/photo_guide/landscape_photography/'.$img)}}" target="_blank">
                                                <img src="{{ asset('/photo_guide/landscape_photography/'.$img) }}" style="width:75px; height: 75px">
                                            </a>

                                        @endforeach

                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-modal-{{$photo->id}}">
                                            <span class="fa fa-trash"></span>
                                        </button>
                                        <a href="{{ route('edit_landscape_photo',['id'=>$photo->id]) }}" type="button" class="btn btn-primary btn-sm">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>


                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>

    @foreach($landscape_photos as $photo)

        <div class="modal fade" id="delete-modal-{{$photo->id}}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h2 class="modal-title text-center"><span class="text-danger">Delete?</span> </h2>

                    </div>
                    <div class="modal-body">
                        <p class="text-center">Are you sure want to delete this row?</p>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('delete_landscape_photo',['id'=>$photo->id]) }}" class="btn btn-primary">OK</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

    @endforeach


</div>


@stop