# 移動 xampp, htdocs DIR
Move-Item 'C:\Users\Administrator\Downloads\xampp\' 'C:\xampp\'
Remove-Item -Recurse 'C:\xampp\htdocs\*'
xcopy 'C:\Users\Administrator\Downloads\Web-Page-Design-main\htdocs\*' 'C:\xampp\htdocs\' /e

# 安裝 certificate
New-Item -Path 'C:\xampp\apache\' -Name 'crt' -ItemType 'Directory'
xcopy 'C:\Users\Administrator\Downloads\Web-Page-Design-main\others\cert.conf' 'C:\xampp\apache\crt\'
xcopy 'C:\Users\Administrator\Downloads\Web-Page-Design-main\others\make-cert.bat' 'C:\xampp\apache\crt\'

Set-Location 'C:\xampp\apache\crt\'
Start-Process 'C:\xampp\apache\crt\make-cert.bat'
do { $q1 = Read-Host "執行 xampp\apache\crt\make-cert.bat 了嗎? (y/n)" } while ($q1 -ne 'y')
Invoke-Item 'C:\xampp\apache\crt\'
Write-Host "`n憑證安裝：`n`t  exec server.crt`n`t  安裝憑證`n`t  本機電腦`n`t  放入以下的存放區`n`t  受信任的授權單位`n`t  完成`n"
do { $q1 = Read-Host "執行 crt\localhost\server.crt 安裝憑證了嗎? (y/n)" } while ($q1 -ne 'y')

Remove-Item 'C:\xampp\apache\conf\extra\httpd-xampp.conf'
xcopy 'C:\Users\Administrator\Downloads\Web-Page-Design-main\others\httpd-xampp.conf' 'C:\xampp\apache\conf\extra\'

# 啟動 XAMPP
Start-Process 'C:\xampp\xampp-control.exe'