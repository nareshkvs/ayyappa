<?php

use App\Http\Livewire\Blog;
use App\Http\Livewire\Editor;
use App\Http\Livewire\Contactus;
use App\Http\Livewire\BlogCreate;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\TemplesComponent;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TemplesController;
use App\Http\Controllers\SettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/settings', [SettingsController::class, 'index']);
        Route::get('/blog/create', BlogCreate::class);
        Route::get('/temples', [TemplesController::class, 'index'])->name('temples');
    });
});

Route::get('blog/{id}/{slug}', [BlogController::class, 'read']);
Route::resource('blogs', BlogController::class)->except('show');
Route::get('temples', [TemplesController::class, 'show'])->name('temples');
Route::get('/temple/{id}', TemplesComponent::class)->where('id', '[0-9]+');
Route::get('contact-us', Contactus::class)->name('contact-us');
//Route::get('blog/{slug}', Blog::class);
Route::get('/editor', Editor::class)->middleware(['web']);
