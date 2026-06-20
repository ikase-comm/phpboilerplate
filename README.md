# Compact Modern PHP Application

A secure, high-performance, and lightweight MVC boilerplate utilizing a single-entry point architecture. Sensitive configuration resources are explicitly decoupled from the public web server scope.

---

## 📂 Project Architecture

```text
├── cnf/                  # SECURE: Application credentials (git-ignored)
│   └── config.php
├── src/                  # Core Business Application Scope
│   ├── Controller/       # HTTP Gateways (e.g., HomeController)
│   ├── Core/             # Base configurations & Database singletons
│   ├── Model/            # Data layer queries
│   └── View/             # Presentation templates
├── public/               # PUBLIC: Web server root directory mapping
│   ├── .htaccess         # Production-ready URL rewrite engine
│   └── index.php         # Single Front Controller entry-point
├── .gitignore            # Git tracking rules
├── composer.json         # Package definitions & PSR-4 maps
└── generate_config.bat   # Windows automated configuration initializer
```

---

## 🚀 Fast Installation Setup

### 1. Clone & Provision Dependencies

Open your project terminal root and execute Composer to build out the autoloader mapping rules:

```bash
composer require vlucas/phpdotenv slim/psr7
composer dump-autoload
```

### 2. Generate Local Configuration File

Run the configuration script generator on your local machine:

```bash
# Double click the batch asset or execute via Command Prompt:
generate_config.bat
```

_Note: This automatically creates `/cnf/config.php` securely outside of your web tracking root directory._

### 3. Initialize Local Database Layout

1. Spin up your **Laragon** MySQL service stack.
2. Connect to your database engine and establish a dynamic base index named `my_app_db`.
3. Load and run the internal database execution table script:

```sql
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password_hash` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Initial Demo User Setup (Password: SecretPassword123)
INSERT INTO `users` (`name`, `email`, `password_hash`)
VALUES ('Admin User', 'admin@example.com', '\$2y\$10\$89M0v.N6x7pP32C1jD4lEOH97rJtY76Xg05/1h2k3l4m5n6o7p8q.');
```

---

## ⚙️ Web Server Configuration

### Laragon / Apache Local Mapping

For the custom dynamic URLs (like `/login`) to track properly into the router script instance, guarantee your local environment allows override mechanics:

1. Open Apache configuration (`httpd.conf`) inside Laragon.
2. Locate your project web root folder block declaration (`<Directory "C:/laragon/www/">`).
3. Explicitly verify the rule parameters match this authorization flag layout:

```apache
<Directory "C:/laragon/www/">
    Options Indexes FollowSymLinks MultiViews
    AllowOverride All
    Require all granted
</Directory>
```

4. Restart your web server services.

---

## 🔒 Security Best Practices

- **Decoupled Configuration**: Keep the `/cnf/` folder directory separate and away from paths managed or routed dynamically via server public links.
- **Version Masking**: Never strip down or disable properties flagged within `.gitignore`.
