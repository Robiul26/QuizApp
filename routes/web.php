<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ExamController;
use App\Http\Controllers\Backend\QuestionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\StudentExamController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfAuthenticated;
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
    // return view('frontend.index');
    return view('auth.login');
})->middleware(RedirectIfAuthenticated::class);

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
    Route::get('admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');

    // Students
    Route::get('student', [AdminController::class, 'AdminStudent'])->name('admin.student');

    //   Exam All Rote
    Route::controller(ExamController::class)->group(function () {
        Route::get('all/exam', 'AllExam')->name('all.exam');
        Route::get('add/exam', 'AddExam')->name('add.exam');
        Route::post('store/exam', 'StoreExam')->name('store.exam');
        Route::get('edit/exam/{id}', 'EditExam')->name('edit.exam');
        Route::Post('update/exam/{id}', 'UpdateExam')->name('update.exam');
        Route::get('exam/delete/{id}', 'DeleteExam')->name('delete.exam');
    }); //   Exam All Rote
    Route::controller(QuestionController::class)->group(function () {
        Route::get('all/question/{exam_id}', 'AllQuestion')->name('all.question');
        Route::get('add/question', 'AddQuestion')->name('add.question');
        Route::post('store/question', 'StoreQuestion')->name('store.question');
        Route::get('edit/question/{id}', 'EditQuestion')->name('edit.question');
        Route::Post('update/question/{id}', 'UpdateQuestion')->name('update.question');
        Route::get('question/delete/{id}', 'DeleteQuestion')->name('delete.question');
    });
});

// User All Route
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('question-paper/{exam_id}', [StudentExamController::class, 'QuestionPaper'])->name('exam-test');
    Route::post('answer/store', [StudentExamController::class, 'AnswerStore'])->name('answer.store');
    // Route::get('result/{exam_id}', [StudentExamController::class, 'ResultView'])->name('result.view');
});


// Admin login routes
Route::get('admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
