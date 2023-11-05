<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Cars;
use Illuminate\Http\Request;

class BookinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $car = Cars::find($id);
        return view("page.booking",compact("car"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingRequest $request)
    {
        $data = $request->except('_token');
        // dd($data);
        if($request->input('car_id') && $request->input('amount')){
            $data['car_id']=$request->input('car_id');
            $data['amount']=$request->input('amount');
        }else{
            return response()->json(['error' => 'not autorized'], 400);
        }
        $data['status']='En attente de traitement';
  
        $booking = Booking::create($data);
     
        return view('page.confim_booking');
      
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
