<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ClientController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage client')) {
            $clients = User::where('parent_id', parentId())->where('type', 'client')->get();
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
        return view('client.index', compact('clients'));
    }


    public function create()
    {
        $gender=User::$gender;
        return view('client.create',compact('gender'));
    }


    public function store(Request $request)
    {

        if (\Auth::user()->can('create client')) {
            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'phone_number' => 'required',
                    'gender' => 'required',
                    'address' => 'required',

                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $ids = parentId();
            $authUser = \App\Models\User::find($ids);
            $totalClient = $authUser->totalClient();
            $subscription = Subscription::find($authUser->subscription);
            if ($totalClient >= $subscription->client_limit && $subscription->client_limit != 0) {
                return redirect()->back()->with('error', __('Your client limit is over, please upgrade your subscription.'));
            }

            $userRole = Role::where('name','client')->where('parent_id',parentId())->first();
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
            if(!empty($user)){
                $client=new Client();
                $client->client_id=$this->clientNumber();
                $client->user_id=$user->id;
                $client->gender=$request->gender;
                $client->city=$request->city;
                $client->state=$request->state;
                $client->country=$request->country;
                $client->zip_code=$request->zip_code;
                $client->address=$request->address;
                $client->parent_id=parentId();
                $client->notes=$request->notes;
                $client->save();
            }
            return redirect()->route('client.index')->with('success', __('Client successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show(Client $client)
    {
        //
    }


    public function edit($id)
    {
        $user=User::find($id);
        $client=$user->clients;
        $gender=User::$gender;
        return view('client.edit',compact('client','user','gender'));
    }


    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('edit client')) {
            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,' . $id,
                    'phone_number' => 'required',
                    'gender' => 'required',
                    'address' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $user= User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->save();

            if(!empty($user)){
                $client=Client::where('user_id',$id)->first();
                $client->gender=$request->gender;
                $client->city=$request->city;
                $client->state=$request->state;
                $client->country=$request->country;
                $client->zip_code=$request->zip_code;
                $client->address=$request->address;
                $client->notes=$request->notes;
                $client->save();
            }
            return redirect()->route('client.index')->with('success', __('Client successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy($id)
    {
        if (\Auth::user()->can('delete client') ) {
            $user = User::find($id);
            $user->delete();
            $client=Client::where('user_id',$id)->delete();

            return redirect()->route('client.index')->with('success', __('Client successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function clientNumber()
    {
        $latest = Client::where('parent_id', parentId())->latest()->first();
        if (!$latest) {
            return 1;
        }
        return $latest->client_id + 1;
    }
}
