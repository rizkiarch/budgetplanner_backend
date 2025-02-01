<?php

namespace App\Repositories\Eloquent;

use App\Models\Incomes\Income;
use App\Repositories\Contracts\IncomeRepositoryInterface;

class IncomeRepository implements IncomeRepositoryInterface
{
    public function __construct(
        private readonly Income $model
    ) {}

    public function getAll()
    {
        return $this->model->forCurrentUser()->get();
    }

    public function getById(int $id)
    {
        return $this->model->forCurrentUser()->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create([
            ...$data,
            'user_id' => auth()->id()
        ]);
    }

    public function update(int $id, array $data)
    {
        $income = $this->getById($id);
        $income->update($data);
        return $income;
    }

    public function delete(int $id)
    {
        $income = $this->getById($id);

        if (!$income) {
            return response()->json(['message' => 'data not found'], 404);
        }

        $income->delete();
        return response()->json(['message' => 'deleted successfully'], 200);
    }

    public function getTotalIncome(): float
    {
        return $this->model->forCurrentUser()->sum('amount');
    }

    public function getByCategory(string $category)
    {
        return $this->model->forCurrentUser()
            ->where('category', $category)
            ->get();
    }
}
