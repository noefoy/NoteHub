<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Vincent Witzmann">
    <meta name="keywords" content="NoteHub">
    <link rel="stylesheet" href="styles.css">
    <title>NoteHub - Login</title>
    <link rel="icon" type="image/png" href="./notehub_logo.png">
    <script src="script.js"></script>
</head>
<body>

<div class="topnav">
    <nav>
        <img class="notehub_logo" src="./notehub_logo.png" alt="Logo">
        <div class="menu-icon fix">&#9776;</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="help.php">Help</a></li>
            <?php
                // Check if a session is not already active
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                
                // Check if the user is logged in
                if (isset($_SESSION['user_id'])) {
                    // If logged in, show logout link
                    echo '<li><a href="logout.php">Logout</a></li>';
                } else {
                    // If not logged in, show login link
                    echo '<li><a href="login.html">Login</a></li>';
                }
            ?>
        </ul>
    </nav>
</div>

<section class="impressumcontent">
    <div class="impressumcontainer">
        <h1 class="impressumh1">
            Impressum
          </h1>
        
          <div id="impressum_title2">Responsible for content:</div>
      
          David Borne <br>
          Lorrainestrasse 5B <br>
          3013 Bern <br>
          Switzerland <br>
          dbo142601@stud.gibb.ch <br>
          +41 *** *** ** ** <br><br>
      
      <div id="impressum_title2">Copyright and intellectual property:</div>
          
      
          All content on this website, including text, graphics, logos, images, audio files, and software,
          is the property of David Borne and his group, consisting of Vincent Witzmann and Noe Foy.
          The use, reproduction, or distribution of any content from this website is prohibited unless authorized in writing by the group.<br><br>
          
      <div id="impressum_title2">Disclaimer:</div>
      
          The information provided on this website is for general informational purposes only.
          We strive for the accuracy of the information presented, but we cannot guarantee
          its completeness or suitability for a specific purpose.
          The use of this website and the information contained therein is at your own risk.<br><br>
          
      <div id="impressum_title2">Contact:</div>
          
          For questions or concerns regarding this imprint or any aspect of this website, please contact us at:
          
          dbo142601@stud.gibb.ch<br><br>
          
          <div id="impressum_title2">Jurisdiction:</div>
          
          This website and its content are subject to the laws of Switzerland,
          and all disputes related to this website or its content are subject
          to the exclusive jurisdiction of the courts in Bern, CH.<br><br>
          
          <div id="impressum_title2">Last Update:</div>
          
          This imprint was last updated on 22.04.2024.
      </div>
</section>



</body>
<footer>
    <p class="footercontent">&copy; 2024 NoteHub. All rights reserved. <a href="impressum.php" class="footercontent">Impressum</a></p>
</footer>
</html>
