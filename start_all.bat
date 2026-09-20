@echo off
title GameKart - Launching All Services & Portals
color 0A

echo ====================================================================
echo                 GAMEKART - E-COMMERCE PLATFORM
echo          Starting Services, Client, Admin & Database
echo ====================================================================
echo.

:: 1. Define Paths & URLs
set "XAMPP_DIR=C:\xamppneww"
set "CLIENT_URL=http://localhost/php/clogin.php"
set "ADMIN_URL=http://localhost/php/aLogin.php"
set "DB_URL=http://localhost/phpmyadmin/index.php?route=/database/structure&db=kmart"
set "PORTAL_URL=http://localhost/php/index.php"

:: 2. Check and Start Apache Web Server
echo [1/4] Checking Apache Web Server...
tasklist /FI "IMAGENAME eq httpd.exe" 2>NUL | find /I /N "httpd.exe">NUL
if "%ERRORLEVEL%"=="0" (
    echo       * Apache Web Server is already running.
) else (
    echo       * Starting Apache Web Server...
    if exist "%XAMPP_DIR%\apache\bin\httpd.exe" (
        start "" /B "%XAMPP_DIR%\apache\bin\httpd.exe"
    ) else (
        start "" /B httpd
    )
)

:: 3. Check and Start MySQL Database Server
echo [2/4] Checking MySQL Database Server...
tasklist /FI "IMAGENAME eq mysqld.exe" 2>NUL | find /I /N "mysqld.exe">NUL
if "%ERRORLEVEL%"=="0" (
    echo       * MySQL Database Server is already running.
) else (
    echo       * Starting MySQL Database Server...
    if exist "%XAMPP_DIR%\mysql\bin\mysqld.exe" (
        start "" /B "%XAMPP_DIR%\mysql\bin\mysqld.exe" --defaults-file="%XAMPP_DIR%\mysql\bin\my.ini" --standalone
    ) else (
        start "" /B mysqld
    )
)

:: 4. Short pause to allow services to initialize
echo.
echo [3/4] Initializing Database and Backend Services...
ping 127.0.0.1 -n 3 >nul

:: 5. Launch Google Chrome with Client Side, Admin Side & phpMyAdmin Database
echo [4/4] Opening Client Side, Admin Side, and Database in Browser...

set "CHROME_PATH="
if exist "C:\Program Files\Google\Chrome\Application\chrome.exe" (
    set "CHROME_PATH=C:\Program Files\Google\Chrome\Application\chrome.exe"
) else if exist "C:\Program Files (x86)\Google\Chrome\Application\chrome.exe" (
    set "CHROME_PATH=C:\Program Files (x86)\Google\Chrome\Application\chrome.exe"
) else if exist "%LocalAppData%\Google\Chrome\Application\chrome.exe" (
    set "CHROME_PATH=%LocalAppData%\Google\Chrome\Application\chrome.exe"
)

if defined CHROME_PATH (
    start "" "%CHROME_PATH%" "%CLIENT_URL%" "%ADMIN_URL%" "%DB_URL%"
) else (
    start "" chrome "%CLIENT_URL%" "%ADMIN_URL%" "%DB_URL%" 2>nul || (
        start "" "%CLIENT_URL%"
        start "" "%ADMIN_URL%"
        start "" "%DB_URL%"
    )
)

echo.
echo ====================================================================
echo  [SUCCESS] All Portals Launched Successfully in Browser!
echo  ------------------------------------------------------------------
echo   * Client Side : %CLIENT_URL%
echo   * Admin Side  : %ADMIN_URL%
echo   * Database    : %DB_URL%
echo ====================================================================
echo.
echo Ready! You can close this window at any time.
ping 127.0.0.1 -n 3 >nul
