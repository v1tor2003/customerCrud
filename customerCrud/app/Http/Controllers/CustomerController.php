<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = Customer::find(1);
        echo $customer->address()->city;
        dd($customer);
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

        $address = new Address;
        $address->cep =  $request->cep;
        $address->state =  $request->state;
        $address->city =  $request->city;
        $address->district =  $request->district;
        $address->street =  $request->street;
        $address->number =  $request->number;
 
        $customer->address()->save($address);
        return redirect()->with('message', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
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
        $customer->update();
        $customer->customerAddress()->update();
        return redirect('customers')->with('message', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect('customers')->with('message', 'Cliente deletado!');
    }
}
