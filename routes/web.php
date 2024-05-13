<?php
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LeavereqController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main');

});
Route::post('/leavereqs', [LeavereqController::class, 'insert'])->name('leavereqs');
Route::post('/signup', [StudentController::class, 'insert'])->name('signup');
Route::get('/login', [StudentController::class,'login'])->name('login');
Route::post('/login', [StudentController::class, 'loginfinal'])->name('loginfinal'); 
Route::get('/leavereqs', [LeavereqController::class,'show_leave_det'])->name('leavereqs');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
