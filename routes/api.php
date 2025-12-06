<?php

use App\Http\Controllers\ConsultationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/drugs/search', [ConsultationController::class, 'searchDrug']);