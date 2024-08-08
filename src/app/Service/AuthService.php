<?php

namespace App\Service;

use App\Exceptions\NotFoundException;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthService extends BaseService
{
    /**
     * @throws Exception
     */
    public function register(array $data): array
    {
        try {
            $user = User::query()->where("email", $data["email"])->first();

            if ($user) {
                throw new Exception('The user exists', 409);
            }

            User::query()->create($data);

            return ['message' => 'success', 'status' => 201];
        } catch (Exception $e) {
            return $this->getErrorResponse($e);
        }
    }

    /**
     * @param $request
     * @return array
     * @throws NotFoundException
     * @throws Exception
     */
    public function login($request): array
    {
        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                throw new Exception('The user was not found', 404);
            }

            $user = User::query()->where('email', $request['email'])->first();

            return ['user' => $user, 'bearer_token' => $user->createToken("Create token for user")->plainTextToken];

        }  catch (\Exception $e) {
            return $this->getErrorResponse($e);
        }
    }
}
