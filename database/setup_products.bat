@echo off
echo Adding products table to database...
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

REM Execute the products schema SQL file
echo Creating products table and inserting initial data...
"%MYSQL_PATH%" -u root webapp_db < products_schema.sql

if %ERRORLEVEL% EQU 0 (
    echo.
    echo SUCCESS: Products table created!
    echo Initial products have been added to the catalog.
) else (
    echo.
    echo ERROR: Failed to create products table!
    echo Please check that MySQL is running in XAMPP.
)

echo.
pause
