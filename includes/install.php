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
         echo 'Connected successfully<br>';
         $sql = "CREATE DATABASE db";
         
         if (mysqli_query($conn, $sql)) {
            echo "Database created successfully<br/>";
         } else {
            echo "Error creating database: " . mysqli_error($conn);
         }
         $dbname = 'db'; 
         $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);  
         
         if(!$conn){  
            die('Could not connect: '.mysqli_connect_error());  
         }  
         echo 'Connected successfully<br/>';  
  
         $sql = "create table images(
            image_id INT AUTO_INCREMENT NOT NULL,primary key (id),
            user_id INT(20),
            image_src VARCHAR(255),
            name VARCHAR(20)
            )";  
            if(mysqli_query($conn, $sql)){  
               echo "users_session created successfully<br/>";  
               } 
               else {  
                  echo "users_session is not created successfully" . mysqli_error($conn);  
               }
         $sql = "create table comments(
            id INT AUTO_INCREMENT NOT NULL,primary key (id),
            img_id INT(20),
            comment_text VARCHAR(255)
            )";  
         
         if(mysqli_query($conn, $sql)){  
         echo "groups table created successfully<br/>";  
         } else {  
            echo "groups table is not created successfully " . mysqli_error($conn);  
         }

         $sql = "create table users(
            id INT AUTO_INCREMENT NOT NULL,primary key (id),
            username VARCHAR(20),
            password VARCHAR(255),
            salt VARCHAR(255),
            email VARCHAR(255),
            verification_token VARCHAR(255),
            verified INT (11),
            groups INT(11)
            )";
         
         if(mysqli_query($conn, $sql)){  
         echo "users table created successfully<br/>";  
         } else {  
            echo "users table is not created successfully" . mysqli_error($conn);  
         }  
         
         mysqli_close($conn);   
      ?>
   </body>
</html>
