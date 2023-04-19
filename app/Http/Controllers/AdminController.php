<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where('is_admin', '=', 1)->get();
        return inertia::render('Admin/Admins/index', ['admins' => $data]);
    }

    public function indexEmployees()
    {
        $employees = User::where('is_confirmed', '=', 1)->with('company')->get();
        return inertia::render('Admin/Employee/index', ['employees' => $employees,]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia::render('Admin/Admins/create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'password' => ['required'],
            'email' => ['required', 'email']
        ]);

        try {
            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->newPassword),
                'is_admin' => 1,
            ]);
            $msg = 'Admin Créer avec succès';
            $status = '201';
            return redirect('/admin/admins')->with('message', $msg)->with('status', $status);
        } catch (\Throwable $th) {
            $msg = 'Email Exist déja.';
            $status = '422';
            return redirect('/admin/admins/create')->with('message', $msg)->with('status', $status);
        }
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
