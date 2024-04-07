<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\BlacklistDomainsCreate;
use App\Livewire\ApiSettingCreate;
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

Route::get('/', function () {
    //return view('welcome');
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
  
    Route::get('/blacklist/domains', function () {
        return view('blacklist-domains');
    })->name('blacklist.domains');

    Route::get('/blacklist/domains/create', BlacklistDomainsCreate::class)->name('blacklist.domain.create');


    Route::get('/api/setting', function () {
        return view('api-setting');
    })->name('api.setting');

    Route::get('/api/setting/create', ApiSettingCreate::class)->name('api.setting.create');

});

Livewire::setScriptRoute(function ($handle) {
    return Route::get('/backend_2/public/bundle/livewire/livewire.js', $handle);
});

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/backend_2/livewire/update', $handle);
});