$psi = New-Object System.Diagnostics.ProcessStartInfo
$psi.FileName = "ssh"
$psi.Arguments = "-o StrictHostKeyChecking=no root@159.198.41.108"
$psi.UseShellExecute = $false
$psi.RedirectStandardInput = $true
$psi.RedirectStandardOutput = $true
$psi.RedirectStandardError = $true

$proc = [System.Diagnostics.Process]::Start($psi)
Start-Sleep -Seconds 2

$proc.StandardInput.WriteLine("u827XXJp91vqE0cyTV")
Start-Sleep -Seconds 3

$proc.StandardInput.WriteLine("ls /var/www/ 2>/dev/null; ls /home/ 2>/dev/null; find / -name artisan -maxdepth 4 2>/dev/null | head -5")
Start-Sleep -Seconds 5

$proc.StandardInput.WriteLine("exit")

$stdout = $proc.StandardOutput.ReadToEnd()
$stderr = $proc.StandardError.ReadToEnd()
$proc.WaitForExit()

Write-Output "=== STDOUT ==="
Write-Output $stdout
Write-Output "=== STDERR ==="
Write-Output $stderr
