
@extends('layouts.master')

@section('title') Photo Guide | Create New @stop

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

            <a href="{{ route('basic_photo') }}"><button type="button" class="btn btn-primary new-item">Back</button></a>

        </section>

        <section class="content">

            <div class="row">

                <div class="col-xs-6">

                    @if ($errors->any())

                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif


                    <div class="box">

                        <div class="box-header">
                            <h3 class="box-title"><span class="text text-blue">Create New Basic Photo</span> </h3>
                        </div>

                        <div class="box-body">
                            <form action="{{ route('store_basic_photo') }}" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="name"> Name :</label>
                                    <input type="text" name="name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description :</label>
                                    <textarea name="description" class="form-control"></textarea>
                                </div>

                                <div class="form-group">

                                    <label for="description">Choose Photo :</label>

                                      <div class="input-group control-group increment" >

                                        <input type="file" name="filename[]" multiple class="form-control uploadImageFile">

                                        <div class="input-group-btn">
                                            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                        </div>

                                    </div>


                                    <div class="clone hide">


                                        <div class="control-group input-group" style="margin-top:10px">

                                            <input type="file" name="filename[]" class="form-control uploadImageFile">

                                            <div class="input-group-btn">
                                                <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-primary">Add New</button>
                                </div>

                                {{ csrf_field() }}

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>

@stop

@section('script')

    <script>

        $(document).ready(function() {

            $(".btn-success").click(function(){

                var html = $(".clone").html();

                $(".increment").after(html);

            });

            $("body").on("click",".btn-danger",function(){

                $(this).parents(".control-group").remove();

            });

        });

    </script>


@stop