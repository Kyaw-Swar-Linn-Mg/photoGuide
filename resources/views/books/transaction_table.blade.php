
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

                    <div class="box">

                        <div class="box-header">
                            <h3 class="box-title">Book Transaction Table</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td><strong>Date</strong></td>
                                    <td><strong>Book Name</strong></td>
                                    <td><strong>Count</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{$transaction->timetick}}</td>
                                        <td>{{$transaction->books->book_name}}</td>
                                        <td>{{$transaction->count}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                {{$transactions->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@stop