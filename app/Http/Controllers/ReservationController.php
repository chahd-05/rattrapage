<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
{
    Reservation::create([
        'user_id' => auth()->id(),
        'book_id' => $request->book_id,
        'status' => 'pending'
    ]);

    return back()->with('success', 'Reservation sent!');
}

public function index()
{
    $reservations = Reservation::with(['user', 'book'])->get();

    return view('reservations.index', compact('reservations'));
}

public function approve(Reservation $reservation)
{
    $reservation->update([
        'status' => 'approved'
    ]);

    $reservation->book->update([
        'status' => 'borrowed'
    ]);

    return back();
}

public function reject(Reservation $reservation)
{
    $reservation->update([
        'status' => 'rejected'
    ]);

    return back();
}
}
