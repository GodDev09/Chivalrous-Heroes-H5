@echo off
chcp 437 >nul
color 4f
title XxSG - Stop All Services

echo.
echo  ============================================
echo   XxSG - STOPPING ALL SERVICES
echo  ============================================
echo.

:: --- Java Game Servers (game, game2, center) ---
echo [*] Stopping Java game servers...
taskkill /F /IM java.exe >nul 2>&1
if %ERRORLEVEL% == 0 (
    echo     [OK] Java processes killed
) else (
    echo     [--] No Java process running
)

:: --- Nginx ---
echo [*] Stopping Nginx...
taskkill /F /IM nginx.exe >nul 2>&1
if %ERRORLEVEL% == 0 (
    echo     [OK] Nginx stopped
) else (
    echo     [--] Nginx was not running
)

:: --- MySQL ---
echo [*] Stopping MySQL...
taskkill /F /IM mysqld.exe >nul 2>&1
if %ERRORLEVEL% == 0 (
    echo     [OK] MySQL stopped
) else (
    echo     [--] MySQL was not running
)

:: --- Redis ---
echo [*] Stopping Redis...
taskkill /F /IM redis-server.exe >nul 2>&1
if %ERRORLEVEL% == 0 (
    echo     [OK] Redis stopped
) else (
    echo     [--] Redis was not running
)

:: --- PHP-CGI ---
echo [*] Stopping PHP-CGI...
taskkill /F /IM php-cgi.exe >nul 2>&1
if %ERRORLEVEL% == 0 (
    echo     [OK] PHP-CGI stopped
) else (
    echo     [--] PHP-CGI was not running
)

echo.
echo  ============================================
echo   All services stopped.
echo  ============================================
echo.
pause
