# Auto-commit and deploy script for RCF Church
$repoPath = "C:\xampp\htdocs\rcfchurch"
$commitInterval = 5

Set-Location $repoPath

Write-Host "Starting auto-commit and deploy monitor for RCF Church..."
Write-Host "Press Ctrl+C to stop monitoring"
Write-Host ""

while ($true) {
    try {
        $gitStatus = git status --porcelain
        
        if ($gitStatus) {
            Write-Host "[$(Get-Date -Format 'HH:mm:ss')] Changes detected, committing and pushing..."
            
            git add -A
            
            $commitMessage = "Auto-deploy: $(Get-Date -Format 'yyyy-MM-dd HH:mm:ss')"
            git commit -m $commitMessage
            
            git push origin main
            
            Write-Host "[$(Get-Date -Format 'HH:mm:ss')] Committed and pushed to GitHub. Firebase auto-deploying..."
            Write-Host ""
        }
    }
    catch {
        Write-Host "[$(Get-Date -Format 'HH:mm:ss')] Error occurred"
    }
    
    Start-Sleep -Seconds $commitInterval
}
