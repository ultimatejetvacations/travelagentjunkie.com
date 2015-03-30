{!! \Form::open(['method' => 'POST', 'url' => $url, 'class' => 'form-horizontal']) !!}
    {!! \Form::hidden('token', $token) !!}
    {!! \Form::hidden('create_customer_profile_form_submitted', true) !!}

    @if($errors->has('token'))
        <div class="col-sm-12 text-center">
            <p class="alert alert-danger">{{$errors->first('token')}}</p>
        </div>
    @endif

    @if($errors->has('response_error'))
        <div class="col-sm-12 text-center">
            <p class="alert alert-danger">{{$errors->first('response_error')}}</p>
        </div>
    @endif

    <div class="col-sm-6">
        <div class="form-group @if($errors->has('traveler_id')) has-error has-feedback @endif">
            {!! \Form::label('traveler_id', 'Traveler:', ['class' => 'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                {!! \Form::select('traveler_id', $travelers, null, ['class' => 'form-control input-sm']) !!}
                @if($errors->has('traveler_id'))
                    <p class="label label-danger">{{$errors->first('traveler_id')}}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="col-sm-12 text-center">
                {!! \Form::submit($submitButtonText, ['class' => 'btn btn-success']) !!}
            </div>
        </div>
    </div>
{!! \Form::close() !!}