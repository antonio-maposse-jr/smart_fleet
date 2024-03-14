<?php

namespace App\Http\Controllers;

use App\Models\Fuel;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class FuelController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage fuel')) {
            $fuels = Fuel::where('parent_id', '=', parentId())->get();
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
        return view('fuel.index', compact('fuels'));
    }


    public function create()
    {
        $vehicles = Vehicle::where('parent_id', parentId())->get()->pluck('name', 'id');
        $drivers = User::where('parent_id', parentId())->where('type', 'driver')->get()->pluck('name', 'id');
        $drivers->prepend(__('Select Driver'), '');
        return view('fuel.create', compact('vehicles', 'drivers'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create fuel')) {
            $validator = \Validator::make(
                $request->all(), [
                    'vehicle' => 'required',
                    'date' => 'required',
                    'time' => 'required',
                    'quantity' => 'required',
                    'fuel_location' => 'required',
                    'meter_reading' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $fuel = new Fuel();
            $fuel->vehicle = $request->vehicle;
            $fuel->driver = !empty($request->driver)?$request->driver:0;
            $fuel->date = $request->date;
            $fuel->time = $request->time;
            $fuel->quantity = $request->quantity;
            $fuel->total_amount = $request->total_amount;
            $fuel->fuel_location = $request->fuel_location;
            $fuel->meter_reading = $request->meter_reading;
            $fuel->notes = $request->notes;
            $fuel->parent_id = parentId();

            if (!empty($request->receipt)) {

                $fuelFilenameWithExt = $request->file('receipt')->getClientOriginalName();
                $fuelFilename = pathinfo($fuelFilenameWithExt, PATHINFO_FILENAME);
                $fuelExtension = $request->file('receipt')->getClientOriginalExtension();
                $fuelFileName = $fuelFilename . '_' . time() . '.' . $fuelExtension;

                $dir = storage_path('upload/fuel');
                $image_path = $dir . $fuelFilenameWithExt;


                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $request->file('receipt')->storeAs('upload/fuel/', $fuelFileName);
                $fuel->receipt = $fuelFileName;
            }
            $fuel->save();


            return redirect()->route('fuel.index')->with('success', __('Fuel successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show(Fuel $fuel)
    {
        //
    }


    public function edit(Fuel $fuel)
    {
        $vehicles = Vehicle::where('parent_id', parentId())->get()->pluck('name', 'id');
        $drivers = User::where('parent_id', parentId())->where('type', 'driver')->get()->pluck('name', 'id');
        $drivers->prepend(__('Select Driver'), '');
        return view('fuel.edit', compact('vehicles', 'fuel', 'drivers'));
    }


    public function update(Request $request, Fuel $fuel)
    {

        if (\Auth::user()->can('create fuel')) {
            $validator = \Validator::make(
                $request->all(), [
                    'vehicle' => 'required',
                    'date' => 'required',
                    'time' => 'required',
                    'quantity' => 'required',
                    'fuel_location' => 'required',
                    'meter_reading' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }


            $fuel->vehicle = $request->vehicle;
            $fuel->driver = !empty($request->driver)?$request->driver:0;
            $fuel->date = $request->date;
            $fuel->time = $request->time;
            $fuel->quantity = $request->quantity;
            $fuel->total_amount = $request->total_amount;
            $fuel->fuel_location = $request->fuel_location;
            $fuel->meter_reading = $request->meter_reading;
            $fuel->notes = $request->notes;

            if (!empty($request->receipt)) {

                $fuelFilenameWithExt = $request->file('receipt')->getClientOriginalName();
                $fuelFilename = pathinfo($fuelFilenameWithExt, PATHINFO_FILENAME);
                $fuelExtension = $request->file('receipt')->getClientOriginalExtension();
                $fuelFileName = $fuelFilename . '_' . time() . '.' . $fuelExtension;

                $dir = storage_path('upload/fuel');
                $image_path = $dir . $fuelFilenameWithExt;


                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $request->file('receipt')->storeAs('upload/fuel/', $fuelFileName);
                $fuel->receipt = $fuelFileName;
            }
            $fuel->save();


            return redirect()->route('fuel.index')->with('success', __('Fuel successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy(Fuel $fuel)
    {
        if (\Auth::user()->can('delete fuel')) {
            $fuel->delete();
            return redirect()->route('fuel.index')->with('success', __('Fuel successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
