{!! \Form::open(['method' => 'POST', 'url' => $url, 'class' => 'form-horizontal']) !!}
    {!! \Form::hidden('token', $token) !!}
    {!! \Form::hidden('create_traveler_form_submitted', true) !!}

    @if($errors->has('token'))
        <div class="col-sm-12 text-center"></div>
        <p class="alert alert-danger">{{$errors->first('token')}}</p>
    @endif

    <div class="col-sm-6">
        <div class="form-group">
            {!! \Form::label('prefix', 'Prefix:', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! \Form::select('prefix', \Misc::getPersonTitles(), null, ['class' => 'form-control input-sm']) !!}
            </div>
        </div>

        <div class="form-group @if($errors->has('first_name')) has-error has-feedback @endif">
            {!! \Form::label('first_name', 'First Name:*', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! \Form::text('first_name', null, ['class' => 'form-control input-sm']) !!}
                @if($errors->has('first_name'))
                    <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                    <p class="label label-danger">{{$errors->first('first_name')}}</p>
                @endif
            </div>
        </div>

        <div class="form-group">
            {!! \Form::label('middle_name', 'Middle Name:', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! \Form::text('middle_name', null, ['class' => 'form-control input-sm']) !!}
            </div>
        </div>

        <div class="form-group @if($errors->has('last_name')) has-error has-feedback @endif">
            {!! \Form::label('last_name', 'Last Name:*', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! \Form::text('last_name', null, ['class' => 'form-control input-sm']) !!}
                @if($errors->has('last_name'))
                    <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                    <p class="label label-danger">{{$errors->first('last_name')}}</p>
                @endif
            </div>
        </div>


        <div class="form-group">
            {!! \Form::label('job_title', 'Job Title:', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! \Form::text('job_title', null, ['class' => 'form-control input-sm']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! \Form::label('relationship', 'Relationship:', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! \Form::text('relationship', null, ['class' => 'form-control input-sm']) !!}
            </div>
        </div>

        <div class="form-group @if($errors->has('date_of_birth')) has-error has-feedback @endif">
            {!! \Form::label('date_of_birth', 'Date of Birth:*', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! \Form::text('date_of_birth', null, ['class' => 'form-control input-sm']) !!}
                @if($errors->has('date_of_birth'))
                    <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                    <p class="label label-danger">{{$errors->first('date_of_birth')}}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! \Form::label('phone', 'Phone:', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! \Form::text('phone', null, ['class' => 'form-control input-sm']) !!}
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
                {!! \Form::select('state', \Misc::getUSAStates(), null, ['class' => 'form-control input-sm']) !!}
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
                {!! \Form::select('country', \Misc::getWorldCountries(), 'United States', ['class' => 'form-control input-sm']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                {!! \Form::submit($submitButtonText, ['class' => 'btn btn-success']) !!}
            </div>
        </div>
    </div>
{!! \Form::close() !!}