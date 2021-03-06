<?php
/**
 * AuthAction.php is the controller to dispatch auth actions with auth view
 *
 * PHP version 5
 *
 * @category PHP
 * @package  /ajax-action/
 * @author   Fukuball Lin <fukuball@gmail.com>
 * @license  No Licence
 * @version  Release: <1.0>
 * @link     http://sarasti.cs.nccu.edu.tw
 */

/**
 * AuthAction is the controller to dispatch auth actions with auth view
 *
 * An example of a AuthAction is:
 *
 * <code>
 *  # This will done by rest request
 * </code>
 *
 * @category PHP
 * @package  /ajax-action/
 * @author   Fukuball Lin <fukuball@gmail.com>
 * @license  No Licence
 * @version  Release: <1.0>
 * @link     http://sarasti.cs.nccu.edu.tw
 */
class AuthAction extends LMRESTControl implements LMRESTfulInterface
{

   /**
    * Dispatch post actions
    *
    * @param array $segments Method segments indicate action and resource
    *
    * @return void
    */
   public function restPost($segments)
   {

      $action_id = $segments[0];

      switch ($action_id) {

      case 'login':

         $validate_login_username
             = LMValidateHelper::validateNoEmpty($_POST['login_username']);
         $validate_login_password
             = LMValidateHelper::validateNoEmpty($_POST['login_password']);

         if (!$validate_login_username || !$validate_login_password) {

            $type = 'not_exist_value';
            $parameter = array("none"=>"none");
            $error_messanger = new IndievoxErrorMessenger($type, $parameter);
            $error_messanger->printErrorJSON();
            unset($error_messanger);

         } else {

            $login_username    = $_POST['login_username'];
            $login_password = $_POST['login_password'];;

            $user_god = new LMUserGod();
            $user_id = $user_god->checkUserPassword($login_username, $login_password);

            if (!empty($user_id)) {

               LMAuthHelper::login($user_id);

               $type = 'success';
               $parameter = array("none"=>"none");
               $error_messanger = new LMErrorMessenger($type, $parameter);
               $error_messanger->printErrorJSON();
               unset($error_messanger);

            } else {

               $type = 'login_fail';
               $parameter = array("none"=>"none");
               $error_messanger = new LMErrorMessenger($type, $parameter);
               $error_messanger->printErrorJSON();
               unset($error_messanger);

            }// end if (!empty($user_id))

         }// end if (!$validate_login_username|| $validate_login_password)

         break;

      case 'logout':

         LMAuthHelper::logout();

         $type = 'success';
         $parameter = array("none"=>"none");
         $error_messanger = new LMErrorMessenger($type, $parameter);
         $error_messanger->printErrorJSON();
         unset($error_messanger);

         break;

      default:

         $type = 'page_not_found';
         $parameter = array("none"=>"none");
         $error_messanger = new LMErrorMessenger($type, $parameter);
         $error_messanger->printErrorJSON();
         unset($error_messanger);

         break;// end default

      }// end switch ($action_id)

   }// end function restPost

   /**
    * Dispatch get actions
    *
    * @param array $segments Method segments indicate action and resource
    *
    * @return void
    */
   public function restGet($segments)
   {

      $action_id = $segments[0];

      switch ($action_id) {

      default:

         $type = 'page_not_found';
         $parameter = array("none"=>"none");
         $error_messanger = new LMErrorMessenger($type, $parameter);
         $error_messanger->printErrorJSON();
         unset($error_messanger);

         break;
      }

  }// end function restGet

   /**
    * Dispatch put actions
    *
    * @param array $segments Method segments indicate action and resource
    *
    * @return void
    */
   public function restPut($segments)
   {

      echo file_get_contents('php://input');

   }// end function restPut

   /**
    * Dispatch delete actions
    *
    * @param array $segments Method segments indicate action and resource
    *
    * @return void
    */
   public function restDelete($segments)
   {

      echo file_get_contents('php://input');

   }// end function restDelete

}// end class BoxAction
?>