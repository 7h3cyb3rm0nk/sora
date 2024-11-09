<?php
namespace Sora\Helpers;

class Helper{
    public static function generate_token(): string {
        return bin2hex(random_bytes(32));
    }

    public static function validate_user(){
        if(!isset($_SESSION['user_id'])){
            header("Location: /login");
            exit;
        }
        if( isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == true) {
            header("Location: /admin");
            return;
        }
    }

    public static function time_ago($timestamp) {
        $current_time = time();
        $time_difference = $current_time - strtotime($timestamp);
        
        // Define time intervals in seconds
        $intervals = array(
            'year'   => 31536000,
            'month'  => 2592000,
            'week'   => 604800,
            'day'    => 86400,
            'hour'   => 3600,
            'minute' => 60,
            'second' => 1
        );
        
        // Handle future dates
        if ($time_difference < 0) {
            return "just now";
        }
        
        // Handle very recent times
        if ($time_difference < 10) {
            return "just now";
        }
        
        // Find the appropriate interval
        foreach ($intervals as $interval => $seconds) {
            $difference = floor($time_difference / $seconds);
            
            if ($difference >= 1) {
                // Handle plural vs singular
                $interval_text = $difference == 1 ? $interval : $interval . 's';
                return $difference . " " . $interval_text . " ago";
            }
        }
    }
}

?>

