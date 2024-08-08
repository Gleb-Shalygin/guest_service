<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuestCreateRequest;
use App\Http\Requests\GuestDeleteRequest;
use App\Http\Requests\GuestUpdateRequest;
use App\Models\Guest;
use App\Service\GuestService;
use Illuminate\Http\JsonResponse;

class GuestController extends BaseController
{
    private GuestService $service;

    public function __construct(GuestService $service)
    {
        $this->service = $service;
    }

    public function create(GuestCreateRequest $request): JsonResponse
    {
        return $this->sendResponse($this->service->create($request->all()));
    }

    public function update(GuestUpdateRequest $request): JsonResponse
    {
        return $this->sendResponse($this->service->update($request->all()));
    }

    public function get(Guest $guest): JsonResponse
    {
        return $this->sendResponse($guest);
    }

    public function getAll(): JsonResponse
    {
        return $this->sendResponse(Guest::all());
    }

    public function delete(GuestDeleteRequest $request): JsonResponse
    {
        return $this->sendResponse($this->service->delete($request->input('id')));
    }
}
