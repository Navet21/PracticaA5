<?php
use App\Http\Controllers\CommunityLinkUserController;
use App\Http\Controllers\CommunityLinkController;
use App\Http\Controllers\ProfileController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [CommunityLinkController::class,'index'])
->middleware(['auth', 'verified'])
->name('dashboard');

Route::post('/dashboard', [CommunityLinkController::class,'store'])
->middleware(['auth', 'verified'])
->name('dashboard');

Route::get('/dashboard/{channel:slug}',[CommunityLinkController::class,'index']);

Route::get('/contact', function () {
    return view('contact');
})->middleware(['auth', 'verified'])->name('contact');

Route::get('/mylinks', [CommunityLinkController::class,'linksDeUsuarios'])
->middleware(['auth', 'verified'])
->name('mylinks');

Route::post('/votes/{link}',[CommunityLinkUserController::class,'store']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/linkstorage',function(){
    Artisan::call('storage:link');
});

//Crud
Route::resource('users', UserController::class)
    ->middleware('can:administrate,App\Models\User');

require __DIR__.'/auth.php';
