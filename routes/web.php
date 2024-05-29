<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

use App\Http\Controllers\GameController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\MediaController;

use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ResponseAjaxController;
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');




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

Route::name('login') ->get('/login',  [HomeController::class, 'login']);
// Route::name('logout')->get('/logout', [HomeController::class, 'logout']);
Auth::routes();

    Route::get('/upload', [MediaController::class, 'showUploadForm'])->name('media.upload.form');
    Route::post('/upload/video', [MediaController::class, 'videoUpload'])->name('media.video.upload');
    Route::post('/upload/image', [MediaController::class, 'imageUpload'])->name('media.image.upload');
    Route::post('/upload/video_url', [MediaController::class, 'videoUrlUpload'])->name('media.video.url.upload');
    Route::post('/upload/image_url', [MediaController::class, 'imageUrlUpload'])->name('media.image.url.upload');


Route::middleware(['web', 'auth'])->group(function () {
    Route::name('home')->get('/', [HomeController::class, 'index']);

    Route::name('response.')->prefix('response')->group(function () {
        Route::name('ajax.')->prefix('ajax')->group(function () {
            Route::name('question')->post('question', [ResponseAjaxController::class, 'question']);
        });
        Route::name('topic')   ->get('questionnaire/{questionnaire}', [ResponseController::class, 'topic']);
        Route::name('question')->get('topic/{topic}',                 [ResponseController::class, 'question']);
        Route::name('finish')->get('finish',                          [ResponseController::class, 'finish']);
    });

    Route::name('questionnaire.')->prefix('questionnaire')->group(callback: function () {
        Route::name('create')->get('create',                 [QuestionnaireController::class, 'create']);
        Route::name('save')  ->post('save',                  [QuestionnaireController::class, 'save']);
        Route::name('view')  ->get('{questionnaire}',        [QuestionnaireController::class, 'view']);
        Route::name('edit')  ->get('{questionnaire}/edit',   [QuestionnaireController::class, 'edit']);
        Route::name('update')->put('{questionnaire}/update', [QuestionnaireController::class, 'update']);
        Route::name('delete')->get('{questionnaire}/delete',[QuestionnaireController::class, 'delete']);
    });


});





