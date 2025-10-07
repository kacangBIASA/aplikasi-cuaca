<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Cuaca Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .weather-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            padding: 30px;
            width: 400px;
            text-align: center;
        }
        .temp {
            font-size: 3rem;
            font-weight: bold;
        }
        .weather-icon {
            width: 100px;
        }
        .footer {
            margin-top: 15px;
            font-size: 0.9rem;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="weather-card">
        <h3 class="mb-4 fw-bold text-primary">🌦️ Aplikasi Cuaca</h3>

        {{-- Form input nama kota manual --}}
        <form method="GET" action="{{ route('weather.index') }}" class="mb-4">
            <div class="input-group">
                <input
                    type="text"
                    name="city"
                    class="form-control"
                    placeholder="Masukkan nama kota"
                    value="{{ request('city') }}"
                    required
                >
                <button class="btn btn-primary">Cari</button>
            </div>
        </form>

        {{-- Hasil cuaca --}}
        @if (isset($weather))
            <h4 class="text-secondary mb-3">{{ $city }}</h4>
            <img src="https://openweathermap.org/img/wn/{{ $weather['weather'][0]['icon'] }}@2x.png"
                 alt="weather icon" class="weather-icon mb-3">
            <div class="temp mb-2">{{ round($weather['main']['temp']) }}°C</div>
            <p class="mb-1 text-capitalize">{{ $weather['weather'][0]['description'] }}</p>
            <p class="mb-0 text-muted">Kelembapan: {{ $weather['main']['humidity'] }}%</p>
            <p class="text-muted">Angin: {{ $weather['wind']['speed'] }} m/s</p>
        @elseif(request('city'))
            <div class="alert alert-danger mt-3">❌ Gagal mengambil data cuaca. Coba lagi.</div>
        @else
            <div class="text-muted">Masukkan nama kota untuk melihat kondisi cuaca.</div>
        @endif

        <div class="footer">
            <small>Dibuat oleh Ridho | Data:
                <a href="https://openweathermap.org/" target="_blank">OpenWeatherMap</a>
            </small>
        </div>
    </div>
</body>
</html>
