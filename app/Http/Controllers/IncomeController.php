<?php

namespace App\Http\Controllers;

use App\Http\Requests\Incomes\StoreIncomeRequest;
use App\Http\Requests\Incomes\UpdateIncomeRequest;
use App\Models\income;
use App\Repositories\Contracts\IncomeRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function __construct()
    {
        private readonly IncomeRepositoryInterface $incomeRepository;
    }{}
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json($this->incomeRepository->getAll);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): JsonResponse
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIncomeRequest $request)
    {
        $data = $request->validated();
        return response()->json([
            $this->incomeRepository->create($data),
            201;
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json((
            $this->incomeRepository->geyById($id)
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIncomeRequest $request, string $id)
    {
        $data = $request->validated();
        return response()->json(
            $this->incomeRepository->update($id, $data)
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

    public function byCategory(string $category): JsonResponse
    {
        return response()->json(
            $this->incomeRepository->getByCategory($category)
        );
    }
}
