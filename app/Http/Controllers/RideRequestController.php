<?php

namespace App\Http\Controllers;

use App\Models\CompletedRide;
use App\Models\Driver;
use Illuminate\Http\Request;
use App\Models\RideRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RideRequestController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        
        if($user->hasRole('Driver')){
            $rideRequests = RideRequest::where('driver_id',$id)->paginate(10);
        }elseif($user->hasRole('Customer')){
            $rideRequests = RideRequest::where('user_id',$id)->paginate(10);
        }else{
            $rideRequests = RideRequest::paginate(10);
        }

        return view('ui.Ride.index', ['rideRequests' => $rideRequests]);
    }
    
    public function create()
    {
        return view('ui.Ride.Create');
    }

    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'pickup' => 'required',
            'pickupLat' => 'required|numeric|min:-90|max:90',
            'pickupLong' => 'required|numeric|min:-180|max:180',
            'destination' => 'required',
            'destinationLat' => 'required|numeric|min:-90|max:90',
            'destinationLong' => 'required|numeric|min:-180|max:180',
            'pickTime' => 'required',
        ]);


        $nearest_driver = $this->findNearestTaxi($request->pickupLat, $request->pickupLong);
        $distance = $this->findDistance($request->pickupLat, $request->pickupLong, $request->destinationLat, $request->destinationLong);

        $rideRequest = new RideRequest;
        $rideRequest->name = $request->name;
        $rideRequest->phone = $request->phone;
        $rideRequest->pickup = $request->pickup;
        $rideRequest->pickupLat = $request->pickupLat;
        $rideRequest->pickupLong = $request->pickupLong;
        $rideRequest->destination = $request->destination;
        $rideRequest->destinationLat = $request->destinationLat;
        $rideRequest->destinationLong = $request->destinationLong;
        $rideRequest->pickTime = $request->pickTime;
        $rideRequest->distance = $distance;
        $rideRequest->status = 'waiting';
        $rideRequest->user_id = Auth::user()->id;
        $rideRequest->driver_id = $nearest_driver;
        

        $rideRequest->save();

        return redirect()->route('ride.index')->with('success', 'Your ride request has been submitted.');
    }

    public function edit($id)
    {
        $rideRequest = RideRequest::findOrFail($id);
        return view('ui.Ride.edit', compact('rideRequest'));
    }

    public function update(Request $request, $id)
    {
        $ride = RideRequest::findOrFail($id);


        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'pickup' => 'required',
            'pickupLat' => 'required|numeric|min:-90|max:90',
            'pickupLong' => 'required|numeric|min:-180|max:180',
            'destination' => 'required',
            'destinationLat' => 'required|numeric|min:-90|max:90',
            'destinationLong' => 'required|numeric|min:-180|max:180',
            'pickTime' => 'required',
        ]);

        $ride->update($validatedData);
        return redirect()->route('ride.index')->with('success', 'Your ride request has been successfully Updated.');
    }


    public function destroy($id)
    {
        $ride = RideRequest::findOrFail($id);
        $ride->delete();
        return redirect()->route('ride.index')->with('success', 'Your ride request has been Deleted successfully.');
    }


    public function findNearestTaxi($lat, $long)
    {
        $nearDriver = DB::table('drivers')
            ->select(
                'drivers.id',
                DB::raw("6371 * acos(cos(radians(" . $lat . "))* cos(radians(drivers.latitude))* cos(radians(drivers.longitude) - radians(" . $long . "))+ sin(radians(" . $lat . "))* sin(radians(drivers.latitude))) AS distance")
            )
            ->orderBy('distance', 'asc')
            ->first();
        
        $nearDriver = $nearDriver->id;
        $drivers = Driver::find($nearDriver);
        $nearestDriver = $drivers->user_id;
        return $nearestDriver;
    }


    public function findDistance($pickupLat, $pickupLong, $destinationLat, $destinationLong)
    {
        $earth_radius = 6371; // km
        $lat1 = $pickupLat;
        $lon1 = $pickupLong;
        $lat2 = $destinationLat;
        $lon2 = $destinationLong;


        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);


        $delta_lat = $lat2 - $lat1;
        $delta_lon = $lon2 - $lon1;
        $a = sin($delta_lat / 2) * sin($delta_lat / 2) + cos($lat1) * cos($lat2) * sin($delta_lon / 2) * sin($delta_lon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earth_radius * $c;
        return $distance;

    }

    public function RideRequestAccept($id)
    {
        $rideRequest = RideRequest::find($id);
        $rideRequest->status = 'accepted';
        $rideRequest->save();
        return redirect()->back();
    }


    public function RideRequestReject($id)
    {
        $rideRequest = RideRequest::find($id);
        $rideRequest->status = 'rejected';
        $rideRequest->save();
        return redirect()->back();
    }

    public function show($id)

    {
        $rideRequest = RideRequest::findOrFail($id);
        return view('ui.Ride.show', compact('rideRequest'));
    }

    public function rideCompleted($id)
    {
        $rideRequest = RideRequest::findOrFail($id);
        $rideRequest->status = "completed";
        $rideRequest->save();

        $completed_ride = new CompletedRide();
        $completed_ride->ride_id = $rideRequest->id;
        $completed_ride->customer_id = $rideRequest->user_id;
        $completed_ride->driver_id = $rideRequest->driver_id;
        $completed_ride->save();

        return redirect()->route('ride.index')->with('success', 'Payment Created Successfully');
    }



    public function rideHistory()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        
        if($user->hasRole('Driver')){
            $rideRequests = RideRequest::where('driver_id',$id)->where('status', 'completed')->paginate(10);
        }elseif($user->hasRole('Customer')){
            $rideRequests = RideRequest::where('user_id',$id)->where('status', 'completed')->paginate(10);
        }else{
            $rideRequests = RideRequest::where('status', 'completed')->paginate(10);
        }

        return view('ui.Ride.history', ['rideRequests' => $rideRequests]);
    }

    
    public function distance()
    {
        $rideRequest = RideRequest::all();
        $distance = $rideRequest->distance;
        return redirect()->action('PaymentController@index', ['Distance' => $distance]);
    }

}
