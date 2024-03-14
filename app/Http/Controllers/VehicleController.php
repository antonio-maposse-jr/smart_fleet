<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage vehicle')) {
            $vehicles = Vehicle::where('parent_id', '=', parentId())->get();
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
        return view('vehicle.index', compact('vehicles'));
    }


    public function create()
    {
        $types=VehicleType::where('parent_id',parentId())->get()->pluck('type','id');
        return view('vehicle.create',compact('types'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create vehicle')) {
            $validator = \Validator::make(
                $request->all(), [
                    'type' => 'required',
                    'name' => 'required',
                    'model' => 'required',
                    'engine_type' => 'required',
                    'engine_no' => 'required',
                    'registration_expiry_date' => 'required',
                    'license_plate' => 'required',
                    'color' => 'required',

                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $vehicle = new Vehicle();
            $vehicle->vehicle_id = $this->vehicleNumber();
            $vehicle->type = $request->type;
            $vehicle->name = $request->name;
            $vehicle->model = $request->model;
            $vehicle->engine_type = $request->engine_type;
            $vehicle->engine_no = $request->engine_no;
            $vehicle->registration_expiry_date = $request->registration_expiry_date;
            $vehicle->license_plate = $request->license_plate;
            $vehicle->document = $request->document;
            $vehicle->color = $request->color;
            $vehicle->notes = $request->notes;
            $vehicle->parent_id = parentId();
            if (!empty($request->document)) {
                $documentFilenameWithExt = $request->file('document')->getClientOriginalName();
                $documentFilename = pathinfo($documentFilenameWithExt, PATHINFO_FILENAME);
                $documentExtension = $request->file('document')->getClientOriginalExtension();
                $documentFileName = $documentFilename . '_' . time() . '.' . $documentExtension;

                $dir = storage_path('upload/document');
                $image_path = $dir . $documentFilenameWithExt;


                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $request->file('document')->storeAs('upload/document/', $documentFileName);
                $vehicle->document = $documentFileName;
            }
            $vehicle->save();


            return redirect()->route('vehicle.index')->with('success', __('Vehicle successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show(Vehicle $vehicle)
    {
        return view('vehicle.show',compact('vehicle'));
    }


    public function edit(Vehicle $vehicle)
    {
        $types=VehicleType::where('parent_id',parentId())->get()->pluck('type','id');
        return view('vehicle.edit',compact('types','vehicle'));
    }


    public function update(Request $request, Vehicle $vehicle)
    {
        if (\Auth::user()->can('edit vehicle')) {
            $validator = \Validator::make(
                $request->all(), [
                    'type' => 'required',
                    'name' => 'required',
                    'model' => 'required',
                    'engine_type' => 'required',
                    'engine_no' => 'required',
                    'registration_expiry_date' => 'required',
                    'license_plate' => 'required',
                    'color' => 'required',

                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $vehicle->type = $request->type;
            $vehicle->name = $request->name;
            $vehicle->model = $request->model;
            $vehicle->engine_type = $request->engine_type;
            $vehicle->engine_no = $request->engine_no;
            $vehicle->registration_expiry_date = $request->registration_expiry_date;
            $vehicle->license_plate = $request->license_plate;
            $vehicle->document = $request->document;
            $vehicle->color = $request->color;
            $vehicle->notes = $request->notes;
            if (!empty($request->document)) {
                $documentFilenameWithExt = $request->file('document')->getClientOriginalName();
                $documentFilename = pathinfo($documentFilenameWithExt, PATHINFO_FILENAME);
                $documentExtension = $request->file('document')->getClientOriginalExtension();
                $documentFileName = $documentFilename . '_' . time() . '.' . $documentExtension;

                $dir = storage_path('upload/document');
                $image_path = $dir . $documentFilenameWithExt;


                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $request->file('document')->storeAs('upload/document/', $documentFileName);
                $vehicle->document = $documentFileName;
            }

            $vehicle->save();

            return redirect()->route('vehicle.index')->with('success', __('Vehicle successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy(Vehicle $vehicle)
    {
        if (\Auth::user()->can('delete vehicle') ) {
            $vehicle->delete();
            return redirect()->route('vehicle.index')->with('success', __('Vehicle successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function vehicleNumber()
    {
        $latest = Vehicle::where('parent_id', parentId())->latest()->first();
        if (!$latest) {
            return 1;
        }
        return $latest->vehicle_id + 1;
    }
}
