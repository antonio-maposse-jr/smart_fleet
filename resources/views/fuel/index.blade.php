@extends('layouts.app')
@section('page-title')
    {{__('Fuel')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{__('Fuel')}}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if(Gate::check('manage fuel'))
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="{{ route('fuel.create') }}"
           data-title="{{__('Create Fuel')}}"> <i
                class="ti-plus mr-5"></i>
            {{__('Create Fuel')}}
        </a>
    @endif
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="display dataTable cell-border datatbl-advance">
                        <thead>
                        <tr>
                            <th>{{__('Vehicle')}}</th>
                            <th>{{__('Driver')}}</th>
                            <th>{{__('Duration')}}</th>
                            <th>{{__('Quantity')}}</th>
                            <th>{{__('Total Amount')}}</th>
                            <th>{{__('Meter Reading')}}</th>
                            <th>{{__('Fuel Location')}}</th>
                            @if(Gate::check('edit fuel') || Gate::check('delete fuel'))
                                <th>{{__('Action')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($fuels as $fuel)

                            <tr>
                                <td>{{ !empty($fuel->vehicles)?$fuel->vehicles->name:'-' }} </td>
                                <td>{{ !empty($fuel->drivers)?$fuel->drivers->name:'-' }} </td>
                                <td>
                                    {{ dateFormat($fuel->date).' '.timeFormat($fuel->time) }}
                                </td>
                                <td>{{ $fuel->quantity }} </td>
                                <td>{{ priceFormat($fuel->total_amount) }} </td>
                                <td>{{ $fuel->meter_reading }} </td>
                                <td>{{ $fuel->fuel_location }} </td>

                                @if(Gate::check('edit fuel') || Gate::check('delete fuel') )
                                    <td>
                                        <div class="cart-action">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['fuel.destroy', $fuel->id]]) !!}
                                            @if(!empty($fuel->receipt))
                                                <a  class="text-primary"  href="{{asset('/storage/upload/fuel/'.$fuel->receipt)}} "
                                                   target="_blank" data-bs-toggle="tooltip"
                                                    data-bs-original-title="{{__('Receipt')}}"> <i data-feather="file"></i> </a>
                                            @endif

                                            @can('edit fuel')
                                                <a class="text-success customModal" data-bs-toggle="tooltip"
                                                   data-bs-original-title="{{__('Edit')}}" href="#" data-size="lg"
                                                   data-url="{{ route('fuel.edit',$fuel->id) }}"
                                                   data-title="{{__('Edit Fuel')}}"> <i data-feather="edit"></i></a>
                                            @endcan
                                            @can('delete fuel')
                                                <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                                                   data-bs-original-title="{{__('Detete')}}" href="#"> <i
                                                        data-feather="trash-2"></i></a>
                                            @endcan
                                            {!! Form::close() !!}
                                        </div>

                                    </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
