<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return UserResource::collection($this->service->list());
    }

    public function store(StoreUserRequest $request)
    {
        return new UserResource($this->service->create($request->validated()));
    }

    public function show($id)
    {
        return new UserResource($this->service->getById($id));
    }

    public function update(StoreUserRequest $request, $id)
    {
        return new UserResource($this->service->update($id, $request->validated()));
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->noContent();
    }
}

