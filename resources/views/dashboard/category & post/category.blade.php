
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


        </section>

        <section class="content">

            <div class="row">

                <div class="col-xs-4">

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
                            <h3 class="box-title"><strong>Create New Category</strong></h3>
                        </div>

                        <div class="box-body">
                            <form action="{{ route('store_category') }}" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="name"> Name :</label>
                                    <input type="text" name="name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-md btn-primary">Add New</button>
                                </div>

                                {{ csrf_field() }}

                            </form>

                        </div>

                    </div>

                </div>

                <div class="col-xs-6 col-xs-offset-1 ">

                    <div class="box">

                        <div class="box-header">
                            <h3 class="box-title"><strong>Category table</strong></h3>
                        </div>

                        <div class="box-body">

                            <table id="dataTable" class="table table-bordered table-striped dataTable">

                                <thead>

                                <tr>

                                    <th>No</th>
                                    <th>Category Name</th>

                                </tr>

                                </thead>

                                <tbody>

                                @foreach($categories as $category)
                                    <tr>

                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>

                                    </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>

@stop

@section('script')

    <script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>

    <script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>


@stop