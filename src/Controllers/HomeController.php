<?php 
namespace Sora\Controllers;
use \Sora\Helpers\Helper;

class HomeController{
  

  
  public function home(){

    if($_SESSION["username"] == "admin") {
      header("Location: /admin");
      return;
    }

    Helper::validate_user();
    
    require "../src/Views/home.html";
    
    
  }

  public function login(){

    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $this->home();
      
    }
    else{
      require_once __DIR__."/../Views/login.html";
    }
  }

  public function register() {
    if($_SERVER['REQUEST_METHOD'] == "POST"){

    }
    else{
      print_r($_SESSION["error"]);
      require_once __DIR__."/../Views/signup.html";
    }
  }
}
