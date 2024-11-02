<?php
namespace Sora\Models;

class SpaceModel {
    private \mysqli $db;

    public function __construct(\mysqli $db) {
        $this->db = $db;
    }

    public function createSpace($name, $admin_id) {
        $stmt = $this->db->prepare("INSERT INTO spaces (name, admin_id) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $admin_id);
        return $stmt->execute();
    }

    public function getSpace($space_id) {
        $stmt = $this->db->prepare("SELECT * FROM spaces WHERE id = ?");
        $stmt->bind_param("i", $space_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function searchSpaces($query) {
        $query = "%$query%";
        $stmt = $this->db->prepare("SELECT * FROM spaces WHERE name LIKE ? LIMIT 10");
        $stmt->bind_param("s", $query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function joinSpace($user_id, $space_id) {
        $stmt = $this->db->prepare("INSERT INTO space_members (user_id, space_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $space_id);
        return $stmt->execute();
    }

    public function leaveSpace($user_id, $space_id) {
        $stmt = $this->db->prepare("DELETE FROM space_members WHERE user_id = ? AND space_id = ?");
        $stmt->bind_param("ii", $user_id, $space_id);
        return $stmt->execute();
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
}