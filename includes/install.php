<html>
   <head>
      <title>Connecting MySQLi Server, Creating MySQLi Tables</title>
   </head>
   
   <body>
      <?php
         $dbhost = 'localhost:3306';
         $dbuser = 'root';
         $dbpass = 'ROOT';
         $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
   
         if(!$conn){
            echo 'Connected failure<br>';
         }
        // echo 'Connected successfully<br>';
         $sql = "CREATE DATABASE IF NOT EXISTS db";
         
         if (mysqli_query($conn, $sql)) {
            echo "Database created successfully, please refresh<br/>";
         } else {
            echo "Error creating database: " . mysqli_error($conn);
         }
         $dbname = 'db'; 
         $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);  
         
         if(!$conn){  
            die('Could not connect: '.mysqli_connect_error());  
         }  
  
         $sql = "create table IF NOT EXISTS images(
            id INT AUTO_INCREMENT NOT NULL,primary key (id),
            filename VARCHAR(255),
            username VARCHAR(20),
            date_uploaded VARCHAR(255),
            likes INT(20),
            user_liked VARCHAR(20)
            )";  
            if(mysqli_query($conn, $sql)){  
            //   echo "images created successfully<br/>";  
               } 
               else {  
                  echo "images is not created successfully<br/>" . mysqli_error($conn);  
               }
         $sql = "create table IF NOT EXISTS comments(
            id INT AUTO_INCREMENT NOT NULL,primary key (id),
            img_id INT(20),
            comment_text VARCHAR(255)
            )";  
         
         if(mysqli_query($conn, $sql)){  
         //echo "comments table created successfully<br/>";  
         } else {  
            echo "comments table is not created successfully<br/>" . mysqli_error($conn);  
         }

         $sql = "create table IF NOT EXISTS users(
            id INT AUTO_INCREMENT NOT NULL,primary key (id),
            username VARCHAR(20),
            password VARCHAR(255),
            salt VARCHAR(255),
            email VARCHAR(255),
            verification_token VARCHAR(255),
            verified INT (11)
            )";
         
         if(mysqli_query($conn, $sql)){  
        // echo "users table created successfully<br/>";  
         } else {  
            echo "users table is not created successfully<br/>" . mysqli_error($conn);  
         }  
         
         mysqli_close($conn);   
      ?>
   </body>
</html>
