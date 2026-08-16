<?php

namespace App\Services;

use App\Models\Profile;

class LocationService
{
    /**
     * Geocode city/country to latitude/longitude using free Nominatim API
     */
    public function geocode(string $city, string $country): ?array
    {
        $query = urlencode("{$city}, {$country}");
        $url = "https://nominatim.openstreetmap.org/search?format=json&q={$query}&limit=1";

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_HTTPHEADER => [
                'User-Agent: TheLoveProject/1.0 (contact@loveproject.us)',
            ],
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200 || !$response) {
            return null;
        }

        $data = json_decode($response, true);

        if (empty($data[0])) {
            return null;
        }

        return [
            'latitude'  => (float) $data[0]['lat'],
            'longitude' => (float) $data[0]['lon'],
        ];
    }

    /**
     * Calculate distance between two points using Haversine formula
     * Returns distance in kilometers
     */
    public function calculateDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 6371; // km

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c, 1);
    }

    /**
     * Format distance for display
     */
    public function formatDistance(float $distanceKm): string
    {
        if ($distanceKm < 1) {
            return '< 1 km away';
        } elseif ($distanceKm < 100) {
            return round($distanceKm) . ' km away';
        } else {
            return number_format($distanceKm, 0) . ' km away';
        }
    }

    /**
     * Get distance between two profiles
     */
    public function getDistanceBetween(Profile $profile1, Profile $profile2): ?float
    {
        if (!$profile1->latitude || !$profile2->latitude) {
            return null;
        }

        return $this->calculateDistance(
            $profile1->latitude, $profile1->longitude,
            $profile2->latitude, $profile2->longitude
        );
    }

    /**
     * Auto-geocode profile if lat/lng missing but city/country exists
     */
    public function autoGeocode(Profile $profile): void
    {
        if ($profile->latitude || !$profile->city || !$profile->country) {
            return;
        }

        $coords = $this->geocode($profile->city, $profile->country);

        if ($coords) {
            $profile->update([
                'latitude'  => $coords['latitude'],
                'longitude' => $coords['longitude'],
            ]);
        }
    }
}
