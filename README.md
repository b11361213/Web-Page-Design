# Web-Page-Design

11201-36454網頁設計與實務應用

```ps1
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
```

[i18n Google sheets example](https://docs.google.com/spreadsheets/d/16ut3yQ8K6vY7XP12HpF_D1WNljqwuG-EyxGfq_47Yss)

[i18n Google sheets](https://docs.google.com/spreadsheets/d/1sp-Rw0xcjd-nEMIacbVywY5zIlCbBGr-Ja9EF0DgJfg)

[localhost SSL](https://www.barryblogs.com/xampp-localhost-ssl-certificate/)

[MySQLAdmin](https://localhost/phpmyadmin/)

[XAMPP 8.2.4](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.2.4/)

[Inspect database](https://localhost/query.php?query=retrieve)

## To-do list

 - [ ] 安裝 SSL 憑證  
 - [ ] 啟動 XAMPP  
   - [ ] 啟動 Apache
   - [ ] 啟動 MySQL
     - [ ] [建立 form 資料庫](https://localhost/phpmyadmin/index.php?route=/server/databases)
     - [ ] [重建 dataform 資料表](https://localhost/rebuild.php?query=rebuild)