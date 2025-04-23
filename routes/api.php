<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompteBancaireController;
use App\Http\Controllers\BanqueController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\EcheanceController;
use App\Http\Controllers\RapprochementBancaireController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PaiementChequeController;
use App\Http\Controllers\PaiementVirementController;
use App\Http\Controllers\TransfertController;
use App\Http\Controllers\UserController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('/user', controller: UserController::class);
Route::apiResource('banque', BanqueController::class);
Route::apiResource('compte', CompteBancaireController::class);
Route::apiResource('rapport', RapportController::class);
Route::apiResource('categorie', CategorieController::class);
Route::apiResource('echeance', EcheanceController::class);
Route::apiResource('rapprochement', RapprochementBancaireController::class);
Route::apiResource('transaction', TransactionController::class);
Route::apiResource('paiement-cheque', PaiementChequeController::class);
Route::apiResource('paiement-virement', PaiementVirementController::class);
Route::apiResource('transfert', TransfertController::class);

