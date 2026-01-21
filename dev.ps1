# Start Main Webapp Development Servers
Write-Host "Starting Main Webapp Development Servers..." -ForegroundColor Cyan
Write-Host ""

# Start PHP server in background
$phpJob = Start-Job -ScriptBlock {
    Set-Location $using:PWD
    php artisan serve
}

# Start NPM dev in background
$npmJob = Start-Job -ScriptBlock {
    Set-Location $using:PWD
    npm run dev
}

Write-Host "Development servers started!" -ForegroundColor Green
Write-Host "- PHP Server: http://localhost:8000" -ForegroundColor Yellow
Write-Host "- Vite Dev Server: Running in background" -ForegroundColor Yellow
Write-Host ""
Write-Host "Monitoring output (Ctrl+C to stop)..." -ForegroundColor Gray
Write-Host ""

try {
    while ($true) {
        $phpJob | Receive-Job
        $npmJob | Receive-Job
        Start-Sleep -Milliseconds 100
    }
} finally {
    Write-Host ""
    Write-Host "Stopping servers..." -ForegroundColor Yellow
    $phpJob | Stop-Job
    $npmJob | Stop-Job
    $phpJob | Remove-Job
    $npmJob | Remove-Job
    Write-Host "Servers stopped." -ForegroundColor Green
}
