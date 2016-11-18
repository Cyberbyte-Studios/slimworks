# Slimworks

TODO: write some marketing description here

##Installation
####Windows (XAMPP/WAMP/others?)
#####WE DO NOT SUPPORT IIS WEB SERVERS
#####XAMPP
    1. extract the cotense of the zip in to htdocs
    2. open install.bat in notepad / notepad++ or editor of choice
    3. change <CHANGE ME> to be the path to your php.exe in mycase it was C:\xampp\php\php.exe
    4. save your changes
    5. run install.bat and let it do its thing
    6. In xampp stop the apache server and then click on the config button and choose php.ini
    7. In php.ini find ;extension=php_intl.dll and remove the ; infront of it
    8. save the file and start the apache server again

####Linux
TODO: sam write linux guide here

```json
{
  "CUSTOM": {
  },
  "MYSQL": {
    "DATABASE": "db",
    "HOST": "127.0.0.1",
    "PASSWORD": "root",
    "PORT": "3306",
    "TUNNEL": "",
    "USER": "root"
  },
  "DEV": {
    "app.base_path": "/test/public/index.php",
    "app.cdn": "http://localhost",
    "app.css": "/test/public/css",
    "app.js": "/test/public/js",
    "app.images": "/test/public/img",
    "logger.name": "test",
    "logger.path": "../../logs/test.log"
  }
}
```
