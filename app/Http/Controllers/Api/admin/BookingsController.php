<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Http\Resources\BookingResource;
use App\Jobs\SendEmail;
use App\Mail\SampleEmail;
use App\Models\Booking;
use App\Models\Cars;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = 5;
        $bookings = Booking::orderBy('created_at', 'desc')->paginate($perPage);
        $count = Booking::count();
        return response()->json([
            'data' =>BookingResource::collection($bookings),
            'count' => $count,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status'=> 'required|string',
        ]);

        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['error' => 'Commande non trouvé.'], 404);
        }
        $car = Cars::find($booking->car_id);
        if( $request->status == 'confirmé') {
        
        $car->status = 'en location';
        $car->save();
        }



        $booking->status = $request->status;
        $booking->save();
        $transaction = Transactions::create([
            "trasaction_date"=>date('Y-m-d'),
            "trasaction_type"=>"Location",
            "amount"=> $booking->amount,
            "trasation_description"=>"Location du vehicule ".$car->brand,
            "trasaction_category"=>"Révenu",
        ]);
        $this->sendEmail($booking);

        return response()->json(['success'=>'change success'],200) ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function sendEmail(Booking $booking)
    {

        // dispatch(new SendEmail($booking));
        Mail::to($booking->email)->send(new SampleEmail($booking));

        //return response()->json(['message'=>'send success'],200);
    }
}
