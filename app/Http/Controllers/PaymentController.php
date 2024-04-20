<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\RideRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return view('ui.payment.index', compact('payments'));
    }

   
    public function create($id)
    {
        $rideID = $id;
        return view('ui.payment.create', ['rideId' => $rideID]);

    }

  
    public function store(Request $request)
    {
        $request->validate([
            'totalTime' => 'required|numeric',
            'waitTime' => 'required|numeric',
            'charge' => 'required|numeric',
        ]);

        $rideRequest = RideRequest::find($request->rideId);
        $distance = $rideRequest->distance;

        $amount = $this->fare($distance, $request->waitTime, $request->charge);

        $payment = new Payment;
        $payment->ride_id = $request->rideId;
        $payment->total_time = $request->totalTime;
        $payment->wait_time = $request->waitTime;
        $payment->amount = $amount;
        $payment->charge = $request->charge;
        $payment->status = 'Not Paid';

        $payment->save();

        return redirect()->route('ride.complete', $payment->ride_id);
    }

    public function fare($distance, $waitTime, $charge)
    {
        if($distance >= 1){
            $fare = 5 + (2 * ($distance - 1)) + (0.25 * $waitTime) + $charge  ;
        }else{
            $fare = 5 + (0.25 * $waitTime) + $charge  ;
        }
        return $fare;

    }

   
    public function show($id)
    {
        $payment = Payment::where('ride_id',$id)->first();
        return view('ui.payment.show', compact('payment'));
    }


    public function edit(Payment $payment)
    {
        $payments = Payment::all();
        return view('ui.payment.edit', compact('payment'));
    }

    
    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);
        $payment->update([
           
        ]);
        return redirect()->route('payment.show', $payment->id)->with('success', 'payment updated successfully!');
    }

    
    public function destroy($id)
    {
        $payment = Payment::find($id);
        $payment->delete();
        return redirect()->route('payment.index')->with('success', 'Payment deleted successfully!');
    }
}
