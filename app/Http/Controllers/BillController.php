<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bills\StoreBillRequest;
use App\Http\Requests\Bills\UpdateBillRequest;
use App\Models\Bill;
use App\Repositories\Contracts\BillRepositoryInterface;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function __construct(
        private readonly BillRepositoryInterface $repository
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
    public function store(StoreBillRequest $request)
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
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBillRequest $request, string $id)
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

    public function markAsPaid(string $id): JsonResponse
    {
        return response()->json(
            $this->repository->markAsPaid($id)
        );
    }

    public function upcomingBills(): JsonResponse
    {
        return response()->json(
            $this->repository->getUpcomingBills()
        );
    }

    public function overdueBills(): JsonResponse
    {
        return response()->json(
            $this->repository->getOverdueBills()
        );
    }
}
