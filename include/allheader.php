<?php
include 'config/config.php';
include 'apis/common.php';
$obj=NEW allapi();
$data=$obj->getallcategory();
$result=json_decode($data);

$datasub=$obj->getallSubcategory();
$subcat=json_decode($datasub, true);

?>
 <!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo PROJECT_TITLE;?></title>
    <link href="favicon.ico" rel="shortcut icon">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/io.style.css" rel="stylesheet" type="text/css">
    <link href="css/theme_dark.css" rel="stylesheet" type="text/css" id="darkStyle" disabled="disabled">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/apple-touch-icon-120x120.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/jquery.common.tools.js"></script>

</head>
<body class="en-body ">
<div id="siteNoty" class="notification-box"></div>
<div class="header clearfix">
    <div class="top-up">
        <div class="top-con">
            <!-- <ul class="topprice">
                <li> BTC/USDT : $ <span class="topnum">15003.53</span><i class="icon-arrow-down">&darr;</i> </li>
                <li> ETH/USDT : $ <span class="topnum">437.46</span><i class="icon-arrow-down">&darr;</i> </li>
                <li> LTC/USDT : $ <span class="topnum">138.48</span><i class="icon-arrow-down">&darr;</i> </li>
                <li> QTUM/USDT : $ <span class="topnum">11</span><i class="icon-arrow-flat"></i> </li>
            </ul> -->

            <ul class="login_lan">
                         <?php if(isset($_SESSION['user_id']))
                        {?>

                        <li class="toplogin" style="color:#dbe2e4;"><?php echo  $_SESSION['user_session'];?>&nbsp;|&nbsp; </li>
                        <li class="toplogin" id="toplogin"><a href="<?php echo BASE_PATH;?>logout">Logout</a></li>
                        <?php }else
                        {?>
                        <li class="toplogin"><a href="<?php echo BASE_PATH;?>login">Signup&nbsp;</a>|&nbsp; </li>
                        <li class="toplogin" id="toplogin"><a href="<?php echo BASE_PATH;?>login">Login</a></li>
                        <?php

                        }
                        ?>

            </ul>
            <ul id="theme">
                <span style="color:#dbe2e4;">Theme:</span>
                <li id="dark" title="Dark" value="dark" onclick="changetheme('dark');">Dark</li>
                <li id="light" title="Light" value="light"  onclick="changetheme('light');">Light</li>
            </ul>
        </div>
    </div>

    <script>
    $( document ).ready(function() {
      function changetheme(data)
      {
        
        if(data=='light')
        {
          <style>
          .dataTable tbody tr:nth-child(odd) {    background-color:#fff;}

          .dataTable tbody tr:nth-child(even) {    background-color:#f8f8f8;}
        }
          </style>
        }

      }

    </script>
    <div class="top-dn">
        <div class="logo">
            <a href="<?= BASE_PATH?>home" target="_top">
                <img src="<?php echo BASE_PATH;?>/images/logo.png" />
            </a>
        </div>


        <ul class="gateio-nav">
            <li>
                <a href="<?php echo BASE_PATH;?>home">Home</a>

            </li>
            <li class="nav-trade-item">
                <a href="javascript:;">Markets<i class="caret"></i></a>
                <ul class="second-nav clearfix">
                    <?php
                  $i=1;
                foreach($result as $cat) {

                   ?>
                  <li>
                      <a href="javascript:;"><?php echo $cat->name;?> Markets<i class="caret"></i></a>
                      <ul class="third-nav clearfix">
                        <?php
                        foreach($subcat[$cat->id]['subcat'] as $subcatgory)
                          {
                            $menuname=explode("W/",$subcatgory);
                        ?>
                        <li><a href='<?php echo BASE_PATH;?>trade?curr=<?php echo base64_encode($subcatgory);?>'><strong><?php echo $subcatgory?></strong></a></li>
                        <?php
                        }
                        ?>
                      </ul>
                  </li>
                    <?php $i++; }?>

                </ul>
            </li>
            <li>
                <a href="<?php echo BASE_PATH;?>myaccount">Wallets</a>

            </li>

        </ul>

        <div id="top_last_rate" style="display: none">0.0002473</div>


    </div>

</div>
