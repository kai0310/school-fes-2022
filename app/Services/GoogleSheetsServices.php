<?php

namespace App\Services;

use Google\Client;
use Google\Exception;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

class GoogleSheetsServices
{
    /**
     * @return Client
     *
     * @throws Exception
     */
    public function getClient(): Client
    {
        $client = new Client();

        $client->setAuthConfig(storage_path('app/credentials.json'));
        $client->addScope(Sheets::SPREADSHEETS);
        $client->setApplicationName(config('app.name'));

        return $client;
    }

    /**
     * @param  string  $sheetId
     * @param  string  $range
     * @return ValueRange
     *
     * @throws Exception
     */
    public function readSheet(string $sheetId, string $range = 'A:Z'): ValueRange
    {
        $client = $this->getClient();
        $service = new Sheets($client);

        return $service->spreadsheets_values->get($sheetId, $range);
    }
}
