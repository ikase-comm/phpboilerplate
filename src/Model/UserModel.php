<?php
declare(strict_types=1);

namespace App\Model;

use App\Core\DB;

class UserModel
{
    public function getUser(int $id): ?array
    {
        $db = DB::connect();
        $stmt = $db->prepare("SELECT id, email, name FROM users WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function verifyLogin(string $email, string $password): ?array
    {
        $db = DB::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        return null;
    }
}
