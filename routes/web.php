<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    $books = Book::with('category')
        ->latest()
        ->take(12)
        ->get();

    $categories = Category::take(4)->get();

    return view('welcome', compact('books', 'categories'));
})->name('welcome');

Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/reviews/{reviewId}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{reviewId}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{reviewId}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

Route::middleware(['auth', 'verified', 'member'])->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

    Route::get('/riwayat', [PeminjamanController::class, 'riwayat'])->name('riwayat');

    Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/create', [LoanController::class, 'create'])->name('loans.create');
    Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');

    Route::get('/my-fines', [FineController::class, 'memberFines'])->name('fines.member');

    Route::get('/books/{bookId}/reviews', [ReviewController::class, 'indexByBook'])->name('reviews.index');
    Route::get('/books/{bookId}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/books/{bookId}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

Route::prefix('admin')->middleware(['auth', 'verified', 'petugas'])->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('admin.books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('admin.books.create');
    Route::post('/books', [BookController::class, 'store'])->name('admin.books.store');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('admin.books.show');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
    Route::put('/books/{id}', [BookController::class, 'update'])->name('admin.books.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('admin.books.destroy');

    Route::get('/loans', [LoanController::class, 'index'])->name('admin.loans.index');
    Route::get('/loans/{id}', [LoanController::class, 'show'])->name('admin.loans.show');
    Route::get('/loans/{id}/edit', [LoanController::class, 'edit'])->name('admin.loans.edit');
    Route::put('/loans/{id}', [LoanController::class, 'update'])->name('admin.loans.update');
    Route::delete('/loans/{id}', [LoanController::class, 'destroy'])->name('admin.loans.destroy');

    Route::get('/fines', [FineController::class, 'index'])->name('fines.index');
    Route::get('/fines/{fine}', [FineController::class, 'show'])->name('fines.show');
    Route::post('/fines/{fine}/mark-paid', [FineController::class, 'markPaid'])->name('fines.mark-paid');
    Route::match(['get', 'post'], '/fines/generate', [FineController::class, 'generateFines'])->name('fines.generate');
});

Route::prefix('admin')->middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);

    Route::delete('/fines/{fine}', [FineController::class, 'destroy'])->name('fines.destroy');

    Route::get('/reviews', [ReviewController::class, 'adminIndex'])->name('reviews.admin-index');
    Route::post('/reviews/{reviewId}/approve', [ReviewController::class, 'approve'])->name('reviews.approve');
    Route::post('/reviews/{reviewId}/reject', [ReviewController::class, 'reject'])->name('reviews.reject');
});

require __DIR__.'/auth.php';
