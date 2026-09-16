import './bootstrap';
import 'bootstrap';
import '../css/app.css';

import $ from 'jquery';
window.$= window.jQuery = $;

$.ajax({
    
    headers: {
        
        'X-CSRF' : $('meta["name="csrf_token"]').attr('content')
    }
})



