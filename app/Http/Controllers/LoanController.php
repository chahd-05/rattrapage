<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function returnBook(Loan $loan)
{
    $loan->update([
        'status' => 'returned',
        'returned_at' => now(),
    ]);

    $loan->book->update([
        'status' => 'available',
    ]);

    return back()->with('success', 'Book returned successfully');
}
}
