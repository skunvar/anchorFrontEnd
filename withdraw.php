
<?php include 'include/allheader.php';?>
<?php
ob_start();

/*-----------Add Session-----------*/
page_protect();
if (!isset($_SESSION['user_id']) && !isset($_SESSION['token'])) {
    header("location:".BASE_PATH."logout");
 }
 $user_session = $_SESSION['user_session'];
   $url_api = URL_API;
 if(isset($_GET['curr']))
        {
          $currencyname=base64_decode($_GET['curr']);

          }
    if (isset($_POST['submit_btn'])) {
        $reciever_address = $_POST['addr'];
        $coin_amount = $_POST['amount'];
        $spendingpassword = $_POST['fundpass'];


        if(isset($_GET['curr']))
        {
          $currencyname=base64_decode($_GET['curr']);


          switch ($currencyname) {
            case 'BTC':

              $postData = array(
                                  "userMailId"=> $user_session,
                                  "amount"=> $coin_amount,
                                  "spendingPassword"=>$spendingpassword,
                                  "recieverBTCCoinAddress"=> $reciever_address

                              );

                      // Create the context for the request
                      $context = stream_context_create(array(
                                'http' => array(
                                'method' => 'POST',
                                'header' => "Content-Type: application/json\r\n",
                                'content' => json_encode($postData)
                                )
                      ));
                      $response = file_get_contents($url_api.'/sendamount/sendBTC', false, $context);

                          break;
                          case 'BCH':

              $postData = array(
                                  "userMailId"=> $user_session,
                                  "amount"=> $coin_amount,
                                  "spendingPassword"=>$spendingpassword,
                                  "recieverBCHCoinAddress"=> $reciever_address

                              );

                      // Create the context for the request
                      $context = stream_context_create(array(
                                'http' => array(
                                'method' => 'POST',
                                'header' => "Content-Type: application/json\r\n",
                                'content' => json_encode($postData)
                                )
                      ));
                      $response = file_get_contents($url_api.'/sendamount/sendBCH', false, $context);

                          break;
                          case 'LTC':

              $postData = array(
                                  "userMailId"=> $user_session,
                                  "amount"=> $coin_amount,
                                  "spendingPassword"=>$spendingpassword,
                                  "recieverLTCCoinAddress"=> $reciever_address

                              );

                      // Create the context for the request
                      $context = stream_context_create(array(
                                'http' => array(
                                'method' => 'POST',
                                'header' => "Content-Type: application/json\r\n",
                                'content' => json_encode($postData)
                                )
                      ));
                      $response = file_get_contents($url_api.'/sendamount/sendLTC', false, $context);

                          break;

             case 'AINR':

              $postData = array(
                                  "userMailId"=> $user_session,
                                  "amount"=> $coin_amount,
                                  "spendingPassword"=>$spendingpassword,
                                  "recieverINRCoinAddress"=> $reciever_address

                              );

                      // Create the context for the request
                      $context = stream_context_create(array(
                                'http' => array(
                                'method' => 'POST',
                                'header' => "Content-Type: application/json\r\n",
                                'content' => json_encode($postData)
                                )
                      ));
                      $response = file_get_contents($url_api.'/sendamount/sendINR', false, $context);

                          break;
                          case 'AEUR':

                               $postData = array(
                                                    "userMailId"=> $user_session,
                                                    "amount"=> $coin_amount,
                                                    "spendingPassword"=>$spendingpassword,
                                                    "recieverEURCoinAddress"=> $reciever_address

                                                );

                                        // Create the context for the request
                                        $context = stream_context_create(array(
                                                  'http' => array(
                                                  'method' => 'POST',
                                                  'header' => "Content-Type: application/json\r\n",
                                                  'content' => json_encode($postData)
                                                  )
                                        ));
                                        $response = file_get_contents($url_api.'/sendamount/sendEUR', false, $context);

                          break;
                          case 'AUSD':
                           $postData = array(
                                                    "userMailId"=> $user_session,
                                                    "amount"=> $coin_amount,
                                                    "spendingPassword"=>$spendingpassword,
                                                    "recieverUSDCoinAddress"=> $reciever_address

                                                );

                                        // Create the context for the request
                                        $context = stream_context_create(array(
                                                  'http' => array(
                                                  'method' => 'POST',
                                                  'header' => "Content-Type: application/json\r\n",
                                                  'content' => json_encode($postData)
                                                  )
                                        ));
                                        $response = file_get_contents($url_api.'/sendamount/sendUSD', false, $context);

                          break;

                          case 'AGBP':
                          $postData = array(
                                                    "userMailId"=> $user_session,
                                                    "amount"=> $coin_amount,
                                                    "spendingPassword"=>$spendingpassword,
                                                    "recieverGBPWCoinAddress"=> $reciever_address

                                                );

                                        // Create the context for the request
                                        $context = stream_context_create(array(
                                                  'http' => array(
                                                  'method' => 'POST',
                                                  'header' => "Content-Type: application/json\r\n",
                                                  'content' => json_encode($postData)
                                                  )
                                        ));
                                        $response = file_get_contents($url_api.'/sendamount/sendGBP', false, $context);


                          break;

                          case 'ABRL':
                         $postData = array(
                                                    "userMailId"=> $user_session,
                                                    "amount"=> $coin_amount,
                                                    "spendingPassword"=>$spendingpassword,
                                                    "recieverBRLCoinAddress"=> $reciever_address

                                                );

                                        // Create the context for the request
                                        $context = stream_context_create(array(
                                                  'http' => array(
                                                  'method' => 'POST',
                                                  'header' => "Content-Type: application/json\r\n",
                                                  'content' => json_encode($postData)
                                                  )
                                        ));
                                        $response = file_get_contents($url_api.'/sendamount/sendBRL', false, $context);


                          break;

                          case 'APLN':
                           $postData = array(
                                                    "userMailId"=> $user_session,
                                                    "amount"=> $coin_amount,
                                                    "spendingPassword"=>$spendingpassword,
                                                    "recieverPLNCoinAddress"=> $reciever_address

                                                );

                                        // Create the context for the request
                                        $context = stream_context_create(array(
                                                  'http' => array(
                                                  'method' => 'POST',
                                                  'header' => "Content-Type: application/json\r\n",
                                                  'content' => json_encode($postData)
                                                  )
                                        ));
                                        $response = file_get_contents($url_api.'/sendamount/sendPLN', false, $context);

                          break;

                          case 'ACAD':

                          $postData = array(
                                                    "userMailId"=> $user_session,
                                                    "amount"=> $coin_amount,
                                                    "spendingPassword"=>$spendingpassword,
                                                    "recieverCADCoinAddress"=> $reciever_address

                                                );

                                        // Create the context for the request
                                        $context = stream_context_create(array(
                                                  'http' => array(
                                                  'method' => 'POST',
                                                  'header' => "Content-Type: application/json\r\n",
                                                  'content' => json_encode($postData)
                                                  )
                                        ));
                                        $response = file_get_contents($url_api.'/sendamount/sendCAD', false, $context);

                          break;

                          case 'ATRY':
                          $postData = array(
                                                    "userMailId"=> $user_session,
                                                    "amount"=> $coin_amount,
                                                    "spendingPassword"=>$spendingpassword,
                                                    "recieverTRYCoinAddress"=> $reciever_address

                                                );

                                        // Create the context for the request
                                        $context = stream_context_create(array(
                                                  'http' => array(
                                                  'method' => 'POST',
                                                  'header' => "Content-Type: application/json\r\n",
                                                  'content' => json_encode($postData)
                                                  )
                                        ));
                                        $response = file_get_contents($url_api.'/sendamount/sendTRY', false, $context);

                          break;

                          case 'ARUB':
                         $postData = array(
                                                    "userMailId"=> $user_session,
                                                    "amount"=> $coin_amount,
                                                    "spendingPassword"=>$spendingpassword,
                                                    "recieverRUBWCoinAddress"=> $reciever_address

                                                );

                                        // Create the context for the request
                                        $context = stream_context_create(array(
                                                  'http' => array(
                                                  'method' => 'POST',
                                                  'header' => "Content-Type: application/json\r\n",
                                                  'content' => json_encode($postData)
                                                  )
                                        ));
                                        $response = file_get_contents($url_api.'/sendamount/sendRUB', false, $context);

                          break;

                          case 'AMXN':
                         $postData = array(
                                                    "userMailId"=> $user_session,
                                                    "amount"=> $coin_amount,
                                                    "spendingPassword"=>$spendingpassword,
                                                    "recieverMXNCoinAddress"=> $reciever_address,

                                                );

                                        // Create the context for the request
                                        $context = stream_context_create(array(
                                                  'http' => array(
                                                  'method' => 'POST',
                                                  'header' => "Content-Type: application/json\r\n",
                                                  'content' => json_encode($postData)
                                                  )
                                        ));
                                        $response = file_get_contents($url_api.'/sendamount/sendMXN', false, $context);

                           break;
                          case 'ACZK':
                            $postData = array(
                                                    "userMailId"=> $user_session,
                                                    "amount"=> $coin_amount,
                                                    "spendingPassword"=>$spendingpassword,
                                                    "recieverCZKCoinAddress"=> $reciever_address

                                                );

                                        // Create the context for the request
                                        $context = stream_context_create(array(
                                                  'http' => array(
                                                  'method' => 'POST',
                                                  'header' => "Content-Type: application/json\r\n",
                                                  'content' => json_encode($postData)
                                                  )
                                        ));
                                        $response = file_get_contents($url_api.'/sendamount/sendCZK', false, $context);

                          break;

                          case 'AILS':
                            $postData = array(
                                                    "userMailId"=> $user_session,
                                                    "amount"=> $coin_amount,
                                                    "spendingPassword"=>$spendingpassword,
                                                    "recieverILSCoinAddress"=> $reciever_address

                                                );

                                        // Create the context for the request
                                        $context = stream_context_create(array(
                                                  'http' => array(
                                                  'method' => 'POST',
                                                  'header' => "Content-Type: application/json\r\n",
                                                  'content' => json_encode($postData)
                                                  )
                                        ));
                                        $response = file_get_contents($url_api.'/sendamount/sendILS', false, $context);

                          break;

                          case 'ANZD':
                         $postData = array(
                                                    "userMailId"=> $user_session,
                                                    "amount"=> $coin_amount,
                                                    "spendingPassword"=>$spendingpassword,
                                                    "recieverNZDCoinAddress"=> $reciever_address

                                                );

                                        // Create the context for the request
                                        $context = stream_context_create(array(
                                                  'http' => array(
                                                  'method' => 'POST',
                                                  'header' => "Content-Type: application/json\r\n",
                                                  'content' => json_encode($postData)
                                                  )
                                        ));
                                        $response = file_get_contents($url_api.'/sendamount/sendNZD', false, $context);

                          break;

                          case 'AJPY':
                           $postData = array(
                                                    "userMailId"=> $user_session,
                                                    "amount"=> $coin_amount,
                                                    "spendingPassword"=>$spendingpassword,
                                                    "recieverJPYCoinAddress"=> $reciever_address

                                                );

                                        // Create the context for the request
                                        $context = stream_context_create(array(
                                                  'http' => array(
                                                  'method' => 'POST',
                                                  'header' => "Content-Type: application/json\r\n",
                                                  'content' => json_encode($postData)
                                                  )
                                        ));
                                        $response = file_get_contents($url_api.'/sendamount/sendJPY', false, $context);

                          break;

                          case 'ASEK':
                           $postData = array(
                                                    "userMailId"=> $user_session,
                                                    "amount"=> $coin_amount,
                                                    "spendingPassword"=>$spendingpassword,
                                                    "recieverSEKCoinAddress"=> $reciever_address

                                                );

                                        // Create the context for the request
                                        $context = stream_context_create(array(
                                                  'http' => array(
                                                  'method' => 'POST',
                                                  'header' => "Content-Type: application/json\r\n",
                                                  'content' => json_encode($postData)
                                                  )
                                        ));
                                        $response = file_get_contents($url_api.'/sendamount/sendSEK', false, $context);

                          break;

                          case 'AAUD':
                         $postData = array(
                                          "userMailId"=> $user_session,
                                          "amount"=> $coin_amount,
                                          "spendingPassword"=>$spendingpassword,
                                          "recieverAUDCoinAddress"=> $reciever_address

                                      );

                              // Create the context for the request
                              $context = stream_context_create(array(
                                        'http' => array(
                                        'method' => 'POST',
                                        'header' => "Content-Type: application/json\r\n",
                                        'content' => json_encode($postData)
                                        )
                              ));
                              $response = file_get_contents($url_api.'/sendamount/sendAUD', false, $context);

                          break;

                            }
                          }



          if ($response === false) {
            die('Error');
        }


        $responseData = json_decode($response, true);
        $message = "Successfully";
        if (isset($responseData['user'])) {
          header("location:".BASE_PATH."successsend?s=".$message);

        } else {
            $error = $responseData['message'];
        }
    }
ob_end_flush();
?>
<div class="content">

	<link href="css/usercenter.css" rel="stylesheet" type="text/css">

<?php include 'include/left_side_menu.php';?>


<script type="text/javascript">
	$(document).ready(function() {
		var accordion_head = $('.accordion > li > a'),
			accordion_body = $('.accordion li > .sub-menu');
		var found = false;
		for (i = 0; i < accordion_body.length; i++) {
			item = accordion_body.eq(i).find("[data-id='withdraw_coin']");
			if (item.length > 0) {
				accordion_head.eq(i).addClass('active').next().slideDown('normal');
				item.css({'background':' #d4f5f6','border-left-color':'#c1e3e4','border-right-color':'#c1e3e4'});
				found = true;
				break;
			}
		}
		if (found == false)
			accordion_head.eq(2).addClass('active').next().slideDown('normal');
		// Click function
		accordion_head.on('click', function(event) {
			// Disable header links
			event.preventDefault();
			// Show and hide the tabs on click
			if ($(this).attr('class') != 'active'){
				accordion_body.slideUp('normal');
				$(this).next().stop(true,true).slideToggle('normal');
				accordion_head.removeClass('active');
				$(this).addClass('active');
			}
		});

		var icoType='';
		if(icoType==''){
			$("#buyIco").parent("li").remove()
		}

		$("input").focus(function(){
			$(".failed").html("")
		});

		$(".files,.cloud,.mail").find("li").click(function () {
			$.cookie('nav_index', 2,{ path: '/' });
		});
		$(".sign").find("li").click(function () {
			$.cookie('nav_index', 3,{ path: '/' });
		});

		//左菜单active标识
		var url=window.location.href,
			pagename=url.split('nt/')[1];
		$('a[data-id="'+pagename+'"]').addClass("mactive");
		if(url.indexOf('?coin_withdraw') > -1 || url.indexOf('aw/') > -1){
			$('a[data-id=withdraw_coin]').addClass("mactive");
		} else if(url.indexOf('?coin_deposit') > -1 || url.indexOf('it/') > -1){
			$('a[data-id=deposit_coin]').addClass("mactive");
		}
		if(url.indexOf('totp/') > -1){
			$('a[data-id=totp]').addClass("mactive");
		}

		$(window).scroll(function () {
			var scrH=$(window).scrollTop();var accHeight=$(".myacc-con").height();
			if(accHeight>834) {
				if (scrH > 100) {
					if(scrH > accHeight-721) {
						$("#marketlist_wrapper").css({"position": "absolute", "top": "", "bottom": "10px", "width": "100%"});
					} else {
						$("#marketlist_wrapper").css({"position": "fixed", "top": "10px", "bottom": "", "width": "22%"});
					}
				} else {
					$("#marketlist_wrapper").attr("style", "");
				}
			}
		});
	});
</script>

	<div class="main_content  acc-m-con">


			<div class='right_mcontent  myacc-con'>

			<style>
	.winput{box-shadow: inset 1px 1px 2px rgba(0,0,0,.1); border-radius: 3px; padding: 8px 5px; font-size: 13px; font-family:'microsoft yahei'; border:1px solid #ddd;}
	#tips{ display:block}
	#withdrawtable td{ padding-right: 8px}
</style>

			<div class="m_title"><h4><?php echo $currencyname;?> Withdrawal</h4></div>
			<div class="sectioncont">
			<p style="color:red;text-align:center;font-size:20px;"> <?php if (isset($error)) {echo $error;}?> </p>

				<form name="withdraw_form" id="withdraw_form" enctype="application/x-www-form-urlencoded" method="post" action="">

				<table id='withdrawtable'>


									<tr id="addr_tr">
									<td align="right"><?php echo $currencyname;?> Address:</td>
									<td style="position:relative;">
										<input type="text" name="addr" id="addr" value="" autocomplete="off" size="50" maxlength="50">

									</td>
								</tr>

								<tr>
					<td align="right">Amount (<?php echo $currencyname;?>):</td><td><input onkeypress="return check_number(event);" type="text" value="" name="amount" id=""> <!-- Minimum 15.1 USDT, Maximum 100000 USDT --></td>
				</tr>


				<tr>
					<td align="right">Spending password:</td><td><input type="password" name="fundpass" id="fundpass" size="20"></td>
				</tr>

				<tr>
				<td>&nbsp;</td>
				<td> <input type="Submit" name="submit_btn" id="submit_btn" value="  Submit request " class="sub-btn" ></td>
				</tr>
				</table>

				</form>


			</div>


</div>
  </div> <!-- main content -->


</div>
<?php include 'include/footer.php';?>

</script>
</body>
</html>
<style type="text/css">
  .leftbar{
    min-height: 450px;
  }
</style>
