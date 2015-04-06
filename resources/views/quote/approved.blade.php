@extends('layouts.master')

@section('title')
    @parent - Approved
@stop

@section('js')
<script>
    $(document).ready(function(){

        /*
        |--------------------------------------------------------------------------
        | Page Events
        |--------------------------------------------------------------------------
        */
        // Show hotel info
        $(document.body).on('click', '.hotel_more_info', function () {
            $(this).closest('tr').next().fadeToggle();

            if($(this).text() == 'More Info ▼')
                $(this).text('Less Info ▲');
            else
                $(this).text('More Info ▼');

            return false;
        });

    });
</script>
@stop

@section('content')
    @if($errors->any())
        {{dd(\Request::all())}}
    @endif
    <div class="container-fluid">

        <div class="row">
            {{--Jumbotron--}}
            <div class="col-sm-12">
                <div class="jumbotron" style="background-color: #ffffff; box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3)">
                    <h1>Here is what you approved</h1>
                    <p>If you would like to make any change, please contact your Private Travel Advisor.</p>

                    <p style="display: inline-block; vertical-align: middle">Continue with the reservation <a href="{{route('quote.secondStep', $quote->token)}}" class="btn btn-success">Second Step</a></p>

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
                            <div class="col-md-3 col-lg-3 hidden-sm hidden-xs" align="center"> <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> </div>

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
        </div>

        <div class="row">

            {{--Flights--}}
            @if(count($acceptedOption->airlines()->get()->filter(function($item) { return ($item->selected == 'y'); })->all() )>0)
                <div class="col-xs-12">
                    <div class="air-container panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Flights <i class="fa fa-plane pull-right"></i></h3>
                    </div>
                    <div class="panel-body">

                        @foreach($acceptedOption->airlines()->get()->filter(function($item) { return ($item->selected == 'y'); })->all() as $airline_key => $airline)
                            <div class="table-responsive">
                                <table class="table table-bordered">

                                    <thead>
                                    <tr>
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
                </div>
            @endif

            {{--Transfers--}}
            @if(count( $acceptedOption->vendors()->get()->filter(function($item) { return ($item->vendor_id > 0 && $item->vendor()->get()->first()->type == 'Transfer' && $item->selected == 'y'); })->all() )>0)
                <div class="col-xs-12">
                    <div class="transfer-container panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Transfers <i class="fa fa-car pull-right"></i></h3>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                </tr>
                                </thead>

                                <tbody class="marginTop20">
                                @foreach($acceptedOption->vendors()->get()->filter(function($item) { return ($item->vendor_id > 0 && $item->vendor()->get()->first()->type == 'Transfer'); })->all() as $service)
                                    <tr>
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
                </div>
            @endif

            {{--Hotel--}}
            @if(count($acceptedOption->rooms()->get()->filter(function($item) { return ($item->selected == 'y'); })->all() )>0)
                <div class="col-xs-12">
                    <div class="hotel-container panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Hotel <i class="fa fa-bed pull-right"></i></h3>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <thead>
                                <tr>
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
                                @foreach($acceptedOption->rooms()->get()->filter(function($item) { return ($item->selected == 'y'); })->all() as $room)
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
                                            <div style="white-space: pre-wrap" class="col-xs-12 well well-sm">{!!\String::BBCode2Html($room->room()->get()->first()->descripcion)!!}</div>

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
                </div>
            @endif

            {{--Virtuoso Amenities--}}
            @if(count($acceptedOption->rooms()->get()->filter(function($item) { return $item->include_virtuoso_amenities == 'y' && $item->selected == 'y'; } )->all()) > 0)
                <div class="col-xs-12">
                    <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Exclusive Amenities <i class="fa fa-magic pull-right"></i></h3>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <tbody class="marginTop20">
                                @foreach($acceptedOption->rooms()->get()->filter(function($item) { return $item->include_virtuoso_amenities == 'y' && $item->selected == 'y'; } )->all() as $room)
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
                                                    <td class="text-center"><input checked type="checkbox" disabled="disabled"></td>
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
                </div>
            @endif

            {{--Hotel Inclusions--}}
            @if(count($acceptedOption->rooms()->get()->filter(function($item) { return $item->include_hotel_inclusions == 'y' && $item->selected == 'y'; } )->all()) > 0)
                <div class="col-xs-12">
                    <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Hotel Inclusions <i class="fa fa-wifi pull-right"></i></h3>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <tbody class="marginTop20">
                                @foreach($acceptedOption->rooms()->get()->filter(function($item) { return $item->include_hotel_inclusions == 'y' && $item->selected == 'y'; } )->all() as $room)
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
                </div>
            @endif

            {{--Excursions--}}
            @if(count( $acceptedOption->vendors()->get()->filter(function($item) { return ($item->vendor_id > 0 && $item->vendor()->get()->first()->type == 'Excursion' && $item->selected == 'y'); })->all() )>0)
                <div class="col-xs-12">
                    <div class="excursion-container panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Excursions <i class="fa fa-bus pull-right"></i></h3>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                </tr>
                                </thead>

                                <tbody class="marginTop20">
                                @foreach($acceptedOption->vendors()->get()->filter(function($item) { return ($item->vendor_id > 0 && $item->vendor()->get()->first()->type == 'Excursion' && $item->selected == 'y'); })->all() as $service)
                                    <tr>
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
                </div>
            @endif

            {{--Insurance--}}
            @if($acceptedOption->insurance_selected == 'y')
                <div class="col-xs-12">
                    <div class="insurance-container panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Insurance <i class="fa fa-ambulance pull-right"></i></h3>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                </tr>
                                </thead>

                                <tbody class="marginTop20">
                                <tr>
                                    <td>{{$acceptedOption->insurance()->get()->first()->insurance_name}}</td>
                                    <td>{{$acceptedOption->insurance_cost}}</td>
                                </tr>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
                </div>
            @endif

            {{--Additional services--}}
            @if(count( $acceptedOption->vendors()->get()->filter(function($item) { return (($item->vendor_id == 0 || $item->vendor()->get()->first()->type == 'Misc') && $item->selected == 'y'); })->all() )>0)
                <div class="col-xs-12">
                    <div class="additional-container panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Additional services <i class="fa fa-beer pull-right"></i></h3>
                        </div>
                        <div class="panel-body">

                            <div class="table-responsive">
                                <table class="table table-bordered">

                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                    </tr>
                                    </thead>

                                    <tbody class="marginTop20">
                                    @foreach($acceptedOption->vendors()->get()->filter(function($item) { return ($item->vendor_id == 0 || $item->vendor()->get()->first()->type == 'Misc' && $item->selected == 'y'); })->all() as $service)
                                        <tr>
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
                </div>
            @endif

            {{--Terms & Conditions--}}
            @if(!empty($acceptedOption->terms))
                <div class="col-xs-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Terms and Conditions</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-xs-12 marginBottom20">
                                {!! \String::BBCode2Html($acceptedOption->terms) !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{--Comments--}}
            @if(!empty($acceptedOption->approve_comments))
                <div class="col-xs-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Comments you sent us</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-xs-12 marginBottom20">
                                {!! $acceptedOption->approve_comments !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
@stop