<?php

namespace App\Repositories\Contracts;

interface ExpenseRepositoryInterface
{
    public function getAll();
    public function getById(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function getTotalExpense(): float;
    public function getByCategory(string $category);
    public function getRecuringExpenses();
}
