@echo off
setlocal enabledelayedexpansion

echo ====================================
echo   Safe Deployment Checker
echo ====================================
echo.

echo [STEP 1] Checking for new/modified files...
echo ----------------------------------------
git status --porcelain > temp_status.txt
for /f %%i in ('type temp_status.txt ^| find /c /v ""') do set file_count=%%i

if %file_count% equ 0 (
    echo No new files to deploy.
    del temp_status.txt
    pause
    exit /b 0
)

echo Found %file_count% new/modified files:
type temp_status.txt
del temp_status.txt
echo.

echo [STEP 2] Security scan for debug code...
echo ----------------------------------------
set debug_found=0

echo Checking for CUSTOM TEST patterns...
for /r %%f in (*.php) do (
    findstr /i "CUSTOM TEST" "%%f" >nul 2>&1
    if !errorlevel! equ 0 (
        echo WARNING: Debug code found in %%f
        set debug_found=1
    )
)

echo Checking for Direct Demo Data Check patterns...
for /r %%f in (*.php) do (
    findstr /i "Direct Demo Data Check" "%%f" >nul 2>&1
    if !errorlevel! equ 0 (
        echo WARNING: Debug code found in %%f
        set debug_found=1
    )
)

echo Checking for error_log debug statements...
for /r %%f in (*.php) do (
    findstr /i "error_log.*DEMO DEBUG" "%%f" >nul 2>&1
    if !errorlevel! equ 0 (
        echo WARNING: Debug code found in %%f
        set debug_found=1
    )
)

if %debug_found% equ 1 (
    echo.
    echo ❌ DEPLOYMENT BLOCKED: Debug code detected!
    echo Please remove all debug code before deploying.
    pause
    exit /b 1
)

echo ✅ No debug code found - Safe to proceed!
echo.

echo [STEP 3] File type analysis...
echo ----------------------------------------
git status --porcelain | findstr "\.php$" | find /c /v "" > temp_php.txt
set /p php_count=<temp_php.txt
git status --porcelain | findstr "\.js$" | find /c /v "" > temp_js.txt
set /p js_count=<temp_js.txt
git status --porcelain | findstr "\.css$" | find /c /v "" > temp_css.txt
set /p css_count=<temp_css.txt
git status --porcelain | findstr "\.\(jpg\|png\|gif\|webp\|jpeg\)$" | find /c /v "" > temp_img.txt
set /p img_count=<temp_img.txt

echo PHP files: %php_count%
echo JavaScript files: %js_count%
echo CSS files: %css_count%
echo Image files: %img_count%
del temp_php.txt temp_js.txt temp_css.txt temp_img.txt 2>nul
echo.

echo [STEP 4] Ready for deployment
echo ----------------------------------------
set /p confirm="Deploy %file_count% files? (y/N): "
if /i not "%confirm%"=="y" (
    echo Deployment cancelled.
    exit /b 0
)

echo.
echo Adding files to git...
git add .

echo.
echo Files staged for commit:
git status --short

echo.
set /p commit_msg="Enter commit message: "
if "%commit_msg%"=="" (
    set commit_msg=Deploy fresh uploaded files
)

echo.
echo Committing changes...
git commit -m "%commit_msg%

🤖 Generated with [Claude Code](https://claude.ai/code)

Co-Authored-By: Claude <noreply@anthropic.com>"

if %errorlevel% neq 0 (
    echo ❌ Commit failed!
    pause
    exit /b 1
)

echo.
echo Pushing to remote repository...
git push origin master

if %errorlevel% neq 0 (
    echo ❌ Push failed!
    pause
    exit /b 1
)

echo.
echo ✅ Deployment completed successfully!
echo ====================================
pause