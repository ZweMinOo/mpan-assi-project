<!DOCTYPE html>
<html>
  <head>
    <title>Setting up database</title>
  </head>
  <body>

    <h3>Setting up...</h3>

<?php
  require_once 'functions.php';

  createTable('members',
              'user VARCHAR(30) NOT NULL,
              pass VARCHAR(30),
              email VARCHAR(30),
              role VARCHAR(20),
              status VARCHAR(80),
              PRIMARY KEY (user)');

  createTable('mails', 
              'id INT UNSIGNED AUTO_INCREMENT,
              sender VARCHAR(30),
              receiver VARCHAR(30),
              time INT UNSIGNED,
              subject VARCHAR(50),
              message VARCHAR(4096),
              PRIMARY KEY (id),
              FOREIGN KEY (sender) REFERENCES members(user),
              FOREIGN KEY (receiver) REFERENCES members(user)');

  createTable('comments',
              'id INT UNSIGNED AUTO_INCREMENT,
              api VARCHAR(30),
              user VARCHAR(30),
              time INT UNSIGNED,
              text VARCHAR(500),
              PRIMARY KEY (id),
              FOREIGN KEY (user) REFERENCES members(user)');

  queryMysql("INSERT INTO members (user,pass,email,role,status) VALUES ('myadmin','admin1111','admin@mpan.com','Administrator','I am an admin')");
  //queryMysql("INSERT INTO members (user,pass,email,role,status) VALUES ('testuser','pass123','testuser@mail.com','Member',' Just user')");
?>
    <br>...done.
    <br> Also Default Admin Created !, Look at table
  </body>
</html>
