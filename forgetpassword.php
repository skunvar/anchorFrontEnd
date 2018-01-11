<?php
include 'include/allheader.php';
?>
<?php
error_reporting(0);

 $url_api=URL_API;

if(isset($_POST['btnforget']))
{
//  var_dump($_POST);
  $email_id = $_POST['email'];



$postData = array(
   "userMailId" => $email_id,

  );

// Create the context for the request
$context = stream_context_create(array(
  'http' => array(
    'method' => 'POST',
    'header' => "Content-Type: application/json\r\n",
    'content' => json_encode($postData)
    )
  ));


$response = file_get_contents($url_api.'/user/sentOtpToEmailForgotPassword', FALSE, $context);

if($response === FALSE){
  die('Error');
}


$responseData = json_decode($response, TRUE);



if(isset($responseData['userMailId']))
{
  $message = $responseData['message'];


  header("location:".BASE_PATH."verfiyforgetotp.php?f=".$message);
}
else
{
  $error = $responseData['message'];
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
<form enctype="application/x-www-form-urlencoded" method="post" action="">

                <table>

<label><h4>Enter Register Email ID</label><h4><br>
<input type="text" name="email" /><br><br><br>
<input type="submit" class="sub-btn" name="btnforget"/><br>
<div style="width:50%;" id="alertmsg1"></div>
</form>
<p class="text-center" style="color:red;"> <?php if (isset($error)) {
    echo $error;
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
