@echo off
chcp 437 >nul
title Redis Server - XxSG
cd /d "%~dp0"
redis-server.exe redis.conf