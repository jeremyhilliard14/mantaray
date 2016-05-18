

<body>
  <nav id="nav" class="navbar navbar-default">
    <div class="container-fluid">
      <div id="home" class="navbar-header">
        <a class="navbar-brand" href="/">Home</a>
      </div>
      <ul id="options" class="nav navbar-nav">
        
        <?php 
          if(isset($_SESSION['username'])){
            print '<li id="welcome">Welcome '.$_SESSION['username'].'</li>';
            print '<li id="post"><a href="post.php">Make a post</a></li>';
            print '<li id="logout"><a href="logout.php">Logout</a></li>';
          }else{
            print '<li id="register"><a href="register.php">Register</a></li>';
            print '<li id="login"><a href="login.php">Login</a></li>';
          }        
        ?>
        
      </ul>
    </div>
  </nav>
