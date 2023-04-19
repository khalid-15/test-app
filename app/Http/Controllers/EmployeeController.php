<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia::render('Employee/Dashboard', [
            'company' => Auth::user()->company,
            'user' => Auth::user(),
            'employees' => Auth::user()->company->employees
        ]);
    }


    public function company()
    {
        $company = Auth::user()->company;
        $employees = $company->employees;
        return inertia::render('Employee/Company', ['Company' => $company, 'Employees' => $employees]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'password' => ['required'],
            'birth_day' => ['before:today'],
            'adresse' => ['string'],
            'password' => ['string'],
            'phone' => ['string']
        ]);
        // Connected User ID
        // $user = User::where('id', '=', $request->id)->where('is_admin', '=', false)->first();
        $user = User::where('id', '=', Auth::user()->id)->where('is_admin', '=', false)->first();
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birth_day' => $request->birth_day,
            'adresse' => $request->adresse,
            'phone' => $request->phone,
        ]);

        return Redirect('/dashboard');
    }


    public function validateProfile(Request $request)
    {
        // test on validated profile
        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'password' => ['required'],
            'birth_day' => ['before:today'],
            'adresse' => ['string'],
            'password' => ['string'],
            'phone' => ['string']
        ]);

        $invitation = Invitation::find($request->id);
        $invitation->update(['status' => 'validated']);


        $user = User::create([
            'email' => $invitation->email,
            'first_name' => $invitation->first_name,
            'last_name' => $invitation->last_name,
            'company_id' => $invitation->company_id,
            'password' => Hash::make($request->newPassword),
            'birth_day' => $request->birth_day,
            'adresse' => $request->adresse,
            'phone' => $request->phone,
            'is_confirmed' => true,
        ]);

        Activity()->log($user->first_name . ' a valider l’invitation' );

        return Redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
