mv 'C:\Users\Administrator\Downloads\xampp\' 'C:\xampp\'
rm -r 'C:\xampp\htdocs\'
xcopy 'C:\Users\Administrator\Downloads\Web-Page-Design-main\htdocs\*' 'C:\xampp\htdocs\' /e

mkdir 'C:\xampp\apache\crt\'
xcopy 'C:\Users\Administrator\Downloads\Web-Page-Design-main\others\cert.conf' 'C:\xampp\apache\crt\'
xcopy 'C:\Users\Administrator\Downloads\Web-Page-Design-main\others\make-cert.bat' 'C:\xampp\apache\crt\'
explorer 'C:\xampp\apache\crt\localhost'
Start-Sleep -Seconds 20

rm 'C:\xampp\apache\conf\extra\httpd-xampp.conf'
xcopy 'C:\Users\Administrator\Downloads\Web-Page-Design-main\others\httpd-xampp.conf' 'C:\xampp\apache\conf\extra\'