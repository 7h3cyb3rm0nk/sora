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
$router = new Router();
$app = new Application($router);

$app->router->get('/', [HomeController::class, 'home']);
$app->router->get('/login', [HomeController::class, 'login']);
$app->router->post('/login', [UserController::class, 'login']);
$app->router->get('/register', [HomeController::class, 'register']);
$app->router->post('/register', [UserController::class, 'register']);
$app->router->get('/logout', [UserController::class, 'logout']);
$app->router->get('/profile', [UserController::class, 'profile']);
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

$app->run();


 
?>

