<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminNotification;

class AdminNotificationController extends Controller
{

    public function getNotifications()
    {
        $notifications = AdminNotification::orderBy('created_at', 'desc')->take(5)->get();
        $count = AdminNotification::where('is_read', false)->count();

        $html = '';

        foreach ($notifications as $notif) {
            $boldClass = $notif->is_read ? 'text-muted' : 'fw-bold';
            $url       = $notif->url ?? route('Admin.index');
            $time      = $notif->created_at->diffForHumans();

            $html .= "
        <li>
            <a class=\"dropdown-item py-2 {$boldClass}\"
               href=\"#\"
               data-notif-id=\"{$notif->id}\"
               data-notif-url=\"{$url}\">
                {$notif->message}
                <br>
                <small class=\"text-muted fw-normal\">{$time}</small>
            </a>
        </li>
        <li><hr class=\"dropdown-divider my-0\"></li>
    ";
        }

        if ($notifications->isEmpty()) {
            $html = '<li><span class="dropdown-item text-muted text-center py-3">No notifications</span></li>';
        }

        if ($count > 0) {
            $html .= '
            <li><hr class="dropdown-divider my-0"></li>
            <li>
                <a class="dropdown-item text-center text-primary py-2"
                   href="#" onclick="markAllRead()">
                    ✅ Mark all as read
                </a>
            </li>
        ';
        }

        return response()->json(['html' => $html, 'count' => $count]);
    }

    public function markAsRead()
    {
        AdminNotification::where('is_read', false)->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }


    public function markOneAsRead(Request $request, $id)
    {
        $notif = AdminNotification::findOrFail($id);
        $notif->update(['is_read' => true]);

        return response()->json([
            'success' => true,
            'url'     => $notif->url ?? route('Admin.index')
        ]);
    }
}
