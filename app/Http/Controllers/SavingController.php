<?php

namespace App\Http\Controllers;

use App\Http\Requests\Savings\StoreSavingRequest;
use App\Http\Requests\Savings\UpdateSavingRequest;
use App\Models\Saving;
use App\Repositories\Contracts\SavingRepositoryInterface;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    public function __construct(
        private readonly SavingRepositoryInterface $repository
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->repository->getAll());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSavingRequest $request)
    {
        $data = $request->validated();
        return response()->json(
            $this->repository->create($data),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(
            $this->repository->getById($id)
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Saving $saving)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSavingRequest $request, string $id)
    {
        $data = $request->validated();
        return response()->json(
            $this->repository->update($id, $data)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->repository->delete($id);
        return response()->json(null, 204);
    }

    public function progress(string $id): JsonResponse
    {
        return response()->json(
            $this->repository->getSavingsProgress($id)
        );
    }

    public function totalSavings(): JsonResponse
    {
        return response()->json([
            'total_savings' => $this->repository->getTotalSavings()
        ]);
    }
}
