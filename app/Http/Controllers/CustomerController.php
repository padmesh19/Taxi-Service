<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CustomerController extends Controller
{
    /**
     * To view the user index page
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $users = User::with('roles')->has('customers')->paginate(10);
        return view('ui.customer.index', compact('users'));
    }

    /**
     * To view the user create page
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $roles = Role::all();
        return view('ui.customer.create', compact('roles'));
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
        $user->assignRole(['Customer']);
       
        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make('password123'),
            'user_id' => $user->id,
        ]);

        return redirect()->route('customer.index')->with('success', 'Customer created successfully!');
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
        return view('ui.customer.show', compact('user'));
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
        return view('ui.customer.edit', compact('user', 'roles'));
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
        $user->assignRole(['Customer']);
        return redirect()->route('customer.show', $user->id)->with('success', 'Customer updated successfully!');
    }


    public function destroy($userId)
    {
        $user = User::find($userId);
        $user->delete();
        return redirect()->route('customer.index')->with('success', 'Customer deleted successfully!');
    }
}
