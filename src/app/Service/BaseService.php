<?php

namespace App\Service;

abstract class BaseService
{
    protected function getErrorResponse($e): array
    {
        return ['error' => $e->getMessage(), 'code' => $e->getCode() !== 0 ? $e->getCode() : 500];
    }
}
