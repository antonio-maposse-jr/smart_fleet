@extends('layouts.app')
@php
    $profile=asset(Storage::url('upload/profile/'));
@endphp
@section('page-title')
    {{__('Client')}}

@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{__('Client')}}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if(Gate::check('manage client'))
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="{{ route('client.create') }}"
           data-title="{{__('Create Client')}}"> <i
                class="ti-plus mr-5"></i>
            {{__('Create Client')}}
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
                            <th>{{__('ID')}}</th>
                            <th>{{__('Client')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Phone Number')}}</th>
                            <th>{{__('Address')}}</th>
                            @if(Gate::check('edit client') || Gate::check('delete client'))
                            <th>{{__('Action')}}</th>
                            @endif

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ !empty($client->clients)?clientPrefix().$client->clients->client_id:'-' }} </td>
                                <td class="table-user">
                                    <img
                                        src="{{!empty($client->avatar)?asset(Storage::url('upload/profile')).'/'.$client->avatar:asset(Storage::url('upload/profile')).'/avatar.png'}}"
                                        alt="" class="mr-2 avatar-sm rounded-circle user-avatar">
                                    <a href="#" class="text-body font-weight-semibold">{{ $client->name }}</a>
                                </td>
                                <td>{{ $client->email }} </td>
                                <td>{{ !empty($client->phone_number)?$client->phone_number:'-' }} </td>
                                <td>{{ !empty($client->clients)?$client->clients->address:'-' }} </td>
                                @if(Gate::check('edit client') || Gate::check('delete client'))
                                <td>
                                    <div class="cart-action">
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['client.destroy', $client->id]]) !!}
                                        @can('edit client')
                                            <a class="text-success customModal" data-bs-toggle="tooltip"
                                               data-bs-original-title="{{__('Edit')}}" href="#" data-size="lg"
                                               data-url="{{ route('client.edit',$client->id) }}"
                                               data-title="{{__('Edit CLient')}}"> <i data-feather="edit"></i></a>
                                        @endcan
                                        @can('delete client')
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
