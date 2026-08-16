$server = "159.198.41.108"
$user = "root"
$pass = "u827XXJp91vqE0cyTV"

$psi = New-Object System.Diagnostics.ProcessStartInfo
$psi.FileName = "C:\Windows\System32\OpenSSH\ssh.exe"
$psi.Arguments = "-o StrictHostKeyChecking=no -o ConnectTimeout=15 $user@$server"
$psi.UseShellExecute = $false
$psi.RedirectStandardInput = $true
$psi.RedirectStandardOutput = $true
$psi.RedirectStandardError = $true
$psi.CreateNoWindow = $true

$proc = [System.Diagnostics.Process]::Start($psi)

Start-Sleep -Seconds 5
$proc.StandardInput.WriteLine($pass)
Start-Sleep -Seconds 5
$proc.StandardInput.WriteLine("echo CONNECTED_OK")
Start-Sleep -Seconds 3

$proc.StandardInput.WriteLine("find / -name artisan -maxdepth 5 2>/dev/null | head -5")
Start-Sleep -Seconds 5

$proc.StandardInput.WriteLine("exit")

$stdout = $proc.StandardOutput.ReadToEnd()
$stderr = $proc.StandardError.ReadToEnd()

Write-Host "=== OUTPUT ==="
Write-Host $stdout
Write-Host "=== ERROR ==="
Write-Host $stderr
