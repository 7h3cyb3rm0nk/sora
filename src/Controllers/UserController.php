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

  protected function render_profile($data) {
    require __DIR__ . "/../Views/html_head.html";
    require __DIR__ . "/../Views/navbar.html";
    echo <<<BODY
    <body style="background: url('/images/sora-bg.png')" >
    BODY;
    
    $html = <<<HTML
    
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Profile Header -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <div class="flex items-start justify-between mb-6">
                    <div class="flex items-center space-x-6">
                        <div class="w-24 h-24 rounded-full bg-gray-200 overflow-hidden">
                            <img src="/default-avatar.png" 
                                 alt="{$data["username"]}'s avatar"
                                 class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{$data["username"]}</h1>
                            <!-- <p class="text-gray-500">Student at University</p>
                            <p class="text-gray-600 mt-1">
                                <i class="fas fa-map-marker-alt"></i> Kerala, India
                            </p> -->
                        </div>
                    </div>
                    <div class="space-x-3">
                        <button class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Follow
                        </button>
                    </div>
                </div>
                
                <p class="text-gray-700 mb-6">
                    {$data["bio"]}
                </p>
                
                <div class="flex space-x-8">
                    <div class="text-center">
                        <div class="text-xl font-bold text-gray-900">42</div>
                        <div class="text-gray-500">Posts</div>
                    </div>
                    <div class="text-center">
                        <div class="text-xl font-bold text-gray-900">1.2k</div>
                        <div class="text-gray-500">Followers</div>
                    </div>
                    <div class="text-center">
                        <div class="text-xl font-bold text-gray-900">890</div>
                        <div class="text-gray-500">Following</div>
                    </div>
                </div>
            </div>
            
            <!-- Tab Navigation -->
            <div class="border-b border-gray-200 bg-gray-100 pt-3 px-4 rounded-md mb-6 hover:shadow-md">
                <nav class="-mb-px flex space-x-8">
                    <a href="#" class="border-b-2 border-blue-500 pb-4 px-1 text-sm font-medium text-blue-600">
                        Posts
                    </a>
                    <a href="#" class="border-b-2 border-transparent pb-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        Media
                    </a>
                    <a href="#" class="border-b-2 border-transparent pb-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        Likes
                    </a>
                </nav>
            </div>
            
            <!-- Posts Grid -->
            <div class="grid grid-cols-1 gap-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-gray-800">Just deployed my first web application! Check it out at example.com #webdev #coding</p>
                    <div class="mt-4 text-gray-500 text-sm">
                        2 hours ago
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-gray-800">Learning new frameworks and loving it! The developer community is amazing. 🚀 #learning #development</p>
                    <div class="mt-4 text-gray-500 text-sm">
                        1 day ago
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-gray-800">Contributing to open source is a great way to learn and give back to the community.</p>
                    <div class="mt-4 text-gray-500 text-sm">
                        3 days ago
                    </div>
                </div>
            </div>
        </div>
    </main>
HTML;

    echo $html;
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
