<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::guard('admin')->user() ?? Auth::guard('users')->user();

        $notifications = $user->notifications()->paginate(10); // Paginate notifications
        $layout = Auth::guard('admin')->check() ? 'layouts.admin' : 'layouts.user';

        return view('notifications.index', compact('notifications', 'layout'));
    }
}
