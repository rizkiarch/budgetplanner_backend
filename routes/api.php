<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FinanceReportController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\SavingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    // Income
    Route::prefix('incomes')->group(function () {
        Route::get('/', [IncomeController::class, 'index']);
        Route::post('/', [IncomeController::class, 'store']);
        Route::get('/{id}', [IncomeController::class, 'show']);
        Route::put('/{id}', [IncomeController::class, 'update']);
        Route::delete('/{id}', [IncomeController::class, 'destroy']);
        Route::get('/category/{category}', [IncomeController::class, 'byCategory']);
    });

    // Bills
    Route::prefix('bills')->group(function () {
        Route::get('/', [BillController::class, 'index']);
        Route::post('/', [BillController::class, 'store']);
        Route::get('/{id}', [BillController::class, 'show']);
        Route::put('/{id}', [BillController::class, 'update']);
        Route::delete('/{id}', [BillController::class, 'destroy']);
        Route::post('/{id}/mark-as-paid', [BillController::class, 'markAsPaid']);
        Route::get('/upcoming', [BillController::class, 'upcomingBills']);
        Route::get('/overdue', [BillController::class, 'overdueBills']);
    });

    // Expenses
    Route::prefix('expenses')->group(function () {
        Route::get('/', [ExpenseController::class, 'index']);
        Route::post('/', [ExpenseController::class, 'store']);
        Route::get('/{id}', [ExpenseController::class, 'show']);
        Route::put('/{id}', [ExpenseController::class, 'update']);
        Route::delete('/{id}', [ExpenseController::class, 'destroy']);
        Route::get('/category/{category}', [ExpenseController::class, 'byCategory']);
        Route::get('/recurring', [ExpenseController::class, 'recurringExpenses']);
    });

    // Savings
    Route::prefix('savings')->group(function () {
        Route::get('/', [SavingController::class, 'index']);
        Route::post('/', [SavingController::class, 'store']);
        Route::get('/{id}', [SavingController::class, 'show']);
        Route::put('/{id}', [SavingController::class, 'update']);
        Route::delete('/{id}', [SavingController::class, 'destroy']);
        Route::get('/{id}/progress', [SavingController::class, 'progress']);
        Route::get('/total', [SavingController::class, 'totalSavings']);
    });

    // Reports
    Route::prefix('reports')->group(function () {
        Route::get('/monthly-summary', [FinanceReportController::class, 'monthlySummary']);
    });
});
