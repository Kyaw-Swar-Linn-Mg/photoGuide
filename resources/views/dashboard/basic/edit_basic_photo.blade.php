
@extends('layouts.master')

@section('title') Photo Guide | Update New @stop

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
                            <h3 class="box-title"><span class="text text-blue">Update Basic Photo</span> </h3>
                        </div>

                        <div class="box-body">

                            <form action="{{ route('update_basic_photo') }}" method="post" enctype="multipart/form-data">

                                <input type="hidden" name="id" id="id" value="{{ $basic_photo->id }}">

                                <div class="form-group">
                                    <label for="name"> Name :</label>
                                    <input type="text" name="name" value="{{ $basic_photo->name }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description :</label>
                                    <textarea name="description" class="form-control">{{ $basic_photo->description }}</textarea>
                                </div>



                                    @foreach(json_decode($basic_photo->filename) as $key=>$value)
                                    <div class="col-sm-6 col-md-6 col-lg-6" id="{{$key}}">
                                        <div class="thumbnail">
                                            <div class="frow">
                                                <button type="button" key={{$key}} name="{{$value}}" id="{{$basic_photo->id}}" class="btnRemove btn-sm text-danger pull-right"><span class="fa fa-remove"></span></button>
                                            </div>
                                            <div class="secrow" style="text-align: center;">
                                                <img class="img" src="{{asset('/photo_guide/basic_photography/'.$value)}}" width="100px" height="100px">
                                            </div>
                                        </div>
                                    </div>


                                    @endforeach


                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">

                                        <label for="description">Choose Photo :</label>

                                        <div class="input-group control-group">

                                            <input type="file" name="filename[]"  multiple>

                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-md btn-primary">Update</button>
                                    </div>
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

            $(".btnRemove").click(function(){
                let id = this.id;
                let photo_name = this.name;
                let url = "/remove_basic_photo";

                $.ajax({
                    url : url,
                    type : "POST",
                    data : { id : id, name : photo_name , _token : "{{csrf_token()}}" },
                    success : function (msg) {
                        console.log(msg);
                        $("#".concat($(".btnRemove").attr('key'))).fadeOut();
                    }
                });
            });

    </script>


@stop