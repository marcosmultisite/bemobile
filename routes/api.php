<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;


Route::post('/transactions', [TransactionController::class, 'store']);