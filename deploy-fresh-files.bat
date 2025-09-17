@echo off
echo ====================================
echo   Fresh Files Deployment Script
echo ====================================
echo.

echo [1/5] Checking for new files...
git status --porcelain

echo.
echo [2/5] Scanning for any debug code...
findstr /S /I "CUSTOM TEST" *.php 2>nul
if %errorlevel% equ 0 (
    echo ERROR: Found debug code! Please remove before deploying.
    pause
    exit /b 1
)

findstr /S /I "Direct Demo Data Check" *.php 2>nul
if %errorlevel% equ 0 (
    echo ERROR: Found debug code! Please remove before deploying.
    pause
    exit /b 1
)

echo No debug code found - Safe to deploy!
echo.

echo [3/5] Adding only new/modified files...
git add .

echo.
echo [4/5] Showing what will be committed...
git status --short

echo.
echo [5/5] Ready to commit and push fresh files
echo.
set /p commit_msg="Enter commit message: "

if "%commit_msg%"=="" (
    echo No commit message provided. Exiting.
    exit /b 1
)

echo.
echo Committing with message: %commit_msg%
git commit -m "%commit_msg%"

echo.
echo Pushing to remote repository...
git push origin master

echo.
echo ====================================
echo   Deployment completed successfully!
echo ====================================
pause