<?php

declare(strict_types=1);
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use App\Orchid\Screens\Company\CompanyTableScreen;
use App\Orchid\Screens\Company\CompanyFormScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('main', PlatformScreen::class)
    ->name('platform.main');

    Route::screen('profile', UserProfileScreen::class)->name('platform.profile');
	Route::screen('/companies', CompanyTableScreen::class)->name('platform.company.table');
	Route::screen('/companies/create', CompanyFormScreen::class)->name('platform.company.create');


//Route::screen('idea', Idea::class, 'platform.screens.idea');
