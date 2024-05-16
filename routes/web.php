<?php
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LeavereqController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Logins\LoginController;
use App\Http\Controllers\Logins\SecurityLogin;
use App\Http\Controllers\Logins\Security\SecurityController;
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
    return view('Logins.main');

});

// Login Controller
Route::get('/AdminLogin',[LoginController::class,'AdminLogin'])->name('AdminLogin');
Route::get('/StudentLogin',[LoginController::class,'StudentLogin'])->name('StudentLogin');
Route::get('/SecurityLogin',[LoginController::class,'SecurityLogin'])->name('SecurityLogin');
Route::get('/StudentSignUp',[LoginController::class,'StudentSignUp'])->name('StudentSignUp');
Route::get('/SecurityDashboard',[LoginController::class,'SecurityDashboard'])->name('SecurityDashboard');


// SecurityLogin Controller
Route::post('/SecurityLoginVerify',[SecurityLogin::class,'SecurityLoginVerify'])->name('SecurityLoginVerify');
Route::get('/SecuritySession',[SecurityLogin::class,'SecuritySession'])->name('SecuritySession');
Route::get('/Logout',[SecurityController::class,'Logout'])->name('Logout');

// Security Controller
Route::get('/OutingText',[SecurityController::class,'OutingText'])->name('OutingText');
Route::get('/LeaveText',[SecurityController::class,'LeaveText'])->name('LeaveText');


Route::post('/leavereqs', [LeavereqController::class, 'insert'])->name('leavereqs');
Route::post('/signup', [StudentController::class, 'insert'])->name('signup');
Route::get('/login', [StudentController::class,'login'])->name('login');
Route::get('/main', [StudentController::class,'signup'])->name('signup');
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
