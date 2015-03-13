@extends('layouts.master')

@section('title')
    @parent - Home
@stop

@section('css')
    <link rel="stylesheet" href="assets/vendor/material-card.css"/>
@stop

@section('js')
    <script>
        $(document).ready(function () {

            /*
             |--------------------------------------------------------------------------
             | Page Events
             |--------------------------------------------------------------------------
             */
            $(document).on('click', '.view-details', function(){
                $('#details-modal').modal('show');
                return false;
            });

            /*
             |--------------------------------------------------------------------------
             | Stylizing features
             |--------------------------------------------------------------------------
             */
            function normalizeContainerHeight(cssClassGet, cssClassSet)
            {
                var height = 0;

                $(cssClassGet).each(function () {
                    if($(this).height() > height)
                        height = $(this).height();
                    console.log(height);
                });

                $(cssClassSet).each(function () {
                    $(this).height(height);
                });
            }

            var timeOut;
            $(window).on('resize', function () {
                clearTimeout(timeOut);
                timeOut = setTimeout(function(){
                    normalizeContainerHeight('.card-container > .card > .card-content > p', '.card-container > .card > .card-content');
                    normalizeContainerHeight('.card-container > .card > .card-title > h5', '.card-container > .card > .card-title');
                }, 500)
            });

            normalizeContainerHeight('.card-container > .card > .card-content > p', '.card-container > .card > .card-content');
            normalizeContainerHeight('.card-container > .card > .card-title > h5', '.card-container > .card > .card-title');

        });
    </script>
@stop

@section('content')
    {{--Modal window--}}
    <div class="modal fade" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="detailsModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            @foreach($options as $key => $option)
                <div class="col-xs-12 col-sm-4 col-md-3 card-container">
                    <div class="card">
                        <div class="card-title">
                            <h5 class="text-center">{{$key+1}}</h5>
                        </div>

                        @if( ! empty($option->photos()->get()->first()->hotelPhoto()->get()->first()->path) )
                        <div class="card-image">
                            <img class="img-responsive" src="http://www.ultimatejetvacations.com/images_resort/{{$option->photos()->get()->first()->hotelPhoto()->get()->first()->path}}">
                        </div>
                        @endif

                        <div class="card-content">
                            <p>Amangani (peaceful home) clings to the crest of East Gros Ventre Butte, some 2,135m above sea...</p>
                        </div>

                        <div class="card-action text-right">
                            <a data-quote-option-id="{{$option->quote_option_id}}" class="view-details" href="#">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
@stop