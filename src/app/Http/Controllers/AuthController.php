<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Service\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends BaseController
{
    private AuthService $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    /**
     * @throws NotFoundException
     */
    public function login(AuthLoginRequest $request): JsonResponse
    {
        return $this->sendResponse($this->service->login($request));
    }

    /**
     * @throws \Exception
     */
    public function register(AuthRegisterRequest $request): JsonResponse
    {
        return $this->sendResponse($this->service->register($request->all()));
    }
}
