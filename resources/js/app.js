import './bootstrap';
import 'bootstrap';
import '../css/app.css';

import $ from 'jquery';
window.$ = $;
window.jQuery = $;
$.ajaxSetup({
    
    headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

getPages();

function getPages(){
  $.ajax({
          url:"/getchild_of",
          method:"get",
          data:{},
          success:function(data){
              $('.Child_Of').html(data);
          }
      })
    }
    getallpages();

    function getallpages(){
       $.ajax({
          url:"/getallpages",
          method:"get",
          data:{},
          success:function(data){
              $('.pages_container').html(data);
          }
      }) 
    }
function loadMarketTicker() {

    $.ajax({
        url: '/market/ticker',
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

