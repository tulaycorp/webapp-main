# =============================================================================
# Shared Database Configuration for webapp-main & webapp-admin-panel
# =============================================================================
# Copy these values to your .env files in both projects
# =============================================================================

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=webapp_store
DB_USERNAME=root
DB_PASSWORD=

# =============================================================================
# How to initialize the database:
# =============================================================================
# 
# Option 1: Using MySQL CLI
#   mysql -u root -p < init.sql
#
# Option 2: Using phpMyAdmin
#   1. Open phpMyAdmin
#   2. Click "Import" tab
#   3. Choose init.sql file
#   4. Click "Go"
#
# Option 3: Using Laravel (from webapp-main directory)
#   php artisan migrate:fresh --seed
#
# =============================================================================
# After database init, run in each project folder:
# =============================================================================
#
# In webapp-main:
#   php artisan serve --port=8000
#
# In webapp-admin-panel:
#   php artisan serve --port=8001
#
# =============================================================================
