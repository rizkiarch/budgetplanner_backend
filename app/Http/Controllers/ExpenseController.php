<?php

namespace App\Http\Controllers;

use App\Http\Requests\Expenses\StoreExpenseRequest;
use App\Http\Requests\Expenses\UpdateExpenseRequest;
use App\Models\Expense;
use App\Repositories\Contracts\ExpenseRepositoryInterface;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{

    public function __construct(
        private readonly ExpenseRepositoryInterface $repository
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
    public function store(StoreExpenseRequest $request)
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
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, string $id)
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

    public function byCategory(string $category): JsonResponse
    {
        return response()->json(
            $this->repository->getByCategory($category)
        );
    }

    public function recurringExpenses(): JsonResponse
    {
        return response()->json(
            $this->repository->getRecurringExpenses()
        );
    }
}
