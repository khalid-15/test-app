<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Activitylog\Models\Activity;
class ActivityController extends Controller
{
    public function index()
    {
        $lastActivity = Activity::orderBy('id', 'DESC')->get();
        return  inertia::render('Admin/ActivityLogs', ['activities' => $lastActivity]);
    }
}
