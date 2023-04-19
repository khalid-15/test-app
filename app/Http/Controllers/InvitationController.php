<?php

namespace App\Http\Controllers;

use App\Mail\Invitation as MailInvitation;
use App\Models\Company;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Inertia\Inertia;


class InvitationController extends Controller
{
    public function index()
    {
        $invitations = Invitation::get();
        // dd($invitation);
        return inertia::render('Admin/Invitations', ['invitations' => $invitations]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'company_id' => ['required']
        ]);

        if (!Invitation::where('email', '=', trim($request->email))->where('status', '!=', 'canceled')->exists()) {
            $invitation = Invitation::create([
                'email' => $request->email,
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'company_id' => $request->company_id,
                'token' => Str::random(32)
            ]);
            $name = $invitation->first_name . ' ' . $invitation->last_name;
            $url = 'localhost/invitation/confirm/' . $invitation->token;
            $company = Company::find($request->company_id);
            Mail::to(trim($request->email))->send(new MailInvitation($name, $url, $company->name));
            Activity()->log('Admin ' . Auth::user()->first_name . ' a invité l\'employé ' . $name .  ' a joindre la société ' . $company->name);
            $msg = 'Employee Invited';
            $state = '201';
        } else {
            $msg = 'Employee already Invited';
            $state = '422';
        }
        return Redirect('/admin/companies')->with('message', $msg)->with('status', $state);
    }

    public function confirm($token)
    {
        if (!$invitation = Invitation::where('token', $token)->where('status' , '=' , 'sent')->first()) {
            return Redirect('/NotAuthorized');
        }
        return inertia::render('Employee/ValidateProfile', ['invitation' => $invitation]);
    }

    public function cancel($id)
    {
        $invitation = Invitation::find($id);
        if ($invitation->status == 'sent') {
            $invitation->update(['status' => 'canceled']);
            Activity()->log(Auth::user()->first_name . ' a annulé l\'invitation de ' . $invitation->first_name . ' ' . $invitation->last_name);
            $msg = 'Invitation Annuler';
            $status = '201';
        } else {
            $msg = 'Failed to update invitation';
            $status = '400';
        }
        return Redirect('/admin/invitations')->with('message' ,$msg )->with('status' , $status);
    }
}
