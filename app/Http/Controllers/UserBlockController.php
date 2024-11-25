<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;

class UserBlockController extends Controller
{
    public function userBlocked()
    {
        return view('userBlock.userBlock');
    }

    public function send_message(Request $request)
{
    // Retrieve the current date
    $currentDate = date('Y-m-d');

    // Get the message content from the request
    $message = $request->input('message');

    // Find the blocked user
    $blockedUser = User::findOrFail(auth()->user()->id);

    // Get the direction of the blocked user
    $direction = $blockedUser->Direction->lib_dir;

    // Find the admin user(s) based on their role
    $admins = User::where('role', 'admin')->pluck('id');

    // Create and save the notification
    foreach ($admins as $admin) {
        Notification::create([
            'id_sender' => $blockedUser->id,
            'id_receiver' => $admin,
            'message' => $message,
            'date' => $currentDate,
            'direction' => $direction,
        ]);
    }

    // Redirect back with a success message
    return redirect()->back()->with('success-msg', 'Message envoyé avec succès');
}
}



