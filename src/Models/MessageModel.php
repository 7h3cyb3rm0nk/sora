<?php
namespace Sora\Models;

class MessageModel {
    private \mysqli $db;

    public function __construct(\mysqli $db) {
        $this->db = $db;
    }

    public function sendMessage($sender_id, $receiver_id, $content) {
        
        $stmt = $this->db->prepare("INSERT INTO messages (sender_id, receiver_id, content) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $sender_id, $receiver_id, $content);
        return $stmt->execute();
    }

    public function getConversations($user_id) {
        $stmt = $this->db->prepare("
            SELECT 
                CASE 
                    WHEN m.sender_id = ? THEN m.receiver_id 
                    ELSE m.sender_id 
                END AS other_user_id,
                u.username,
                u.profile_picture,
                m.content AS last_message,
                m.created_at AS last_message_time,
                COUNT(CASE WHEN m.is_read = 0 AND m.receiver_id = ? THEN 1 END) AS unread_count
            FROM messages m
            JOIN users u ON (CASE WHEN m.sender_id = ? THEN m.receiver_id ELSE m.sender_id END) = u.id
            LEFT JOIN conversation_deletions cd ON (cd.user_id = ? AND cd.other_user_id = u.id)
            WHERE (m.sender_id = ? OR m.receiver_id = ?) AND (cd.deleted_at IS NULL OR m.created_at > cd.deleted_at)
            
            GROUP BY other_user_id
            ORDER BY last_message_time DESC
        ");
        $stmt->bind_param("iiiiii", $user_id, $user_id, $user_id, $user_id, $user_id, $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getMessages($user_id, $other_user_id) {
        $stmt = $this->db->prepare("
            SELECT m.*, u.username, u.profile_picture
            FROM messages m
            JOIN users u ON m.sender_id = u.id
            LEFT JOIN conversation_deletions cd ON (cd.user_id = ? AND cd.other_user_id = ?)
            WHERE ((m.sender_id = ? AND m.receiver_id = ?) OR (m.sender_id = ? AND m.receiver_id = ?))
                AND (cd.deleted_at IS NULL OR m.created_at > cd.deleted_at)
            ORDER BY m.created_at ASC
        ");
        $stmt->bind_param("iiiiii", $user_id, $other_user_id, $user_id, $other_user_id, $other_user_id, $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function markMessagesAsRead($user_id, $other_user_id) {
        $stmt = $this->db->prepare("UPDATE messages SET is_read = TRUE WHERE sender_id = ? AND receiver_id = ? AND is_read = FALSE");
        $stmt->bind_param("ii", $other_user_id, $user_id);
        return $stmt->execute();
    }

    public function deleteConversation($user_id, $other_user_id) {
        $stmt = $this->db->prepare("INSERT INTO conversation_deletions (user_id, other_user_id) VALUES (?, ?) ON DUPLICATE KEY UPDATE deleted_at = CURRENT_TIMESTAMP");
        $stmt->bind_param("ii", $user_id, $other_user_id);
        return $stmt->execute();
    }

    public function blockUser($blocker_id, $blocked_id) {
        $stmt = $this->db->prepare("INSERT IGNORE INTO blocks (blocker_id, blocked_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $blocker_id, $blocked_id);
        return $stmt->execute();
    }

    public function unblockUser($blocker_id, $blocked_id) {
        $stmt = $this->db->prepare("DELETE FROM blocks WHERE blocker_id = ? AND blocked_id = ?");
        $stmt->bind_param("ii", $blocker_id, $blocked_id);
        return $stmt->execute();
    }

    public function isBlocked($user_id, $other_user_id) {
        $stmt = $this->db->prepare("SELECT * FROM blocks WHERE (blocker_id = ? AND blocked_id = ?) ");
        $stmt->bind_param("ii", $user_id, $other_user_id);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function getUnreadMessageCount($user_id) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as unread_count
            FROM messages m
            LEFT JOIN conversation_deletions cd ON (cd.user_id = ? AND cd.other_user_id = m.sender_id)
            WHERE m.receiver_id = ? AND m.is_read = FALSE
            AND (cd.deleted_at IS NULL OR m.created_at > cd.deleted_at)
        ");
        $stmt->bind_param("ii", $user_id, $user_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['unread_count'];
    }
}