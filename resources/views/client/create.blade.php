{{Form::open(array('url'=>'client','method'=>'post'))}}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            {{Form::label('name',__('Name'),array('class'=>'form-label')) }}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('email',__('Email'),array('class'=>'form-label'))}}
            {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('phone_number',__('Phone Number'),array('class'=>'form-label')) }}
            {{Form::text('phone_number',null,array('class'=>'form-control','placeholder'=>__('Enter Phone Number'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('gender', __('Gender'),['class'=>'form-label']) }}
            {!! Form::select('gender', $gender,null,array('class' => 'form-control hidesearch ','required'=>'required')) !!}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('country',__('Country'),array('class'=>'form-label')) }}
            {{Form::text('country',null,array('class'=>'form-control','placeholder'=>__('Enter country'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('state',__('State'),array('class'=>'form-label')) }}
            {{Form::text('state',null,array('class'=>'form-control','placeholder'=>__('Enter state'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('city',__('City'),array('class'=>'form-label')) }}
            {{Form::text('city',null,array('class'=>'form-control','placeholder'=>__('Enter city'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('zip_code',__('Zip Code'),array('class'=>'form-label')) }}
            {{Form::text('zip_code',null,array('class'=>'form-control','placeholder'=>__('Enter zip code'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('address',__('Address'),array('class'=>'form-label')) }}
            {{Form::textarea('address',null,array('class'=>'form-control','placeholder'=>__('Enter address'),'rows'=>2,'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('notes',__('Notes'),array('class'=>'form-label')) }}
            {{Form::textarea('notes',null,array('class'=>'form-control','placeholder'=>__('Enter notes'),'rows'=>2))}}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">{{__('Close')}}</button>
    {{Form::submit(__('Create'),array('class'=>'btn btn-primary ml-10'))}}
</div>
{{Form::close()}}

