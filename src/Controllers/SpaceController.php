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

    public function listSpaces() {
        Helper::validate_user();
        $user_id = $_SESSION['user_id'];
        $userSpaces = $this->spaceModel->getUserSpaces($user_id);
        require __DIR__."/../Views/spaces_list.html";
    }

    public function createSpace() {
        Helper::validate_user();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $name = $_POST['name'];
            $admin_id = $_SESSION['user_id'];

            $space_id = $this->spaceModel->createSpace($name, $admin_id);
            if ($space_id) {
                header("Location: /spaces/$space_id");
                exit;
            } else {
                $_SESSION['error'] = "Error creating space";
                header("Location: /spaces/create");
                exit;
            }
        }

        require __DIR__."/../Views/create_space.html";
    }

    public function viewSpace($space_id) {
        Helper::validate_user();
        $user_id = $_SESSION['user_id'];

        $space = $this->spaceModel->getSpace($space_id);
        if (!$space) {
            header("Location: /spaces");
            exit;
        }

        if (!$this->spaceModel->isSpaceMember($user_id, $space_id)) {
            $_SESSION['error'] = "You are not a member of this space";
            header("Location: /spaces");
            exit;
        }

        $tweets = $this->spaceModel->getSpaceTweets($space_id);
        $isAdmin = $this->spaceModel->isSpaceAdmin($user_id, $space_id);
        require __DIR__."/../Views/view_space.html";
    }

    public function joinSpace() {
        Helper::validate_user();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $space_code = $_POST['space_code'];
            $user_id = $_SESSION['user_id'];

            $space = $this->spaceModel->searchSpaceByCode($space_code);
            if ($space) {
                if ($this->spaceModel->joinSpace($user_id, $space['id'])) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to join space']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid space code']);
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

            if (!$this->spaceModel->isSpaceMember($user_id, $space_id)) {
                echo json_encode(['success' => false, 'message' => 'You are not a member of this space']);
                return;
            }

            if ($this->spaceModel->createSpaceTweet($user_id, $space_id, $content)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to create tweet']);
            }
        }
    }

    public function deleteSpaceTweet() {
        Helper::validate_user();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $tweet_id = $_POST['tweet_id'];
            $space_id = $_POST['space_id'];
            $user_id = $_SESSION['user_id'];

            if ($this->spaceModel->deleteSpaceTweet($tweet_id, $user_id, $space_id)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete tweet']);
            }
        }
    }

    public function deleteSpace() {
        Helper::validate_user();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $space_id = $_POST['space_id'];
            $user_id = $_SESSION['user_id'];

            if ($this->spaceModel->isSpaceAdmin($user_id, $space_id)) {
                if ($this->spaceModel->deleteSpace($space_id, $user_id)) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to delete space']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'You are not the admin of this space']);
            }
        }
    }
}