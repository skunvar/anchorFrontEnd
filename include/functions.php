<script src ="bignumber.js/bignumber.js/bignumber.js"></script>
<script type="text/javascript" src="js/sails.io.js"></script>
<script type="text/javascript">
  url_api = '<?php echo URL_API;?>';
  io.sails.url = url_api;
  window.ioo = io;
  socket = io.connect( url_api, {
    reconnection: true,
    reconnectionDelay: 1000,
    reconnectionDelayMax : 5000,
    reconnectionAttempts: 99999
  });

  socket.on( 'connect', function () {} );
  socket.on( 'disconnect', function () { socket.connect();  } );

  io.socket.on('INR_ASK_ADDED', function askCreated(data){

    getallaskbid();
    });
  io.socket.on('INR_BID_ADDED', function bidCreated(data){

    getallaskbid();

    });
</script>
<script>


 function bidAmount() {
          var a = new BigNumber(document.getElementById('bid_rate').value);
          var b = new BigNumber(document.getElementById('bid_vol').value);
          var result = (a).times(b);
          if (!isNaN(result)) {
              document.getElementById('bid_amount').value = result;
          }
    }
     function bidAmountTotal()
      {
          var res= new BigNumber(document.getElementById('bid_amount').value);
          var a = new BigNumber(document.getElementById('bid_vol').value);
          var b = new BigNumber(document.getElementById('bid_rate').value);
          if(res)
          {
            var equal=(res).dividedBy(b);
            document.getElementById('bid_vol').value=equal;
          }

      }
      function askAmount() {
          var a = new BigNumber(document.getElementById('ask_rate').value);
          var b = new BigNumber(document.getElementById('ask_vol').value);
          var result = (a).times(b);
          if (!isNaN(result)) {
              document.getElementById('ask_amount').value = result;

          }
      }
      function askTotalAmount()
      {
        var a = new BigNumber(document.getElementById('ask_amount').value);
        var b = new BigNumber(document.getElementById('ask_vol').value);
        var res = new BigNumber(document.getElementById('ask_rate').value);
          if(res)
          {
            var equal=(res).dividedBy(b);
            document.getElementById('ask_vol').value=equal;
          }

      }

function sell_data(){



var ask_rate = document.getElementById('ask_rate').value;
var ask_vol = document.getElementById('ask_vol').value;
var ask_amount = document.getElementById('ask_amount').value;

var sub_curr='<?php echo substr($currency1,1,3);?>';
var main_curr='<?php echo   strtolower($currency2);?>';

if(ask_rate !='' && ask_vol !='0' && ask_amount !='0')
{

<?php if(isset($_SESSION['user_id'])){
?>
user_id = '<?php echo $_SESSION['user_id']; ?>';
var askownerId=user_id;

var url=url_api+"/trademarket"+main_curr+sub_curr.toLowerCase()+"/addAsk"+sub_curr+"Market";

var json_ask = {
"askAmount<?php echo  $currency2;?>":ask_amount,
"askAmount<?php echo substr($currency1,1,3);?>":ask_vol,
"askRate":ask_rate,
"askownerId":askownerId
}


$.ajax({
type: "POST",
contentType: "application/json",
url: url,
data: JSON.stringify(json_ask),
success: function(result){


$('#alertmsg1').empty();

if (result.statusCode!=200)
{
     $('#alertmsg1').append('<div class="alert alert-danger"><strong> &nbsp;'+result.message+'</strong>  </div>');

}
}
});
<?php }else{?>

$('#alertmsg1').html('<div class="alert alert-danger"><strong>Please Login First !!!</strong>  </div>');
<?php }?>
}else{
$('#alertmsg1').html('<div class="alert alert-danger"><strong>Please filled price and amount first !!!</strong>  </div>');
}
}



function buy_data(){



var bid_rate = document.getElementById('bid_rate').value;
var bid_vol = document.getElementById('bid_vol').value;
var bid_amount = document.getElementById('bid_amount').value;

var sub_curr='<?php echo substr($currency1,1,3);?>';
var main_curr='<?php echo   strtolower($currency2);?>';

if(bid_rate !='' && bid_vol !='0' && bid_amount !='0')
{

<?php if(isset($_SESSION['user_id'])){
?>
var user_id = '<?php echo $_SESSION['user_id']; ?>';

var bidownerId=user_id;

var url=url_api+"/trademarket"+main_curr+sub_curr.toLowerCase()+"/addBid"+sub_curr+"Market";


var json_ask = {
      "bidAmount<?php echo  $currency2;?>":bid_amount,
      "bidAmount<?php echo substr($currency1,1,3);?>":bid_vol,
      "bidRate":bid_rate,
      "bidownerId":bidownerId,

}


$.ajax({
type: "POST",
contentType: "application/json",
url: url,
data: JSON.stringify(json_ask),
success: function(result){


$('#alertmsg').empty();

if (result.statusCode!=200)
  {
     $('#alertmsg').append('<div class="alert alert-danger"><strong> &nbsp;'+result.message+'</strong>  </div>');

}
}
});
<?php }else{?>

$('#alertmsg').html('<div class="alert alert-danger"><strong>Please Login First !!!</strong>  </div>');
<?php }?>
}else{
$('#alertmsg').html('<div class="alert alert-danger"><strong>Please filled price and amount first !!!</strong>  </div>');
}
}
var sub_curr='<?php echo substr($currency1,1,3);?>';
var main_curr='<?php echo  strtolower($currency2);?>';
function del(bidId,bidownerId) {

    if (confirm("Do You Want To Delete!")) {
      $.ajax({
        type: "POST",
         url: url_api + "/trademarket"+main_curr+sub_curr.toLowerCase()+"/removeBid"+sub_curr+"Market",
        data: {
          "bidId<?php echo substr($currency1,1,3);?>": bidId,
          "bidownerId": bidownerId
        },
        success: function(result){
          alert('Data Delete Successfully');

        }
      });
    }
  }
  function del_ask(askId,askownerId) {
    if (confirm("Do You Want To Delete!")) {
      $.ajax({
        type: "POST",
        url: url_api + "/trademarket"+main_curr+sub_curr.toLowerCase()+"/removeAsk"+sub_curr+"Market",
        data: {
          "askId<?php echo substr($currency1,1,3);?>":askId,
          "askownerId":askownerId

        },
        success: function(result){
          alert('Data Delete Successfully');

        }
      });
    }
  }


getAllDetailsOfUser();
getAllAskTotal();
getAllBidTotal();
orderBookBid();
orderBookAsk();
getUsermaincurrencyBalance();
getUsersubcurrencyBalance();
userOpenOrders();
userClosedOrders();
getCurrentAskPrice();
getAsksSuccess();
getBidsSuccess();



function getCurrentAskPrice(data){
  $.ajax({
      type: "POST",
      url: url_api+ "/trademarket"+main_curr+sub_curr.toLowerCase()+"/getAllAsk"+sub_curr,

      data: {},
      success: function(data)
      {


    if(data.asks<?php echo substr($currency1,1,3);?>){

      $('#ask_current').empty();
      for(var i=0; i< data.asks<?php echo substr($currency1,1,3);?>.length;i++){
        if(data.asks<?php echo substr($currency1,1,3);?>[i].status == 2){
          $('#ask_current').append(" &nbsp;"+data.asks<?php echo substr($currency1,1,3);?>[i].askRate+"");

          break;
        }
      }
    }

      },
      error: function(err){
      }
    });
  }



function getAllDetailsOfUser(){
    $.ajax({
      type: "POST",
      url: url_api+ "/user/getAllDetailsOfUser",
      data: {
        userMailId: '<?php if(isset( $_SESSION['user_session'])){ echo $_SESSION['user_session'];} ?>'

      },
      success: function(res)
      {

         getUsermaincurrencyBalance(res);
          getUsersubcurrencyBalance(res);

      },
      error: function(err){
      }
    });
  }
  function getUsermaincurrencyBalance(res){
      $.ajax({
      type: "POST",
      url: url_api+ "/user/getAllDetailsOfUser",
      data: {
        userMailId:'<?php if(isset( $_SESSION['user_session'])){ echo $_SESSION['user_session'];} ?>'
      },
      success: function(res)
      {


    $('#balance_bid_able').empty();
    $('#balance_bid_freeze').empty();
    $('#balance_bid_able').append(res.user.<?php echo $currency2;?>balance);
    $('#balance_bid_freeze').append(res.user.Freezed<?php echo $currency2;?>balance);

      },
      error: function(err){
      }
    });
  }
    function getUsersubcurrencyBalance(res){
      $.ajax({
      type: "POST",
      url: url_api+ "/user/getAllDetailsOfUser",
      data: {
        userMailId:'<?php if(isset( $_SESSION['user_session'])){ echo $_SESSION['user_session'];} ?>'

      },
      success: function(res)
      {


    $('#balance_ask_able').empty();
    $('#balance_ask_freeze').empty();
    $('#balance_ask_able').append(res.user.<?php echo substr($currency1,1,3);?>balance);
    $('#balance_ask_freeze').append(res.user.Freezed<?php echo substr($currency1,1,3);?>balance);

      },
      error: function(err){
      }
    });
  }

function getAllAsk(){
    $.ajax({
      type: "POST",
      contentType: "application/json",
      url: url_api+ "/trademarket"+main_curr+sub_curr.toLowerCase()+"/getAllAsk"+sub_curr,
      data: {},
      success: function(data){



      }
    });
  }

  function getAllBid(){
    $.ajax({
      type: "POST",
      contentType: "application/json",
      url: url_api+ "/trademarket"+main_curr+sub_curr.toLowerCase()+"/getAllBid"+sub_curr,
      data: {},
      success: function(data){



        }
      });
    }

  function getAllAskTotal(){
    $.ajax({
      type: "POST",
      contentType: "application/json",
      url: url_api+ "/trademarket"+main_curr+sub_curr.toLowerCase()+"/getAllAsk"+sub_curr,
      data: {},
      success: function(data){

        $('#orderbook_last_ASK').empty();
        $('#orderbook_lastask').empty();
        if(data.askAmount<?php echo $currency2;?>Sum && data.askAmount<?php echo substr($currency1,1,3);?>Sum){
        $('#orderbook_lastask').append(" &nbsp;"+data.askAmount<?php echo $currency2;?>Sum.toFixed(5)+"");
        $('#orderbook_last_ASK').append(" &nbsp;"+data.askAmount<?php echo substr($currency1,1,3);?>Sum.toFixed(5) +"");

        }

      }
    });
  }

  function getAllBidTotal(){
    $.ajax({
      type: "POST",
      contentType: "application/json",
      url: url_api+ "/trademarket"+main_curr+sub_curr.toLowerCase()+"/getAllBid"+sub_curr,
      data: {},
      success: function(data){

        var bid_orders = data;
        $('#orderbook_last_BID').empty();
        $('#orderbook_lastbid').empty();
        if(bid_orders.bidAmount<?php echo $currency2;?>Sum && bid_orders.bidAmount<?php echo substr($currency1,1,3);?>Sum){
           $('#orderbook_lastbid').append(" &nbsp;"+bid_orders.bidAmount<?php echo $currency2;?>Sum.toFixed(5)+"");
           $('#orderbook_last_BID').append(" &nbsp;"+bid_orders.bidAmount<?php echo substr($currency1,1,3);?>Sum.toFixed(5)+"");
        }
      }
    });
  }
  function orderBookBid(){
          $.ajax({
          type: "POST",
          contentType: "application/json",
          url:  url_api+ "/trademarket"+main_curr+sub_curr.toLowerCase()+"/getAllBid"+sub_curr,
          data: {},
          success: function(data){

          var bid_orders = data;
          $('#bid-list').empty();

          if(data.bids<?php echo substr($currency1,1,3);?>){
          for (var i = 0; i < 20; i++) {
          if(i==bid_orders.bids<?php echo substr($currency1,1,3);?>.length) break;
          if(data.bids<?php echo substr($currency1,1,3);?>[i].status != 1){

          $('#bid-list').append('<tr><td> BID </td><td>'+bid_orders.bids<?php echo substr($currency1,1,3);?>[i].bidAmount<?php echo substr($currency1,1,3);?>+ '</td><td>' + bid_orders.bids<?php echo substr($currency1,1,3);?>[i].bidRate + '</td><td>' +  bid_orders.bids<?php echo substr($currency1,1,3);?>[i].bidAmount<?php echo $currency2;?> + '</td></tr>')
        }
      }
    }
  }
});
}
  function orderBookAsk() {
                $.ajax({
                type: "POST",
                contentType: "application/json",
                url: url_api+ "/trademarket"+main_curr+sub_curr.toLowerCase()+"/getAllAsk"+sub_curr,
                data: {},
                success: function(data){

                $('#ask-list').empty();
                if(data.asks<?php echo substr($currency1,1,3);?>){
                for (var j = 0; j < 20; j++){
                if(j==data.asks<?php echo substr($currency1,1,3);?>.length) break;
                if(data.asks<?php echo substr($currency1,1,3);?>[j].status != 1){

                $('#ask-list').append('<tr><td> ASK  </td><td>' +data.asks<?php echo substr($currency1,1,3);?>[j].askAmount<?php echo substr($currency1,1,3);?> + '</td><td>' + data.asks<?php echo substr($currency1,1,3);?>[j].askRate + '</td><td>' +  data.asks<?php echo substr($currency1,1,3);?>[j].askAmount<?php echo $currency2;?> + '</td></tr>');
                }
          }
        }
      }
  });
}
function userOpenOrders(){
     $.ajax({
      type: "POST",
      url: url_api+ "/user/getAllDetailsOfUser",
      data: {
        userMailId: '<?php if(isset( $_SESSION['user_session'])){ echo $_SESSION['user_session'];} ?>'

      },
      success: function(res){

    $('#ulMyOrderList').empty();
    $('#ulMyOrderList').empty();
    bid=res.user.bids<?php echo substr($currency1,1,3);?>;
    ask=res.user.asks<?php echo substr($currency1,1,3);?>;
    var finalObj = bid.concat(ask);


    for( var i=0; i<finalObj.length; i++)
    {
      if(finalObj[i].status == 2 ){
        if(finalObj[i].bidAmount<?php echo substr($currency1,1,3);?>){
          $('#ulMyOrderList').append('<tr><td>'
            +finalObj[i].createdAt+
            '</td><td>BID</td><td>'
            +finalObj[i].bidAmount<?php echo substr($currency1,1,3);?>+
            '</td><td>'
            +finalObj[i].bidRate+
            '</td><td>'
            +finalObj[i].totalbidAmount<?php echo substr($currency1,1,3);?>+
            '</td><td>'
            +finalObj[i].totalbidAmount<?php echo $currency2;?>+
            '</td><td><a class="text-danger " onclick="del(id='+finalObj[i].id +',ownwe='+finalObj[i].bidowner<?php echo substr($currency1,1,3);?>+');"><i class="fa fa-window-close fa-2x closebtn" aria-hidden="true"></i></a></td></tr>');
        }
        else{
          $('#ulMyOrderList').append('<tr><td>'
            +finalObj[i].createdAt+
            '</td><td>Ask</td><td>'
            +finalObj[i].askAmount<?php echo substr($currency1,1,3);?>+
            '</td><td>'
            +finalObj[i].askRate+
            '</td><td>'
            +finalObj[i].totalaskAmount<?php echo substr($currency1,1,3);?>+
            '</td><td>'
            +finalObj[i].totalaskAmount<?php echo $currency2;?>+
            '</td><td><a class="text-danger" onclick="del_ask(id='+finalObj[i].id+',askowner='+finalObj[i].askowner<?php echo substr($currency1,1,3);?>+');" ><i class="fa fa-window-close fa-2x closebtn" aria-hidden="true"></i></a>'+
            '</td></tr>');
        }
      }
    }
    }
    });
  }
  function userClosedOrders(){
     $.ajax({
      type: "POST",
      url: url_api+ "/user/getAllDetailsOfUser",
      data: {
        userMailId: '<?php if(isset( $_SESSION['user_session'])){ echo $_SESSION['user_session'];} ?>'

      },
      success: function(res){

    $('#my-fund-list').empty();
    $('#my-fund-list').empty();
    bid=res.user.bids<?php echo substr($currency1,1,3);?>;
    ask=res.user.asks<?php echo substr($currency1,1,3);?>;
    var finalObj = bid.concat(ask);

    for( var i=0; i<finalObj.length; i++)
    {
      if(finalObj[i].status == 1 )
      {
        if(finalObj[i].bidAmount<?php echo substr($currency1,1,3);?>){
          $('#my-fund-list').append('<tr><td>'
            +finalObj[i].createdAt+
            '</td><td>Buy</td><td>'
            +finalObj[i].bidAmount<?php echo substr($currency1,1,3);?>+
            '</td><td>'
            +finalObj[i].bidRate+
            '</td><td>'
            +finalObj[i].totalbidAmount<?php echo substr($currency1,1,3);?>+
            '</td><td>'
            +finalObj[i].totalbidAmount<?php echo $currency2;?>+
            '</td></tr>');
        }
        else{
          $('#my-fund-list').append('<tr><td>'
            +finalObj[i].createdAt+
            '</td><td>Sell</td><td>'
            +finalObj[i].askAmount<?php echo substr($currency1,1,3);?>+
            '</td><td>'
            +finalObj[i].askRate+
            '</td><td>'
            +finalObj[i].totalaskAmount<?php echo substr($currency1,1,3);?>+
            '</td><td>'
            +finalObj[i].totalaskAmount<?php echo $currency2;?>+
            '</td></tr>');
        }
      }
    }
  }
    });
  }

  function getBidsSuccess(){
    $.ajax({
      type: "POST",
      contentType: "application/json",
      url: url_api+"/trademarket"+main_curr+sub_curr.toLowerCase()+"/getBids"+sub_curr+"Success",
      data: {},
      success: function(data){
        $('#my-fund-list').empty();

        var bid_orders = data;
        if(bid_orders.bids<?php echo substr($currency1,1,3);?>){

        for (var i = 0; i < 30; i++) {
          if(i==bid_orders.bids<?php echo substr($currency1,1,3);?>.length) break;
          $('#my-fund-list').append('<tr><td>' + bid_orders.bids<?php echo substr($currency1,1,3);?>[i].createdAt + '</td>'+
            '</td><td>BID</td><td>' + bid_orders.bids<?php echo substr($currency1,1,3);?>[i].bidAmount<?php echo $currency2;?>+ '</td><td>' + bid_orders.bids<?php echo substr($currency1,1,3);?>[i].bidAmount<?php echo substr($currency1,1,3);?> + '</td><td>'+ bid_orders.bids<?php echo substr($currency1,1,3);?>[i].totalbidAmount<?php echo $currency2;?> + '</td><td>'+ bid_orders.bids<?php echo substr($currency1,1,3);?>[i].totalbidAmount<?php echo substr($currency1,1,3);?> + '</td></tr>')
        }
      }

      }
    });
  }
  function getAsksSuccess(){
    $.ajax({
      type: "POST",
      contentType: "application/json",
      url: url_api+"/trademarket"+main_curr+sub_curr.toLowerCase()+"/getAsks"+sub_curr+"Success",
      data: {},
      success: function(data){
        $('#my-fund-list').empty();
        var ask_orders = data;
        if(data.asks<?php echo substr($currency1,1,3);?>){

        for (var i = 0; i < 30; i++){
          if(i==data.asks<?php echo substr($currency1,1,3);?>.length) break;
          $('#market_ask_bch').append('<tr><td>' + ask_orders.asks<?php echo substr($currency1,1,3);?>[i].createdAt + '</td>' +
            '</td><td>ASK</td><td>'+ ask_orders.asks<?php echo substr($currency1,1,3);?>[i].askAmount<?php echo $currency2;?> + '</td><td>' + ask_orders.asks<?php echo substr($currency1,1,3);?>[i].askAmount<?php echo substr($currency1,1,3);?> + '</td><td>'+ ask_orders.asks<?php echo substr($currency1,1,3);?>[i].totalaskAmount<?php echo $currency2;?> + '</td><td>'+ ask_orders.asks<?php echo substr($currency1,1,3);?>[i].totalaskAmount<?php echo substr($currency1,1,3);?> + '</td></tr>')
        }
}
      }
    });
  }

  io.socket.on('<?php echo substr($currency1,1,3);?>_ASK_ADDED', function askCreated(data){

    getAllAskTotal();
    orderBookAsk();
    userOpenOrders();
    userClosedOrders();
    getCurrentAskPrice();
    getAsksSuccess();
    });
  io.socket.on('<?php echo substr($currency1,1,3);?>_BID_ADDED', function bidCreated(data){

    getAllBidTotal();
    orderBookBid();
    userOpenOrders();
    userClosedOrders();
    getCurrentAskPrice();
    getBidsSuccess();

    });
   io.socket.on('<?php echo substr($currency1,1,3);?>_BID_DESTROYED', function bidCreated(data){
      getAllBidTotal();
      orderBookBid();
      userOpenOrders();
     userClosedOrders();
     getBidsSuccess();


    });
   io.socket.on('<?php echo substr($currency1,1,3);?>_ASK_DESTROYED', function askCreated(data){
      getAllAskTotal();
      orderBookAsk();
      userOpenOrders();
     userClosedOrders();
     getAsksSuccess();

    });


</script>
