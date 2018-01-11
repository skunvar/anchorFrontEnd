<?php
include 'include/allheader.php';
?>

<?php
error_reporting(0);
$email =$_GET['e'];
$url_api=URL_API;

if(isset($_POST['btnlogin']))
{
	$email = $_POST['email'];
  $password = $_POST['signuppassword'];
	$confirmpassword = $_POST['confirmpassword'];

	$postData = array(

		"userMailId"=>$email,
		"newPassword"=>$password,
		"confirmNewPassword"=>$confirmpassword
		);

// Create the context for the request
	$context = stream_context_create(array(
		'http' => array(
			'method' => 'POST',
			'header' => "Content-Type: application/json\r\n",
			'content' => json_encode($postData)
			)
		));


	$response = file_get_contents($url_api.'/user/updateForgotPassordAfterVerify', TRUE, $context);

	if($response === FALSE){
		die('Error');
	}


	$responseData = json_decode($response, TRUE);

	if($responseData['statusCode']==200){
		$message = $responseData['message'];
		header("location:".BASE_PATH."login");

	}
	else
	{
		$fail = $responseData['message'];

	}
}




?>
<!DOCTYPE html>
<html>

<body>


<div class="content">

    <link href="css/usercenter.css" rel="stylesheet" type="text/css">


<div class="main_content  acc-m-con">
       <div class="m_title"><h4 align="center">Update Your Password</h4></div>


            <div align="center" class="sectioncont">
            <p style="color:green;"> <?php if(isset($message)) {echo $message; }?> </p>
		    <p style="color:red;"> <?php if(isset($fail)) {echo $fail; }?> </p>
<form enctype="application/x-www-form-urlencoded" method="post" action="">

                <table>

<label><h4>Enter Email</label><h4><br>
<input type="text" name="email" /><br><br><br>
<label><h4>New Password</label><h4><br>
<input type="password" name="signuppassword"  /><br><br><br>
<label><h4>Confirm New Password</label><h4><br>
<input type="password" name="confirmpassword"  /><br><br><br>
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