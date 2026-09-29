@echo off
color 1f
title XxSG - MySQL Sifre Degistirici
echo.
echo ============================================
echo  MySQL root sifresi degistiriliyor...
echo  Eski: EghgTJGqPmZ9RQiW
echo  Yeni: X7kR9mP2qN5wL8jZ
echo ============================================
echo.
echo ONCELIKLE PHPStudy'den MySQL'i baslattiginizdan
echo emin olun! Baslamak icin ENTER'a basin...
pause

"%~dp0phpstudy_pro\Extensions\MySQL5.7.26\bin\mysql.exe" -u root -pEghgTJGqPmZ9RQiW -e "ALTER USER 'root'@'localhost' IDENTIFIED BY 'X7kR9mP2qN5wL8jZ'; FLUSH PRIVILEGES;"

if %ERRORLEVEL% == 0 (
    echo.
    echo [BASARILI] MySQL root sifresi degistirildi!
    echo Yeni sifre: X7kR9mP2qN5wL8jZ
) else (
    echo.
    echo [HATA] MySQL'e baglanılamadi. MySQL'in calistigından emin olun.
)
echo.
pause
