<?php
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LeavereqController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Logins\Admin\ForgotPasswordAdminController;
use App\Http\Controllers\Logins\Security\ForgotPasswordSecurityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Logins\LoginController;
use App\Http\Controllers\Logins\Students\LeaveRequest;
use App\Http\Controllers\Logins\SecurityLogin;
use App\Http\Controllers\Logins\Security\SecurityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\stud_profile;
use App\Http\Controllers\Logins\StudentLogin;
use App\Http\Controllers\Logins\Students\OutingHistory;
use App\Http\Controllers\Logins\Security\OutingController;
use App\Http\Controllers\Logins\AdminLogin;

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
//Reset Password for Security
Route::get('reset_pass_sec', [ForgotPasswordSecurityController::class, 'showForgetPasswordForm'])->name('reset_pass_sec');
Route::post('sec-forget-password', [ForgotPasswordSecurityController::class, 'submitForgetPasswordForm'])->name('sec-forget.password.post'); 
Route::get('sec-reset.password/{token}', [ForgotPasswordSecurityController::class, 'showResetPasswordForm'])->name('sec-reset.password.get');
Route::post('sec-reset.password', [ForgotPasswordSecurityController::class, 'submitResetPasswordForm'])->name('sec-reset.password.post');

//Reset Password for Admin
Route::get('reset_pass_admin', [ForgotPasswordAdminController::class, 'showForgetPasswordForm'])->name('reset_pass_admin');
Route::post('admin-forget-password', [ForgotPasswordAdminController::class, 'submitForgetPasswordForm'])->name('admin-forget.password.post'); 
Route::get('admin-reset.password/{token}', [ForgotPasswordAdminController::class, 'showResetPasswordForm'])->name('admin-reset.password.get');
Route::post('admin-reset.password', [ForgotPasswordAdminController::class, 'submitResetPasswordForm'])->name('admin-reset.password.post');

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
Route::get('/SecurityLogout',[SecurityLogin::class,'SecurityLogout'])->name('SecurityLogout');

// Security Controller
Route::get('/OutingText',[SecurityController::class,'OutingText'])->name('OutingText');
Route::get('/LeaveText',[SecurityController::class,'LeaveText'])->name('LeaveText');

// StudentLogin Controller
Route::get('/StudentDashboard',[StudentLogin::class,'StudentDashboard'])->name('StudentDashboard');
Route::post('StudentLoginVerify',[StudentLogin::class,'StudentLoginVerify'])->name('StudentLoginVerify');
Route::get('StudentSession',[StudentLogin::class,'StudentSession'])->name('StudentSession');
Route::get('StudentLogout',[StudentLogin::class,'StudentLogout'])->name('StudentLogout');
Route::get('StudentProfile',[StudentLogin::class,'StudentProfile'])->name('StudentProfile');

// Student Page's Outing Controller
Route::get('/GetOutings',[OutingHistory::class,'GetOutings'])->name('GetOutings');


// Security Page's Outing Controller
Route::post('/InsertOuting',[OutingController::class,'InsertOuting'])->name('InsertOuting');
Route::get('/OutingStatus',[OutingController::class,'OutingStatus'])->name('OutingStatus');
Route::get('/UnclosedOuting',[OutingController::class,'UnclosedOuting'])->name('UnclosedOuting');
Route::get('/BoysOuting',[OutingController::class,'BoysOuting'])->name('BoysOuting');
Route::get('/GirlsOuting',[OutingController::class,'GirlsOuting'])->name('GirlsOuting');


// Student Controllers
Route::get('/LeaveRequestPage',[LeaveRequest::class,'LeaveRequestPage'])->name('LeaveRequestPage');
Route::post('/InsertLeaveRequest',[LeaveRequest::class,'InsertLeaveRequest'])->name('InsertLeaveRequest');
Route::get('/DisabledDetails',[LeaveRequest::class,'DisabledDetails'])->name('DisabledDetails');
Route::get('/leavereqshist', [LeaveRequest::class,'show_leave_det'])->name('leavereqshist');
Route::post('/signup', [StudentController::class, 'insert'])->name('signup');
Route::get('/main', [StudentController::class,'signup'])->name('signup');

// Admin Login Controller
Route::get('/AdminDashboard',[AdminLogin::class,'AdminDashboard'])->name('AdminDashboard');
Route::post('/AdminLoginVerify',[AdminLogin::class,'AdminLoginVerify'])->name('AdminLoginVerify');
Route::get('/AdminSession',[AdminLogin::class,'AdminSession'])->name('AdminSession');
Route::get('/AdminLogout',[AdminLogin::class,'AdminLogout'])->name('AdminLogout');

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
