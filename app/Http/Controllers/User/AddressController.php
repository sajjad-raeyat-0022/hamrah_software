<?php

namespace App\Http\Controllers\User;

use App\Models\City;
use App\Models\State;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = UserAddress::where('user_id', auth()->id())->get();
        $states = State::all();
        return view('user.users_profile.addresses',compact('states', 'addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd($request->all());
         $request->validateWithBag('addressStore', [
            'title' => 'required',
            'phone_number' => 'required|ir_mobile',
            'state_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'postal_code' => 'required|ir_postal_code'
        ]);

        UserAddress::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'phone_number' => $request->phone_number,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'postal_code' => $request->postal_code
        ]);

        alert()->success('آدرس مورد نظر ایجاد شد', 'باتشکر');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserAddress $address)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'phone_number' => 'required|ir_mobile',
            'state_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'postal_code' => 'required|ir_postal_code'
        ]);

        if($validator->fails()){
            $validator->errors()->add('address_id' , $address->id);
            return redirect()->back()->withErrors($validator, 'addressUpdate')->withInput();
        }

        $address->update([
            'title' => $request->title,
            'phone_number' => $request->phone_number,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'postal_code' => $request->postal_code
        ]);

        alert()->success('آدرس مورد نظر ویرایش شد', 'باتشکر');
        return redirect()->route('user.users_profile.addresse');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getStateCitiesList(Request $request)
    {
        $cities = City::where('state_id', $request->state_id)->get();
        return $cities;
    }
}
