<?php
include 'include/allheader.php';
  page_protect();
if (!isset($_SESSION['user_id']) && !isset($_SESSION['token'])) {
  header("location:".BASE_PATH."login");
}
$user_session = $_SESSION['user_session'];

?>


<div class="content">
<link href="css/usercenter.css" rel="stylesheet" type="text/css">
<?php include 'include/left_side_menu.php';?>
<script type="text/javascript">


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

</script>

<div class="main_content  acc-m-con">


<div class='right_mcontent  myacc-con'>

<style>
    .funds-p-tier b{width: 50%;text-align: right;padding-right: 8px;}
    .en-body .fund-deposit,.en-body .fund-withdraw,.en-body .fund-to-trade{ width: 68px}
    .sectioncont .all-funds-table.dataTable thead tr td:last-child, .sectioncont .all-funds-table.dataTable tr td:last-child {width: 25%;}
    .f-d-info {min-height: 187px;}
</style>

<div class="sectioncont funds-dtl myfunds-dtl">
    <div class="m_title" id="wallet"> Currencies: </div>
    <div class="HideZeroDiv pull-left" id="hideZbtn">
        <label for="hidezero">
        <input type="checkbox" id="hidezero"  name='hidezero' style="width: 20px;" value="1" onclick="hidezerobalance();" />
        <label for="hidezero" class="vr-btn"></label>
        <span class="hidezero-span">Hide zero balances</span>
        </label>
        <input type="hidden" id="min"><input type="hidden" id="max">
    </div>
    <table id="funds" class='dataTable sf-grid all-funds-table' cellspacing="0" cellpadding="0">
        <thead>
            <tr role="row" style="height:40px">
              <!-- <th align='right' style="width:0%"><b></b></th> -->
              <th align='right' style="width:10%"><b>Type</b></th>
              <th align='right' style="width:10%"><b> Balance</b></th>
              <th align='right' style="width:10%"><b> Freeze Balance</b></th>
              <th align='right' style="width:10%"><b>Total</b></th>
              <th align='right' style="width:40%"><b>Operation</b></th>
            </tr>
        </thead>
        <tbody role="alert" aria-live="polite" aria-relevant="all">
        <?php
$obj=NEW allapi();
$data=$obj->getallcurrency();
$result=json_decode($data);

        $url_api=URL_API;
        $postData = array(
          "userMailId"=> $user_session

          );
          $user_session = $_SESSION['user_session'];
          $context = stream_context_create(array(
            'http' => array(
              'method' => 'POST',
              'header' => "Content-Type: application/json\r\n",
              'content' => json_encode($postData)
              )
            ));
         $response = file_get_contents($url_api.'/user/getAllDetailsOfUser', false, $context);
         $responseData = json_decode($response, true);
         $i=1;
        foreach($result as $currencyname){
          $cun=trim($currencyname,"A");

          ?>
                  <tr class='odd hanga <?php $chkbal=$responseData['user'][$cun.'balance']+$responseData['user']['Freezed'.$cun.'balance'];if($chkbal==0){echo "rowhidebal";}?>'  data-id='zero' >
                    <!-- <td align='left'></td> -->
                    <td align='right'><span class='icon-16 icon-16-usdt'></span><span style='color:#08a287'>
                    <b><?php echo $currencyname; ?></b></span></td>
                    <td align='right'><?php echo $responseData['user'][$cun.'balance']; ?></td>
                    <td align='right' class=no-od><?php echo $responseData['user']['Freezed'.$cun.'balance'];?></td>
                    <td align='right'><?php echo $total=$responseData['user'][$cun.'balance']+$responseData['user']['Freezed'.$cun.'balance'];?></td>

                    <td align='right'>
<a href="<?= BASE_PATH?>deposit?curr=<?php echo base64_encode($currencyname);?> " class='normal-depo fund-deposit'
title='Working'>Deposit</a>
<a href="<?= BASE_PATH?>withdraw?curr=<?php echo base64_encode($currencyname);?>" class='normal-depo fund-withdraw' title='Working'>Withdraw</a>
<a href="<?= BASE_PATH?>transaction?curr=<?php echo base64_encode($currencyname);?>" class='normal-depo fund-to-trade' title='Working'>History</a></td>
                </tr>
                <?php $i++;}?>
                    </tbody>
    </table>


</div>
<br>
<script src="js/jquery.dataTables.min.js"></script>
<script>

function hidezerobalance()
{

  if ($('#hidezero').is(":checked"))
{
    $('.rowhidebal').hide();
}else{
  $('.rowhidebal').show();
}
}
    // $.fn.dataTable.ext.search.push(
    //         function( settings, data, dataIndex ) {
    //             var min = parseFloat( $('#min').val());
    //             var max = parseFloat( $('#max').val());
    //             var acc = parseFloat( data[1] ) || 0;
    //             if ( ( isNaN( min ) && isNaN( max ) ) ||
    //                     ( isNaN( min ) && acc <= max ) ||
    //                     ( min <= acc   && isNaN( max ) ) ||
    //                     ( min <= acc   && acc <= max ) )
    //             {
    //                 return true;
    //             }
    //             return false;
    //         }
    // );

function cancel_withdraw(uid, wid){
var json_req = {
type : "cancel_withdraw",
uid : uid,
wid : wid
};
$.ajax({type:"get",url:"/json_svr/exchange/?u=21", data:json_req, xhrFields: { withCredentials: true},
success : function(data, textStatus){
var json_res = data;
if ( json_res && json_res.result ) {
view_code = "<div class='cancel_content'>Cancelled!</div>";
noty({text: view_code, type: "success",layout: "bottomLeft", closeWith : ['button', 'click'],theme : 'gateioNotyTheme', timeout: 5000, callback: {onShow: function() {}}});
}else{
view_code = "<div class='cancel_content'>Failed! "+json_res.msg+"</div>";
noty({text: view_code, type: "warning",layout: "bottomLeft", closeWith : ['button', 'click'],theme : 'gateioNotyTheme', timeout: 10000, callback: {onShow: function() {}}});
}
},
error : function(){
noty({text: "Network error", type: "error",layout: "bottomLeft", closeWith : ['button', 'click'],theme : 'gateioNotyTheme', timeout: 10000, callback: {onShow: function() {}}});
},
complete : function(){
}
});
}

    $( function () {

        var tableIndex=$('#funds').DataTable({
            "dom": '<"top"f>rt<"bottom"ip><"clear">',
            "pageLength": 12,
            "autoWidth": false,
            "language": {
                "sInfoEmpty":"0 matching records",
                "sSearch": ""
            },
            "order": [
                [4, null]
            ],
            "columnDefs": [
                { "orderable": false, "targets": [ 4 ] }
            ]
        });

tableIndex.on('draw.dt',function() {
var lb=$(".leftbar"), mc=$(".main_content"),lh=lb.height(),mh=mc.height();
lb.css("height",mh)
});
    // if ($.cookie('show_zero_funds') === undefined || $.cookie('show_zero_funds') === '0') {
    //         $('#hidezero').prop('checked', false).removeClass('zero-active');
    //         $('#min,#max').val('');
    //         tableIndex.draw();
    //     } else {
    //         $('#hidezero').prop('checked', true).addClass('zero-active');
    //         $('#min').val('0.00000001');
    //         $('#max').val('9999999999');
    //         tableIndex.draw();
    //     }

        // $('#hideZbtn').on('click', function() {
        //
        //     if ($('#hidezero').hasClass("zero-active")) {
        //         $('#min,#max').val('');
        //         tableIndex.draw();
        //         setTimeout(function(){$('#hidezero').removeClass('zero-active')},200);
        //         $.cookie('show_zero_funds', '0',{ expires:30,path: '/' });
        //
        //     } else { //全部币种显示
        //         $('#min').val('0.00000001');
        //         $('#max').val('9999999999');
        //         tableIndex.draw();
        //         setTimeout(function(){$('#hidezero').addClass('zero-active')},200);
        //         $.cookie('show_zero_funds', '1',{ expires:30,path: '/' });
        //
        //     }
        // });

var $dep=$("#latestDepo"), $wit=$("#latestWith");
if($dep.find("tr").size() > 4){
$dep.parent().css("padding-right","10px").prev("table").css("padding-right","26px");
} else if($dep.find("tr").size() == 1){
$dep.find(".table-empty").show()
}
if($wit.find("tr").size() > 4){
$wit.parent().css("padding-right","10px").prev("table").css("padding-right","26px");
} else if($wit.find("tr").size() == 1){
$wit.find(".table-empty").show()
}
$("td:contains('Done')").css("color","#008069");
$("td:contains('Cancelled')").css("color","#888");
$("td:contains('Rejected')").css("color","#a00");
$("td:contains('Pending')").css("color","#dc9a00");
$("td:contains('Verifying')").css("color","#f60");
$("td:contains('Processing')").css("color","#0086b3");

});

</script>


<br>
</div>
  </div>


</div>
<?php include 'include/footer.php'; ?>


<script>
//     $(function(){
// $.fn.animateProgress = function(progress, callback) {
// return this.each(function() {
//   $(this).animate({
// width: progress+'%'
//   }, {
// duration: 800,
// easing: 'swing',
// step: function( progress ){
//     $('.value').text(Math.ceil(progress) + '%');
// },
// complete: function(scope, i, elem) {
//   if (callback) {
// callback.call(this, i, elem );
//   };
// }
//   });
// });
//   };
//   if(pro_val=='') barcon.animateProgress(0); else barcon.animateProgress(pro_val);
//
//         var lb=$(".leftbar"), mc=$(".main_content"),lh=lb.height(),mh=mc.height();
//         if (lh < mh){lb.css("height",mh)}
//
//         $(".side-sev ul li").hover(function(){
//             var _this=$(this);
//             _this.find(".sidebox").stop().animate({"width":"165px"},2).css({"background":"#009173"});
//         },function(){
//             $(this).find(".sidebox").stop().animate({"width":"45px"},2).css({"background":"none"});
//         });
//
//         $("#bottomWXli").hover(function(){
//             $(".wx-bottom").show()
//         },function(){
//             $(".wx-bottom").hide()
//         });
// $("#runTime").hover(function(){
// $(this).css("height","auto")
//         },function(){
// $(this).css("height","26px")
//         });
//
//         var notyContent='SMT(SmartMesh) is listed on gate.io(10 million bonus)';
//
//         function notyCookie() {
//             var noticeMsg = $("#siteNotyCon").text();
//             $.cookie('notice', noticeMsg, { expires: 365, path: '/' });
//         }
//
//
//     });


</script>
</body>
</html>
