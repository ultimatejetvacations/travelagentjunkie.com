@extends('layouts.master')

@section('title')
    @parent - Second Step
@stop

@section('css')
    <link rel="stylesheet" href="/assets/css/shake-animation.css"/>
    <link rel="stylesheet" href="/assets/vendor/expandable-heading/expandable-heading.css"/>
    <style>
        input.form-control, select.form-control {
            border: 1px solid #cccccc !important;
            padding-left: 5px !important;
            padding-right: 5px !important;
        }
    </style>
@stop

@section('js')
    <script src="/assets/vendor/expandable-heading/expandable-heading.js"></script>
    <script src="/assets/vendor/jquery.maskedinput.js"></script>
    <script>
        $(document).ready(function(){

            $(document.body).on('click', '.show-create-traveler-form', function () {
                $(this).removeClass('shake-animation');
                $('#create-traveler-form-wrapper').slideToggle();
                return false;
            });

            $(document.body).on('click', '.show-customer-profile-form', function () {
                $(this).removeClass('shake-animation');
                $('#create-customer-profile-form-wrapper').slideToggle();
                return false;
            });

            $(document.body).on('click', '.show-credit-card-form', function () {
                $(this).closest('.row').next().slideToggle();
                return false;
            });

            $(document.body).on('click', '.copy-traveler-info', function () {
                var data = JSON.parse($(this).attr('data'));
                var form = $(this).closest('form');

                $.each(data, function(label, value){
                    if(value != '')
                        form.find('input[name='+label+']').val(value);
                });
                return false;
            });

            $("input[name=date_of_birth]").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
            $("input[name=expiration_date]").mask("9999-99",{placeholder:"yyyy-mm"});

        });
    </script>
@stop

@section('content')
    <div class="container-fluid">

        {{--Travelers Panel--}}
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Travelers <button class="pull-right show-create-traveler-form btn btn-xs btn-default @if(count($travelers) < 1) shake-animation @endif">Add a traveler <i class="fa fa-user-plus"></i></button></h3>
                </div>
                <div class="panel-body">

                    <div class="panel panel-info" id="create-traveler-form-wrapper" @if( ! Input::old('create_traveler_form_submitted')) style="display: none" @endif>
                        <div class="panel-heading">
                            <h3 class="panel-title">Add a new traveler to the booking</h3>
                        </div>
                        <div class="panel-body">
                            @include('forms.create_traveler', ['url' => secure_url('/quote/save-traveler'),
                                                                'token' => $quote->token,
                                                                'submitButtonText' => 'Create'])
                        </div>
                    </div>

                    @forelse($travelers as $traveler)
                        <div class="panel panel-success" style="margin-bottom: 0">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{$traveler->prefix.' '}}{{$traveler->first_name.' '}}{{$traveler->middle_name.' '}}{{$traveler->last_name.' '}}</h3>
                                <span class="pull-right clickable panel-collapsed"><i class="glyphicon glyphicon-plus"></i></span>
                            </div>

                            <div class="panel-body"style="display: none; /*style for default collapsed*/">
                                <div class="col-md-6">
                                    <table class="table table-hover">
                                        <tr>
                                            <td>Prefix</td>
                                            <td>{{$traveler->prefix}}</td>
                                        </tr>
                                        <tr>
                                            <td>First Name</td>
                                            <td>{{$traveler->first_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Middle Name</td>
                                            <td>{{$traveler->middle_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Last Name</td>
                                            <td>{{$traveler->last_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Job Title</td>
                                            <td>{{$traveler->job_title}}</td>
                                        </tr>
                                        <tr>
                                            <td>Relationship</td>
                                            <td>{{$traveler->relationship}}</td>
                                        </tr>
                                        <tr>
                                            <td>Date of Birth</td>
                                            <td>{{($traveler->date_of_birth->toDateString() != '-0001-11-30' ? $traveler->date_of_birth->toFormattedDateString() : '')}}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-md-6">
                                    <table class="table table-hover">
                                        <tr>
                                            <td>Phone</td>
                                            <td>{{$traveler->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>{{$traveler->address}}</td>
                                        </tr>
                                        <tr>
                                            <td>City</td>
                                            <td>{{$traveler->city}}</td>
                                        </tr>
                                        <tr>
                                            <td>State</td>
                                            <td>{{$traveler->state}}</td>
                                        </tr>
                                        <tr>
                                            <td>ZIP</td>
                                            <td>{{$traveler->zip}}</td>
                                        </tr>
                                        <tr>
                                            <td>Country</td>
                                            <td>{{$traveler->country}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><strong>Made a mistake and want to fix it? Call your Travel Private Advisor.</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h3 class="well text-center">There are no travelers yet for this reservation.</h3>
                    @endforelse
                </div>
            </div>
        </div>

        {{--Credit Cards Panel--}}
        @if(count($travelers) > 0)
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Credit Cards @if(count($customerProfileTravelers) > 1)<button class="pull-right show-customer-profile-form btn btn-xs btn-default @if(count($customerProfiles) < 1) shake-animation @endif">Create Payment Profile <i class="fa fa-user"></i></button>@endif</h3>
                    </div>
                    <div class="panel-body">

                        {{--Create Customer profile form--}}
                        <div class="panel panel-info" id="create-customer-profile-form-wrapper" @if( ! Input::old('create_customer_profile_form_submitted')) style="display: none" @endif>
                            <div class="panel-heading">
                                <h3 class="panel-title">Create a Payment Profile</h3>
                            </div>
                            <div class="panel-body">
                                @include('forms.create_customer_profile', ['url' => secure_url('/quote/create-customer-profile'),
                                                                    'token' => $quote->token,
                                                                    'travelers' => $customerProfileTravelers,
                                                                    'submitButtonText' => 'Create'])
                            </div>
                        </div>

                        {{--Customer profile info--}}
                        @forelse($customerProfiles as $customerProfile)
                            <?php $customerTraveler = $customerProfile->memberTraveler()->get()->first(); // Work around to avoid making a request for each property
                                  $paymentProfiles = $customerProfile->authorizeProfile(true)->paymentProfiles // Work around to avoid making a request for counting and then for displaying ?>
                            <div class="panel panel-success" style="margin-bottom: 0">
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{$customerTraveler->prefix.' '}}{{$customerTraveler->first_name.' '}}{{$customerTraveler->middle_name.' '}}{{$customerTraveler->last_name.' '}}</h3>
                                    <span class="pull-right clickable panel-collapsed"><i class="glyphicon glyphicon-plus"></i></span>
                                </div>

                                <div class="panel-body" @if(Input::old('create_credit_card_form_submitted') != $customerProfile->customerProfileId) style="display: none; /*style for default collapsed*/" @endif>
                                    <div class="row">
                                        <div class="col-sm-12"><a class="pull-right show-credit-card-form btn btn-default marginBottom20" href="#">Add a New Credit Card <i class="fa fa-credit-card"></i></a></div>
                                    </div>

                                    {{--Create Credit Card form--}}
                                    <div class="panel panel-info" class="create-credit-card-form-wrapper" @if(Input::old('create_credit_card_form_submitted') != $customerProfile->customerProfileId) style="display: none" @endif>
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Add a New Credit Card</h3>
                                        </div>
                                        <div class="panel-body">
                                            @include('forms.create_credit_card', ['url' => secure_url('/quote/save-credit-card'),
                                                                    'token' => $quote->token,
                                                                    'travelerInfo' => $customerTraveler,
                                                                    'customerProfileId' => $customerProfile->customerProfileId,
                                                                    'submitButtonText' => 'Add Credit Card'])
                                        </div>
                                    </div>

                                    {{--Display credit cards--}}
                                    <div class="row">
                                        @if(count($paymentProfiles) > 0)
                                            <div class="col-sm-12">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Card Number</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($paymentProfiles as $paymentProfile)
                                                            <tr>
                                                                <td>{{$paymentProfile->billTo->firstName}}</td>
                                                                <td>{{$paymentProfile->billTo->lastName}}</td>
                                                                <td>{{$paymentProfile->payment->creditCard->cardNumber}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h3 class="well text-center">There are not credit cards for this reservation yet.<br/><small class="label label-danger">We won't charge you card until we confirm availability.</small></h3>
                        @endforelse
                    </div>
                </div>
            </div>
        @endif

    </div>
@stop
