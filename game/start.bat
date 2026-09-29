@echo off
color 1f
title XxSG - Game Sunucu 1 (S1)
chcp 437 >nul
"%~dp0..\Java\jdk1.8.0_181\bin\java" -Dfile.encoding=utf-8 -Duser.language=en -Duser.country=US -cp "%~dp0lib\*;%~dp0target\classes" com.linlongyx.sanguo.webgame.startup.GameServer
pause
