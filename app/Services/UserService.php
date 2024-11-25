<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class UserService
{
    /**
     * @throws Exception|GuzzleException
     */
    public function userExists(int $userId): bool
    {
        $client = new Client();

        try {
            $response = $client->get(env('SERVICE_A_URL') . "/api/users/check/" . $userId, [
                'timeout' => 5,
            ]);

            if ($response->getStatusCode() !== 200) {
                throw new Exception('Error fetching data, resp');
            }

            return true;
        } catch (Exception $e) {
            if ($e->getCode() === 404) {
                return false;
            }
            throw new Exception('Error fetching data: ' . $e->getMessage());
        }
    }
}
