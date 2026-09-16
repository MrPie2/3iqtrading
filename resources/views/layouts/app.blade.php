<!doctype html>
<html lang="en">
<head>
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="3IQ Trading — a modern investment and retirement planning website template.">
    <title>{{ $title ?? '3IQ Trading' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    @stack('head')
</head>
<body>
@include('partials.navbar')
    @if(session('success'))
        <div class="container position-relative" style="z-index:20">
            <div class="alert alert-success alert-dismissible fade show mt-3 shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @yield('content')

    
@include('partials.footer')
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
<script>

function loadMarketTicker() {

    $.ajax({
        url: 'https://3iqtrading.org/market/ticker',
        type: 'GET',
        dataType: 'json',

        success: function(response) {

            if (!response.success) {
                console.log('Market data failed:', response.message);
                return;
            }

            let html = '';

            response.data.forEach(function(stock) {

                const price = Number(stock.price || 0);
                const change = Number(stock.change || 0);
                const percent = Number(stock.change_percent || 0);

                const direction = change >= 0 ? 'up' : 'down';

                html += `
                    <div class="iq-stock">
                        <strong>${stock.symbol}</strong>

                        <span class="iq-price">
                            $${price.toFixed(2)}
                        </span>

                        <span class="iq-change ${direction}">
                            ${change >= 0 ? '▲' : '▼'}
                            ${Math.abs(percent).toFixed(2)}%
                        </span>
                    </div>
                `;
            });

            // Duplicate for continuous scrolling
            $('#iqTicker').html(html + html);
        },

        error: function(xhr, status, error) {

            console.log('Market API Error:', error);
            console.log('HTTP Status:', xhr.status);
            console.log('Response:', xhr.responseText);
        }
    });
}

// Load immediately
loadMarketTicker();

// Refresh every 60 seconds
setInterval(loadMarketTicker, 60000);

</script>
