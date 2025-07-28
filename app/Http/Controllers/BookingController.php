<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Customer: Book a service
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today'
        ]);

        $userId = Auth::id(); // Get authenticated user's ID directly

        return Booking::create([
            'user_id' => $userId,
            'service_id' => $request->service_id,
            'booking_date' => $request->booking_date,
            'status' => 'pending'
        ]);
    }

    // Customer: My bookings
    public function myBookings()
    {
        $userId = Auth::id();

        $user = User::with(['bookings.service']) // Eager load bookings with service
            ->findOrFail($userId);

        return $user->bookings;
    }

    // Admin: All bookings
    public function allBookings()
    {
        return Booking::with(['user', 'service'])->get();
    }
}
