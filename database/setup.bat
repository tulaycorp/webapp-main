@echo off
echo Setting up database...
echo.

REM Change to the directory containing this script
cd /d "%~dp0"

REM Path to MySQL executable in XAMPP
set MYSQL_PATH=C:\xampp\mysql\bin\mysql.exe

REM Check if MySQL is accessible
if not exist "%MYSQL_PATH%" (
    echo ERROR: MySQL not found at %MYSQL_PATH%
    echo Please make sure XAMPP is installed correctly.
    pause
    exit /b 1
)

REM Execute the schema SQL file
echo Creating database and tables...
"%MYSQL_PATH%" -u root < schema.sql

if %ERRORLEVEL% EQU 0 (
    echo.
    echo SUCCESS: Database setup completed!
    echo Database: webapp_db
    echo Tables: users, sessions
) else (
    echo.
    echo ERROR: Database setup failed!
    echo Please check that MySQL is running in XAMPP.
)

echo.
pause
