<?php
/**
 * LMHelper.php is site helper class
 *
 * PHP version 5
 *
 * @category PHP
 * @package  /p-class/helper/
 * @author   Fukuball Lin <fukuball@gmail.com>
 * @license  No Licence
 * @version  Release: <1.0>
 * @link     http://sarasti.cs.nccu.edu.tw
 */

 /**
  * LMHelper is site helper class
  *
  * An example of a LMHelper is:
  *
  * <code>
  *   LMHelper::function();
  * </code>
  *
  * @category PHP
  * @package  /p-class/helper/
  * @author   Fukuball Lin <fukuball@gmail.com>
  * @license  No Licence
  * @version  Release: <1.0>
  * @link     http://sarasti.cs.nccu.edu.tw
  */
class LMHelper
{

   /**
    * Method static currentFilePath get current file path
    *
    * @return string $current_file_path
    */
  public static function currentFilePath()
  {

     return $_SERVER['PHP_SELF'];

  }// end function currentFilePath

  /**
    * Method static currentFullPageURL get current full page url
    *
    * @return string $current_page_url
    */
  public static function currentFullPageURL()
  {

    $pageURL = 'http';

    if ($_SERVER["HTTPS"] == "on") {

       $pageURL .= "s";

    }// end if

    $pageURL .= "://";

    if ($_SERVER["SERVER_PORT"] != "80") {

      $pageURL .= $_SERVER["SERVER_NAME"].":".
         $_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

    } else {

      $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

    }// end if

    return $pageURL;

  }// end function currentFullPageURL

  /**
    * Method static currentPageURL get current page url
    *
    * @return string $current_page_url
    */
  public static function currentPageURL()
  {

    $pageURL = 'http';

    if ($_SERVER["HTTPS"] == "on") {

       $pageURL .= "s";

    }// end if

    $pageURL .= "://";

    if ($_SERVER["SERVER_PORT"] != "80") {

      $pageURL .= $_SERVER["SERVER_NAME"].":".
         $_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

    } else {

      $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

    }// end if

     $pageURL_array = explode("?", $pageURL);
    $pageURL = $pageURL_array[0];

    return $pageURL;

  }// end function currentPageURL

  /**
    * Method static currentPageURLPath get current page url path
    *
    * @return string $current_page_url_path
    */
  public static function currentPageURLPath()
  {

    $currentPageURL = self::currentPageURL();

    return str_replace(SITE_HOST, "", $currentPageURL);

  }// end function currentPageURLPath

  /**
    * Method static getUserIP get current user ip
    *
    * @return string $ip
    */
  public static function getUserIP()
  {
      if ($_SERVER["HTTP_X_FORWARDED_FOR"]) {

         if ($_SERVER["HTTP_CLIENT_IP"]) {

            $proxy = $_SERVER["HTTP_CLIENT_IP"];

         } else {

            $proxy = $_SERVER["REMOTE_ADDR"];

         }// end if

         $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];

      } else {

         if ($_SERVER["HTTP_CLIENT_IP"]) {

            $ip = $_SERVER["HTTP_CLIENT_IP"];

         } else {

            $ip = $_SERVER["REMOTE_ADDR"];

         }// end if

      }// end if

      return $ip;

  }// end function getUserIP

  /**
   * Method static doGet to get url content
   *
   * @param string $url # the url
   *
   * @return string $response
   */
   public static function doGet($url)
   {

      $ch = curl_init();


      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

      $response = curl_exec($ch);
      curl_close($ch);

      return $response;
   }// end function doGet

   /**
   * Method static doPost to post url content
   *
   * @param string $url   # the url
   * @param array  $fields # the parameters
   *
   * @return string $response
   */
   public static function doPost($url, $fields)
   {

      $fields_string = '';

      foreach ($fields as $key => $value)
      {
          $fields_string .= $key . '=' . $value . '&';
      }
      $fields_string = rtrim($fields_string, '&');

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POST, count($fields));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

      $response = curl_exec($ch);
      curl_close($ch);

      return $response;

   }// end function doPost

   public static function print_getauth($json_get_auth) {
      $jsonresult=json_decode($json_get_auth);
      $token=$jsonresult->info->token;
      $sign=$jsonresult->info->sign;
      print_r($jsonresult);
   }

   public static function smstest() {
      global $isvid,$serviceid,$isvkey,$host,$token,$sign,$phone,$msg;
      $smsserver="http://sms.hiapi1.lab.hipaas.hinet.net/hisms/servlet/send";
      $ch=curl_init();
      curl_setopt($ch, CURLOPT_URL, $smsserver);
      curl_setopt($ch,CURLOPT_POST,1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, "isvAccount=$isvid&token=$token&sign=$sign&msisdn=$phone&msg=$msg");
      curl_exec($ch);
   }

   public static function hiapi_get_auth($host) {
      global $isvkey,$isvid,$serviceid;

      $nonce = substr(md5(uniqid('nonce_', true)),0,16);
      $timestamp=round(microtime(true)*1000);
      $sdksign=sha1($isvkey.$nonce.$timestamp);
      $url="http://$host/SrvMgr/requestToken/$isvid/$serviceid/$nonce/$timestamp/$sdksign/";
      print $url."\n";

      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
      $r=curl_exec($ch);
      $jsonresult=json_decode($r);
      $token=$jsonresult->info->token;
      $sign=$jsonresult->info->sign;
      return array($token,$sign);
   }

}// end class LMHelper
?>