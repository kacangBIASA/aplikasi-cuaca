<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        return view('weather.index');
    }

    public function getWeather(Request $request)
    {
        $city = $request->input('city');
        $apiKey = env('OPENWEATHER_API_KEY');

        // Panggil API cuaca gratis berdasarkan nama kota
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric',
            'lang' => 'id'
        ]);

        // Cek apakah berhasil
        if ($response->failed() || $response->json('cod') != 200) {
            return back()->with('error', 'Kota tidak ditemukan atau gagal mengambil data cuaca!');
        }

        $weather = $response->json();

        // Kirim data ke view
        return view('weather.index', [
            'weather' => $weather,
            'city' => ucfirst($city),
        ]);
    }
}
