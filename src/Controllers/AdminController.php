<?php
namespace Sora\Controllers;
use Sora\Models\AdminModel;
use Sora\Models\UserModel;
use Sora\Config\Database;

class AdminController{
    private $adminModel;
    private $userModel;

    public function __construct(){
        $db = Database::get_connection();
        $this->adminModel = new AdminModel($db);
        $this->userModel = new UserModel($db);
    }

    public function admin(){
        if(!$_SESSION["is_admin"] == true){
            http_response_code(401);
            echo "Only admin can access this resource";
            return;

        }
        $this->generate_user_list();
    }


    private function generate_user_list(){
        
        $user_list = $this->userModel->generateUserList();
        include __DIR__."/../Views/admin_panel.php";
    }

    public function delete_user(){
        $input  = file_get_contents('php://input');
        $data = jsone_decode($input, true);
        if (isset($data["user_id"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
            if($this->userModel->deleteUser($data["user_id"])){
                echo json_encode([
                    'status' => 'Success',
                    'message' => 'User deleted successfully'
                ]);
                return;
            
            }
            else{
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Unable to delete user'
                ]);
                return;
            }

        }
        else{
            echo json_encode([
                'status' => 'error',
                'message' => 'invalid request'
            ]);
            return;
        }
    }
}
?>