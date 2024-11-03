<?php
namespace Sora\Controllers;

use Sora\Models\MessageModel;
use Sora\Config\Database;
use Sora\Helpers\Helper;
use Sora\Models\UserModel;

class MessageController {
    private $messageModel;
    private $userModel;

    public function __construct() {
        $db = Database::get_connection();
        $this->messageModel = new MessageModel($db);
        $this->userModel = new UserModel($db);
    }

    public function listConversations() {
        Helper::validate_user();
        $user_id = $_SESSION['user_id'];
        $conversations = $this->messageModel->getConversations($user_id);

        // Fetch user details for conversations with no messages
        foreach ($conversations as &$conversation) {
            if (empty($conversation['username'])) {
                $user = $this->userModel->getUserById($conversation['other_user_id']);
                $conversation['username'] = $user['username'];
                $conversation['profile_picture'] = $user['profile_picture'];
            }
        }

        require __DIR__."/../Views/conversations_list.php";
    }

    public function viewConversation($other_user_id) {
        Helper::validate_user();
        $user_id = $_SESSION['user_id'];
        $is_blocked=false;
        
        if ($this->messageModel->isBlocked( $user_id, $other_user_id)) {
            $is_blocked = true;
            
        }
        $other_username  = $this->userModel->getUserById($other_user_id)["username"];

        $messages = $this->messageModel->getMessages($user_id, $other_user_id);
        $this->messageModel->markMessagesAsRead($user_id, $other_user_id);
        require __DIR__."/../Views/conversation.php";
    }

    public function sendMessage() {
        Helper::validate_user();
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $sender_id = $_SESSION['user_id'];
            $receiver_id = $_POST['receiver_id'];
            $content = $_POST['content'];

            if($sender_id == $receiver_id) {
                echo json_encode(['success' => false, 'message' => 'You cannot send messages to yourself.']);
                http_response_code(400);
                exit;
            }

            if($this->messageModel->isBlocked($receiver_id, $sender_id)){
                echo json_encode(['success' => false, 'message' => 'You cannot send messages to this user.']);
                return;
            }

            if ($this->messageModel->isBlocked($sender_id, $receiver_id)) {
                echo json_encode(['success' => false, 'message' => 'You cannot send messages to this user.']);
                return;
            }

            if ($this->messageModel->sendMessage($sender_id, $receiver_id, $content)) {
                $receiver = $this->userModel->getUserById($receiver_id);
                echo json_encode([
                    'success' => true,
                    'message' => 'Message sent successfully',
                    'receiver' => [
                        'id' => $receiver['id'],
                        'username' => $receiver['username'],
                        'profile_picture' => $receiver['profile_picture']
                    ]
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to send message']);
            }
        }
    }

    public function deleteConversation() {
        Helper::validate_user();
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user_id = $_SESSION['user_id'];
            $other_user_id = $_POST['other_user_id'];

            if ($this->messageModel->deleteConversation($user_id, $other_user_id)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete conversation']);
            }
        }
    }

    public function blockUser() {
        Helper::validate_user();
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $blocker_id = $_SESSION['user_id'];
            $blocked_id = $_POST['blocked_id'];

            if ($this->messageModel->blockUser($blocker_id, $blocked_id)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to block user']);
            }
        }
    }

    public function unblockUser() {
        Helper::validate_user();
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = json_decode(file_get_contents("php://input"), true);
            $user_id = $_SESSION['user_id'];
            $blocked_user_id = $data['user_id'];

            if ($this->messageModel->unblockUser($user_id, $blocked_user_id)) {
                echo json_encode(['success' => true, 'message' => 'User unblocked successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to unblock user']);
            }
        }
    }

    public function isBlocked($user_id, $other_user_id) {
        return $this->messageModel->isBlocked($user_id, $other_user_id);
    }

    public function getUnreadMessageCount() {
        if (isset($_SESSION['user_id'])) {
            return $this->messageModel->getUnreadMessageCount($_SESSION['user_id']);
        }
        return 0;
    }
    
}