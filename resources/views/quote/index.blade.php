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
            // Show hotel info
            $(document).on('click', '.hotel_more_info', function () {
               $(this).closest('tr').next().fadeToggle(function () {
                   // Set black background height for modal window
                   var height = $(this).closest('.modal').find('.modal-dialog').outerHeight();
                   var minHeight = $(document.body).height();
                   $(this).closest('.modal').find('.modal-backdrop').css({
                       'height': height + 60,
                       'min-height' : minHeight
                   });
               });

                if($(this).text() == 'More Info ▼')
                    $(this).text('Less Info ▲');
                else
                    $(this).text('More Info ▼');

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
    @foreach($options as $key => $option)
        <div class="modal fade" id="modal-{{$key+1}}" tabindex="-1" role="dialog" aria-labelledby="detailsModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Option {{$key+1}} of {{count($options)}}</h4>
                    </div>
                    <div class="modal-body">

                        {{--Flights--}}
                        @if(count($option->airlines()->get())>0)
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Flights</h3>
                                </div>
                                <div class="panel-body">

                                    @foreach($option->airlines()->get() as $airline_key => $airline)
                                        <div class="table-responsive">
                                            <table class="table table-bordered">

                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th>Airline</th>
                                                        <th>flight #</th>
                                                        <th>From</th>
                                                        <th>To</th>
                                                        <th>Date</th>
                                                        <th>Departure Time</th>
                                                        <th>Arrival Time</th>
                                                        <th># of Passengers</th>
                                                        <th>Total Price</th>
                                                    </tr>
                                                </thead>

                                                <tbody class="marginTop20">
                                                @foreach($airline->airfares()->get() as $airfare_key => $airfare)
                                                    <tr>
                                                        @if($airfare_key == 0)
                                                            <td class="text-center" rowspan="{{count($airline->airfares()->get())}}"><input checked type="checkbox" name="air[]" class="airfare_option_choice" value="" price=""></td></td>
                                                        @endif
                                                        <td>{{$airfare->airline()->get()->first()->airline_name}}</td>
                                                        <td>{{$airfare->flight_number}}</td>
                                                        <td>{{$airfare->departure_from}}</td>
                                                        <td>{{$airfare->departure_to}}</td>
                                                        <td>{{$airfare->departure_date}}</td>
                                                        <td>{{$airfare->departure_time}}</td>
                                                        <td>{{$airfare->arrival_time}}</td>

                                                        @if($airfare_key == 0)
                                                            <td class="text-center" rowspan="{{count($airline->airfares()->get())}}">{{$airline->number_of_passengers}}</td>
                                                        @endif

                                                        @if($airfare_key == 0)
                                                            <td class="text-center" rowspan="{{count($airline->airfares()->get())}}">{{$airline->price}}</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                </tbody>

                                            </table>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @endif

                        {{--Hotel--}}
                        @if(count($option->rooms()->get())>0)
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Hotel</h3>
                                </div>
                                <div class="panel-body">

                                    <div class="table-responsive">
                                        <table class="table table-bordered">

                                            <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>Hotel Name</th>
                                                <th>Room Name</th>
                                                <th>Check In</th>
                                                <th>Check Out</th>
                                                <th>Number Of Guests</th>
                                                <th>Nightly Rate</th>
                                                <th>Total Price (incl. Tax and Resort Fees)</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                            </thead>

                                            <tbody class="marginTop20">
                                                @foreach($option->rooms()->get() as $room)
                                                    <?php
                                                    // Calculate number of nights (considering free nights)
                                                    $nights = round((strtotime($room->checkout) - strtotime($room->checkin)) / 86400);
                                                    $nights = $nights - $room->free_nights; // nights minus free nights

                                                    // Calculate nightly rate price
                                                    $total_nightly_price = $nights * $room->nightly_rate;

                                                    // Extra Persons Charges for Room
                                                    $extra_person_fees = 0;
                                                    foreach($room->extraPersons()->get() as $extraPerson):
                                                        // calculate all the extra person charges for room
                                                        $extra_person_fees += ($extraPerson->extra_persons * $room->extra_person_fee) * $extraPerson->extra_person_nights;
                                                    endforeach;

                                                    // adult service fees
                                                    if($room->adult_service_fee_type == "$") {
                                                        $adult_service_fees = $room->number_of_adults * $nights * $room->adult_service_fee;
                                                    } else { // %
                                                        $adult_service_fees = ($room->number_of_adults * $nights) * ($room->adult_service_fee / 100);
                                                    }

                                                    // child service fees
                                                    if($room->child_service_fee_type == "$") {
                                                        $child_service_fees = $room->number_of_children * $nights * $room->child_service_fee;
                                                    } else { // %
                                                        $child_service_fees = ($room->number_of_children * $nights) * ($room->child_service_fee / 100);
                                                    }

                                                    // Tax -- Applies to Total Nightly Rate + Extra Person Charges
                                                    $total_nightly_price = $total_nightly_price + $extra_person_fees + $adult_service_fees + $child_service_fees;
                                                    $tax_amount = $total_nightly_price * ($room->tax / 100);
                                                    $total_nightly_price = $total_nightly_price + $tax_amount;

                                                    // Total Room Price - factor in discount, if any.
                                                    $total_price = $total_nightly_price - $room->discount;
                                                    ?>
                                                    <tr>
                                                        <td><input checked type="checkbox" name="hotel_room[]" class="hotel_room_choice" value="" price="" ></td>
                                                        <td>{{$room->room()->get()->first()->hotel()->get()->first()->name_}}</td>
                                                        <td>{{$room->room()->get()->first()->nombre}}</td>
                                                        <td>{{$room->checkin}}</td>
                                                        <td>{{$room->checkout}}</td>
                                                        <td>{{$room->number_of_adults+$room->number_of_children+$room->number_of_infants}}</td>
                                                        <td>{{$room->nightly_rate}}</td>
                                                        <td>{{number_format($total_price,2)}}</td>
                                                        <td><a href="#" class="hotel_more_info">More Info ▼</a></td>
                                                    </tr>
                                                    <tr class="hidden">
                                                        <td colspan="9" class="room_description">
                                                            <h5 class="col-xs-12">{{$room->room()->get()->first()->hotel()->get()->first()->name_}}</h5>
                                                            <div style="white-space: pre-wrap" class="col-xs-12 well well-sm">{{$room->room()->get()->first()->descripcion}}</div>

                                                            @foreach($room->photos()->get() as $photo_record)
                                                                @if($photo_record->id_hotel_photo > 0)
                                                                    <div class="col-xs-4 marginBottom20">
                                                                        <img class="img-rounded" width="100%" src="http://www.ultimatejetvacations.com/images_resort/{{$photo_record->hotelPhoto()->get()->first()->path}}" />
                                                                    </div>
                                                                @else
                                                                    <div class="col-xs-4 marginBottom20">
                                                                        <img class="img-rounded" width="100%" src="http://www.ultimatejetvacations.com/images_resort/{{$photo_record->roomPhoto()->get()->first()->path}}" />
                                                                    </div>
                                                                @endif
                                                            @endforeach

                                                            @if(count($room->promotion()->get())>0)
                                                                <div class="col-xs-12">
                                                                    <h6>Promotion - {{$room->promotion()->get()->first()->name_}}</h6>
                                                                    <div style="white-space: pre-wrap" class="col-xs-12 well well-sm">{{$room->promotion()->get()->first()->description}}</div>
                                                                </div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>

                                </div>
                            </div>
                        @endif


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success">Approve Option</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Greetings</h3>
                    </div>
                    <div class="panel-body">
                        @if( ! empty($quote->greeting) )
                            {{$quote->greeting}}
                        @endif
                    </div>
                </div>
            </div>
        </div>

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
                            <a data-quote-option-id="{{$option->quote_option_id}}" class="view-details" href="" data-toggle="modal" data-target="#modal-{{$key+1}}">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@stop