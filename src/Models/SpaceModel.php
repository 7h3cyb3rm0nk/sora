<?php
namespace Sora\Models;

class SpaceModel {
    private \mysqli $db;

    public function __construct(\mysqli $db) {
        $this->db = $db;
    }

    public function createSpace($name, $admin_id) {
        $code = $this->generateUniqueCode();
        $stmt = $this->db->prepare("INSERT INTO spaces (name, admin_id, code) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $name, $admin_id, $code);
        if ($stmt->execute()) {
            $space_id = $stmt->insert_id;
            $this->joinSpace($admin_id, $space_id);
            return $space_id;
        }
        return false;
    }

    private function generateUniqueCode() {
        do {
            $code = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 8);
            $stmt = $this->db->prepare("SELECT id FROM spaces WHERE code = ?");
            $stmt->bind_param("s", $code);
            $stmt->execute();
            $result = $stmt->get_result();
        } while ($result->num_rows > 0);
        return $code;
    }

    public function getSpace($space_id) {
        $stmt = $this->db->prepare("SELECT * FROM spaces WHERE id = ?");
        $stmt->bind_param("i", $space_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function searchSpaceByCode($code) {
        $stmt = $this->db->prepare("SELECT * FROM spaces WHERE code = ?");
        $stmt->bind_param("s", $code);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getUserSpaces($user_id) {
        $stmt = $this->db->prepare("
            SELECT s.* 
            FROM spaces s
            JOIN space_members sm ON s.id = sm.space_id
            WHERE sm.user_id = ?
        ");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function joinSpace($user_id, $space_id) {
        $stmt = $this->db->prepare("INSERT IGNORE INTO space_members (user_id, space_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $space_id);
        return $stmt->execute();
    }

    public function leaveSpace($user_id, $space_id) {
        $stmt = $this->db->prepare("DELETE FROM space_members WHERE user_id = ? AND space_id = ?");
        $stmt->bind_param("ii", $user_id, $space_id);
        return $stmt->execute();
    }

    public function isSpaceMember($user_id, $space_id) {
        $stmt = $this->db->prepare("SELECT * FROM space_members WHERE user_id = ? AND space_id = ?");
        $stmt->bind_param("ii", $user_id, $space_id);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function isSpaceAdmin($user_id, $space_id) {
        $stmt = $this->db->prepare("SELECT * FROM spaces WHERE id = ? AND admin_id = ?");
        $stmt->bind_param("ii", $space_id, $user_id);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function createSpaceTweet($user_id, $space_id, $content) {
        $stmt = $this->db->prepare("INSERT INTO space_tweets (user_id, space_id, content) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $user_id, $space_id, $content);
        return $stmt->execute();
    }

    public function getSpaceTweets($space_id) {
        $stmt = $this->db->prepare("
            SELECT st.*, u.username, u.profile_picture
            FROM space_tweets st
            JOIN users u ON st.user_id = u.id
            WHERE st.space_id = ?
            ORDER BY st.created_at DESC
        ");
        $stmt->bind_param("i", $space_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteSpaceTweet($tweet_id, $user_id, $space_id) {
        $stmt = $this->db->prepare("DELETE FROM space_tweets WHERE id = ? AND (user_id = ? OR EXISTS (SELECT 1 FROM spaces WHERE id = ? AND admin_id = ?))");
        $stmt->bind_param("iiii", $tweet_id, $user_id, $space_id, $user_id);
        return $stmt->execute();
    }

    public function deleteSpace($space_id, $admin_id) {
        // First, delete all tweets in the space
        $stmt = $this->db->prepare("DELETE FROM space_tweets WHERE space_id = ?");
        $stmt->bind_param("i", $space_id);
        $stmt->execute();

        // Then, delete all space members
        $stmt = $this->db->prepare("DELETE FROM space_members WHERE space_id = ?");
        $stmt->bind_param("i", $space_id);
        $stmt->execute();

        // Finally, delete the space itself
        $stmt = $this->db->prepare("DELETE FROM spaces WHERE id = ? AND admin_id = ?");
        $stmt->bind_param("ii", $space_id, $admin_id);
        return $stmt->execute();
    }
}