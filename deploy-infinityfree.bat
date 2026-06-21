@echo off
echo ========================================
echo  DEPLOY TO INFINITYFREE
echo ========================================
echo.

echo [1/4] Installing production dependencies...
call composer install --no-dev --optimize-autoloader --ignore-platform-req=php
echo.

echo [2/4] Generating deployment zip...
echo.

:: Create temp deploy folder
if exist "C:\laragon\www\tugasWirjo\deploy_tmp" rmdir /s /q "C:\laragon\www\tugasWirjo\deploy_tmp"
mkdir "C:\laragon\www\tugasWirjo\deploy_tmp"

:: Copy project files (excluding vendor, node_modules, etc.)
echo Copying files...
xcopy /E /I /Q "app" "deploy_tmp\app"
xcopy /E /I /Q "bootstrap" "deploy_tmp\bootstrap"
xcopy /E /I /Q "config" "deploy_tmp\config"
xcopy /E /I /Q "database" "deploy_tmp\database"
xcopy /E /I /Q "public" "deploy_tmp\public"
xcopy /E /I /Q "resources" "deploy_tmp\resources"
xcopy /E /I /Q "routes" "deploy_tmp\routes"
xcopy /E /I /Q "storage" "deploy_tmp\storage"
copy "artisan" "deploy_tmp\artisan"
copy "composer.json" "deploy_tmp\composer.json"
copy "composer.lock" "deploy_tmp\composer.lock"
copy ".env.infinityfree" "deploy_tmp\.env"

echo.
echo [3/4] Creating zip file...
echo.

:: Check if 7zip exists
where 7z >nul 2>&1
if %errorlevel% equ 0 (
    7z a -tzip "dcpro-infinityfree.zip" deploy_tmp\*
) else (
    powershell -command "Compress-Archive -Path 'deploy_tmp\*' -DestinationPath 'dcpro-infinityfree.zip' -Force"
)

echo.
echo [4/4] Cleanup...
rmdir /s /q "deploy_tmp"

echo.
echo ========================================
echo  SELESAI!
echo ========================================
echo.
echo File deployment: dcpro-infinityfree.zip
echo.
echo Langkah selanjutnya:
echo 1. Login ke InfinityFree
echo 2. Buka File Manager
echo 3. Upload dcpro-infinityfree.zip ke folder htdocs
echo 4. Extract zip di folder htdocs
echo 5. Buat database di panel
echo 6. Edit file .env dengan data database
echo 7. Jalankan: php artisan migrate --force
echo.
pause
