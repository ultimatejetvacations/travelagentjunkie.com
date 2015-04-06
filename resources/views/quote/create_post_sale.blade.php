@extends('layouts.master')

@section('title')
    @parent - Create Post Sale
@stop

@section('css')

@stop

@section('js')

@stop

@section('content')
    <div class="container-fluid">
        <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Create Post Sale</h3>
                </div>
                <div class="panel-body text-center">
                    @if($errors->has('token'))
                        <div class="col-sm-12 text-center"></div>
                        <p class="alert alert-danger">{{$errors->first('token')}}</p>
                    @endif
                    <h4>Let's begin creating the post sale.</h4>
                    {!! \Form::open(['method' => 'POST', 'url' => route('quote.createPostSale'), 'class' => 'form-horizontal']) !!}
                        {!! \Form::submit('Create Post Sale', ['class' => 'btn btn-success']) !!}
                        {!! \Form::hidden('token', $quote->token) !!}
                    {!! \Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop