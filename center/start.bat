@echo off
color 1f
title XxSG - Center Sunucu
chcp 437 >nul
"%~dp0..\Java\jdk1.8.0_181\bin\java" -Dfile.encoding=utf-8 -Duser.language=en -Duser.country=US -cp "%~dp0lib\*;%~dp0target\classes" com.linlongyx.startup.CrossServer
pause
