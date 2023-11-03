# Web-Page-Design

11201-36454網頁設計與實務應用

```ps1
mv 'C:\Users\Administrator\Downloads\xampp\' 'C:\xampp\'
rm -r 'C:\xampp\htdocs\'
xcopy 'C:\Users\Administrator\Downloads\Web-Page-Design-main\htdocs\*' 'C:\xampp\htdocs\' /e

mkdir 'C:\xampp\apache\crt\'
xcopy 'C:\Users\Administrator\Downloads\Web-Page-Design-main\others\cert.conf' 'C:\xampp\apache\crt\'
xcopy 'C:\Users\Administrator\Downloads\Web-Page-Design-main\others\make-cert.bat' 'C:\xampp\apache\crt\'
explorer 'C:\xampp\apache\crt\'
Read-Host "Press any key to countine"

rm 'C:\xampp\apache\conf\extra\httpd-xampp.conf'
xcopy 'C:\Users\Administrator\Downloads\Web-Page-Design-main\others\httpd-xampp.conf' 'C:\xampp\apache\conf\extra\'
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
     - [ ] [重建 dataform 資料表](https://localhost/query.php?query=rebuild)