<?php
use Sora\Controllers\MessageController;

$messageController = new MessageController();
$unread_message_count = $messageController->getUnreadMessageCount();
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once __DIR__."/html_head.html" ?>
<body class="bg-gray-100">
<?php include_once __DIR__ ."/navbar.html"?>

<main class="container mx-auto px-4 py-8">
    <?php echo $content; ?>
    
</main>

</body>
</html>