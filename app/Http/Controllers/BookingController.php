<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BookingController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage booking')) {
            $bookings = Booking::where('parent_id', '=', parentId())->get();
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
        return view('booking.index', compact('bookings'));
    }


    public function create()
    {
        if (\Auth::user()->can('create booking')) {
            $vehicles = Vehicle::where('parent_id', parentId())->get()->pluck('name', 'id');
            $vehicles->prepend(__('Select Vehicle'), '');

            $clients = User::where('parent_id', parentId())->where('type', 'client')->get()->pluck('name', 'id');
            $clients->prepend(__('Select Client'), '');

            $drivers = User::where('parent_id', parentId())->where('type', 'driver')->get()->pluck('name', 'id');
            $drivers->prepend(__('Select Driver'), '');

            $status = Booking::$status;
            $paymentStatus = Booking::$paymentStatus;

            return view('booking.create', compact('vehicles', 'clients', 'drivers', 'status','paymentStatus'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create booking')) {
            $validator = \Validator::make(
                $request->all(), [
                    'client' => 'required',
                    'vehicle' => 'required',
                    'start_date' => 'required',
                    'start_time' => 'required',
                    'end_date' => 'required',
                    'end_time' => 'required',
                    'pickup_address' => 'required',
                    'drop_off_address' => 'required',
                    'total_traveller' => 'required',
                    'approx_distance' => 'required',
                    'status' => 'required',
                    'amount' => 'required',
                    'payment_status' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $booking = new Booking();
            $booking->booking_id = $this->bookingNumber();
            $booking->client = $request->client;
            $booking->vehicle = $request->vehicle;
            $booking->driver = $request->driver;
            $booking->start_date = $request->start_date;
            $booking->start_time = $request->start_time;
            $booking->end_date = $request->end_date;
            $booking->end_time = $request->end_time;
            $booking->pickup_address = $request->pickup_address;
            $booking->drop_off_address = $request->drop_off_address;
            $booking->total_traveller = $request->total_traveller;
            $booking->approx_distance = $request->approx_distance;
            $booking->status = $request->status;
            $booking->notes = $request->notes;
            $booking->amount = $request->amount;
            $booking->payment_status = $request->payment_status;
            $booking->payment_notes = $request->payment_notes;
            $booking->parent_id = parentId();
            $booking->save();
            return redirect()->route('booking.index')->with('success', __('Booking successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show($id)
    {
        if (\Auth::user()->can('show booking')) {
            $booking = Booking::find(Crypt::decrypt($id));
            $settings = settings();
            return view('booking.show', compact('booking','settings'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function edit($id)
    {
        if (\Auth::user()->can('edit booking')) {
            $booking = Booking::find(Crypt::decrypt($id));

            $vehicles = Vehicle::where('parent_id', parentId())->get()->pluck('name', 'id');
            $vehicles->prepend(__('Select Vehicle'), '');

            $clients = User::where('parent_id', parentId())->where('type', 'client')->get()->pluck('name', 'id');
            $clients->prepend(__('Select Client'), '');

            $drivers = User::where('parent_id', parentId())->where('type', 'driver')->get()->pluck('name', 'id');
            $drivers->prepend(__('Select Driver'), '');

            $status = Booking::$status;
            $paymentStatus = Booking::$paymentStatus;
            return view('booking.edit', compact('vehicles', 'clients', 'drivers', 'status', 'booking','paymentStatus'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function update(Request $request, Booking $booking)
    {
        if (\Auth::user()->can('edit booking')) {
            $validator = \Validator::make(
                $request->all(), [
                    'client' => 'required',
                    'vehicle' => 'required',
                    'start_date' => 'required',
                    'start_time' => 'required',
                    'end_date' => 'required',
                    'end_time' => 'required',
                    'pickup_address' => 'required',
                    'drop_off_address' => 'required',
                    'total_traveller' => 'required',
                    'approx_distance' => 'required',
                    'status' => 'required',
                    'amount' => 'required',
                    'payment_status' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $booking->client = $request->client;
            $booking->vehicle = $request->vehicle;
            $booking->driver = $request->driver;
            $booking->start_date = $request->start_date;
            $booking->start_time = $request->start_time;
            $booking->end_date = $request->end_date;
            $booking->end_time = $request->end_time;
            $booking->pickup_address = $request->pickup_address;
            $booking->drop_off_address = $request->drop_off_address;
            $booking->total_traveller = $request->total_traveller;
            $booking->approx_distance = $request->approx_distance;
            $booking->status = $request->status;
            $booking->notes = $request->notes;
            $booking->amount = $request->amount;
            $booking->payment_status = $request->payment_status;
            $booking->payment_notes = $request->payment_notes;
            $booking->save();
            return redirect()->route('booking.index')->with('success', __('Booking successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy(Booking $booking)
    {
        if (\Auth::user()->can('delete booking')) {
            $booking->delete();
            return redirect()->route('booking.index')->with('success', __('Booking successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function bookingNumber()
    {
        $latest = Booking::where('parent_id', parentId())->latest()->first();
        if (!$latest) {
            return 1;
        }
        return $latest->booking_id + 1;
    }


}
