<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;


Route::post('/login', function (Request $request) {
    $response = Http::post('http://auth-service/api/login', $request->all());
    return $response->json();
});
