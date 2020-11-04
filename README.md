# web_filesharing
Using php and mySql to create an access code based system to view photos. 

When cloning be aware that..
1) You need to add www-data as one of the sudoers, so that php can run the shell files. (/etc/sudoers)
--> Instructions on how to do this...
  a) sudo nano /etc/sudoers
  b) Scroll down to the part where it says "User privilege specification"
  c) Underneath the root profile add...
  "www-data ALL=(ALL) NOPASSWD: ALL"
  d) Restart your php-fpm service
  "sudo service php7.4-fpm restart" This exact command may vary based on your system
2) You need to create a database. Database is used multiple times, so if you change the name of your database, you may have to change it in a couple of the files.
-->Instructions on how to create a database
  a) Be sure to have mysql installed, or for raspberry pi users, mariadb.
  b) Once you have a database server set up as well as a client, you will have to create a database, you can do this by running 
  "CREATE DATABASE picproj;" on the database console. 
  c) Once you create the database you will have to create a user with access to the database so that php can edit and view the tables. Run this on the console:
  "GRANT ALL PRIVILEGES ON picproj.* TO 'php'@'localhost';" php will be the name of the user, and picproj is the name of our database.
3) You have to go into php.ini to change the upload limit that is set by php itself. 
  a) In order to find your php.ini file you will have to run 
  "<?php  phpinfo(); ?>" to find the exact location of this configuration file. 
  b) Once you figure out where this file is, you could use sudo nano in order to edit the the field where it says "upload_max_filesize"

