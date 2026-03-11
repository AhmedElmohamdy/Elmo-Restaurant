<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminNotification;

class AdminController extends Controller
{
    public function index()
    {
        $notifications = AdminNotification::orderBy('created_at', 'desc')->take(5)->get();
        $notifCount    = AdminNotification::where('is_read', false)->count();
        return view(' Admin.Home.Index', compact('notifications', 'notifCount'));
    }
}
