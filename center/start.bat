@echo off
color 1f
title XxSG - Center Sunucu
chcp 437 >nul
C:\XxSG\Java\jdk1.8.0_181\bin\java -Dfile.encoding=utf-8 -Duser.language=en -Duser.country=US -cp C:\XxSG\center\lib\*;C:\XxSG\center\target\classes com.linlongyx.startup.CrossServer
pause
