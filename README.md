 <h1>Camagru</h1>
 A simple image-sharing web application; similar to Instagram.
 
 <h1>Requirements</h1>

 <ol>
  <li>PHP</li>
  <li>JavaScript</li>
  <li>XAMPP</li>
  <li>MySQL</li>
  <li>CSS</li>
  <li>HTML</li>
</ol>
  <h1>Setup</h1>
 <ol>
   <li>Install Apache XAMPP stack.</li>
   <li>Clear out htdocs folder</li>
   <li>Clone this repository into htdocs folder</li>
   <li>Change your MySQL databaseto use default credentials(only for production and initial setup): user: root, password: ROOT</li>
   <li>Go to http://localhost/Camagru/ to connect and create the database</li>
   <li>Follow the steps to create an account and verify your email</li>
   <li>Login and have fun!</li>
 </ol>

 <h1>Architecture</h1>
 This application has a very simple file structure. There is a folder containing all the classes for the application; each class handles a different type of data for the application, as well as the functions for accessing and updating that data. Each view, which is represented by a php file with html included, is associated with a (kind of) matching function (ie, the login_page.php view file has a corresponding login_user function). The includes folder contains the html files for the header and footer that are on every page, as well as the install.php file that gets called the first time the dbh class is instantiated (ie the first time a user visits the home page).
 
 <h1>Testing</h1>
 I used the Camagru marking sheet as a test outline. The expected outcomes reflect user expectations. 
 <ol>
   <li>Preliminary checks: application written in PHP, no external frameworks, application uses PDOs.</li>
   <li>Start webserver (webserver starts and gallery is located at http://localhost/Camagru/)</li>
   <li>User can create an account (register and verify email)</li>
   <li>User can log in </li>
   <li>User can capture picture using the webcam or upload a picture from their computer</li>
   <li>The user can view all posted pictures in the gallery</li>
   <li>The user can change their account details</li>
  </ol>


 
