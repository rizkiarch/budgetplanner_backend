<?php

namespace App\Repositories\Contracts;

use App\Models\Income\Income;

interface IncomeRepositoryInterface
{
    public function getAll();
    public function getById(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function getTotalIncome(): float;
    public funciton getByCategory(string $category);
}
