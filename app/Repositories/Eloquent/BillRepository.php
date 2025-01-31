<?php

namespace App\Repositories\Eloquent;

use App\Models\Bills\Bill;
use App\Repositories\Contracts\BillRepositoryInterface;

class BillRepository implements BillRepositoryInterface
{
    public funciton __construct(
        private readonly Bill $model
    ){}

    public function getAll()
    {
        return $this->model->forCurrentUser()->get();
    }

    public function getById(string $id)
    {
        return $this->model->forCurrentUser()->findorFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create([
            ...$data,
            'user_id' => auth()->id(),
            'status' => 'unpaid',
        ]);
    }

    public function update(string $id, array $data)
    {
        $bill = $this->getById($id);
        $bill->update($data);
        return $bill;
    }

    public function markAsPaid(string $id)
    {
        $bill = $this->getById($id);
        $bill->update(['status' => 'paid']);
        return $bill;
    }

    public function getOverdueBills()
    {
        return $this->model->forCurrentUser()
            ->where('due_date', '<', now())
            ->where('status', 'unpaid')
            ->get();
    }

    public function getUpcomingBills(int $days = 7)
    {
        return $this->model->forCurrentUser()
            ->whereBetween('due_date', [now(), now()->addDays($days)])
            ->get();
    }
}
