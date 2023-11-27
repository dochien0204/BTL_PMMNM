<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Master\MasterController;
use App\Http\Controllers\MedicalRegistrationForm\MedicalRegistrationFormController;
use App\Http\Controllers\Medicine\MedicineController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('create-user', [AuthController::class, 'createUser']);
    Route::post('login', [AuthController::class, 'login']);
});

// Route::middleware('auth:api')->group(function () {
Route::prefix('product')->group(function () {
    Route::get('', [ProductController::class, 'index'])->middleware('transaction');
});

Route::prefix('users')->group(function () {
    Route::get('/list', [UserController::class, 'getAllUser']);
});

// Authentication
Route::prefix('auth')->group(function () {
    Route::post('/forget-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password/{token}', [AuthController::class, 'resetPassword']);

    Route::get('/verify-account/{idUser}/{token}', [AuthController::class, 'verificationGet']);
    Route::post('/verification', [AuthController::class, 'verificationSend']);

    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/detail-user/{idUser}', [AuthController::class, 'getDetailUser']);
    Route::post('/update-user/{idUser}', [AuthController::class, 'updateUser']);

    Route::post('/block', [AuthController::class, 'blockUser']);

    Route::post('logout', [AuthController::class, 'logout']);
});

// Patient
Route::prefix('patient')->group(function () {
    Route::get('/alls', [PatientController::class, 'getAllPatient'])->middleware('permission:admin_sys,le_tan');
    Route::get('/search', [PatientController::class, 'searchPatients'])->middleware('permission:admin_sys,le_tan');
    Route::get('/detail', [PatientController::class, 'getPatientById']);
    Route::post('/create', [PatientController::class, 'createNewPatient'])->middleware(['transaction', 'permission:admin_sys,le_tan']);
    Route::delete('/delete', [PatientController::class, 'deletePatientById'])->middleware(['transaction', 'permission:admin_sys,le_tan']);
    Route::put('/update', [PatientController::class, 'updatePatient'])->middleware(['transaction', 'permission:admin_sys,le_tan,bac_si']);
});

//Medicine
Route::prefix('medicine')->group(function () {
    Route::get('/alls', [MedicineController::class, 'getAllMedicines']);
    Route::get('/detail', [MedicineController::class, 'getMedicineById']);
    Route::post('/create', [MedicineController::class, 'createNewMedicine'])->middleware('transaction');
    Route::delete('/delete', [MedicineController::class, 'deleteMedicine'])->middleware('transaction');
    Route::put('/update', [MedicineController::class, 'updateMedicine'])->middleware('transaction');
});

//Master data
Route::prefix('master')->group(function () {
    Route::get('/category', [CategoryController::class, 'getAllCategoryByType']);
    Route::get('/status', [MasterController::class, 'getAllStatusByType']);
});

//Medical Registration Form
Route::prefix('medical-registration-form')->group(function () {
    Route::post('/create', [MedicalRegistrationFormController::class, 'createMedicalRegistrationForm'])->middleware('transaction');
    Route::get('/alls', [MedicalRegistrationFormController::class, 'getListMedicalRegistrationForms']);
    Route::put('/update-status', [MedicalRegistrationFormController::class, 'updateStatusMedicalForm'])->middleware('transaction');
    Route::put('/update', [MedicalRegistrationFormController::class, 'updateMedicalResgistrationForm'])->middleware(['transaction', 'permission:le_tan']);
    Route::get("/list/doctor", [MedicalRegistrationFormController::class, 'getListMedicalFormOfDoctor'])->middleware('permission:bac_si');
    Route::get("/list/patient", [MedicalRegistrationFormController::class, 'getListMedicalFormCompleteOfPatient'])->middleware('permission:bac_si,le_tan');
});
