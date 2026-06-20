<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <style>
        body {
            font-family: sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .dashboard-card {
            background: #fff;
            padding: 2.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h1 {
            color: #333;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
        }

        p {
            color: #666;
            font-size: 1.1rem;
            line-height: 1.5;
            margin-bottom: 2rem;
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 0.8rem;
            border-radius: 4px;
            font-weight: bold;
            text-decoration: none;
            box-sizing: border-box;
            transition: background 0.2s;
        }

        .btn-login {
            background: #007bff;
            color: white;
        }

        .btn-login:hover {
            background: #0056b3;
        }

        .btn-logout {
            background: #dc3545;
            color: white;
        }

        .btn-logout:hover {
            background: #bd2130;
        }
    </style>
</head>

<body>

    <div class="dashboard-card">
        <h1>Welcome to the App</h1>

        <?php if ($userData): ?>
            <p>Hello, <strong><?= htmlspecialchars($userData['name']) ?></strong>!</p>
            <a href="/logout" class="btn btn-logout">Log Out</a>
        <?php else: ?>
            <p>You are not logged in. Access your dashboard features below.</p>
            <a href="/login" class="btn btn-login">Please log in to continue</a>
        <?php endif; ?>
    </div>

</body>

</html>