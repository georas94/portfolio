<?php

namespace App\Service;


use Symfony\Contracts\HttpClient\HttpClientInterface;

class GeoService
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getLocation(float $lat, float $lon): ?array
    {
        $url = 'https://nominatim.openstreetmap.org/reverse';
        $params = [
            'format' => 'json',
            'lat' => $lat,
            'lon' => $lon,
            'zoom' => 10,
            'addressdetails' => 1,
        ];

        $response = $this->httpClient->request('GET', $url, [
            'query' => $params,
            'headers' => [
                'User-Agent' => 'Symfony-GeoService' // important pour Nominatim
            ]
        ]);

        if ($response->getStatusCode() !== 200) {
            return null;
        }

        $data = $response->toArray();
        return $data['address'] ?? null;
    }

    public function getCityLabel(array $address): string
    {

        return $address['city']
            ?? $address['town']
            ?? $address['village']
            ?? $address['state']
            ?? $address['region']
            ?? 'Inconnu';
    }
}
