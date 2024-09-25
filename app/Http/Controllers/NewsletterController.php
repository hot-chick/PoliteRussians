<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        // Validate the email input and check if it already exists
        $validated = $request->validate([
            'email' => 'required|email'
        ]);

        // Check if the email is already subscribed
        $existingSubscriber = Subscriber::where('email', $validated['email'])->first();

        if ($existingSubscriber) {
            return redirect()->back()->with('error', 'Вы уже подписаны на новости.');
        }

        // Store the new subscriber
        Subscriber::create(['email' => $validated['email']]);

        return redirect()->back()->with('success', 'Вы успешно подписались на новости!');
    }
}
