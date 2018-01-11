
<div class="content index-content clearfix">
	<table class="leftbar">
    <tr>
        <td style="border-bottom:0;" valign="top">
            <div id="marketlist_wrapper" class="dataTables_wrapper" role="grid">



		<table class="marketlist dataTable" id="tradelist" cellspacing="0" cellpadding="0">

    <tbody role="alert" aria-live="polite" aria-relevant="all">
    	<tr>
            <td class="no-wrap alignRight" width="100%" style="border-bottom:0">
                <ul id='market_controller' class="clearfix">

			<?php
				$i=1;
			foreach($result as $cat) { ?>
					<button value="<?php echo $cat->name;?>"
						 class="tline_btn left_btn <?php if(($i==1) && ($currency2=='BTC')){echo "tn_selected";} if($currency2==$cat->name){echo "tn_selected";}?>"><?php echo $cat->name;?></button>
					<?php $i++; }?>

                </ul>
                <!-- <input type="text" class="search" id="marketSearch" value="Search..." /> -->
            </td>
          </tr>

     	<tr>
				<?php foreach($result as $cat) {?>
            <td id='marketlist_container_<?php echo strtolower($cat->name);?>'
							 class="no-wrap alignRight" style="width:100%;display:none;">
            <table class="dataTable" id="marketlist_<?php echo strtolower($cat->name);?>">
							<thead>
								<tr role="row" style="height:40px">
										<th class="no-wrap sortable sorting"><b>Type</b></th>
										<th class="no-wrap sortable sorting">Ask<span id="leftPriceType"></span></th>
										<!-- <th class="no-wrap sortable sorting" id="leftbarupdntop">24h %</th> -->
									</tr>
			</thead><tbody>
			<?php
			$i=1;
			$money=getallaskbid();


			foreach($subcat[$cat->id]['subcat'] as $subcatgory)
				{

					$pricecat=explode("/",$subcatgory);
          $strChng=substr($pricecat[0],1,3);
          
          $pricesubcat=($pricecat[1].$strChng);
          


					?>
				 <tr role="row" class="<?php if($i% 2 == 0){ echo "even";}else{echo "odd";}?>">
				  <td><a href="<?= BASE_PATH?>trade?curr=<?php echo base64_encode($subcatgory);?>"><?php echo $subcatgory?></a></td>
				  <td class="alignRight"><a href="<?= BASE_PATH?>trade?curr=<?php echo base64_encode($subcatgory);?>">Ask:<span style="color:red;"><?php echo number_format($money['ask'.$pricesubcat],5,'.',',');?></span><br>Bid:<span style="color:green;"><?php echo number_format($money['bid'.$pricesubcat],5,'.',',');?></span></a></td>
				  <!-- <td class=" alignRight"><a href="<?= BASE_PATH?>trade?curr=<?php echo base64_encode($subcatgory);?>">1231</a></td> -->
				</tr>

			<?php $i++;}?>

					</tbody>
							</table>

							</td>
						<?php }?>

          </tr>

		</tbody>
	</table>

	</div>
	</td>
	</tr>
</table>
<?php include 'include/functions.php';?>
<script>

    $(function () {
      var base = 'BTC';
			var marketCom = $("#marketlist_container_btc");

        var item = marketCom.find("[data-trade='EOS_BTC']");

            marketCom.css('display', 'block').siblings().css('display', 'none');

        if (item.length > 0) {
            item.closest('tr').addClass('coin-selected');
        }

        $("#market_controller").find("button").click(function () {
            $("#market_controller").find("button").removeClass("tn_selected");
            $(this).addClass("tn_selected").siblings().removeClass("tn_selected");



            var td = $(this).attr('value');


            if (td == 'BTC') {
				$("#marketlist_container_bch,#marketlist_container_ltc").css('display', 'none');
                $("#marketlist_container_btc").css('display', 'block');
                base = 'USDT';
            } else if (td == 'BCH') {
				$("#marketlist_container_btc,#marketlist_container_ltc").css('display', 'none');
                $("#marketlist_container_bch").css('display', 'block');
                base = 'BTC';
            } else if (td == 'LTC') {
				$("#marketlist_container_btc,#marketlist_container_bch").css('display', 'none');
                $("#marketlist_container_ltc").css('display', 'block');
                base = 'ETH';
            }


        return false;
    });
$( document ).ready(function() {
			$("#marketlist_container_bch,#marketlist_container_ltc,#marketlist_container_btc").css('display', 'none');
			$('#marketlist_container_<?php echo strtolower($currency2);?>').show();
		});

// 	$('#marketSearch').keyup(function(e) {
// 		var needle = $(this).val();
// 		$.each($('.bizhong_en'),
// 		function() {
// 			var symbol = $(this).html();
// 			if (symbol.toLowerCase().indexOf(needle.toLowerCase()) == -1) {
// 				$('#' + $(this).attr('line_id')).hide();
// 			} else {
// 				$('#' + $(this).attr('line_id')).show();
// 				 if (e.keyCode == 13) {
// 					window.location = "/trade/"+symbol+"_"+base;
// 				}
// 			}
// 		});
// 	}).focus(function() {
//         if ($(this).val() === 'Search...') {
//             $(this).val('');
//         }
//     }).blur(function() {
//         if ($(this).val() === '') {
//             $(this).val('Search...');
//         }
//     });
 });

</script>


<?php

function getallaskbid()
  {

      $content = file_get_contents( URL_API."/balance/getRatesAllBidAsk");

	   $data=json_decode($content,true);



    return $data;
  }
?>
<!-- <script type="text/javascript" src="js/sails.io.js"></script> -->
<script type="text/javascript">
  // io.sails.url = 'http://209.188.21.216:1338';
  // window.ioo = io;
  // socket = io.connect( 'http://209.188.21.216:1338', {
  //   reconnection: true,
  //   reconnectionDelay: 1000,
  //   reconnectionDelayMax : 5000,
  //   reconnectionAttempts: 99999
  // });

  // socket.on( 'connect', function () {} );
  // socket.on( 'disconnect', function () { socket.connect();  } );

  
</script>
