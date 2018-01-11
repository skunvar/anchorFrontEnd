
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
 if(isset($_GET['s']))
{
  $message=$_GET['s'];

  }
    ?>
<div class="content">

	<link href="css/usercenter.css" rel="stylesheet" type="text/css">

<?php include 'include/left_side_menu.php';?>


<script type="text/javascript">
	$(document).ready(function() {

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

			<div class="sectioncont">
			<form action="<?= BASE_PATH?>successsend" method="post">
			    	<div class="card text-black bg-success">
		                <div class="card-header text-center text-black">
		                    <h1 class="text-black">Withdrawal Response</h1>
		                </div>
		                <div class="card-body bg-white text-center text-success">
		                    <?php if(!empty($message)){ ?>
								<label>The transaction has been  <?php echo $message;?> initiated.</label>
							<?php
							} else {
							?>
								<label class="text-warning">There is some issue in processng your transaction. Please try after some time</label>
							<?php
							}
							?>
		                </div>

		            </div>
		        </form>

</div> <!-- right_mcontent -->
  </div> <!-- main content -->


</div>
<?php include 'include/footer.php';?>

</script>
</body>
</html>
