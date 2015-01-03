    <nav class="navbar navbar-default" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">ServerStatus</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <li <?php if(isset($name)===false) { echo 'class="active"'; } ?>><a href="/">Overview</a></li>
            <?php if(isset($name)) { echo '<li class="active"><a href="/server.php?id='.$name.'">'.$name.'</a></li>';}?>
          </ul>
        </div>
      </div>
    </nav>