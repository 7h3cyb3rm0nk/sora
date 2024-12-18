<?php 
require __DIR__."/../vendor/autoload.php";
ini_set('session.cookie_httponly', 1); 
ini_set('session.cookie_secure', 1); 
ini_set('session.use_strict_mode', 1); // Prevents session fixation in some cases
ini_set('session.gc_maxlifetime', 1800);



session_start();
use Sora\Core\Application;
use Sora\Core\Router;
use Sora\Controllers\UserController;
use Sora\Controllers\HomeController;
use Sora\Controllers\PostController;
use Sora\Helpers\Helper;
use Sora\Controllers\SpaceController;
use Sora\Controllers\MessageController;
use Sora\Controllers\AdminController;
$messageController = new MessageController();
$unread_message_count = $messageController->getUnreadMessageCount();

$router = new Router();
$app = new Application($router);

$app->router->get('/', [HomeController::class, 'home']);
$app->router->get('/login', [HomeController::class, 'login']);
$app->router->post('/login', [UserController::class, 'login']);
$app->router->get('/signup', [HomeController::class, 'register']);
$app->router->post('/signup', [UserController::class, 'register']);
$app->router->get('/logout', [UserController::class, 'logout']);
$app->router->get('/profile', [UserController::class, 'profile']);
$app->router->get('/delete_profile', [UserController::class, 'deleteProfile']);
$app->router->get('/profile/:any', [UserController::class, 'profile']);
$app->router->get('/get_followed_users', [UserController::class, 'get_followed_users']);
$app->router->get('/get_followers_users', [UserController::class, 'get_followers_users']);
$app->router->get('/search_users', [UserController::class, 'search_users']);
$app->router->get('/get_user_status', [UserController::class, 'getUserStatus']);



$app->router->post('/create', [PostController::class, 'create']);
$app->router->post('/edit_profile', [UserController::class, 'edit_user_details']);
$app->router->post('/add_likes', [PostController::class, 'add_likes']);
$app->router->post('/remove_likes', [PostController::class, 'remove_likes']);
$app->router->post('/add_comment', [PostController::class, 'add_comment']);
$app->router->post('/delete_post', [PostController::class, 'delete_post']);
$app->router->post('/delete_comment', [PostController::class, 'delete_comment']);
$app->router->post('/follow', [UserController::class, 'follow']);
$app->router->post('/unfollow', [UserController::class, 'unfollow']);
$app->router->post('/update_status', [UserController::class, 'updateStatus']);
$app->router->post('/delete_profile', [UserController::class, 'deleteProfile']);


$app->router->get('/spaces', [SpaceController::class, 'listSpaces']);
$app->router->get('/spaces/create', [SpaceController::class, 'createSpace']);
$app->router->post('/spaces/create', [SpaceController::class, 'createSpace']);
$app->router->get('/spaces/:num', [SpaceController::class, 'viewSpace']);
$app->router->post('/spaces/join', [SpaceController::class, 'joinSpace']);
$app->router->post('/spaces/leave', [SpaceController::class, 'leaveSpace']);
$app->router->post('/spaces/tweet', [SpaceController::class, 'createSpaceTweet']);
$app->router->post('/spaces/tweet/delete', [SpaceController::class, 'deleteSpaceTweet']);
$app->router->post('/spaces/delete', [SpaceController::class, 'deleteSpace']);



$app->router->get('/messages', [MessageController::class, 'listConversations']);
$app->router->get('/messages/:num', [MessageController::class, 'viewConversation']);
$app->router->post('/messages/send', [MessageController::class, 'sendMessage']);
$app->router->post('/messages/delete', [MessageController::class, 'deleteConversation']);
$app->router->post('/messages/block', [MessageController::class, 'blockUser']);
$app->router->post('/messages/unblock', [MessageController::class, 'unblockUser']);
$app->router->get('/users/search', [UserController::class, 'searchUsersForConversation']);

$app->router->get('/admin', [AdminController::class, 'admin']);

$app->router->post('/admin/delete_user', [AdminController::class, 'delete_user']);

$app->run();


 
?>

