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
    private readonly IncomeRepositoryInterface $incomeRepository;

    public function __construct(IncomeRepositoryInterface $incomeRepository)
    {
        $this->incomeRepository = $incomeRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->incomeRepository->getAll());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): JsonResponse {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIncomeRequest $request)
    {
        $data = $request->validated();
        return response()->json([
            $this->incomeRepository->create($data),
            201
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json((
            $this->incomeRepository->getById($id)
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
    public function update(UpdateIncomeRequest $request, int $id)
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
        $response = $this->incomeRepository->delete($id);
        return $response;
    }

    public function byCategory(string $category)
    {
        return response()->json(
            $this->incomeRepository->getByCategory($category)
        );
    }
}
