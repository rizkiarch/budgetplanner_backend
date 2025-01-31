<?php

namespace App\Repositories\Contracts;

interface BillRepositoryInterface
{
    public function getAll();
    public function getById(string $id);
    public function create(array $data);
    public function update(string $id, array $data);
    public function delete(string $id);
    public function markAsPaid(string $id);
    public function getOverdueBills();
    public function getUpcomingBills(int $days = 7);
}
