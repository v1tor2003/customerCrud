<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, 
        [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg',
            'cep' => 'required',
            'state' => 'required',
            'city' => 'required',
            'district' => 'required',
            'street' => 'required',
            'number' => 'required',
        ]);

        $image = $request->file('avatar');
        if($image){
            $destination = 'images/';
            $new_image_name = now() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($destination, $new_image_name));
        }

        $customer = Customer::create([
            'name' =>  $request->input('name'),
            'email' =>  $request->input('email'),
            'phone' =>  $request->input('phone'),
            'avatar'=> $image,
        ]);
        $address = new Address([
            'cep' => $request->input('cep'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'district' => $request->input('district'),
            'street' => $request->input('street'),
            'number' => $request->input('number'),
        ]);
        $customer->address()->save($address);
        return Redirect::route('customers')->with('message', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, 
        [
            'name' => 'sometimes|string',
            'email' => 'sometimes|email',
            'phone' => 'sometimes',
            'avatar' => 'sometimes|image|mimes:jpeg,png,jpg',
            'cep' => 'sometimes',
            'state' => 'sometimes',
            'city' => 'sometimes',
            'district' => 'sometimes',
            'street' => 'sometimes',
            'number' => 'sometimes',
        ]);

        $customer = Customer::find($customer->id);
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->phone = $request->input('phone');
        
        $image = $request->file('avatar');
        if($image){
            $destination = 'images/';
            $new_image_name = now() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($destination, $new_image_name));
            $customer->name = $request->input('name');
        }

        $customer->address->cep = $request->input('cep');
        $customer->address->state = $request->input('state');
        $customer->address->city = $request->input('city');
        $customer->address->district = $request->input('district');
        if($request->input('number'))
            $customer->address->number = $request->input('number');

        $customer->save();
        $customer->address->save();
        return Redirect::route('customers')->with('message', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return Redirect::route('customers')->with('message', 'Cliente deletado!');
    }
}
