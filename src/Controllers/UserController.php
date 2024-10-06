<?php

namespace Sora\Controllers;
use Sora\Config\Database;
use Sora\Models\UserModel;
// require_once __DIR__ . "/../../vendor/autoload.php";
// session_start();

/** Controller class for User Model
 *
 */
class UserController {

  /**@var Sora\Models\User $userModel user model object
   */
  private $userModel;
  
  /**Constructor for User Controller
   */

  public function __construct() {
  /** @var mysqli $db object returned from Sora\Config\Database::get_connection()
   */
  try{
  $db = Database::getConnection();
  }
  catch(Exception $e){
    echo "error getting a database connection";
    exit;
  }

  $this->userModel = new UserModel($db);

    
  }

  public function logout() {
    $_SESSION = array();
    session_destroy();
    header('Location: /login');
    exit;
  }

  public function isLoggedin(): bool{
    return isset($_SESSION['user_id']);
  }


  public function register(): array {
    $response =  $this->userModel->register($_POST);
    if($response['success'] === true) {
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['user_id'] = $response['user']['id'];
      header('Location: index.php');
    }
    else{
      $errors = $response['error'];
      include 'views/register.php';
    }
  }

  public function login() {
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $response = $this->userModel->authenticate($username, $password);
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['user_id'] = $response['user']['id'];
    header('Location: /');
    }
    else{
      include __DIR__."/../Views/login.html";
    }
  
  }

  

}
