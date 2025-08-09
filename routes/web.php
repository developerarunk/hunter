<?php
use App\Http\Controllers\NodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/nodes', [NodeController::class, 'index'])->name('nodes.index');