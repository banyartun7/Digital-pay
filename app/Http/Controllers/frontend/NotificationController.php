<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\frontend\NotificationController;

class NotificationController extends Controller
{
    public function index(){
        $user = auth()->guard('web')->user();
        $notifications = $user->notifications()->paginate(5);
        return view('frontend.notification', compact('user', 'notifications'));
    }

    public function notificationDetail(String $id){
        $user = auth()->guard('web')->user();
        $notification = $user->notifications()->where('id', $id)->firstOrFail();
        $notification->markAsRead();
        return view('frontend.notification_detail', compact('notification'));
    }
}
