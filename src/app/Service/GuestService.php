<?php

namespace App\Service;

use App\Models\Guest;
use Monarobase\CountryList\CountryListFacade as CountryList;
use Propaganistas\LaravelPhone\PhoneNumber;

class GuestService extends BaseService
{
    public function create($params): array
    {
        try {
            if (!isset($params['country'])) {
                $params['country'] = $this->getCountry($params['phone']);
            }

            $guest = Guest::query()->create($params);

            return ['data' => $guest];
        } catch (\Exception $e) {
            return $this->getErrorResponse($e);
        }
    }

    public function update($params): array
    {
        try {
            if (!isset($params['country'])) {
                $params['country'] = $this->getCountry($params['phone']);
            }

            $guest = Guest::find($params['id']);
            $guest->update($params);

            return ['message' => 'The data has been successfully updated'];
        } catch (\Exception $e) {
            return $this->getErrorResponse($e);
        }
    }

    public function delete($id): array
    {
        Guest::destroy($id);

        return ['message' => 'The record was successfully deleted'];
    }


    /**
     * @throws \Exception
     */
    private function getCountry($phone): string
    {
        $countryCode = (new PhoneNumber($phone))->getCountry();

        if (!$countryCode) {
            throw new \Exception('Incorrect phone number', 404);
        }

        return CountryList::getOne($countryCode, 'ru');
    }
}
