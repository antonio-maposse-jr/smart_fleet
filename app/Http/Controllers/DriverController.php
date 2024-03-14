<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Driver;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DriverController extends Controller
{
    public function index()
    {
        if (\Auth::user()->can('manage driver')) {
            $drivers = User::where('parent_id', parentId())->where('type', 'driver')->get();
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
        return view('driver.index', compact('drivers'));
    }


    public function create()
    {
        $gender = User::$gender;
        return view('driver.create', compact('gender'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create driver')) {
            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'phone_number' => 'required',
                    'gender' => 'required',
                    'age' => 'required',
                    'joining_date' => 'required',
                    'address' => 'required',
                    'license_number' => 'required',
                    'issue_date' => 'required',
                    'expiration_date' => 'required',

                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $ids = parentId();
            $authUser = \App\Models\User::find($ids);
            $totalDriver = $authUser->totalDriver();
            $subscription = Subscription::find($authUser->subscription);
            if ($totalDriver >= $subscription->driver_limit && $subscription->driver_limit != 0) {
                return redirect()->back()->with('error', __('Your driver limit is over, please upgrade your subscription.'));
            }

            $userRole = Role::where('name', 'driver')->where('parent_id', parentId())->first();
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->password = \Hash::make(123456);
            $user->type = $userRole->name;
            $user->profile = 'avatar.png';
            $user->lang = 'english';
            $user->parent_id = parentId();
            $user->save();
            $user->assignRole($userRole);


            if (!empty($user)) {
                $driver = new Driver();
                $driver->driver_id = $this->driverNumber();
                $driver->user_id = $user->id;
                $driver->gender = $request->gender;
                $driver->age = $request->age;
                $driver->joining_date = $request->joining_date;
                $driver->address = $request->address;
                $driver->license_number = $request->license_number;
                $driver->issue_date = $request->issue_date;
                $driver->expiration_date = $request->expiration_date;
                $driver->reference = $request->reference;
                $driver->notes = $request->notes;
                $driver->parent_id = parentId();

                if (!empty($request->document)) {
                    $documentFilenameWithExt = $request->file('document')->getClientOriginalName();
                    $documentFilename = pathinfo($documentFilenameWithExt, PATHINFO_FILENAME);
                    $documentExtension = $request->file('document')->getClientOriginalExtension();
                    $documentFileName = $documentFilename . '_' . time() . '.' . $documentExtension;

                    $directory = storage_path('upload/document');
                    $filePath = $directory . $documentFilenameWithExt;


                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $request->file('document')->storeAs('upload/document/', $documentFileName);
                    $driver->document = $documentFileName;
                }

                if (!empty($request->license)) {
                    $licenseFilenameWithExt = $request->file('license')->getClientOriginalName();
                    $licenseFilename = pathinfo($licenseFilenameWithExt, PATHINFO_FILENAME);
                    $licenseExtension = $request->file('license')->getClientOriginalExtension();
                    $licenseFileName = $licenseFilename . '_' . time() . '.' . $licenseExtension;

                    $directory = storage_path('upload/license');
                    $filePath = $directory . $licenseFilenameWithExt;

                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $request->file('license')->storeAs('upload/license/', $licenseFileName);
                    $driver->license = $licenseFileName;
                }

                $driver->save();
            }
            return redirect()->route('driver.index')->with('success', __('Driver successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show($id)
    {
        $user = User::find($id);
        $driver = $user->drivers;
        return view('driver.show', compact('driver', 'user'));
    }


    public function edit($id)
    {
        $user = User::find($id);
        $driver = $user->drivers;
        $gender = User::$gender;
        return view('driver.edit', compact('driver', 'user', 'gender'));
    }


    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('edit driver')) {
            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,' . $id,
                    'phone_number' => 'required',
                    'gender' => 'required',
                    'age' => 'required',
                    'joining_date' => 'required',
                    'address' => 'required',
                    'license_number' => 'required',
                    'issue_date' => 'required',
                    'expiration_date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->save();

            if (!empty($user)) {
                $driver = Driver::where('user_id', $id)->first();
                $driver->gender = $request->gender;
                $driver->age = $request->age;
                $driver->joining_date = $request->joining_date;
                $driver->address = $request->address;
                $driver->license_number = $request->license_number;
                $driver->issue_date = $request->issue_date;
                $driver->expiration_date = $request->expiration_date;
                $driver->reference = $request->reference;
                $driver->notes = $request->notes;
                if (!empty($request->document)) {
                    $documentFilenameWithExt = $request->file('document')->getClientOriginalName();
                    $documentFilename = pathinfo($documentFilenameWithExt, PATHINFO_FILENAME);
                    $documentExtension = $request->file('document')->getClientOriginalExtension();
                    $documentFileName = $documentFilename . '_' . time() . '.' . $documentExtension;

                    $directory = storage_path('upload/document');
                    $filePath = $directory . $documentFilenameWithExt;


                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $request->file('document')->storeAs('upload/document/', $documentFileName);
                    $driver->document = $documentFileName;
                }
                if (!empty($request->license)) {
                    $licenseFilenameWithExt = $request->file('license')->getClientOriginalName();
                    $licenseFilename = pathinfo($licenseFilenameWithExt, PATHINFO_FILENAME);
                    $licenseExtension = $request->file('license')->getClientOriginalExtension();
                    $licenseFileName = $licenseFilename . '_' . time() . '.' . $licenseExtension;

                    $directory = storage_path('upload/license');
                    $filePath = $directory . $licenseFilenameWithExt;

                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $request->file('license')->storeAs('upload/license/', $licenseFileName);
                    $driver->license = $licenseFileName;
                }
                $driver->save();
            }
            return redirect()->route('driver.index')->with('success', __('Driver successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy($id)
    {
        if (\Auth::user()->can('delete driver')) {
            $user = User::find($id);
            $user->delete();
            $driver = Driver::where('user_id', $id)->delete();

            return redirect()->route('driver.index')->with('success', __('Client successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function driverNumber()
    {
        $latest = Driver::where('parent_id', parentId())->latest()->first();
        if (!$latest) {
            return 1;
        }
        return $latest->driver_id + 1;
    }
}
