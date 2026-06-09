<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Reservation;
use Carbon\Carbon;
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

    
    Loan::create([
        'user_id' => $reservation->user_id,
        'book_id' => $reservation->book_id,
        'borrowed_at' => Carbon::now(),
        'status' => 'ongoing'
    ]);

    $reservation->book->update([
        'status' => 'borrowed'
    ]);

    return back()->with('success', 'Reservation approved and loan created');
}

public function reject(Reservation $reservation)
{
    $reservation->update([
        'status' => 'rejected'
    ]);

    return back();
}
}
