
@extends('layouts.master')

@section('title') Category | Create New @stop

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

            <a href="{{ route('post_table') }}"><button type="button" class="btn btn-primary new-item">Back</button></a>


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

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                    <div class="box">

                        <div class="box-header">
                            <h3 class="box-title"><strong>Create New Post</strong></h3>
                        </div>

                        <div class="box-body">
                            <form action="{{ route('store_post') }}" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="select_post"> Select Post :</label>

                                    <select name="select_post" class="form-control">

                                        @foreach($categories as $category)

                                            <option value="{{ $category->id }}">{{ $category->name }}</option>

                                            @endforeach

                                    </select>

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
                                    <button type="submit" class="btn btn-md btn-primary">Add New</button>
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