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

    public function delete_post() {
        Helper::validate_user();
    
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
    
        if (isset($data['post_id'])) {
            $post_id = $data['post_id'];
            $user_id = $_SESSION['user_id'];
    
            if ($this->postModel->delete_post($post_id, $user_id)) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Post deleted successfully'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to delete post'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'post_id not found in request'
            ]);
        }
    }

    public  function render_tweet($tweet){
        $is_liked = $this->postModel->check_user_likes($tweet["id"]);
        $like_class = $is_liked == 1 ? "liked" : "";
        $id = $tweet["id"];
        $username = $tweet["username"];
        $content = $tweet['content'];
        $created_at = Helper::time_ago($tweet['created_at']);
        $upvotes = $tweet['upvotes'] ?? 0;
        $comments = $tweet['comment_count'] ?? 0;
        $dp_available = $tweet['profile_picture'] ?? false;
        $comments_html = self::render_comments($id);
        if($dp_available){
            $pfp_avatar = <<<HTML
             <img src="{$tweet['profile_picture']}" alt="" class="w-10 h-10 rounded-full mr-3">
            HTML;
        }

        else{
            $pfp_avatar = <<<HTML
            <img src="images/icons/user-avatar.png" alt="" class="w-10 h-10 rounded-full mr-3">
            HTML;
        }
        $delete_button = '';
    if ($tweet['user_id'] == $_SESSION['user_id']) {
        $delete_button = <<<HTML
        <button class="delete-tweet flex items-center space-x-1 hover:text-red-500 transition duration-300" data-post-id="$id">
            <i class="fas fa-trash"></i>
            <span>Delete</span>
        </button>
        HTML;
    }
        $html = <<<HTML
    <div class="bg-gray-300 p-4 rounded-lg shadow opacity-95 shadow-sm hover:shadow-md transition duration-300">
        <div class="flex items-center mb-2">
            $pfp_avatar
            <div>
                <a href="/profile/{$username}" class="font-bold text-slate-900 block">@{$username}</a>
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-clock mr-1"></i>
                    <span>{$created_at}</span>
                </div>
            </div>
        </div>
        <p class="mb-3 text-slate-900">{$content}</p>
        <div class="flex items-center space-x-4 text-gray-500">
            
            <button class="upvotes flex items-center space-x-1 hover:text-blue-500 transition duration-300 $like_class " data-post-id="$id" data-liked-id="$is_liked">
                <i class="fas fa-arrow-up"></i>
                <span id="upvotes">{$upvotes}</span>
            </button>
            <button class="flex items-center space-x-1 hover:text-green-500 transition duration-300 comment-toggle" data-post-id="$id">
            
                <i class="fas fa-comment"></i>
                <span>{$comments} comments</span>
            </button>
            $delete_button
        </div>
        <div class="comments-section mt-4 hidden" id="comments-section-{$id}">
                <h4 class="text-lg font-semibold mb-2">Comments</h4>
                <div class="space-y-2 mb-4" id="comments-{$id}">
                    {$comments_html}
                </div>
                <form action="/add_comment" method="post" class="flex" data-username="{$_SESSION['username']}">
                    <input type="hidden" name="post_id" value="{$id}">
                    <input type="text" name="content" class="flex-grow p-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Add a comment...">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 transition-colors duration-200">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>

            
        
    </div>
    HTML;
    return $html;

    }

    public function render_tweets($user_id=NULL, $self=false){
        if($user_id == NULL){

         $data = $this->postModel->get_tweets($_SESSION['user_id'], $self);
        }
        else{
            $data = $this->postModel->get_tweets($user_id, $self);
           
        }
        

        foreach($data as $tweet){
            $html = $this->render_tweet($tweet);
            echo $html;
        }
    
    }
    
    private static function render_comments($post_id) {
        $db = Database::get_connection();
        $postModel = new PostModel($db);
        $comments = $postModel->get_comments($post_id);

        $comments_html = '';
        foreach ($comments as $comment) {
            $comment_time = Helper::time_ago($comment['created_at']);
            $comments_html .= <<<HTML
            <div class="bg-gray-100 p-3 rounded-md">
                <p class="font-semibold text-sm">{$comment['username']}</p>
                <p class="text-gray-700">{$comment['content']}</p>
                <p class="text-xs text-gray-500 mt-1">{$comment_time}</p>
            </div>
            HTML;
        }

        return $comments_html;
    }
    


    public function add_likes()
{
    // Fetch the raw POST body and decode the JSON
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Check if post_id exists in the decoded JSON
    if (isset($data['post_id'])) {
        $postId = $data['post_id'];

        // Assuming you have a method to increment the like count in your model
        $result = $this->postModel->add_likes($postId);

        if ($result) {
            // Return a success response
            echo json_encode([
                'status' => 'success',
                'message' => 'Like added successfully',
                'post_id' => $postId
            ]);
        } else {
            // Handle database failure
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to add like. Please try again later.',
                'post_id' => $postId
            ]);
        }
    } else {
        // Return an error response if post_id is not found
        echo json_encode([
            'status' => 'error',
            'message' => 'post_id not found in request'
        ]);
    }
}

public function remove_likes(){
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Check if post_id exists in the decoded JSON
    if (isset($data['post_id'])) {
        $postId = $data['post_id'];

        // Assuming you have a method to increment the like count in your model
        $result = $this->postModel->remove_likes($postId);

        if ($result) {
            // Return a success response
            echo json_encode([
                'status' => 'success',
                'message' => 'Like removed successfully',
                'post_id' => $postId
            ]);
        } else {
            // Handle database failure
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to remove like. Please try again later.',
                'post_id' => $postId
            ]);
        }
    } else {
        // Return an error response if post_id is not found
        echo json_encode([
            'status' => 'error',
            'message' => 'post_id not found in request'
        ]);
    }
}


public function add_comment() {
    Helper::validate_user();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $user_id = $_SESSION['user_id'];
        $post_id = $_POST['post_id'];
        $content = $_POST['content'];

        if ($this->postModel->add_comment($user_id, $post_id, $content)) {
            // Comment added successfully
            // header("Location: /?post_id=" . $post_id);
            exit;
        } else {
            $error[] = "Error adding comment";
            http_response_code(500);
        }
    }
}

public function get_comments($post_id) {
    return $this->postModel->get_comments($post_id);
}

   
}

?>