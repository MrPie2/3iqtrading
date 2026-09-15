import './bootstrap';

import $ from 'jquery';
window.$= window.jQuery = $;

$.ajax({
    
    headers: {
        
        'X-CSRF' : $('meta["name="csrf_token"]').attr('content')
    }
})



