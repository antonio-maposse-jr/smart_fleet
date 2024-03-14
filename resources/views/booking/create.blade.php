@extends('layouts.app')
@section('page-title')
    {{__('Inspection')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('inspection.index')}}">
                {{__('Inspection')}}
            </a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{__('Create')}}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')

@endsection
@section('content')
    {{Form::open(array('url'=>'booking','method'=>'post'))}}
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-4 col-lg-4">
                            {{ Form::label('client', __('Client'),['class'=>'form-label']) }}
                            {!! Form::select('client', $clients,null,array('class' => 'form-control hidesearch ','required'=>'required')) !!}
                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            {{ Form::label('vehicle', __('Vehicle'),['class'=>'form-label']) }}
                            {!! Form::select('vehicle', $vehicles,null,array('class' => 'form-control hidesearch ','required'=>'required')) !!}
                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            {{ Form::label('driver', __('Driver'),['class'=>'form-label']) }}
                            {!! Form::select('driver', $drivers,null,array('class' => 'form-control hidesearch ','required'=>'required')) !!}
                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            {{Form::label('start_date',__('Start Date'),array('class'=>'form-label')) }}
                            {{Form::date('start_date',null,array('class'=>'form-control','required'=>'required'))}}
                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            {{Form::label('start_time',__('Start Time'),array('class'=>'form-label')) }}
                            {{Form::time('start_time',null,array('class'=>'form-control','required'=>'required'))}}
                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            {{Form::label('end_date',__('End Date'),array('class'=>'form-label')) }}
                            {{Form::date('end_date',null,array('class'=>'form-control','required'=>'required'))}}
                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            {{Form::label('end_time',__('End Time'),array('class'=>'form-label')) }}
                            {{Form::time('end_time',null,array('class'=>'form-control','required'=>'required'))}}
                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            {{Form::label('total_traveller',__('Total Traveller'),array('class'=>'form-label')) }}
                            {{Form::number('total_traveller',null,array('class'=>'form-control','placeholder'=>__('Enter number of traveller'),'required'=>'required'))}}
                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            {{Form::label('approx_distance',__('Approx Distance (km)'),array('class'=>'form-label')) }}
                            {{Form::number('approx_distance',null,array('class'=>'form-control','placeholder'=>__('Enter approx distance (km)'),'required'=>'required'))}}
                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            {{Form::label('pickup_address',__('Pickup Address'),array('class'=>'form-label')) }}
                            {{Form::textarea('pickup_address',null,array('class'=>'form-control','placeholder'=>__('Enter pickup address'),'rows'=>2,'required'=>'required'))}}
                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            {{Form::label('drop_off_address',__('Drop Off Address'),array('class'=>'form-label')) }}
                            {{Form::textarea('drop_off_address',null,array('class'=>'form-control','placeholder'=>__('Enter drop off address'),'rows'=>2,'required'=>'required'))}}
                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            {{Form::label('notes',__('Notes'),array('class'=>'form-label')) }}
                            {{Form::textarea('notes',null,array('class'=>'form-control','placeholder'=>__('Enter notes'),'rows'=>2))}}
                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            {{ Form::label('status', __('Status'),['class'=>'form-label']) }}
                            {!! Form::select('status', $status,null,array('class' => 'form-control hidesearch ','required'=>'required')) !!}
                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            {{Form::label('amount',__('Total Amount'),array('class'=>'form-label')) }}
                            {{Form::number('amount',null,array('class'=>'form-control','placeholder'=>__('Enter total amount'),'required'=>'required'))}}
                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            {{ Form::label('payment_status', __('Payment Status'),['class'=>'form-label']) }}
                            {!! Form::select('payment_status', $paymentStatus,null,array('class' => 'form-control hidesearch ','required'=>'required')) !!}
                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            {{Form::label('payment_notes',__('Payment Notes'),array('class'=>'form-label')) }}
                            {{Form::textarea('payment_notes',null,array('class'=>'form-control','placeholder'=>__('Enter payment notes'),'rows'=>2))}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-end">
        <div class="col-md-12 col-lg-12">
            {{Form::submit(__('Create'),array('class'=>'btn btn-primary ml-10'))}}
        </div>
    </div>
    {{ Form::close() }}
@endsection
