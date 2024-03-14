{{Form::open(array('url'=>'service','method'=>'post', 'enctype' => "multipart/form-data"))}}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('vehicle', __('Vehicle'),['class'=>'form-label']) }}
            {!! Form::select('vehicle', $vehicles,null,array('class' => 'form-control hidesearch ','required'=>'required')) !!}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('service_start_date',__('Service Start Date'),array('class'=>'form-label')) }}
            {{Form::date('service_start_date',null,array('class'=>'form-control','required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('service_end_date',__('Service End Date'),array('class'=>'form-label')) }}
            {{Form::date('service_end_date',null,array('class'=>'form-control','required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('total_amount',__('Total Amount'),array('class'=>'form-label')) }}
            {{Form::number('total_amount',null,array('class'=>'form-control','placeholder'=>__('Enter service total amount'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('status', __('Status'),['class'=>'form-label']) }}
            {!! Form::select('status', $status,null,array('class' => 'form-control hidesearch ','required'=>'required')) !!}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('attachment',__('Attachment'),array('class'=>'form-label')) }}
            {{Form::file('attachment',array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-12">
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

