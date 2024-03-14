{{Form::open(array('url'=>'vehicle','method'=>'post', 'enctype' => "multipart/form-data"))}}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            {{Form::label('name',__('Vehicle Name'),array('class'=>'form-label')) }}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter vehicle name'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('type', __('Type'),['class'=>'form-label']) }}
            {!! Form::select('type', $types,null,array('class' => 'form-control hidesearch ','required'=>'required')) !!}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('model',__('Model'),array('class'=>'form-label')) }}
            {{Form::text('model',null,array('class'=>'form-control','placeholder'=>__('Enter model'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('engine_type',__('Engine Type'),array('class'=>'form-label')) }}
            {{Form::text('engine_type',null,array('class'=>'form-control','placeholder'=>__('Enter engine type'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('engine_no',__('Engine Number'),array('class'=>'form-label')) }}
            {{Form::text('engine_no',null,array('class'=>'form-control','placeholder'=>__('Enter engine number'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('license_plate',__('License Plate'),array('class'=>'form-label')) }}
            {{Form::text('license_plate',null,array('class'=>'form-control','placeholder'=>__('Enter license plate'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('registration_expiry_date',__('Registration Expiry Date'),array('class'=>'form-label')) }}
            {{Form::date('registration_expiry_date',null,array('class'=>'form-control','required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('color',__('Color'),array('class'=>'form-label')) }}
            {{Form::text('color',null,array('class'=>'form-control','placeholder'=>__('Enter vehicle color')))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('document',__('Document'),array('class'=>'form-label')) }}
            {{Form::file('document',array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('notes',__('Notes'),array('class'=>'form-label')) }}
            {{Form::textarea('notes',null,array('class'=>'form-control','placeholder'=>__('Enter notes'),'rows'=>2,'required'=>'required'))}}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">{{__('Close')}}</button>
    {{Form::submit(__('Create'),array('class'=>'btn btn-primary ml-10'))}}
</div>
{{Form::close()}}

