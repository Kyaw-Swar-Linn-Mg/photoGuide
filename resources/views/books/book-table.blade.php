<? session_start() ?>
@extends('layouts.master')

@section('title') Book Table @stop

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
            <a href="{{ route('create_book') }}"> <button type="button" class="btn btn-primary new-item" >Add New Book</button></a>
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
                            <h3 class="box-title">Book Table</h3>
                        </div>
                        <table class="table table-responsive table-bordered" id="bookTable">
                            <thead>
                            <tr>
                                <th>No_</th>
                                <th>Book Name</th>
                                <th>Content Owner</th>
                                <th>Publisher</th>
                                <th>Book Uniq_Id</th>
                                <th>Cover Photo</th>
                                <th>Prize</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($books as $key=> $book)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td style="width: 15em;">{{ $book->book_name }}</td>
                                <td style="width: 10em;">{{ $book->contentOwner->name }}</td>
                                <td>{{ $book->publisher->name }}</td>
                                <td>{{ $book->book_uniq_idx }}</td>
                                <td><img src="{{route('cover_photo',['book_cover'=>$book->cover_photo])}}" class="img-rounded" style="width: 100px;height: 80px" alt="..."> </td>
                                <td>{{ $book->prize }}</td>
                                <td>{{ $book->created_at }}</td>
                                <td style="width: 7.5em;">
                                    <a class="btn btn-primary" href="{{ route('edit_book',['id'=>$book->idx]) }}">Edit</a> |
                                    <a href="{{route('delete_book',['id'=>$book->idx])}}" class="btn btn-danger btn-lgr"><span class="fa fa-trash"></span> </a>
                                </td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>

    </div>


    @stop