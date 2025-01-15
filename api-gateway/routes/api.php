<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


Route::post('/login', function (Request $request) {
    Log::info('Login attempt from ' . $request->all());
    $response = Http::post('http://auth-service/api/login', $request->all());
    return $response->json();
});
