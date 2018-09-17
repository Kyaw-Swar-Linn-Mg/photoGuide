<? session_start() ?>
@extends('layouts.master')

@section('title') Post Table @stop

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
            <a href="{{ route('post') }}"> <button type="button" class="btn btn-primary new-item" >Add New</button></a>
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
                            <h3 class="box-title"><span class="text-blue">Posts Table</span> </h3>
                        </div>

                        <div class="box-body">

                            <table id="dataTable" class="table table-bordered table-striped dataTable">

                                <thead>

                                <tr>

                                    <th>No</th>
                                    <th>Category Name</th>
                                    <th>Photo</th>
                                    <th>Action</th>

                                </tr>

                                </thead>

                                <tbody>

                                @foreach($posts as $photo)

                                    <tr>
                                        <td>{{ $photo->id }}</td>

                                        <td>{{ $photo->category_name }}</td>

                                        <td>

                                            @foreach($photo->filename as $img)

                                                <a href="{{asset('/photo_guide/post/'.$img)}}" target="_blank">
                                                    <img src="{{ asset('/photo_guide/post/'.$img) }}" style="width:75px; height: 75px">
                                                </a>

                                            @endforeach

                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-modal-{{$photo->id}}">
                                                <span class="fa fa-trash"></span>
                                            </button>
                                            <a href="{{ route('edit_post',['id'=>$photo->id]) }}" type="button" class="btn btn-primary btn-sm">
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


        @foreach($posts as $photo)

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
                            <a href="{{ route('delete_post',['id'=>$photo->id]) }}" class="btn btn-primary">OK</a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

    </div>


@stop
