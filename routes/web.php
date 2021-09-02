<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PieceController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\ModeleController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\CarburantController;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\ReparationController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\FournisseurController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('marques', MarqueController::class);
    Route::resource('modeles', ModeleController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('vehicules', VehiculeController::class);
    Route::get('vehicules/{vehicule}/chargeMarque', [VehiculeController::class, 'chargeMarque']);
    Route::get('/findModele', [VehiculeController::class, 'findModele']);
    Route::resource('departements', DepartementController::class);
    Route::resource('chauffeurs',ChauffeurController::class);
    Route::get('/fileUpload', [DocumentController::class, 'fileUpload'])->name('file.upload');
    Route::post('/fileUploadPost', [DocumentController::class, 'fileUploadPost'])->name('file.upload.post');
    Route::resource('documents', DocumentController::class);
    Route::get('/findEtat', [DocumentController::class, 'findEtat']);
    Route::get('/show', [DocumentController::class, 'show']);
    Route::get('/voir{id}', [DocumentController::class, 'voir']);
    Route::get('/telecharger{file}', [DocumentController::class, 'telecharger']);
    Route::resource('missions', MissionController::class);
    Route::get('/findEtat', [MissionController::class, 'findEtat']);
    Route::resource('carburants', CarburantController::class);
    Route::get('/findMission', [CarburantController::class, 'findMission']);
    Route::get('/findEtat', [CarburantController::class, 'findEtat']);
    Route::resource('pieces', PieceController::class);
    Route::resource('fournisseurs', FournisseurController::class);
    Route::resource('reparations', ReparationController::class);
});
