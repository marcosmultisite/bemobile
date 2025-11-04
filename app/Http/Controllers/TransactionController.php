<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $service;

    public function __construct(TransactionService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return TransactionResource::collection($this->service->list($request));
    }

    public function store(StoreTransactionRequest $request)
    {
        return new TransactionResource($this->service->create($request->validated()));
    }

    public function show($id)
    {
        return new TransactionResource($this->service->getById($id));
    }

    public function update(StoreTransactionRequest $request, $id)
    {
        return new TransactionResource($this->service->update($id, $request->validated()));
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->noContent();
    }
}