<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicalReportController;

Route::get('/', [MedicalReportController::class, 'index'])->name('home');

Route::resource('reports', MedicalReportController::class);
Route::get('reports/{medicalReport}/pdf', [MedicalReportController::class, 'generatePdf'])->name('reports.generate-pdf');
