@extends('layouts.master')

@section('title')
    @parent - Home
@stop

@section('css')
    <link rel="stylesheet" href="/assets/vendor/material-card.css"/>
    <style>
        .custom-close {
            line-height: 1.2 !important;
            margin: 0 0 0 10px !important;
        }
        .input-container {
            width: 30px !important;
        }
        .modal {
            overflow-y: auto !important;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function () {

            /*
             |--------------------------------------------------------------------------
             | Page functions
             |--------------------------------------------------------------------------
             */
            function roundNumber(number, decimals){
                return Number(Math.round(number+'e'+decimals)+'e-'+decimals);
            }

            function adjustSummary(input)
            {
                var modal = input.closest('.modal');
                var modalInfo = modal.find('.modal-info');
                var summaryAffix = modal.find('.summary-affix');
                var summary = modal.find('.summary');

                // Air
                var airContainer = modalInfo.find('.air-container');
                adjustAir(airContainer, summary, summaryAffix);

                // Transfer
                var transferContainer = modalInfo.find('.transfer-container');
                adjustTransfer(transferContainer, summary, summaryAffix);

                // Hotel
                var hotelContainer = modalInfo.find('.hotel-container');
                adjustHotel(hotelContainer, summary, summaryAffix);

                // Excursion
                var excursionContainer = modalInfo.find('.excursion-container');
                adjustExcursion(excursionContainer, summary, summaryAffix);

                // Insurance
                var insuranceContainer = modalInfo.find('.insurance-container');
                adjustInsurance(insuranceContainer, summary, summaryAffix);

                // Additional Services
                var additionalContainer = modalInfo.find('.additional-container');
                adjustAdditional(additionalContainer, summary, summaryAffix);

                // Total
                adjustTotal(summary, summaryAffix);
            }

            function adjustAir(container, summary, summaryAffix)
            {
                var total = 0;
                var summaryTable = summary.find('table.table');
                var summaryAffixTable = summaryAffix.find('table.table');

                $('.airfare_option_choice', container).each(function () {
                    if( $(this).is(':checked') )
                        total += roundNumber( parseFloat($(this).attr('price')) ,2);
                });

                summaryAffixTable.find('tbody > tr.air-summary > td:last-child').text('$'+roundNumber(total,2));
                summaryTable.find('tbody > tr.air-summary > td:last-child').text('$'+roundNumber(total,2));

                if(total > 0)
                {
                    summaryAffixTable.find('tbody > tr.air-summary').fadeIn('fast');
                    summaryTable.find('tbody > tr.air-summary').fadeIn('fast');
                }
                else
                {
                    summaryAffixTable.find('tbody > tr.air-summary').fadeOut('fast');
                    summaryTable.find('tbody > tr.air-summary').fadeOut('fast');
                }
            }

            function adjustTransfer(container, summary, summaryAffix)
            {
                var total = 0;
                var summaryTable = summary.find('table.table');
                var summaryAffixTable = summaryAffix.find('table.table');

                $('.transfer_option_choice', container).each(function () {
                    if( $(this).is(':checked') )
                        total += roundNumber( parseFloat($(this).attr('price')) ,2);
                });

                summaryAffixTable.find('tbody > tr.transfer-summary > td:last-child').text('$'+roundNumber(total,2));
                summaryTable.find('tbody > tr.transfer-summary > td:last-child').text('$'+roundNumber(total,2));

                if(total > 0)
                {
                    summaryAffixTable.find('tbody > tr.transfer-summary').fadeIn('fast');
                    summaryTable.find('tbody > tr.transfer-summary').fadeIn('fast');
                }
                else
                {
                    summaryAffixTable.find('tbody > tr.transfer-summary').fadeOut('fast');
                    summaryTable.find('tbody > tr.transfer-summary').fadeOut('fast');
                }
            }

            function adjustHotel(container, summary, summaryAffix)
            {
                var total = 0;
                var summaryTable = summary.find('table.table');
                var summaryAffixTable = summaryAffix.find('table.table');

                $('.hotel_option_choice', container).each(function () {
                    if( $(this).is(':checked') )
                        total += roundNumber( parseFloat($(this).attr('price')) ,2);
                });

                summaryAffixTable.find('tbody > tr.hotel-summary > td:last-child').text('$'+roundNumber(total,2));
                summaryTable.find('tbody > tr.hotel-summary > td:last-child').text('$'+roundNumber(total,2));

                if(total > 0)
                {
                    summaryAffixTable.find('tbody > tr.hotel-summary').fadeIn('fast');
                    summaryTable.find('tbody > tr.hotel-summary').fadeIn('fast');
                }
                else
                {
                    summaryAffixTable.find('tbody > tr.hotel-summary').fadeOut('fast');
                    summaryTable.find('tbody > tr.hotel-summary').fadeOut('fast');
                }
            }

            function adjustExcursion(container, summary, summaryAffix)
            {
                var total = 0;
                var summaryTable = summary.find('table.table');
                var summaryAffixTable = summaryAffix.find('table.table');

                $('.excursion_option_choice', container).each(function () {
                    if( $(this).is(':checked') )
                        total += roundNumber( parseFloat($(this).attr('price')) ,2);
                });

                summaryAffixTable.find('tbody > tr.excursion-summary > td:last-child').text('$'+roundNumber(total,2));
                summaryTable.find('tbody > tr.excursion-summary > td:last-child').text('$'+roundNumber(total,2));

                if(total > 0)
                {
                    summaryAffixTable.find('tbody > tr.excursion-summary').fadeIn('fast');
                    summaryTable.find('tbody > tr.excursion-summary').fadeIn('fast');
                }
                else
                {
                    summaryAffixTable.find('tbody > tr.excursion-summary').fadeOut('fast');
                    summaryTable.find('tbody > tr.excursion-summary').fadeOut('fast');
                }
            }

            function adjustInsurance(container, summary, summaryAffix)
            {
                var total = 0;
                var summaryTable = summary.find('table.table');
                var summaryAffixTable = summaryAffix.find('table.table');

                $('.insurance_option_choice', container).each(function () {
                    if( $(this).is(':checked') )
                        total += roundNumber( parseFloat($(this).attr('price')) ,2);
                });

                summaryAffixTable.find('tbody > tr.insurance-summary > td:last-child').text('$'+roundNumber(total,2));
                summaryTable.find('tbody > tr.insurance-summary > td:last-child').text('$'+roundNumber(total,2));

                if(total > 0)
                {
                    summaryAffixTable.find('tbody > tr.insurance-summary').fadeIn('fast');
                    summaryTable.find('tbody > tr.insurance-summary').fadeIn('fast');
                }
                else
                {
                    summaryAffixTable.find('tbody > tr.insurance-summary').fadeOut('fast');
                    summaryTable.find('tbody > tr.insurance-summary').fadeOut('fast');
                }
            }

            function adjustAdditional(container, summary, summaryAffix)
            {
                var total = 0;
                var summaryTable = summary.find('table.table');
                var summaryAffixTable = summaryAffix.find('table.table');

                $('.additional_option_choice', container).each(function () {
                    if( $(this).is(':checked') )
                        total += roundNumber( parseFloat($(this).attr('price')) ,2);
                });

                summaryAffixTable.find('tbody > tr.additional-summary > td:last-child').text('$'+roundNumber(total,2));
                summaryTable.find('tbody > tr.additional-summary > td:last-child').text('$'+roundNumber(total,2));

                if(total > 0)
                {
                    summaryAffixTable.find('tbody > tr.additional-summary').fadeIn('fast');
                    summaryTable.find('tbody > tr.additional-summary').fadeIn('fast');
                }
                else
                {
                    summaryAffixTable.find('tbody > tr.additional-summary').fadeOut('fast');
                    summaryTable.find('tbody > tr.additional-summary').fadeOut('fast');
                }
            }

            function adjustTotal(summary, summaryAffix)
            {
                var total = 0;
                var totalAffix = 0;
                var summaryTable = summary.find('table.table');
                var summaryAffixTable = summaryAffix.find('table.table');

                $('tbody > tr', summaryTable).each(function () {
                    if(! $(this).is(':last-child'))
                    {
                        var text = $('td:last-child', this).text();
                        var value = roundNumber(parseFloat(text.split('$')[1]), 2);
                        total += roundNumber( (typeof value !== typeof undefined && value !== false ? value : 0 ), 2);
                    }
                });

                $('tbody > tr', summaryAffixTable).each(function () {
                    if(! $(this).is(':last-child'))
                    {
                        var text = $('td:last-child', this).text();
                        var value = roundNumber(parseFloat(text.split('$')[1]), 2);
                        totalAffix += roundNumber( (typeof value !== typeof undefined && value !== false ? value : 0 ), 2);
                    }
                });

                summaryTable.find('tbody > tr:last-child > td:last-child').text( '$'+roundNumber(total, 2) );
                summaryAffixTable.find('tbody > tr:last-child > td:last-child').text( '$'+roundNumber(totalAffix, 2) );
            }

            /*
             |--------------------------------------------------------------------------
             | Page Events
             |--------------------------------------------------------------------------
             */
            // Show hotel info
            $(document.body).on('click', '.hotel_more_info', function () {

                $(this).closest('tr').next().fadeToggle(function () {

                    if($(window).height() < 992) {
                        // Set black background height for modal window
                        var height = 0;
                        var tempHeight = $(this).closest('.modal').find('.modal-dialog').outerHeight();
                        height = tempHeight + $(this).closest('.modal').find('.summary').outerHeight();
                        var minHeight = $(document.body).height();
                        $(this).closest('.modal').find('.modal-backdrop').css({
                            'height': height + 90,
                            'min-height': minHeight
                        });
                    } else {
                        // Set black background height for modal window
                        var height = $(this).closest('.modal').find('.modal-dialog').outerHeight();
                        var minHeight = $(document.body).height();
                        $(this).closest('.modal').find('.modal-backdrop').css({
                            'height': height + 90,
                            'min-height': minHeight
                        });
                    }

                });

                if($(this).text() == 'More Info ▼')
                    $(this).text('Less Info ▲');
                else
                    $(this).text('More Info ▼');

                return false;
            });

            // Listener for click on all checkbox
            $(document.body).on('change', 'input[type=checkbox]', function() {
                adjustSummary($(this));
            });

            // Listener for modal navigation
//            $(document.body).on('click', '.modal-navigation', function () {
//                var currentModalId = '#'+$(this).closest('.modal').attr('id');
//
//                // Hide current modal and show target modal
//                $(currentModalId).modal('hide');
//            });

            //Listener for modal show
            $('.modal').on('shown.bs.modal', function () {
                // Work around for modal scroll to work properly
                if($(window).height() < 992) {
                    // Set black background height for modal window
                    var height = 0;
                    var tempHeight = $(this).find('.modal-info').outerHeight();
                    height = tempHeight + $(this).find('.summary').outerHeight();
                    var minHeight = $(document.body).height();
                    $(this).find('.modal-backdrop').css({
                        'height': height + 90,
                        'min-height': minHeight
                    });
                } else {
                    // Set black background height for modal window
                    var height = $(this).find('.modal-info').outerHeight();
                    var minHeight = $(document.body).height();
                    $(this).find('.modal-backdrop').css({
                        'height': height + 90,
                        'min-height': minHeight
                    });
                }
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

            /*
             |--------------------------------------------------------------------------
             | Page Initializations
             |--------------------------------------------------------------------------
             */
            // Initialize summary tables
            $('.modal-info').each(function () {
                var checkbox = $(this).find('input[type=checkbox]:first');
                adjustSummary(checkbox);
            });

        });
    </script>
@stop

@section('content')
    {{--Modal window--}}
    @foreach($options as $key => $option)
        {!! \Form::open(['method' => 'POST', 'url' => route('quote.approveOption', $option->quote_option_id, false)]) !!}
        {{--<form action="{{route('quote.approveOption', $option->quote_option_id)}}" method="POST">--}}
            {{--<input type="hidden" name="_token" value="{{csrf_token()}}">--}}

            <div class="modal fade" id="modal-{{$key+1}}" tabindex="-1" role="dialog" aria-labelledby="detailsModal" aria-hidden="true">

                {{--Modal Info--}}
                <div class="modal-info modal-dialog custom-modal-dialog col-md-8 custom-col-md-8">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close custom-close visible-xs visible-sm" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">
                                Option {{$key+1}} of {{count($options)}}

                                {{--<div class="modal-navigation pull-right">--}}
                                    {{--<a class="modal-navigation btn btn-success btn-xs @if($key+1 < 2) disabled @endif" href="#" data-toggle="modal" data-target="#modal-{{$key}}" class="btn btn-success btn-sm" href="#"><i class="fa fa-long-arrow-left"></i></a>--}}
                                    {{--<a class="modal-navigation btn btn-success btn-xs @if($key+1 >= count($options)) disabled @endif" href="#" data-toggle="modal" data-target="#modal-{{$key+2}}" class="btn btn-success btn-sm" href="#"><i class="fa fa-long-arrow-right"></i></a>--}}
                                    {{--<button type="button" class="close custom-close visible-xs visible-sm" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                                {{--</div>--}}
                            </h4>
                        </div>
                        <div class="modal-body">

                            {{--Flights--}}
                            @if(count($option->airlines()->get())>0)
                                <div class="air-container panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Flights <i class="fa fa-plane pull-right"></i></h3>
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
                                                                <td class="text-center input-container" rowspan="{{count($airline->airfares()->get())}}"><input checked type="checkbox" name="air[]" class="airfare_option_choice" value="{{$airline->quote_airline_id}}" price="{{$airline->price}}"></td></td>
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
                                                                <td class="text-center" rowspan="{{count($airline->airfares()->get())}}">{{number_format($airline->price,2)}}</td>
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

                            {{--Transfers--}}
                            @if(count( $option->vendors()->get()->filter(function($item) { return ($item->vendor_id > 0 && $item->vendor()->get()->first()->type == 'Transfer'); })->all() )>0)
                                <div class="transfer-container panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Transfers <i class="fa fa-car pull-right"></i></h3>
                                    </div>
                                    <div class="panel-body">

                                        <div class="table-responsive">
                                            <table class="table table-bordered">

                                                <thead>
                                                <tr>
                                                    <th>&nbsp;</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Price</th>
                                                </tr>
                                                </thead>

                                                <tbody class="marginTop20">
                                                @foreach($option->vendors()->get()->filter(function($item) { return ($item->vendor_id > 0 && $item->vendor()->get()->first()->type == 'Transfer'); })->all() as $service)
                                                    <tr>
                                                        <td class="text-center input-container"><input checked type="checkbox" name="service[]" class="transfer_option_choice" value="{{$service->quote_options_vendor_id}}" price="{{$service->price}}"></td>
                                                        <td>{{$service->vendor()->get()->first()->vendor_name}}</td>
                                                        <td>{{$service->description}}</td>
                                                        <td>{{$service->price}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>

                                            </table>
                                        </div>

                                    </div>
                                </div>
                            @endif

                            {{--Hotel--}}
                            @if(count($option->rooms()->get())>0)
                                <div class="hotel-container panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Hotel <i class="fa fa-bed pull-right"></i></h3>
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
                                                            <td class="text-center input-container"><input checked type="checkbox" name="hotel_room[]" class="hotel_option_choice" value="{{$room->quote_option_room_id}}" price="{{$total_price}}"></td>
                                                            <td>{{$room->room()->get()->first()->hotel()->get()->first()->name_}}</td>
                                                            <td>{{$room->room()->get()->first()->nombre}}</td>
                                                            <td>{{$room->checkin}}</td>
                                                            <td>{{$room->checkout}}</td>
                                                            <td>{{$room->number_of_adults+$room->number_of_children+$room->number_of_infants}}</td>
                                                            <td>{{$room->nightly_rate}}</td>
                                                            <td>{{number_format($total_price,2)}}</td>
                                                            <td><a href="#" class="hotel_more_info">Less Info ▲</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="9" class="room_description">
                                                                <h5 class="col-xs-12">{{$room->room()->get()->first()->hotel()->get()->first()->name_}}</h5>
                                                                <div style="white-space: pre-wrap" class="col-xs-12 well well-sm">{!!\String::BBCode2Html($room->room()->get()->first()->descripcion)!!}</div>

                                                                @foreach($room->photos()->get() as $photo_record)
                                                                    @if($photo_record->id_hotel_photo > 0)
                                                                        <div class="col-xs-4 marginBottom20">
                                                                            <img class="img-rounded" width="100%" src="//www.ultimatejetvacations.com/images_resort/{{$photo_record->hotelPhoto()->get()->first()->path}}" />
                                                                        </div>
                                                                    @else
                                                                        <div class="col-xs-4 marginBottom20">
                                                                            <img class="img-rounded" width="100%" src="//www.ultimatejetvacations.com/images_resort/{{$photo_record->roomPhoto()->get()->first()->path}}" />
                                                                        </div>
                                                                    @endif
                                                                @endforeach

                                                                @if(count($room->promotion()->get())>0)
                                                                    <div class="col-xs-12">
                                                                        <h6>Promotion - {{ $room->promotion()->get()->first()->name_}}</h6>
                                                                        <div style="white-space: pre-wrap" class="col-xs-12 well well-sm">{!!\String::BBCode2Html($room->promotion()->get()->first()->description)!!}</div>
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

                            {{--Virtuoso Amenities--}}
                            @if(count($option->rooms()->get()->filter(function($item) { return $item->include_virtuoso_amenities == 'y'; } )->all()) > 0)
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Exclusive Amenities <i class="fa fa-magic pull-right"></i></h3>
                                    </div>
                                    <div class="panel-body">

                                        <div class="table-responsive">
                                            <table class="table table-bordered">

                                                <tbody class="marginTop20">
                                                @foreach($option->rooms()->get()->filter(function($item) { return $item->include_virtuoso_amenities == 'y'; } )->all() as $room)
                                                    <?php
                                                    $amenities = $room->room()->get()->first()->hotel()->get()->first()->virtuoso_amenities;
                                                    $amenities = explode("\r", $amenities);
                                                    ?>
                                                    @if(count($amenities)>0)
                                                        <tr>
                                                            <th colspan="3">{{$room->room()->get()->first()->hotel()->get()->first()->name_}}</th>
                                                        </tr>
                                                        @foreach($amenities as $amenity)
                                                            @if(!empty($amenity))
                                                                <tr>
                                                                    <td class="text-center input-container"><input checked type="checkbox" disabled="disabled"></td>
                                                                    <td>{{$amenity}}</td>
                                                                    <td>$0.00</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                </tbody>

                                            </table>
                                        </div>

                                    </div>
                                </div>
                            @endif

                            {{--Hotel Inclusions--}}
                            @if(count($option->rooms()->get()->filter(function($item) { return $item->include_hotel_inclusions == 'y'; } )->all()) > 0)
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Hotel Inclusions <i class="fa fa-wifi pull-right"></i></h3>
                                    </div>
                                    <div class="panel-body">

                                        <div class="table-responsive">
                                            <table class="table table-bordered">

                                                <tbody class="marginTop20">
                                                @foreach($option->rooms()->get()->filter(function($item) { return $item->include_hotel_inclusions == 'y'; } )->all() as $room)
                                                    <?php
                                                    $inclusions = $room->room()->get()->first()->hotel()->get()->first()->resortFact()->get()->first()->room_amenities;
                                                    $inclusions = explode("\r", $inclusions);
                                                    ?>
                                                    @if(count($inclusions)>0)
                                                        <tr>
                                                            <th colspan="2">{{$room->room()->get()->first()->hotel()->get()->first()->name_}}</th>
                                                        </tr>
                                                        @foreach($inclusions as $inclusion)
                                                            @if(!empty($inclusion))
                                                                <tr>
                                                                    <td>{{$inclusion}}</td>
                                                                    <td>$0.00</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                </tbody>

                                            </table>
                                        </div>

                                    </div>
                                </div>
                            @endif

                            {{--Excursions--}}
                            @if(count( $option->vendors()->get()->filter(function($item) { return ($item->vendor_id > 0 && $item->vendor()->get()->first()->type == 'Excursion'); })->all() )>0)
                                <div class="excursion-container panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Excursions <i class="fa fa-bus pull-right"></i></h3>
                                    </div>
                                    <div class="panel-body">

                                        <div class="table-responsive">
                                            <table class="table table-bordered">

                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th>Name</th>
                                                        <th>Description</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>

                                                <tbody class="marginTop20">
                                                @foreach($option->vendors()->get()->filter(function($item) { return ($item->vendor_id > 0 && $item->vendor()->get()->first()->type == 'Excursion'); })->all() as $service)
                                                    <tr>
                                                        <td class="text-center input-container"><input checked type="checkbox" name="service[]" class="excursion_option_choice" value="{{$service->quote_options_vendor_id}}" price="{{$service->price}}"></td>
                                                        <td>{{$service->vendor()->get()->first()->vendor_name}}</td>
                                                        <td>{{$service->description}}</td>
                                                        <td>{{$service->price}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>

                                            </table>
                                        </div>

                                    </div>
                                </div>
                            @endif

                            {{--Insurance--}}
                            @if($option->insurance_id > 0)
                                <div class="insurance-container panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Insurance <i class="fa fa-ambulance pull-right"></i></h3>
                                    </div>
                                    <div class="panel-body">

                                        <div class="table-responsive">
                                            <table class="table table-bordered">

                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th>Name</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>

                                                <tbody class="marginTop20">
                                                    <tr>
                                                        <td class="text-center input-container"><input checked type="checkbox" name="insurance[]" class="insurance_option_choice" value="{{$option->quote_option_id}}" price="{{$option->insurance_cost}}"></td>
                                                        <td>{{$option->insurance()->get()->first()->insurance_name}}</td>
                                                        <td>{{$option->insurance_cost}}</td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                        </div>

                                    </div>
                                </div>
                            @endif

                            {{--Additional services--}}
                            @if(count( $option->vendors()->get()->filter(function($item) { return ($item->vendor_id == 0 || $item->vendor()->get()->first()->type == 'Misc'); })->all() )>0)
                                <div class="additional-container panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Additional services <i class="fa fa-beer pull-right"></i></h3>
                                    </div>
                                    <div class="panel-body">

                                        <div class="table-responsive">
                                            <table class="table table-bordered">

                                                <thead>
                                                <tr>
                                                    <th>&nbsp;</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Price</th>
                                                </tr>
                                                </thead>

                                                <tbody class="marginTop20">
                                                @foreach($option->vendors()->get()->filter(function($item) { return ($item->vendor_id == 0 || $item->vendor()->get()->first()->type == 'Misc'); })->all() as $service)
                                                    <tr>
                                                        <td class="text-center input-container"><input checked type="checkbox" name="service[]" class="additional_option_choice" value="{{$service->quote_options_vendor_id}}" price="{{$service->price}}"></td>
                                                        <td>@if($service->vendor_id == 0) {{$service->service_name}} @else {{$service->vendor()->get()->first()->vendor_name}} @endif</td>
                                                        <td>{{$service->description}}</td>
                                                        <td>{{$service->price}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>

                                            </table>
                                        </div>

                                    </div>
                                </div>
                            @endif

                            {{--Terms & Conditions--}}
                            @if(!empty($option->terms))
                                <h6>Terms and Conditions:</h6>
                                <div class="col-xs-12 marginBottom20">
                                    {!! \String::BBCode2Html($option->terms) !!}
                                </div>
                            @endif

                            {{--Comments--}}
                            <div class="col-xs-12">
                                <div class="input-group col-xs-12">
                                    <label for="approve_comments" class="">Comments:</label>
                                    <textarea class="form-control" name="approve_comments" id="" rows="5" style="width: 100%; border: 1px solid; resize: none; padding: 10px" placeholder="Any comment you would like to send us?"></textarea>
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer"></div>
                    </div>
                </div>

                {{--Modal Affix Summary--}}
                <div class="summary-affix modal-dialog hidden-sm hidden-xs col-md-4 custom-col-md-4 custom-affix affix">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">QUOTE SUMMARY</h4>
                        </div>

                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr class="air-summary"><td>Air</td><td class="text-right">$0</td></tr>
                                        <tr class="transfer-summary"><td>Transfers</td><td class="text-right">$0</td></tr>
                                        <tr class="hotel-summary"><td>Hotel</td><td class="text-right">$0</td></tr>
                                        <tr class="excursion-summary"><td>Excursions</td><td class="text-right">$0</td></tr>
                                        <tr class="insurance-summary"><td>Insurance</td><td class="text-right">$0</td></tr>
                                        <tr class="additional-summary"><td>Additional Services</td><td class="text-right">$0</td></tr>
                                        <tr class="total-summary"><td><strong>Total</strong></td><td class="text-right">$0</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-success approve-option" value="Approve Option" />
                        </div>
                    </div>
                </div>

                {{--Modal Summary--}}
                <div class="summary modal-dialog custom-modal-dialog visible-sm visible-xs col-md-4 custom-col-md-4">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">QUOTE SUMMARY</h4>
                        </div>

                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr class="air-summary"><td>Air</td><td class="text-right">$0</td></tr>
                                        <tr class="transfer-summary"><td>Transfers</td><td class="text-right">$0</td></tr>
                                        <tr class="hotel-summary"><td>Hotel</td><td class="text-right">$0</td></tr>
                                        <tr class="excursion-summary"><td>Excursions</td><td class="text-right">$0</td></tr>
                                        <tr class="insurance-summary"><td>Insurance</td><td class="text-right">$0</td></tr>
                                        <tr class="additional-summary"><td>Additional Services</td><td class="text-right">$0</td></tr>
                                        <tr class="total-summary"><td><strong>Total</strong></td><td class="text-right">$0</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-success approve-option" value="Approve Option" />
                        </div>
                    </div>
                </div>

            </div>
        {{--</form>--}}
        {!! \Form::close() !!}
    @endforeach

    <div class="container-fluid">

        <div class="row">
            {{--Greetings--}}
            <div class="col-sm-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Greetings <i class="fa fa-comments pull-right"></i></h3>
                    </div>
                    <div class="panel-body">
                        @if( ! empty($quote->greeting) )
                            {!!\String::BBCode2Html($quote->greeting)!!}
                        @endif
                    </div>
                </div>
            </div>

            {{--Member Info--}}
            <div class="col-sm-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ucfirst($member->first_name).' '.ucfirst($member->last_name)}}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 hidden-sm hidden-xs" align="center"> <img alt="User Pic" src="//lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> </div>

                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>
                                        @if(!empty($member->phone))
                                            <tr>
                                                <td>Phone</td>
                                                <td>{{$member->phone}}</td>
                                            </tr>
                                        @endif
                                        @if(!empty($member->location))
                                            <tr>
                                                <td>Location</td>
                                                <td>{{$member->location}}</td>
                                            </tr>
                                        @endif
                                        @if(!empty($member->state))
                                            <tr>
                                                <td>State</td>
                                                <td>{{$member->state}}</td>
                                            </tr>
                                        @endif
                                        @if(!empty($member->address))
                                            <tr>
                                                <td>Address</td>
                                                <td>{{$member->address}}</td>
                                            </tr>
                                        @endif
                                        @if(count($member->emails()->get()->all()) > 0)
                                            <tr>
                                                <td>Email</td>
                                                <td>
                                                    @foreach($member->emails()->get()->all() as $email)
                                                        <a href="mailto:{{$email->email}}">{{$email->email}}</a><br/>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            {{--<div class="col-xs-12">--}}
                {{--<div class="jumbotron" style="background-color: #ffffff; box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3)">--}}
                    {{--<h1>Here are the options</h1>--}}
                    {{--<p>Click on details to see each option in depth.</p>--}}
                {{--</div>--}}
            {{--</div>--}}

            @foreach($options as $key => $option)
                <div class="col-xs-12 col-sm-4 col-md-3 card-container">
                    <div class="card">
                        <div class="card-title">
                            <h5 class="text-center">Option {{$key+1}}</h5>
                        </div>

                        @if( ! empty( $photoPath = $option->photos()->get()->first()->hotelPhoto()->get()->first()->path) )
                            <div class="card-image">
                                <a data-quote-option-id="{{$option->quote_option_id}}" class="view-details" href="#" data-toggle="modal" data-target="#modal-{{$key+1}}"><img class="img-responsive" src="//www.ultimatejetvacations.com/images_resort/{{$photoPath}}"></a>
                            </div>
                        @endif

                        <div class="card-content">
                            <p>{{\String::limit($option->rooms()->get()->first()->room()->get()->first()->hotel()->get()->first()->summary)}}</p>
                        </div>

                        <div class="card-action text-right">
                            <a data-quote-option-id="{{$option->quote_option_id}}" class="view-details btn btn-success" href="#" data-toggle="modal" data-target="#modal-{{$key+1}}">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@stop