@extends('layouts.app')
@section('page-title')
    {{__('Booking')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('booking.index')}}">
                {{__('Booking')}}
            </a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{ bookingPrefix().$booking->booking_id }} {{__('Details')}}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    <a class="btn btn-secondary print" href="javascript:void(0);"><i class="fa fa-print"></i> {{__('Print')}}</a>

@endsection
@section('content')
    <div class="row" id="invoice-print">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body cdx-invoice">
                    <div id="cdx-invoice">
                        <div class="head-invoice">
                            <div class="codex-brand">
                                <a class="codexbrand-logo" href="Javascript:void(0);">
                                    <img class="img-fluid"
                                         src="{{asset(Storage::url('upload/logo/')).'/'.(isset($settings['company_logo']) && !empty($settings['company_logo'])?$settings['company_logo']:'logo.png')}}"
                                         alt="invoice-logo">
                                </a>
                                <a class="codexdark-logo" href="Javascript:void(0);">
                                    <img class="img-fluid"
                                         src="{{asset(Storage::url('upload/logo/')).'/'.(isset($settings['company_logo']) && !empty($settings['company_logo'])?$settings['company_logo']:'logo.png')}}"
                                         alt="invoice-logo">
                                </a>
                            </div>
                            <ul class="contact-list">
                                <li>
                                    <div class="icon-wrap"><i class="fa fa-user"></i></div>
                                    {{$settings['company_name']}}
                                </li>
                                <li>
                                    <div class="icon-wrap"><i class="fa fa-phone"></i></div>
                                    {{$settings['company_email']}}
                                </li>
                                <li>
                                    <div class="icon-wrap"><i class="fa fa-envelope"></i></div>
                                    {{$settings['company_phone']}}
                                </li>

                            </ul>
                        </div>
                        <div class="invoice-user">
                            <div class="left-user">
                                <h5>{{__('Receipt To')}}:</h5>
                                <ul class="detail-list">
                                    <li>
                                        <div class="icon-wrap"><i class="fa fa-user"></i></div>
                                        {{!empty($booking->clients)?$booking->clients->name:''}}
                                    </li>
                                    <li>
                                        <div class="icon-wrap"><i class="fa fa-phone"></i></div>
                                        {{!empty($booking->clients)?$booking->clients->phone_number:''}}
                                    </li>
                                    <li>
                                        <div class="icon-wrap"><i class="fa fa-mailchimp"></i></div>
                                        {{!empty($booking->clients)?$booking->clients->email:''}}
                                    </li>

                                </ul>
                            </div>
                            <div class="right-user">
                                <ul class="detail-list">
                                    <li>{{__('Booking Date')}}: <span> {{dateFormat($booking->created_at)}}</span></li>
                                    <li>{{__('Booking ID')}}: <span>{{bookingPrefix().$booking->booking_id}}</span></li>
                                    <li>{{__('Start Date')}}:
                                        <span>{{dateFormat($booking->start_date)}} - {{timeFormat($booking->start_time)}}</span>
                                    </li>
                                    <li>{{__('End Date')}}:
                                        <span>
                                        {{ dateFormat($booking->end_date) }} -
                                                {{ timeFormat($booking->end_time) }}
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="body-invoice">
                            <div class="table-responsive1">
                                <table class="table ml-1">
                                    <thead>
                                    <tr>
                                        <th>{{__('Vehicle')}}</th>
                                        <th>{{ !empty($booking->vehicles)?$booking->vehicles->name:'-' }} </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{__('Driver')}}</td>
                                        <td>{{ !empty($booking->drivers)?$booking->drivers->name:'-' }} </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Total Traveller')}}</td>
                                        <td>{{$booking->total_traveller}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Approx Distance (Km)')}}</td>
                                        <td>{{ $booking->approx_distance }} </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Pickup Address')}}</td>
                                        <td>{{ $booking->pickup_address }} </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Drop Off Address')}}</td>
                                        <td>{{ $booking->drop_off_address }} </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Status')}}</td>
                                        <td>
                                            @if($booking->status=='yet_to_start')
                                                <span
                                                    class="badge badge-primary">{{\App\Models\Booking::$status[$booking->status]}}</span>
                                            @elseif($booking->status=='completed' )
                                                <span
                                                    class="badge badge-success">{{\App\Models\Booking::$status[$booking->status]}}</span>
                                            @elseif($booking->status=='on_going')
                                                <span
                                                    class="badge badge-warning">{{\App\Models\Booking::$status[$booking->status]}}</span>
                                            @elseif($booking->status=='cancelled')
                                                <span
                                                    class="badge badge-danger">{{\App\Models\Booking::$status[$booking->status]}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Payment Status')}}</td>
                                        <td>
                                            @if($booking->payment_status=='paid')
                                                <span
                                                    class="badge badge-sucess">{{\App\Models\Booking::$paymentStatus[$booking->payment_status]}}</span>
                                            @elseif($booking->payment_status=='unpaid')
                                                <span
                                                    class="badge badge-danger">{{\App\Models\Booking::$paymentStatus[$booking->payment_status]}}</span>
                                            @elseif($booking->payment_status=='partial_paid')
                                                <span
                                                    class="badge badge-warning">{{\App\Models\Booking::$paymentStatus[$booking->payment_status]}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('Notes')}}</td>
                                        <td>{{ $booking->notes }} </td>
                                    </tr>
                                    @if(!empty($booking->payment_notes))
                                        <tr>
                                            <td>{{__('Payment Notes')}}</td>
                                            <td>{{ $booking->payment_notes }} </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($booking->amount>0)
                            <div class="footer-invoice">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>{{__('Total Payment')}}</td>
                                        <td>{{priceFormat($booking->amount)}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('script-page')
    <script>
        $(document).on('click', '.print', function () {
            var printContents = document.getElementById('invoice-print').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

        });
    </script>
@endpush
