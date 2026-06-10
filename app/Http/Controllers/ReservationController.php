<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
{
    $userId = auth()->id();
    $bookId = $request->book_id;

    $existing = Reservation::where('user_id', $userId)
        ->where('book_id', $bookId)
        ->whereIn('status', ['pending', 'approved'])
        ->first();

    if ($existing) {
        return back()->with('error', 'You already requested this book.');
    }

    $book = Book::find($bookId);

    if ($book->status === 'borrowed') {
        return back()->with('error', 'Book is currently borrowed.');
    }

    Reservation::create([
        'user_id' => $userId,
        'book_id' => $bookId,
        'status' => 'pending'
    ]);

    return back()->with('success', 'Reservation sent!');
}

public function approve(Reservation $reservation)
{
    
    $existingLoan = Loan::where('book_id', $reservation->book_id)
        ->where('status', 'ongoing')
        ->first();

    if ($existingLoan) {
        return back()->with('error', 'Book already borrowed.');
    }

    $reservation->update([
        'status' => 'approved'
    ]);

    Loan::create([
        'user_id' => $reservation->user_id,
        'book_id' => $reservation->book_id,
        'borrowed_at' => now(),
        'status' => 'ongoing'
    ]);

    $reservation->book->update([
        'status' => 'borrowed'
    ]);

    return back()->with('success', 'Approved successfully');
}

public function reject(Reservation $reservation)
{
    $reservation->update([
        'status' => 'rejected'
    ]);

    return back();
}
}
