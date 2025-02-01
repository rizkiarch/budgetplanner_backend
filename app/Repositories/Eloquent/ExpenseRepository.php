<?php

namespace App\Repositories\Eloquent;

use App\Models\Expenses\Expense;
use App\Repositories\Contracts\ExpenseRepositoryInterface;
use Illuminate\Http\Request;

class ExpenseRepository implements ExpenseRepositoryInterface
{
    public function __construct(
        private readonly Expense $model
    ) {}

    public function getAll()
    {
        return $this->model->forCurrentUser()->get();
    }

    public function getById(string $id)
    {
        return $this->model->forCurrentUser()->find($id);
    }

    public function create(array $data)
    {
        $expense = $this->model->create(array_merge($data, [
            'user_id' => auth()->id(),
        ]));

        return response()->json(['message' => 'created successfully', 'data' => $expense], 201);
    }

    public function update(int $id, array $data)
    {
        $expense = $this->getById($id);

        if (!$expense) {
            return response()->json(['message' => 'data not found'], 404);
        }

        $expense->update($data);
        return response()->json(['message' => 'updated successfully', 'data' => $expense], 200);
    }

    public function delete(int $id)
    {
        $expense = $this->getById($id);

        if (!$expense) {
            return response()->json(['message' => 'data not found'], 404);
        }

        $expense->delete();
        return response()->json(['message' => 'deleted successfully'], 200);
    }

    public function getTotalExpense(): float
    {
        return $this->model->forCurrentUser()->sum('amount');
    }

    public function getByCategory(string $category)
    {
        return $this->model->forCurrentUser()
            ->where('category', $category)
            ->get();
    }

    public function getRecurringExpenses(bool $recuring = true)
    {
        $expenses = $this->model->forCurrentUser()
            ->where('is_recurring', $recuring)
            ->get();

        return response()->json($expenses);
    }
}
