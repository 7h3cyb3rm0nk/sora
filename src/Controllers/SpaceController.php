<?php
namespace Sora\Controllers;

use Sora\Models\SpaceModel;
use Sora\Config\Database;
use Sora\Helpers\Helper;

class SpaceController {
    private $spaceModel;

    public function __construct() {
        $db = Database::get_connection();
        $this->spaceModel = new SpaceModel($db);
    }

    public function createSpace() {
        Helper::validate_user();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $name = $_POST['name'];
            $admin_id = $_SESSION['user_id'];

            if ($this->spaceModel->createSpace($name, $admin_id)) {
                header("Location: /spaces");
                exit;
            } else {
                $_SESSION['error'] = "Error creating space";
                header("Location: /spaces/create");
                exit;
            }
        }

        require "../src/Views/create_space.html";
    }

    public function viewSpace($space_id) {
        Helper::validate_user();

        $space = $this->spaceModel->getSpace($space_id);
        if (!$space) {
            header("Location: /spaces");
            exit;
        }

        $tweets = $this->spaceModel->getSpaceTweets($space_id);
        require "../src/Views/view_space.html";
    }

    public function searchSpaces() {
        Helper::validate_user();

        $query = $_GET['query'] ?? '';
        $spaces = $this->spaceModel->searchSpaces($query);
        echo json_encode($spaces);
    }

    public function joinSpace() {
        Helper::validate_user();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $space_id = $_POST['space_id'];
            $user_id = $_SESSION['user_id'];

            if ($this->spaceModel->joinSpace($user_id, $space_id)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to join space']);
            }
        }
    }

    public function leaveSpace() {
        Helper::validate_user();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $space_id = $_POST['space_id'];
            $user_id = $_SESSION['user_id'];

            if ($this->spaceModel->leaveSpace($user_id, $space_id)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to leave space']);
            }
        }
    }

    public function createSpaceTweet() {
        Helper::validate_user();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $space_id = $_POST['space_id'];
            $content = $_POST['content'];
            $user_id = $_SESSION['user_id'];

            if ($this->spaceModel->createSpaceTweet($user_id, $space_id, $content)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to create tweet']);
            }
        }
    }
}