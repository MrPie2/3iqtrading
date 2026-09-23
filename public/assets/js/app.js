(function (window, document) {
    'use strict';

    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    window.api = async function api(url, options = {}) {
        const config = { ...options };
        config.headers = {
            Accept: 'application/json',
            ...(csrf ? { 'X-CSRF-TOKEN': csrf } : {}),
            ...(options.headers || {})
        };
        const response = await fetch(url, config);
        const contentType = response.headers.get('content-type') || '';
        const data = contentType.includes('application/json')
            ? await response.json()
            : { message: await response.text() };
        if (!response.ok) {
            const message = data.message || data.error || 'Request failed. Please try again.';
            const error = new Error(message);
            error.status = response.status;
            error.data = data;
            throw error;
        }
        return data;
    };

    window.formData = function formData(form) {
        return new URLSearchParams(new FormData(form));
    };

    const $ = window.jQuery;
    if (!$) {
        console.warn('3IQ Trading: jQuery is not loaded.');
        return;
    }

    window.$ = $;
    window.jQuery = $;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrf
        }
    });

    function getPages() {
        $.ajax({
            url: '/getchild_of',
            method: 'GET',
            success: function (data) {
                $('.Child_Of').html(data);
            }
        });
    }

    function getallpages() {
        $.ajax({
            url: '/getallpages',
            method: 'GET',
            success: function (data) {
                $('.pages_container').html(data);
            }
        });
    }

    getPages();
    getallpages();

    function loadMarketTicker() {
        $.ajax({
            url: '/market/ticker',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (!response.success) {
                    console.log('Market data failed:', response.message);
                    return;
                }

                let html = '';
                response.data.forEach(function (stock) {
                    const price = Number(stock.price || 0);
                    const change = Number(stock.change || 0);
                    const percent = Number(stock.change_percent || 0);
                    const direction = change >= 0 ? 'up' : 'down';

                    html += '<div class="iq-stock">' +
                        '<strong>' + stock.symbol + '</strong>' +
                        '<span class="iq-price">$' + price.toFixed(2) + '</span>' +
                        '<span class="iq-change ' + direction + '">' +
                        (change >= 0 ? '▲' : '▼') + ' ' + Math.abs(percent).toFixed(2) + '%' +
                        '</span></div>';
                });

                $('#iqTicker').html(html + html);
            },
            error: function (xhr, status, error) {
                console.log('Market API Error:', error);
                console.log('HTTP Status:', xhr.status);
                console.log('Response:', xhr.responseText);
            }
        });
    }

    loadMarketTicker();
    window.setInterval(loadMarketTicker, 60000);
})(window, document);
