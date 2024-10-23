<?php
namespace Sora\Models;

class PostModel{
    private \mysqli $db;
    public function __construct(\mysqli $db){
        $this->db = $db;

    }

    public function create_post($user_id, $content): bool{

        
        $stmt =  $this->db->prepare("INSERT INTO posts (user_id, content) VALUES (?, ?)");

        $stmt->bind_param("is", $user_id, $content);
        return $stmt->execute();

    }

    public function view_posts(): array{
        $stmt = $this->db->prepare("Select * from posts");
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $data = $result->fetch_all(MYSQLI_ASSOC);
            return $data;

        }
        else {
            return [
                'error' => 'NO_RESULT'  
            ];
        }
    }

    public function get_tweets($user_id) {
        $stmt = $this->db->prepare("SELECT 
                p.id, 
                p.content, 
                p.created_at,
                u.username, 
                u.profile_picture,
                COUNT(l.post_id) AS upvotes
            FROM 
                posts p
            JOIN 
                users u ON p.user_id = u.id 
            LEFT JOIN 
                likes l ON p.id = l.post_id
            LEFT JOIN
                follows f ON p.user_id = f.followed_id AND f.follower_id = ? 
            WHERE 
                p.user_id = ? OR f.follower_id = ?
            GROUP BY
                p.id
            ORDER BY 
                p.created_at DESC;");
    
        $stmt->bind_param("iii", $user_id, $user_id, $user_id); // Bind parameters
    
        $stmt->execute();
    
        $result = $stmt->get_result();
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function add_likes($post_id){
        
        $user_id = $_SESSION['user_id'];
       

            $stmt = $this->db->prepare("insert ignore into likes(user_id, post_id) values(?,?)");
            $stmt->bind_param("ss",$user_id, $post_id );
            $result = $stmt->execute();
            return $result;

    }

    public function remove_likes($post_id) {
        $user_id = $_SESSION['user_id'];

        $stmt = $this->db->prepare("delete from likes where user_id=? and post_id=?");
        $stmt->bind_param("ss", $user_id, $post_id);
        $result = $stmt->execute();
        return $result;
    }
    

    
}