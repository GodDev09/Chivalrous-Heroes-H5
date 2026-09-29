@echo off
color 1f
title XxSG - Game Sunucu 2 (S2)
chcp 437 >nul
C:\XxSG\Java\jdk1.8.0_181\bin\java -Dfile.encoding=utf-8 -Duser.language=en -Duser.country=US -cp C:\XxSG\game2\lib\*;C:\XxSG\game2\target\classes  com.linlongyx.sanguo.webgame.startup.GameServer
pause
