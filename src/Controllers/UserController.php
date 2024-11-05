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
  public $postController;
  
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
  $this->postController = new PostController();

    
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
      $_SESSION['user_status'] = $response['user']['status'];
      $_SESSION['is_admin'] = false;
      header('Location: /');
      exit;
    }
    else{
    $_SESSION['auth_error'] = $response["error"];
    
      header('Location: /signup');
      exit;
    }
  }

  public function login() {
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];
    $response = $this->userModel->authenticate($username, $password);

    if (!$response['success']){
      $_SESSION['auth_error'] = $response["error"];
      header("Location: /login");
      exit;
    }
    session_regenerate_id(true);
    $_SESSION['username'] = $response['user']['username'];
    $_SESSION['user_id'] = $response['user']['id'];
    $_SESSION['user_status'] = $response['user']['status'];
    // $_SESSION['auth_error'] = $response["error"];

    if($_SESSION["username"] == "admin"){
      $_SESSION["is_admin"] = true;
       header('Location: /admin');
       exit;
    }
    else{
      $_SESSION["is_admin"] = false;
    }

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
        $user = $this->get_user_details($username);
        unset($data);
        $data["followers"] = $this->userModel->get_user_followers($user["username"]);
        $data["following"] = $this->userModel->get_user_following($user["username"]);
        $data["posts"] = $this->userModel->get_user_posts($user["username"]);
        include __DIR__ ."/../Views/profile.html";
      
      }
    }
    else{
      if($username == $_SESSION["username"]){
        $username = $_SESSION['username'];
        $user = $this->get_user_details($username);
        unset($data);
        $data["followers"] = $this->userModel->get_user_followers($user["username"]);
        $data["following"] = $this->userModel->get_user_following($user["username"]);
        $data["posts"] = $this->userModel->get_user_posts($user["username"]);
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


  public function deleteProfile() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /login');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $userId = $_SESSION['user_id'];
        $result = $this->userModel->deleteUser($userId);

        if ($result) {
            session_destroy();
            header('Location: /');
            exit;
        } else {
            $_SESSION['error'] = "Failed to delete profile. Please try again.";
            header('Location: /profile');
            exit;
        }
    } else {
        include __DIR__."/../Views/delete_profile.php";
    }
}

  protected function render_profile($user) {
    
    echo <<<BODY
    <body style="background: url('/images/sora-bg4.png')" >
    BODY;
    
    $data = [];
    $data["user"] = $user;

    $data["posts"] = $this->userModel->get_user_posts($user["username"]);
    $data["likes"] = $this->userModel->get_user_likes($user["username"]);
    $data["comments"] = $this->userModel->get_user_comments($user["username"]);
    $data["followers"] = $this->userModel->get_user_followers($user["username"]);
    $data["following"] = $this->userModel->get_user_following($user["username"]);
    

    require __DIR__ ."/../Views/user_profile.html";
}

public function render_user_tweets($data){
  $posts = $data["posts"];
  $user_id = $data["user"]["id"];
  $this->postController->render_tweets($user_id);
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
  


public function get_followed_users() {
  $user_id = $_SESSION['user_id'];
  $followed_users = $this->userModel->get_followed_users($user_id);
  echo json_encode($followed_users);
}

public function get_followers_users(){
  $user_id = $_SESSION['user_id'];
  $followers_users = $this->userModel->get_followers_users($user_id);
  $formatted_result = array_map(function($user){
    $isFollowing = $this->userModel->isFollowing($_SESSION["user_id"], $user["id"]);
    $user['isFollowing'] = $isFollowing;
    return $user;
  }, $followers_users);
  echo json_encode($formatted_result);
}

public function search_users() {
  $query = $_GET['query'] ?? '';
  $results = $this->userModel->search_users($query);
  
  $formatted_results = array_map(function($user) {

    $isFollowing = $this->userModel->isFollowing($_SESSION["user_id"], $user["id"]);
    $user["isFollowing"] = $isFollowing;
    return [
        'id' => $user['id'],
        'username' => $user['username'],
        'profile_picture' => $user['profile_picture'] ?? '/images/icons/user-avatar.png',
        'isFollowing'    => $user["isFollowing"] 
    ];
}, $results);

echo json_encode($formatted_results);
}


public function follow() {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $input = json_decode(file_get_contents('php://input'), true);
      $followerId = $_SESSION['user_id'];
      $followedId = $input['user_id'];
      
      if ($this->userModel->follow($followerId, $followedId)) {
          echo json_encode(['success' => true]);
          exit;
      }
  }
  echo json_encode(['success' => false]);
}

public function unfollow() {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $input = json_decode(file_get_contents('php://input'), true);
      $followerId = $_SESSION['user_id'];
      $followedId = $input['user_id'];
      
      if ($this->userModel->unfollow($followerId, $followedId)) {
          echo json_encode(['success' => true]);
          exit;
      }
  }
  echo json_encode(['success' => false]);
}
  

public function updateStatus() {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $input = json_decode(file_get_contents('php://input'), true);
      $userId = $_SESSION['user_id'];
      $status = $input['status'];
      
      // If status is empty, set it to NULL in the database
      $status = empty($status) ? null : $status;
      // $_SESSION['status'] = empty($status) ? "" : $status;
      
      if ($this->userModel->updateStatus($userId, $status)) {
        
          $_SESSION['user_status'] = $status;
          echo json_encode(['success' => true]);
          exit;
      }
  }
  echo json_encode(['success' => false]);
}

public function getUserStatus() {
  $userId = $_SESSION['user_id'];
  $status = $this->userModel->getUserStatus($userId);
  echo json_encode(['status' => $status]);
}

public function searchUsersForConversation() {
  \Sora\Helpers\Helper::validate_user();
  
  $searchTerm = $_GET['term'] ?? '';
  $users = $this->userModel->searchUsersForConversation($searchTerm);
  
  header('Content-Type: application/json');
  echo json_encode($users);
}
}



