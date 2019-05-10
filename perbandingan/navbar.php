<!-- navbar -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container" id="ui_top_panel">
      <!-- menu bar -->
      <div class="menubar collapse navbar-collapse" id="navbarSupportedContent">
        <img src="minilogo.png" alt="minilogo optan" class="mr-2" href="index.php" style="width:5em;">
        <ul class="navbar-nav mr-auto" style="color: white;">
          <li class="nav-item active"> 
          <?php
            if(($_SESSION['role']) == 'Expert' ) {
                echo '<a href="/trialz.php">Back to Annotation Page</a> ';
            }
            else {
                echo '<a href="/trialzUser.php">Back to Annotation Page</a>';
            }
          ?>
          </li>
          
      <form action="" class="form-inline my-2 my-lg-0">
      <a class="d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" style="color:beige;"><?php echo $_SESSION['username'] ?> as <?php echo $_SESSION['role'] ?></a>
        <!-- <a class="d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="" style="color:beige;"><?php echo $_SESSION['role'] ?></a> -->
        <a class="d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="logout.php" style="color:beige;"><button type="button" class="btn btn-outline-secondary btn-sm">Logout</button></a>
      </form>
      <!-- <input type="file" id="invisible_file_input" name="files[]" style="display:none"> -->
    </div> <!-- endof #top_panel -->
  </nav>

<!-- end of navbar -->