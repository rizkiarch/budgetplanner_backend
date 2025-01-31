<?php

namespace App\Repositories\Contracts;

interface SavingRepositoryInterface
{
    public function getAll();
    public function getById(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function getTotalSaving(): float;
    public function getSavingsProgress(string $id);
}
