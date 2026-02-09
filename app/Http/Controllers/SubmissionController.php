<?php

namespace App\Http\Controllers;

use App\Models\LoveMessage;
use App\Models\RsvpSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function storeRsvp(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'guestNames' => 'required|string|max:1000',
            'guestCount' => 'required|integer|min:1|max:20',
            'contactMethodRsvp' => 'required|in:phone,email,facebook',
            'contactPhoneRsvp' => 'required_if:contactMethodRsvp,phone|nullable|string|max:255',
            'contactEmailRsvp' => 'required_if:contactMethodRsvp,email|nullable|email|max:255',
            'contactFacebookRsvp' => 'required_if:contactMethodRsvp,facebook|nullable|string|max:255',
        ]);

        $contactValue = match ($data['contactMethodRsvp']) {
            'phone' => $data['contactPhoneRsvp'] ?? null,
            'email' => $data['contactEmailRsvp'] ?? null,
            'facebook' => $data['contactFacebookRsvp'] ?? null,
        };

        $existingRsvp = RsvpSubmission::where('contact_value', $contactValue)
            ->where('contact_method', $data['contactMethodRsvp'])
            ->first();

        if ($existingRsvp) {
            return back()->with('error', 'rsvp-duplicate');
        }

        RsvpSubmission::create([
            'guest_names' => $data['guestNames'],
            'guest_count' => $data['guestCount'],
            'contact_method' => $data['contactMethodRsvp'],
            'contact_value' => $contactValue,
        ]);

        return back()->with('status', 'rsvp-saved');
    }

    public function storeLove(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'loveName' => 'required|string|max:255',
            'loveMessage' => 'required|string|max:500',
            'contactMethodLove' => 'required|in:phone,email,facebook',
            'contactPhoneLove' => 'required_if:contactMethodLove,phone|nullable|string|max:255',
            'contactEmailLove' => 'required_if:contactMethodLove,email|nullable|email|max:255',
            'contactFacebookLove' => 'required_if:contactMethodLove,facebook|nullable|string|max:255',
        ]);

        $contactValue = match ($data['contactMethodLove']) {
            'phone' => $data['contactPhoneLove'] ?? null,
            'email' => $data['contactEmailLove'] ?? null,
            'facebook' => $data['contactFacebookLove'] ?? null,
        };

        $existingLove = LoveMessage::where('contact_value', $contactValue)
            ->where('contact_method', $data['contactMethodLove'])
            ->first();

        if ($existingLove) {
            return back()->with('error', 'love-duplicate');
        }

        LoveMessage::create([
            'name' => $data['loveName'],
            'message' => $data['loveMessage'],
            'contact_method' => $data['contactMethodLove'],
            'contact_value' => $contactValue,
        ]);

        return back()->with('status', 'love-sent');
    }

    public function dashboard()
    {
        $rsvps = RsvpSubmission::orderBy('created_at', 'desc')->get();
        $loveMessages = LoveMessage::orderBy('created_at', 'desc')->get();

        $totalAttending = $rsvps->sum('guest_count');
        $totalRsvps = $rsvps->count();
        $totalLoveMessages = $loveMessages->count();

        return view('dashboard', compact('rsvps', 'loveMessages', 'totalAttending', 'totalRsvps', 'totalLoveMessages'));
    }
}
