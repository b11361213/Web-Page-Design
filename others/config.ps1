# 移動 xampp, htdocs DIR
mv 'C:\Users\Administrator\Downloads\xampp\' 'C:\xampp\'
rm -r 'C:\xampp\htdocs\'
xcopy 'C:\Users\Administrator\Downloads\Web-Page-Design-main\htdocs\*' 'C:\xampp\htdocs\' /e

# 安裝 certificate
mkdir 'C:\xampp\apache\crt\'
xcopy 'C:\Users\Administrator\Downloads\Web-Page-Design-main\others\cert.conf' 'C:\xampp\apache\crt\'
xcopy 'C:\Users\Administrator\Downloads\Web-Page-Design-main\others\make-cert.bat' 'C:\xampp\apache\crt\'

# explorer 'C:\xampp\apache\crt\'
# & 'C:\xampp\apache\crt\make-cert.bat'
Start-Process 'C:\xampp\apache\crt\make-cert.bat'
do { $q1 = Read-Host "執行 xampp\apache\crt\make-cert.bat 了嗎? (y/n)" } while ($q1 -ne 'y')
Write-Host "`n憑證安裝：`n`t  exec server.crt`n`t  安裝憑證`n`t  本機電腦`n`t  放入以下的存放區`n`t  受信任的授權單位`n`t  完成`n"
do { $q1 = Read-Host "執行 crt\localhost\server.crt 安裝憑證了嗎? (y/n)" } while ($q1 -ne 'y')

rm 'C:\xampp\apache\conf\extra\httpd-xampp.conf'
xcopy 'C:\Users\Administrator\Downloads\Web-Page-Design-main\others\httpd-xampp.conf' 'C:\xampp\apache\conf\extra\'

# start apache and mysql
do { $q1 = Read-Host "`n`t即將啟動 apache 與 mysql，是否啟動? (y/n)" } while ($q1 -ne 'y')
Start-Process 'C:\xampp\apache_start.bat'
Start-Process 'C:\xampp\mysql_start.bat'