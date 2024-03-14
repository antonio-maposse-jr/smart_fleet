<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage service')) {
            $services = Service::where('parent_id', '=', parentId())->get();
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
        return view('service.index', compact('services'));
    }


    public function create()
    {
        $vehicles=Vehicle::where('parent_id',parentId())->get()->pluck('name','id');
        $status=Service::$status;
        return view('service.create',compact('vehicles','status'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create service')) {
            $validator = \Validator::make(
                $request->all(), [
                    'vehicle' => 'required',
                    'service_start_date' => 'required',
                    'service_end_date' => 'required',
                    'total_amount' => 'required',
                    'status' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $service = new Service();
            $service->vehicle = $request->vehicle;
            $service->service_start_date = $request->service_start_date;
            $service->service_end_date = $request->service_end_date;
            $service->total_amount = $request->total_amount;
            $service->status = $request->status;
            $service->notes = $request->notes;
            $service->parent_id = parentId();

            if (!empty($request->attachment)) {

                $serviceFilenameWithExt = $request->file('attachment')->getClientOriginalName();
                $serviceFilename = pathinfo($serviceFilenameWithExt, PATHINFO_FILENAME);
                $serviceExtension = $request->file('attachment')->getClientOriginalExtension();
                $serviceFileName = $serviceFilename . '_' . time() . '.' . $serviceExtension;

                $dir = storage_path('upload/service');
                $image_path = $dir . $serviceFilenameWithExt;


                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $request->file('attachment')->storeAs('upload/service/', $serviceFileName);
                $service->files = $serviceFileName;
            }
            $service->save();


            return redirect()->route('service.index')->with('success', __('Service successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show(Service $service)
    {
        //
    }


    public function edit(Service $service)
    {
        $vehicles=Vehicle::where('parent_id',parentId())->get()->pluck('name','id');
        $status=Service::$status;
        return view('service.edit',compact('vehicles','service','status'));
    }


    public function update(Request $request, Service $service)
    {
        if (\Auth::user()->can('edit service')) {
            $validator = \Validator::make(
                $request->all(), [
                    'vehicle' => 'required',
                    'service_start_date' => 'required',
                    'service_end_date' => 'required',
                    'total_amount' => 'required',
                    'status' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }


            $service->vehicle = $request->vehicle;
            $service->service_start_date = $request->service_start_date;
            $service->service_end_date = $request->service_end_date;
            $service->total_amount = $request->total_amount;
            $service->status = $request->status;
            $service->notes = $request->notes;

            if (!empty($request->attachment)) {
                $serviceFilenameWithExt = $request->file('attachment')->getClientOriginalName();
                $serviceFilename = pathinfo($serviceFilenameWithExt, PATHINFO_FILENAME);
                $serviceExtension = $request->file('attachment')->getClientOriginalExtension();
                $serviceFileName = $serviceFilename . '_' . time() . '.' . $serviceExtension;

                $dir = storage_path('upload/service');
                $image_path = $dir . $serviceFilenameWithExt;

                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $request->file('attachment')->storeAs('upload/service/', $serviceFileName);
                $service->files = $serviceFileName;
            }
            $service->save();


            return redirect()->route('service.index')->with('success', __('Service successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy(Service $service)
    {
        if (\Auth::user()->can('delete service') ) {
            $service->delete();
            return redirect()->route('service.index')->with('success', __('Service successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
