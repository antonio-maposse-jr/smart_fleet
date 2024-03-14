@extends('layouts.app')
@section('page-title')
    {{__('Service')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{__('Service')}}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if(Gate::check('manage service'))
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="{{ route('service.create') }}"
           data-title="{{__('Create Service')}}"> <i
                class="ti-plus mr-5"></i>
            {{__('Create Service')}}
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
                            <th>{{__('Start Date')}}</th>
                            <th>{{__('End Date')}}</th>
                            <th>{{__('Total Amount')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Attachment')}}</th>
                            @if(Gate::check('edit service') || Gate::check('delete service'))
                                <th>{{__('Action')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ !empty($service->vehicles)?$service->vehicles->name:'-' }} </td>
                                <td>{{ dateFormat($service->service_start_date) }} </td>
                                <td>{{ dateFormat($service->service_end_date) }} </td>
                                <td>{{ priceFormat($service->total_amount) }} </td>
                                <td>
                                    @if($service->status=='scheduled')
                                        <span
                                            class="badge badge-primary">{{\App\Models\Service::$status[$service->status]}}</span>
                                    @elseif($service->status=='in_progress' )
                                        <span
                                            class="badge badge-secondary">{{\App\Models\Service::$status[$service->status]}}</span>
                                    @elseif($service->status=='completed')
                                        <span
                                            class="badge badge-success">{{\App\Models\Service::$status[$service->status]}}</span>
                                    @elseif($service->status=='on_hold')
                                        <span
                                            class="badge badge-warning">{{\App\Models\Service::$status[$service->status]}}</span>
                                    @else
                                        <span
                                            class="badge badge-danger">{{\App\Models\Service::$status[$service->status]}}</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($service->files))
                                        <a href="{{asset('/storage/upload/service/'.$service->files)}} " target="_blank" data-bs-toggle="tooltip"
                                           data-bs-original-title="{{__('Attachment')}}"> <i data-feather="file"></i> </a>
                                    @else
                                        -
                                    @endif

                                   </td>
                                @if(Gate::check('edit service') || Gate::check('delete service') )
                                    <td>
                                        <div class="cart-action">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['service.destroy', $service->id]]) !!}
                                            @can('edit service')
                                                <a class="text-success customModal" data-bs-toggle="tooltip"
                                                   data-bs-original-title="{{__('Edit')}}" href="#" data-size="lg"
                                                   data-url="{{ route('service.edit',$service->id) }}"
                                                   data-title="{{__('Edit Service')}}"> <i data-feather="edit"></i></a>
                                            @endcan
                                            @can('delete service')
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
