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
  $db = Database::get_connection();
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

  public function is_logged_in(): bool{
    return isset($_SESSION['user_id']);
  }


  public function register(): array {
    $response =  $this->userModel->register($_POST);
    if($response['success'] === true) {
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['user_id'] = $response['user']['id'];
      header('Location: /');
      exit;
    }
    else{
      $_SESSION['error'] = $response['error'];
    
      header('Location: /register');
      exit;
    }
  }

  public function login() {
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];
    $response = $this->userModel->authenticate($username, $password);

    if (!$response['success']){
      $_SESSION['login_error'] = ["Username/Password incorrect"];
      header("Location: /login");
      exit;
    }
    session_regenerate_id(true);
    $_SESSION['username'] = $response['user']['username'];
    $_SESSION['user_id'] = $response['user']['id'];
    
    header('Location: /');
    exit;
    }
    else{
      include __DIR__."/../Views/login.html";
    }
  
  }

  public function profile($username=NULL) {
    if($username == NULL){

    
      if($_SERVER['REQUEST_METHOD'] == "GET"){
        $username = $_SESSION['username'];
        include __DIR__ ."/../Views/profile.html";
      
      }
    }
    else{
      if($username == $_SESSION["username"]){
        header("Location: /profile");
        exit;
      }
      $user = $this->get_user_details($username);
      if (empty($user)){
        http_response_code(404);
        echo "404 Not Found\n";
        exit;
      }
      $this->render_profile($user);
    }
  } 

  protected function render_profile($user) {
    
    echo <<<BODY
    <body style="background: url('/images/sora-bg.png')" >
    BODY;
    
    $data = [];

    $data["posts"] = $this->userModel->get_user_posts($user["username"]);
    $data["likes"] = $this->userModel->get_user_likes($user["username"]);
    $data["comments"] = $this->userModel->get_user_comments($user["username"]);
    $data["followers"] = $this->userModel->get_user_followers($user["username"]);
    $data["following"] = $this->userModel->get_user_following($user["username"]);
    

    require __DIR__ ."/../Views/user_profile.html";
}

public function render_user_tweets($data){
  $posts = $data["posts"];
  foreach( $posts as $post) {
    echo <<<HTML
    <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-800">{$post["content"]}</p>
                <div class="mt-4 text-gray-500 text-sm">
                    2 hours ago
                </div>
            </div>
    HTML;
  }
}

  public function get_user_details($username) {
    $user = $this->userModel->get_user_details($username);
    return $user;


  }
  



  public function edit_user_details(){
    if($_SERVER['REQUEST_METHOD'] == "POST"){


      $username = $_SESSION['username'];
      $password = $_POST['old_password'];
      $response = $this->userModel->authenticate($username, $password);
      if($response['success'] != true){
        $_SESSION['update_error'] = "Invalid Credentials";
        header("Location: /profile");
        exit;

      }
      else{
        $data = [
        "username" => $_POST['username'],
        "password" => password_hash($_POST['new_password'], PASSWORD_DEFAULT),
        "firstname" => $_POST['firstname'] ?? "",
        "lastname" => $_POST['lastname'] ?? "",
        "bio" =>     $_POST['bio'],
        // "profile_picture" => $_FILES['profile_picture'] ?? "",
        ];

        if($_POST['new_password'] == ""){
          unset($data["password"]);
        }
        
        
      }
      if ($this->userModel->update_user_details($username, $data)) {
        // Success message (optional)
        $_SESSION['update_success'] = "Profile updated successfully!"; 
        $_SESSION['username'] = $data["username"];
      } else {
        // Handle the case where no changes were made (optional)
        $_SESSION['update_info'] = "No changes were made to your profile."; 
      }
      header("Location: /profile");
    }
  
    else{
      header("Location: /profile");
    }
  }
  

  


}
