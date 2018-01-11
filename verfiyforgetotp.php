<?php
include 'include/allheader.php';
?>

<?php
error_reporting(0);
$url_api=URL_API;

$forget = $_GET['f'];

///login With forget passworr////
if(isset($_POST['btnlogin']))
{
//  var_dump($_POST);
  $email_id = $_POST['email'];
  $password = $_POST['OTP'];


$postData = array(
   "userMailId" => $email_id,
        "otp" => $password
  );

// Create the context for the request
$context = stream_context_create(array(
  'http' => array(
    'method' => 'POST',
    'header' => "Content-Type: application/json\r\n",
    'content' => json_encode($postData)
    )
  ));


$responseforget = file_get_contents($url_api.'/user/verifyOtpToEmailForgotPassord', TRUE, $context);


if($responseforget === FALSE){
  die('Error');
}


$responseDataforget = json_decode($responseforget, TRUE);

if($responseDataforget['statusCode'] != 401 )
{

header("location:".BASE_PATH."updateforgetpassword?e=".$email_id);

}
else
{
unset($forget);
  $message = $responseDataforget['message'];
}

}


?>
<!DOCTYPE html>
<html>

<body>


<div class="content">

    <link href="css/usercenter.css" rel="stylesheet" type="text/css">


<div class="main_content  acc-m-con">
       <div class="m_title"><h4 align="center">Forget Password</h4></div>


            <div align="center" class="sectioncont">
            <p style="color:Green;"> <?php if(isset($forget)) {echo $forget. " You Can SignIn Now."; }?> </p>
<form enctype="application/x-www-form-urlencoded" method="post" action="">

                <table>

<label><h4>Enter Register Emial ID</label><h4><br>
<input type="text" name="email" /><br><br><br>
<label><h4>Enter OTP</label><h4><br>
<input type="text" name="OTP"  /><br><br><br>
<input type="submit" class="sub-btn" name="btnlogin"/><br>
<div style="width:50%;" id="alertmsg1"></div>
</form>
<p class="text-center" style="color:red;"> <?php if (isset($message)) {
    echo $message;
}?> </p>
</table>
</form>
</div>

</div>
</div>
<br>
<br>
<?php include 'include/footer.php';?>
</body>
</html>
<style>
.main_content
{
    width:100% !important;
}
</style>