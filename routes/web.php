<?php
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LeavereqController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Logins\LoginController;
use App\Http\Controllers\Logins\Students\LeaveRequest;
use App\Http\Controllers\Logins\SecurityLogin;
use App\Http\Controllers\Logins\Security\SecurityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\stud_profile;
use App\Http\Controllers\Logins\StudentLogin;

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
//Forgot Password
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget-password');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset.password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset.password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

// Login Controller
Route::get('/AdminLogin',[LoginController::class,'AdminLogin'])->name('AdminLogin');
Route::get('/StudentLogin',[LoginController::class,'StudentLogin'])->name('StudentLogin');
Route::get('/SecurityLogin',[LoginController::class,'SecurityLogin'])->name('SecurityLogin');
Route::get('/StudentSignUp',[LoginController::class,'StudentSignUp'])->name('StudentSignUp');

// SecurityLogin Controller
Route::get('SecurityDashboard',[SecurityLogin::class,'SecurityDashboard'])->name('SecurityDashboard');
Route::post('/SecurityLoginVerify',[SecurityLogin::class,'SecurityLoginVerify'])->name('SecurityLoginVerify');
Route::get('/SecuritySession',[SecurityLogin::class,'SecuritySession'])->name('SecuritySession');
Route::get('/Logout',[SecurityLogin::class,'Logout'])->name('Logout');

// Security Controller
Route::get('/OutingText',[SecurityController::class,'OutingText'])->name('OutingText');
Route::get('/LeaveText',[SecurityController::class,'LeaveText'])->name('LeaveText');

// StudentLogin Controller
Route::get('/StudentDashboard',[StudentLogin::class,'StudentDashboard'])->name('StudentDashboard');
Route::post('StudentLoginVerify',[StudentLogin::class,'StudentLoginVerify'])->name('StudentLoginVerify');
Route::get('StudentSession',[StudentLogin::class,'StudentSession'])->name('StudentSession');
Route::get('StudentLogout',[StudentLogin::class,'StudentLogout'])->name('StudentLogout');

// Student Controllers
Route::get('/LeaveRequestPage',[LeaveRequest::class,'LeaveRequestPage'])->name('LeaveRequestPage');
Route::post('/InsertLeaveRequest',[LeaveRequest::class,'InsertLeaveRequest'])->name('InsertLeaveRequest');
Route::get('/DisabledDetails',[LeaveRequest::class,'DisabledDetails'])->name('DisabledDetails');
Route::get('/leavereqshist', [LeaveRequest::class,'show_leave_det'])->name('leavereqshist');
Route::post('/signup', [StudentController::class, 'insert'])->name('signup');
Route::get('/main', [StudentController::class,'signup'])->name('signup');

// Route::post('/leavereqs', [LeavereqController::class, 'insert'])->name('leavereqs');
// Route::get('/login', [StudentController::class,'login'])->name('login');
//Route::post('/login', [StudentController::class, 'loginfinal'])->name('loginfinal'); 
// Route::get('/leavereqs', [LeavereqController::class,'show_leave_det'])->name('leavereqs');


//Profile Section
Route::get('/studupdate', [stud_profile::class,'changePassword'])->name('updatepassword');
Route::post('/change-password', [stud_profile::class, 'changePasswordSave'])->name('postChangePassword');
Route::post('/change-roomno', [stud_profile::class, 'changeroomno'])->name('postChangeroomno');
Route::post('/change-hostel', [stud_profile::class, 'changehostel'])->name('postChangehostel');
Route::post('/change-phoneno', [stud_profile::class, 'changephoneno'])->name('postChangephoneno');
Route::post('/change-email', [stud_profile::class, 'changeemail'])->name('postChangeemail');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
