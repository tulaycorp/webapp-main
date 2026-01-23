#!/usr/bin/env pwsh
# Deploy script to pull latest changes on the server

$env:SSH_ASKPASS_REQUIRE = "never"

# Use sshpass equivalent or expect-like behavior
$password = "password"

# Create a temporary expect-like script
$expectScript = @"
spawn ssh -i "a:\Webdev\sshfolder\SSH" root@157.230.39.113 "cd /var/www/webapp-main && git pull origin prod"
expect "Enter passphrase"
send "$password\r"
expect eof
"@

# For PowerShell, we'll use a different approach
Write-Host "Connecting to server to pull latest changes..."

# Use plink if available, or create an SSH config
# For now, let's create a batch file that can handle this
"@

Set-Content -Path "a:\Webdev\webapp-main\deploy-temp.ps1" -Value $expectScript
