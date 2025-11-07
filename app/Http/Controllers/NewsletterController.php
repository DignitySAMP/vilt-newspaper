<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $newsletter = Newsletter::where('user_id', Auth::id())->first();

        if (!$newsletter) {

            Newsletter::create([
                'user_id' => Auth::user()->id
            ]);

            return redirect()->back()->with('newsletter', 'You have successfully subscribed to the newsletter');
        }

        else return redirect()->back()->withErrors(['email' => 'You are already subscribed to the newsletter']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $newsletter = Newsletter::where('user_id', Auth::id())->first();

        if ($newsletter) {
            Newsletter::destroy($newsletter->id);
            return redirect()->back()->with('newsletter', 'You have successfully unsubscribed from the newsletter.');
        }
        else return redirect()->back()->withErrors(['email' => 'You aren\'t subscribed to the newsletter']);
    }
}
