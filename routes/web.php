<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\LoanController;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Reservation;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    if (auth()->user()->role === 'admin') {
        return redirect('/admin');
    }

    $search = request('search');

    $books = Book::when($search, function ($query) use ($search) {
        $query->where('title', 'like', "%$search%")
              ->orWhere('author', 'like', "%$search%");
    })->get();

    $reservations = Reservation::where('user_id', auth()->id())
        ->with('book')
        ->get();

    $loans = Loan::where('user_id', auth()->id())
        ->with('book')
        ->get();

    return view('dashboard', compact('books', 'reservations', 'loans', 'search'));

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/reservations', [ReservationController::class, 'store']);

    Route::get('/my-loans', function () {
        $loans = auth()->user()->loans()->with('book')->get();
        return view('loans.index', compact('loans'));
    });

});

Route::middleware(['auth', 'is_admin'])->group(function () {

    Route::get('/admin', function () {
        return view('admin.dashboard', [
            'booksCount' => Book::count(),
            'usersCount' => \App\Models\User::count(),
            'reservationsCount' => Reservation::count(),
            'loansCount' => Loan::count(),
            'pendingReservations' => Reservation::where('status', 'pending')->with(['user','book'])->get(),
            'loans' => Loan::with('book','user')->get(),
        ]);
    });

    Route::resource('books', \App\Http\Controllers\BookController::class);

    Route::get('/reservations', [ReservationController::class, 'index']);
    Route::post('/reservations/{reservation}/approve', [ReservationController::class, 'approve']);
    Route::post('/reservations/{reservation}/reject', [ReservationController::class, 'reject']);

    Route::post('/loans/{loan}/return', [LoanController::class, 'returnBook']);

});

require __DIR__.'/auth.php';