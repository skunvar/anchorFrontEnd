<?php

class allapi
{
 

  public function getallcategory()
  {
    $data = array(
      array(
        "id" => "1",
        "name" => "BTC",
        "sort" => 1
      ),
      array(
        "id" => 2,
        "name" => "BCH",
        "sort" => 2
      ),
      array(
        "id" => 3,
        "name" => "LTC",
        "sort" => 3
      )
    );
    $data=json_encode($data);
      return $data;
  }

  public function getallSubcategory()
  {
    $data = array(
      "1"=>array(
        "id" => "1",
        "name" => "BTC",
         "subcat"=>array(
          "AINR/BTC","AUSD/BTC","AEUR/BTC","AGBP/BTC","ABRL/BTC","APLN/BTC","ACAD/BTC","ATRY/BTC","ARUB/BTC","AMXN/BTC","ACZK/BTC","AILS/BTC","ANZD/BTC","AJPY/BTC","ASEK/BTC","AAUD/BTC"
          ),
        "sort" => 1
      ),
      "2"=>array(
        "id" => 2,
        "name" => "BCH",
       "subcat"=>array(
          "AINR/BCH","AUSD/BCH","AEUR/BCH","AGBP/BCH","ABRL/BCH","APLN/BCH","ACAD/BCH","ATRY/BCH","ARUB/BCH","AMXN/BCH","ACZK/BCH","AILS/BCH","ANZD/BCH","AJPY/BCH","ASEK/BCH","AAUD/BCH"
          ),
        "sort" => 2
      ),
      "3"=>array(
        "id" => 3,
        "name" => "LTC",
         "subcat"=>array(
          "AINR/LTC","AUSD/LTC","AEUR/LTC","AGBP/LTC","ABRL/LTC","APLN/LTC","ACAD/LTC","ATRY/LTC","ARUB/LTC","AMXN/LTC","ACZK/LTC","AILS/LTC","ANZD/LTC","AJPY/LTC","ASEK/LTC","AAUD/LTC"
          ),
        "sort" => 3
      )
    );
    $data=json_encode($data);
    return $data;
  }

  public function getallcurrency()
  {
    $data = array(
          "BTC","BCH","LTC","AINR","AUSD","AEUR","AGBP","ABRL","APLN","ACAD","ATRY","ARUB","AMXN","ACZK","AILS","ANZD","AJPY","ASEK","AAUD"
    );
    $data=json_encode($data);
    return $data;
  }
}



function page_protect()
{
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['HTTP_USER_AGENT'])) {
        if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT'])) {
            logout();
            exit;
        }
    }
}

function logout()
{
    global $db;
    global $pathString;
    session_start();
    unset($_SESSION['user_id']);
    unset($_SESSION['user_email_id']);
    unset($_SESSION['user_session']);
    unset($_SESSION['user_admin']);
    unset($_SESSION['user_supportpin']);
    unset($_SESSION['HTTP_USER_AGENT']);
    session_unset();
    session_destroy();
    header("Location:".BASE_PATH.'home');
}
?>
