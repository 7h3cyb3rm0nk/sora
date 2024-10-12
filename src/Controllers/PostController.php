<?php
namespace Sora\Controllers;

use \Sora\Models\PostModel;
use \Sora\Config\Database;
use \Sora\Helpers\Helper;


class PostController {
    private $postModel;
    
    public function __construct(){
        $db = Database::get_connection();
        $this->postModel = new PostModel($db);

    }

    public function create(){
        Helper::validate_user();

        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            $user_id = $_SESSION['user_id'];
            $content = $_POST['content'];
            
            if($_SESSION['csrf_token'] !== $_POST['csrf_token']){
                unset($_SESSION['csrf_token']);
                http_response_code(400);
                exit;
            }
            else{
                unset($_SESSION['csrf_token']);
                if($this->postModel->create_post($user_id, $content)){
                   header("Location: /");
                   exit;
                } else{
                    $error[] = "Error creating post";
                }
            }
        }
        else{
            $errors[] = "invalid request method";
        }
    }

    public static function render_tweet($username, $content, $created_at, $upvotes=0, $comments=0, $dp=NULL){

        $html = <<<HTML
    <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transition duration-300">
        <div class="flex items-center mb-2">
            <img src="{$dp}" alt="User 1" class="w-10 h-10 rounded-full mr-3">
            <div>
                <a href="/" class="font-bold text-sora-secondary block">@{$username}</a>
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-clock mr-1"></i>
                    <span>{$created_at}</span>
                </div>
            </div>
        </div>
        <p class="mb-3">{$content}</p>
        <div class="flex items-center space-x-4 text-gray-500">
            <button class="flex items-center space-x-1 hover:text-blue-500 transition duration-300">
                <i class="fas fa-arrow-up"></i>
                <span>{$upvotes}</span>
            </button>
            <button class="flex items-center space-x-1 hover:text-green-500 transition duration-300">
                <i class="fas fa-comment"></i>
                <span>{$comments} comments</span>
            </button>
        </div>
    </div>
    HTML;
    return $html;

    }
}

?>