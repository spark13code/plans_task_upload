<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Plans;
use App\Http\Controllers\ComboPlans;
use App\Http\Controllers\EligibilityCriteria;


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

// Dashboard
Route::get('/', [Dashboard::class,'index'])->name('dashboard');


// Plans
Route::get('/plans',[Plans::class,'index'])->name('plans.list');
Route::get('/add-plan/{id?}',[Plans::class,'addPlan'])->name('plan.add');
Route::post('/insert-update-plan/{id?}',[Plans::class,'insertUpdatePlan'])->name('plan.insert-update');
Route::get('/get-plans',[Plans::class,'getPlans'])->name('plans.fetch');
Route::get('/delete-plan/{id}',[Plans::class,'deletePlan'])->name('plan.delete');


// Combo plans
Route::get('/combo-plans',[ComboPlans::class,'index'])->name('combo-plans.list');
Route::get('/add-combo-plan/{id?}',[ComboPlans::class,'addComboPlan'])->name('combo-plan.add');
Route::get('/get-plans-for-combo/{id?}',[ComboPlans::class,'getPlans'])->name('get-plans-for-combo');
Route::get('/get-combo-plans',[ComboPlans::class,'getPlansCombo'])->name('get-combo-plans');
Route::post('/insert-update-combo-plan/{id?}',[ComboPlans::class,'insertUpdateComboPlan'])->name('combo-plan.insert-update');
Route::get('/delete-combo-plan/{id}',[ComboPlans::class,'deleteComboPlan'])->name('combo-plan.delete');

// Eligibility Criteria 
Route::get('/eligibility-criteria',[EligibilityCriteria::class,'index'])->name('eligibility-criteria.list');
Route::get('/get-eligible-criteria',[EligibilityCriteria::class,'getEligibleCriteria'])->name('eligible-criteria.fetch');
Route::get('/add-eligible-criteria/{id?}',[EligibilityCriteria::class,'addEligibleCriteria'])->name('eligible-criteria.add');
Route::post('/insert-update-eligible-criteria/{id?}',[EligibilityCriteria::class,'insertUpdateEligibleCriteria'])->name('eligible-criteria.insert-update');
Route::get('/delete-eligible-criteria/{id}',[EligibilityCriteria::class,'deleteEligibleCriteria'])->name('eligible-criteria.delete');