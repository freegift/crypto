<table>
    <tr>
        <td>
            <label id="btc_p"></label>
            <div id="btc_s">kHz</div>
        </td>
        <td>
            <label id="wave_p"></label>
            <div id="wave_s">kHz</div>
        </td>
        <td>
<!--            <label id="btc_p"></label>
            <div id="btc_s">kHz</div>-->
        </td>
    </tr>
</table>
<!--<label id="chat-message"></label>
<div id="k">kHz</div>-->

<script>  
//	function showMessage(messageHTML) {
//		$('#chat-box').append(messageHTML);
//	}

	//$(document).ready(function(){
		var websocket = new WebSocket("wss://stream.binance.com:9443/ws/btcusdt@trade"); 
                /* {
                        "e": "trade",     // Event type
                        "E": 123456789,   // Event time
                        "s": "BNBBTC",    // Symbol
                        "t": 12345,       // Trade ID
                        "p": "0.001",     // Price
                        "q": "100",       // Quantity
                        "b": 88,          // Buyer order ID
                        "a": 50,          // Seller order ID
                        "T": 123456785,   // Trade time
                        "m": true,        // Is the buyer the market maker?
                        "M": true         // Ignore
                      }*/
    
                websocket.onopen = function(event) { 
                    //var text = '';
			//alert(event.isTrusted);
                        //alert(JSON.stringify(event));
                        
		};
                
		websocket.onmessage = function(event) {
                    //var data = JSON.stringify(event.data);
                    //alert(data);
			var p_data = JSON.parse(event.data);
			//showMessage("<div class='"+Data.message_type+"'>"+Data.message+"</div>");
			document.getElementById("btc_p").innerHTML = p_data.p;
                        document.getElementById("btc_s").innerHTML = p_data.s;
		};
		/*
		websocket.onerror = function(event){
			showMessage("<div class='error'>Problem due to some Error</div>");
		};
		websocket.onclose = function(event){
			showMessage("<div class='chat-connection-ack'>Connection Closed</div>");
		}; */
		
		/*$('#frmChat').on("submit",function(event){
                    event.preventDefault();
                    $('#chat-user').attr("type","hidden");		
                    var messageJSON = {
                            chat_user: $('#chat-user').val(),
                            chat_message: $('#chat-message').val()
                    };
                    websocket.send(JSON.stringify(messageJSON));
		});*/
	//});
</script>
<script>
    var w_wave = new WebSocket("wss://stream.binance.com:9443/ws/bnbusdt@trade"); 
    w_wave.onmessage = function(event) {
        var w_data = JSON.parse(event.data);
        document.getElementById("wave_p").innerHTML = w_data.p;
        document.getElementById("wave_s").innerHTML = w_data.s;
    };
</script>