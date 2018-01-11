<div id='sectioncont' class="buy-sell-order clearfix" style="margin-top: 3.5%;">
  <div id='tableAskList' data-id="sectioncont">



  <div class="maichu">
  <div class="b-s-title clearfix">
     <div class="">Total BID <?= $currency1;?><span class="unit-symbol" id="orderUnitSymbol"></span><span class="unit-symbol hide" id="cnySymbol"></span><span class="red" id='orderbook_last_BID'></span></div>
      <br>

      <div class="">Total BID <?= $currency2;?><span class="unit-symbol" id="orderUnitSymbol"></span><span class="unit-symbol hide" id="cnySymbol"></span><span style="margin:10px;" class="red" id='orderbook_lastbid'></span></div>
</div>
    <div class="m_con maidan list-wrapper">
      <box padding-bottom=0 class= "right-list list" >
     <!--  <li class= "title-line sorting" style="height:30px; margin-top:15px;border-bottom: 1px solid #e4ebf0">
          <span class= "right-align price" ><b>Price</b></span>
          <span class= "volume right-align" ><b>Amount</b></span>
          <span class= "total right-align" ><b>Total(BTC)</b></span>
        </li> -->
        <table  class="dataTable myorder" style="width:100%">
                  <thead class="thead-blu">
                  <tr>
                  <td  width="20%">Bid</td>
                  <td width="20%">Amount</td>
                  <td width="40%">Price</td>
                  <td  width="40%">Total(BTC)</td>
                  </tr>
                  </thead>
                  <tbody  id="bid-list"></tbody>
                  </table>


      </box>
    </div>
  </div>

  <div class="mairu">
    <div class="b-s-title clearfix">
      <div class="">Total ASK <?= $currency1;?><span class="unit-symbol" id="orderUnitSymbol"></span><span class="unit-symbol hide" id="cnySymbol"></span><span class="red" id='orderbook_last_ASK'></span></div>
      <br>

      <div class="">Total ASK <?= $currency2;?><span class="unit-symbol" id="orderUnitSymbol"></span><span class="unit-symbol hide" id="cnySymbol"></span><span style="margin:10px;" class="red" id='orderbook_lastask'></span></div>

    </div>
    <div class="m_con maidan  list-wrapper">
      <box padding-bottom=0 class= "right-list list" >
          <!-- <li class= "title-line sorting" style="height:30px; margin-top:15px;border-bottom: 1px solid #e4ebf0">
          <span class= "right-align price" ><b>Price</b></span>
          <span class= "volume right-align" ><b>Amount</b></span>
          <span class= "total right-align" ><b>Total(BTC)</b></span>
        </li> -->
               <table class="dataTable myorder" style="width:100%">
                <thead class="thead">
                <tr>
                <td  width="20%">Ask</td>
                <td width="20%">Amount</td>
                <td width="40%">Price</td>
                <td  width="40%">Total(BTC)</td>
                </tr>
                </thead>
                <tbody id="ask-list"></tbody>
                 </table>
      </box>
    </div>
  </div>



  <?php include 'include/functions.php';?>

</div>
