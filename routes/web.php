<?php

use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Models\Post;
use App\Models\Gallery;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\User\UserBookingController;

use App\Http\Controllers\Admin\TicketTypeController;
use App\Http\Controllers\Admin\BookingAdminController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\PageController;

Route::middleware(['auth'])->group(function () {

    // dashboard user
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    // riwayat pemesanan user
    Route::get('/dashboard/riwayat-pemesanan', [UserBookingController::class, 'index'])
        ->name('user.bookings.index');

    Route::get('/dashboard/riwayat-pemesanan/{booking}', [UserBookingController::class, 'show'])
        ->name('user.bookings.show');
});

// HOME
Route::get('/', [HomeController::class, 'index'])->name('home');

// PAGES DINAMIS (dari tabel pages)
Route::get('/profil', function () {
    $page = Page::where('slug', 'profil')->where('is_published', true)->firstOrFail();
    return view('pages.dynamic', compact('page'));
})->name('profil');

Route::get('/kontak', function () {
    $page = Page::where('slug', 'kontak')->where('is_published', true)->firstOrFail();
    return view('pages.dynamic', compact('page'));
})->name('kontak');

Route::get('/aturan', function () {
    $page = Page::where('slug', 'aturan')->where('is_published', true)->firstOrFail();
    return view('pages.dynamic', compact('page'));
})->name('aturan');

// MENU PUBLIK LAIN (static)
Route::get('/peta', fn () => view('pages.peta'))->name('peta');
Route::get('/tiket', fn () => view('pages.tiket'))->name('tiket');
Route::get('/kegiatan', fn () => view('pages.kegiatan'))->name('kegiatan');

// BERITA PUBLIK
Route::get('/berita', function () {
    $posts = Post::published()->latest()->paginate(6);
    return view('pages.berita', compact('posts'));
})->name('berita.index');

Route::get('/berita/{slug}', function ($slug) {
    $post = Post::published()->where('slug', $slug)->firstOrFail();
    return view('pages.berita_show', compact('post'));
})->name('berita.show');

// GALERI PUBLIK
Route::get('/galeri', function () {
    $items = Gallery::where('is_active', true)->orderBy('sort_order')->latest()->paginate(12);
    return view('pages.galeri', compact('items'));
})->name('galeri');


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';


/*
|--------------------------------------------------------------------------
| USER AREA (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{code}/pay', [BookingController::class, 'pay'])->name('booking.pay');
});


/*
|--------------------------------------------------------------------------
| ADMIN (WAJIB LOGIN + ROLE ADMIN)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        // Dashboard
        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

        // CRUD tiket
        Route::resource('tiket', TicketTypeController::class)->except(['show']);

        // ✅ PEMESANAN (pakai controller biar bisa detail)
        Route::get('/pemesanan', [BookingAdminController::class, 'index'])->name('pemesanan.index');
        Route::get('/pemesanan/{booking}', [BookingAdminController::class, 'show'])->name('pemesanan.show');
        Route::patch('/pemesanan/{booking}/status', [BookingAdminController::class, 'updateStatus'])->name('pemesanan.status');

        // Laporan (sementara view)
        Route::view('/laporan', 'admin.laporan.index')->name('laporan.index');

        // CRUD Berita (admin)
        Route::resource('berita', PostController::class)->except(['show']);

        // CRUD Galeri (admin)
        Route::resource('galeri', GalleryController::class)->except(['show']);

        // Kelola Halaman (pages)
        Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
        Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('/pages/{page}', [PageController::class, 'update'])->name('pages.update');
    });
