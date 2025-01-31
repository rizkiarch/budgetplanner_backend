<?php

namespace App\Repositories\Eloquent;

use App\Models\Expenses\Expense;
use App\Repositories\Contracts\ExpenseRepositoryInterface;

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
        return $this->model->create([
            ...$data,
            'user_id' => auth()->id(),
        ]);
    }

    public function update(string $id, array $data)
    {
        $expense = $this->getById($id);
        $expense->update($data);
        return $expense;
    }

    public function delete(string $id)
    {
        $expense = $this->getById($id);
        $expense->delete();
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

    public function getRecuringExpenses()
    {
        return $this->model->forCurrentUser()
            ->where('is_recurring', true)
            ->get();
    }
}
