<?php

namespace App\Repositories\Eloquent;

use App\Models\Income\Income;
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

    public function getById(string $id)
    {
        return $this->model->forCurrentUser()->find($id);
    }

    public function update(string $id, array $data)
    {
        $income = $this->getById($id);
        $income->update($data);
        return $income;
    }

    public function delete(string $id)
    {
        $income = $this->getById($id);
        $income->delete();
    }

    public function getByCategory(string $category)
    {
        return $this->model->forCurrentUser()
            ->where('category', $category)
            ->get();
    }
}
