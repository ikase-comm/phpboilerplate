<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\UserModel;

class HomeController
{
    public function index(): void
    {
        $userData = null;
        if (isset($_SESSION['user_id'])) {
            $model = new UserModel();
            $userData = $model->getUser((int) $_SESSION['user_id']);
        }

        $pageTitle = "Dashboard";
        require __DIR__ . '/../View/home_template.php';
    }

    public function loginView(): void
    {
        // If already logged in, send them straight to dashboard
        if (isset($_SESSION['user_id'])) {
            header("Location: /");
            exit();
        }

        $pageTitle = "Account Login";
        $error = $_SESSION['login_error'] ?? null;
        unset($_SESSION['login_error']); // Clear flash error message

        require __DIR__ . '/../View/login_template.php';
    }

    public function loginSubmit(): void
    {
        // 1. Sanitize incoming text inputs
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';

        if (!$email || empty($password)) {
            $_SESSION['login_error'] = "Please fill in all fields correctly.";
            header("Location: /login");
            exit();
        }

        // 2. Query data layer and verify password
        $model = new UserModel();
        $user = $model->verifyLogin($email, $password);

        if ($user) {
            // 3. Login success: Rotate session ID to prevent session fixation attacks
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            header("Location: /");
            exit();
        }

        // 4. Login failed
        $_SESSION['login_error'] = "Invalid email or password.";
        header("Location: /login");
        exit();
    }

    public function logout(): void
    {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
        header("Location: /login");
        exit();
    }
}
