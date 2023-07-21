<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        return Inertia::render('index',[
            'customers'=> Customer::all()->map(function ($customer){
                return[
                    'id'=>$customer->id,
                    'name'=>$customer->name,

                ];
            })
        ]);
    }
    public function create(){
        return inertia::render('create');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required| max:255',
            'email'=>'required|email|unique:customers',
            'phone'=>'required|unique:customers|max:14|min:10',
        ]);
        Customer::create($validated);
        return Redirect::route('customers.index')->with('message','Created Successfully');
    }
    public function destroy(Customer $customer){
        $customer->delete();
        return Redirect::route('customers.index')->with('message','Deleted Successfully');
    }
    public function edit(Customer $customer){
        return Inertia::render('edit',[
           'customer'=>$customer

        ]);
    }
    public function update(Request $request, Customer $customer){
        $validated = $request->validate([
            'name' => 'required| max:255',
            'email'=>'required|email',
            'phone'=>'required|max:14|min:10',
        ]);
        $customer->update($validated);
        return Redirect::route('customers.index')->with('message','Updated Successfully');
    }
}
