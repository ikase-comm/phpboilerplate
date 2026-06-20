@echo off
SETLOCAL EnableDelayedExpansion

:: Ensure the destination folder exists
if not exist "cnf" mkdir cnf

:: Set target path
set "CONFIG_FILE=cnf\config.php"

echo Initializing config file generation...

echo ^<?php > "%CONFIG_FILE%"
echo /** >> "%CONFIG_FILE%"
echo  * Application Configuration >> "%CONFIG_FILE%"
echo  * Location: /cnf/config.php (Outside WWW) >> "%CONFIG_FILE%"
echo  */ >> "%CONFIG_FILE%"
echo. >> "%CONFIG_FILE%"
echo declare(strict_types=1); >> "%CONFIG_FILE%"
echo. >> "%CONFIG_FILE%"
echo if (count(get_included_files()) === 1) { >> "%CONFIG_FILE%"
echo     http_response_code(403); >> "%CONFIG_FILE%"
echo     exit('Direct access denied.'); >> "%CONFIG_FILE%"
echo } >> "%CONFIG_FILE%"
echo. >> "%CONFIG_FILE%"
echo $cnf = [ >> "%CONFIG_FILE%"
echo     'db' =^> [ >> "%CONFIG_FILE%"
echo         'host' =^> '127.0.0.1', >> "%CONFIG_FILE%"
echo         'database' =^> 'my_app_db', >> "%CONFIG_FILE%"
echo         'username' =^> 'root', >> "%CONFIG_FILE%"
echo         'password' =^> '', >> "%CONFIG_FILE%"
echo         'charset' =^> 'utf8mb4', >> "%CONFIG_FILE%"
echo         'options' =^> [ >> "%CONFIG_FILE%"
echo             PDO::ATTR_ERRMODE =^> PDO::ERRMODE_EXCEPTION, >> "%CONFIG_FILE%"
echo             PDO::ATTR_DEFAULT_FETCH_MODE =^> PDO::FETCH_ASSOC, >> "%CONFIG_FILE%"
echo             PDO::ATTR_EMULATE_PREPARES =^> false, >> "%CONFIG_FILE%"
echo         ], >> "%CONFIG_FILE%"
echo     ], >> "%CONFIG_FILE%"
echo. >> "%CONFIG_FILE%"
echo     'app' =^> [ >> "%CONFIG_FILE%"
echo         'env' =^> 'development', >> "%CONFIG_FILE%"
echo         'timezone' =^> 'UTC', >> "%CONFIG_FILE%"
echo         'debug' =^> false, >> "%CONFIG_FILE%"
echo     ], >> "%CONFIG_FILE%"
echo. >> "%CONFIG_FILE%"
echo     'security' =^> [ >> "%CONFIG_FILE%"
echo         'app_key' =^> 'your-super-secret-32-char-random-key', >> "%CONFIG_FILE%"
echo     ], >> "%CONFIG_FILE%"
echo ]; >> "%CONFIG_FILE%"
echo. >> "%CONFIG_FILE%"
echo $cnf['app']['url'] = $cnf['app']['env'] == "production" ? "https://astronum.app" : "http://localhost"; >> "%CONFIG_FILE%"
echo. >> "%CONFIG_FILE%"
echo return $cnf; >> "%CONFIG_FILE%"

echo Done! Secure configuration created at /cnf/config.php
pause
