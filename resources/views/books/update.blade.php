
@extends('layouts.master')

@section('title') Book | Update New @stop

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
            <a href="{{ route('book_table') }}"><button type="button" class="btn btn-primary new-item">Back</button></a>
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
                            <h3 class="box-title">Update New Book</h3>
                        </div>
                        <div class="box-body">
                            <form action="{{ route('update_book') }}" method="post" enctype="multipart/form-data">

                                <input type="hidden" name="idx" id="idx" value="{{$book->idx}}">

                                <div class="form-group">
                                    @if($book->cover_photo)
                                        <img src="{{route('cover_photo',['book_cover'=>$book->cover_photo])}}" class="img-rounded" style="width: 100px;height: 80px" alt="...">
                                    @else
                                        <label class="label label-danger">No Cover Image</label>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="cover_photo">Cover Photo :</label>
                                    <input type="file" name="cover_photo">
                                </div>

                                <div class="form-group">
                                    <label for="book_name">Book Name :</label>
                                    <input type="text" name="book_name" class="form-control" value="{{ $book->book_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="content_owner">Content Owner :</label>
                                    <select name="co_id" class="form-control">
                                        @foreach($content_owners as $content_owner )
                                            <option value="{{ $content_owner->idx }}" @if($content_owner->idx === $book->contentOwner->idx) {{ 'selected' }} @endif>{{ $content_owner->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="publisher">Publisher :</label>
                                    <select name="publisher_id" class="form-control">
                                        @foreach($publishers as $publisher)
                                            <option value="{{ $publisher->idx }}" @if($publisher->idx === $book->publisher->idx) {{ 'selected' }} @endif>{{ $publisher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="book_uniq_idx">Book_Uniq_Id :</label>
                                    <input type="text" name="book_uniq_idx" value="{{ $book->book_uniq_idx }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="prize">Prize :</label>
                                    <input type="text" name="prize" value="{{ $book->prize }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary">Add New</button>
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