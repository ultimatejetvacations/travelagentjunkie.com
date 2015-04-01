{!! \Form::open(['method' => 'POST', 'url' => $url, 'class' => 'form-horizontal']) !!}
    {!! \Form::hidden('token', $token) !!}
    {!! \Form::hidden('customer_profile_id', $customerProfileId) !!}
    {!! \Form::hidden('create_credit_card_form_submitted', $customerProfileId) !!}
    {!! \Form::hidden('validation_mode', 'none') !!}

    @if($errors->has('token'))
        <div class="col-sm-12 text-center"></div>
        <p class="alert alert-danger">{{$errors->first('token')}}</p>
    @endif

    @if($errors->has('customer_profile_id'))
        <div class="col-sm-12 text-center"></div>
        <p class="alert alert-danger">{{$errors->first('customer_profile_id')}}</p>
    @endif

    @if($errors->has('response_error'))
        <div class="col-sm-12 text-center"></div>
        <p class="alert alert-danger">{{$errors->first('response_error')}}</p>
    @endif

    <div class="col-sm-6">
        <div class="form-group">
            <h4>Billing Info <a class="copy-traveler-info btn btn-warning"
                               data='{"first_name": "{{$travelerInfo->first_name}}",
                                      "last_name": "{{$travelerInfo->last_name}}",
                                      "address": "{{$travelerInfo->address}}",
                                      "city": "{{$travelerInfo->city}}",
                                      "state": "{{$travelerInfo->state}}",
                                      "zip": "{{$travelerInfo->zip}}",
                                      "country": "{{$travelerInfo->country}}",
                                      "phone": "{{$travelerInfo->phone}}"}'
                               href="#">Copy Traveler Info</a></h4>
        </div>

        <div class="form-group">
            {!! \Form::label('first_name', 'First Name:', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! \Form::text('first_name', null, ['class' => 'form-control input-sm']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! \Form::label('last_name', 'Last Name:', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! \Form::text('last_name', null, ['class' => 'form-control input-sm']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! \Form::label('company', 'Company:', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! \Form::text('company', null, ['class' => 'form-control input-sm']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! \Form::label('address', 'Address:', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! \Form::text('address', null, ['class' => 'form-control input-sm']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! \Form::label('city', 'City:', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! \Form::text('city', null, ['class' => 'form-control input-sm']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! \Form::label('state', 'State:', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! \Form::text('state', null, ['class' => 'form-control input-sm']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! \Form::label('zip', 'ZIP:', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! \Form::text('zip', null, ['class' => 'form-control input-sm']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! \Form::label('country', 'Country:', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! \Form::text('country', null, ['class' => 'form-control input-sm']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! \Form::label('phone', 'Phone:', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! \Form::text('phone', null, ['class' => 'form-control input-sm']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <h4>Payment Info</h4>
        </div>

        <div class="form-group @if($errors->has('credit_card_number')) has-error has-feedback @endif">
            {!! \Form::label('credit_card_number', 'Credit Card Number*:', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! \Form::text('credit_card_number', null, ['class' => 'form-control input-sm', 'placeholder' => 'Enter your credit card number without spaces and dashes.']) !!}
                @if($errors->has('credit_card_number'))
                    <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                    <p class="label label-danger">{{$errors->first('credit_card_number')}}</p>
                @endif
            </div>
        </div>

        <div class="form-group @if($errors->has('expiration_date')) has-error has-feedback @endif">
            {!! \Form::label('expiration_date', 'Expiration Date*:', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! \Form::text('expiration_date', null, ['class' => 'form-control input-sm', 'placeholder' => 'yyyy-mm']) !!}
                @if($errors->has('expiration_date'))
                    <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                    <p class="label label-danger">{{$errors->first('expiration_date')}}</p>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                {!! \Form::submit($submitButtonText, ['class' => 'btn btn-success']) !!}
            </div>
        </div>
    </div>
{!! \Form::close() !!}