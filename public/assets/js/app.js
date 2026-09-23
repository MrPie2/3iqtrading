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
})(window, document);
