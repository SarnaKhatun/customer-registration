<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Traits\ImageUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    use ImageUploader;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::latest()->get();
        return view('backend.agent.customer.list', compact('customers'));
    }

    public function agentList()
    {
        $users = User::latest()->where('role', 1)->where('approved', 0)->where('created_by', Auth::user()->id)->get();
        return view('backend.agent.customer.agent-list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.agent.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'required|max:255',
            'type' => 'required',
            'phone' => [
                'required',
                Rule::unique('users', 'phone'),
                Rule::unique('customers', 'phone'),
            ],
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'phone.unique' => 'This phone number is already in use. Please use a different one.',
        ]);
        if($request->type == 'agent')
        {
            $user = new User();
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->nid_number = $request->nid_number;
            $user->role = 2;
            $user->balance = 1500;
            $user->password = Hash::make('12345678');
            $user->created_by = Auth::user()->id;
            $user->approved = 0;
            $user->status = 1;


            if ($request->hasFile('image')) {
                $imageFile = $request->file('image');
                $width = 400;
                $height = 400;
                $folder = 'backend/images/user/';
                $user->image = $this->uploadImage($imageFile, $width, $height, $folder, 75);
            }

            $user->save();
            return redirect()->route('customers.agent-index')->with('success', 'Agent Data Created successfully.');

        }

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->type = $request->type;
        if ($request->type == 'general' || $request->type == 'driver') {
            $customer->nid_number = $request->nid_number;
        }
        if ($request->type == 'driver') {
            $customer->vehicle_type = $request->vehicle_type;
            $customer->license_number = $request->license_number;
        }
        if ($request->type == 'student') {
            $customer->school_name = $request->school_name;
            $customer->teacher_name = $request->teacher_name;
        }
        $customer->password = Hash::make('12345678');
        $customer->created_by = Auth::user()->id;
        $customer->approved = 0;
        $customer->status = 1;


        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $width = 400;
            $height = 400;
            $folder = 'backend/images/customer/';
            $customer->image = $this->uploadImage($imageFile, $width, $height, $folder, 75);
        }


        $customer->save();
        return redirect()->route('customers.index')->with('success', 'Customer Data Created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
