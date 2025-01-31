<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\SavingRepositoryInterface;

class SavingRepository implements SavingRepositoryInterface
{
    public function __construct(
        private readonly Saving $model
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
        $saving = $this->getById($id);
        $saving->update($data);
        return $saving;
    }

    public function delete(string $id)
    {
        $saving = $this->getById($id);
        $saving->delete();
    }

    public function getTotalSaving(): float
    {
        return $this->model->forCurrentUser()->sum('amount');
    }

    public function getSavingsProgress(string $id)
    {
        $saving = $this->getById($id);
        return [
            'current' => $saving->amount,
            'target' => $saving->target,
            'percentage' => $saving->progressPercentage(),
        ];
    }
}
