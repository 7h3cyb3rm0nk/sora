<?php
namespace Sora\Controllers;

use Sora\Models\MessageModel;
use Sora\Config\Database;
use Sora\Helpers\Helper;

class MessageController {
    private $messageModel;

    public function __construct() {
        $db = Database::get_connection();
        $this->messageModel = new MessageModel($db);
    }

    public function listConversations() {
        Helper::validate_user();
        $user_id = $_SESSION['user_id'];
        $conversations = $this->messageModel->getConversations($user_id);
        require __DIR__."/../Views/conversations_list.php";
    }

    public function viewConversation($other_user_id) {
        Helper::validate_user();
        $user_id = $_SESSION['user_id'];
        
        if ($this->messageModel->isBlocked($user_id, $other_user_id)) {
            $_SESSION['error'] = "You cannot view this conversation.";
            header("Location: /messages");
            exit;
        }

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

            if ($this->messageModel->isBlocked($sender_id, $receiver_id)) {
                echo json_encode(['success' => false, 'message' => 'You cannot send messages to this user.']);
                return;
            }

            if ($this->messageModel->sendMessage($sender_id, $receiver_id, $content)) {
                echo json_encode(['success' => true]);
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
            $blocker_id = $_SESSION['user_id'];
            $blocked_id = $_POST['blocked_id'];

            if ($this->messageModel->unblockUser($blocker_id, $blocked_id)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to unblock user']);
            }
        }
    }

    public function getUnreadMessageCount() {
        if (isset($_SESSION['user_id'])) {
            return $this->messageModel->getUnreadMessageCount($_SESSION['user_id']);
        }
        return 0;
    }
    
}