<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use App\Models\Message;
use App\Models\Category;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function show(Notification $notification) {
        $user = auth()->user();
    
        $following = DB::table('follows')
            ->where('follower_id', $user->id)
            ->pluck('created_at', 'followed_id');
    
        $notifications = Notification::whereIn('user_id', array_keys($following->toArray()))
            ->where(function ($query) use ($following) {
                foreach ($following as $followed_id => $followed_at) {
                    $query->orWhere(function ($q) use ($followed_id, $followed_at) {
                        $q->where('user_id', $followed_id)
                          ->where('created_at', '>', $followed_at);
                    });
                }
            })
            ->latest()
            ->get();

        $messages = Message::where('user_id', auth()->id())->latest()->get();

        return view("listings.show-notifications", [
            "categories" => Category::all(),
            "users" => User::all(),
            "notifications" => $notifications,
            "messages" => $messages
        ]);
    }

    public function destroy(Notification $notification) {
        $notification->delete();

        return redirect("/home/notifications");
    }

    public function interest(Message $message, Listing $listing) {
        $existingMessage = Message::where('interested_user_id', auth()->id())
            ->where('user_id', $listing->user_id)
            ->where('description', 'by mal záujem o ' . $listing->item_name)
            ->first();
    
        if (!$existingMessage && auth()->id() != $listing->user_id) {
            Message::create([
                'interested_user_id' => auth()->id(),
                'user_id' => $listing->user_id,
                'description' => 'by mal záujem o ' . $listing->item_name,
            ]);
        }
    
        return redirect()->back();
    }

    public function destroy_message(Message $message) {
        $message->delete();

        return redirect("/home/notifications");
    }

    public function report($id) {
        $existingReport = Message::where('interested_user_id', auth()->id())
            ->where('user_id', 1)
            ->where('description', 'nahlásil inzerát s id ' . $id)
            ->first();
    
        if (!$existingReport && auth()->id() != 1) {
            Message::create([
                'interested_user_id' => auth()->id(),
                'user_id' => 1,
                'description' => 'nahlásil inzerát s id ' . $id,
            ]);
        }

        return back()->with("message", "Inzerát bol nahlásený!");
    }
}