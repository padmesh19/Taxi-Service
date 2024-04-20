<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DriverController extends Controller
{
 /**
     * To view the user index page
     *
     * @return Application|Factory|View
     */
    public function index()
    {
       $users = User::with('roles')->has('drivers')->paginate(10);
        return view('ui.driver.index', compact('users'));
    }

    /**
     * To view the user create page
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $roles = Role::all();
        return view('ui.driver.create', compact('roles'));
    }

    /**
     * To store the user details
     *
     * @param UserStoreRequest $request
     * @return RedirectResponse
     */
    public function store(UserStoreRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password123'),
        ]);
        $user->assignRole(['Driver']);
       
        Driver::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make('password123'),
            'user_id' => $user->id,
        ]);

        return redirect()->route('driver.index')->with('success', 'driver created successfully!');
    }

    /**
     * To view the user show page
     *
     * @param $userId
     * @return Application|Factory|View
     */
    public function show($userId)
    {
        $user = User::findOrFail($userId);
        return view('ui.driver.show', compact('user'));
    }

    /**
     * To view the user edit page
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('ui.driver.edit', compact('user', 'roles'));
    }

    /**
     * To update the user details
     *
     * @param UserUpdateRequest $request
     * @param $userId
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request, $userId)
    {
        $user = User::find($userId);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password123'),
        ]);
        $user->assignRole(['Driver']);
        return redirect()->route('driver.show', $user->id)->with('success', 'Driver updated successfully!');
    }

    public function destroy($userId)
    {
        $user = User::find($userId);
        $user->delete();
        return redirect()->route('driver.index')->with('success', 'driver deleted successfully!');
    }

    public function Location(){
        $id = Auth::id();
        $driver = Driver::where('User_id',$id)->first();
        return view('ui.driver.showLocation', compact('driver'));
    }

    public function editLocation($id){
        $driver = Driver::where('User_id',$id)->first();
        return view('ui.driver.editLocation', compact('driver'));
    }

    public function updateLocation(Request $request, $id){
        $driver = Driver::where('User_id',$id)->first();
        $driver->update([
            'location' => $request->location,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
        return redirect()->route('driverLocation.show', $driver->id)->with('success', 'Driver Location updated successfully!');
    }
}

