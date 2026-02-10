<?php

namespace App\Http\Controllers;

use App\Models\InvitationCode;
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
            'codeRsvp' => 'required|string|max:255',
        ]);

        // Check if the invitation code exists (case-insensitive)
        $invitationCode = InvitationCode::where('code', strtoupper($data['codeRsvp']))->first();

        if (!$invitationCode) {
            return back()->withErrors(['codeRsvp' => 'The invitation code you entered is invalid. Please check and try again.'])->withInput();
        }

        // Check if the code has already been used
        if ($invitationCode->is_used) {
            return back()->withErrors(['codeRsvp' => 'This invitation code has already been used. Each code can only be used once.'])->withInput();
        }

        // Check if the guest count exceeds the maximum allowed for this code
        if ($data['guestCount'] > $invitationCode->max_guests) {
            return back()->withErrors(['guestCount' => "This invitation code can only accommodate up to {$invitationCode->max_guests} guest(s). Please adjust the number of guests."])->withInput();
        }

        // Create the RSVP submission
        RsvpSubmission::create([
            'guest_names' => $data['guestNames'],
            'guest_count' => $data['guestCount'],
            'contact_code' => strtoupper($data['codeRsvp']),
        ]);

        // Mark the code as used
        $invitationCode->update(['is_used' => true]);

        return back()->with('status', 'rsvp-saved');
    }

    public function storeLove(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'loveName' => 'required|string|max:255',
            'loveMessage' => 'required|string|max:500',
        ]);

        LoveMessage::create([
            'name' => $data['loveName'],
            'message' => $data['loveMessage'],
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
