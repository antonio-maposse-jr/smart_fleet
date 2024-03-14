{{Form::open(array('url'=>'fuel','method'=>'post', 'enctype' => "multipart/form-data"))}}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('vehicle', __('Vehicle'),['class'=>'form-label']) }}
            {!! Form::select('vehicle', $vehicles,null,array('class' => 'form-control hidesearch ','required'=>'required')) !!}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('driver', __('Driver'),['class'=>'form-label']) }}
            {!! Form::select('driver', $drivers,null,array('class' => 'form-control hidesearch')) !!}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('date',__('Date'),array('class'=>'form-label')) }}
            {{Form::date('date',null,array('class'=>'form-control','required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('time',__('Time'),array('class'=>'form-label')) }}
            {{Form::time('time',null,array('class'=>'form-control','required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('meter_reading',__('Meter Reading'),array('class'=>'form-label')) }}
            {{Form::number('meter_reading',null,array('class'=>'form-control','placeholder'=>__('Enter meter reading'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('quantity',__('Total Quantity'),array('class'=>'form-label')) }}
            {{Form::number('quantity',null,array('class'=>'form-control','placeholder'=>__('Enter fuel quantity'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('total_amount',__('Total Amount'),array('class'=>'form-label')) }}
            {{Form::number('total_amount',null,array('class'=>'form-control','placeholder'=>__('Enter total amount'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('fuel_location',__('Fuel Location'),array('class'=>'form-label')) }}
            {{Form::text('fuel_location',null,array('class'=>'form-control','placeholder'=>__('Enter fuel location'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('receipt',__('Receipt'),array('class'=>'form-label')) }}
            {{Form::file('receipt',array('class'=>'form-control'))}}
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

