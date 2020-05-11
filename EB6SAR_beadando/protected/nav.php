<?php require_once 'protected/userManager.php'; ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Oldal neve</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="index.php">Home</a>
      <?php if(!IsUserLoggedIn()) : ?>
      	<a class="nav-item nav-link text" href="index.php?P=login">Login</a>
      	<a class="nav-item nav-link text" href="index.php?P=register">Register</a>
      <?php else : ?>

      	<a class="nav-item nav-link enable" href="index.php?P=store">Store</a>
      	<a class="nav-item nav-link enable" href="index.php?P=library">Library</a>
      	<a class="nav-item nav-link enable" href="index.php?P=profile">Profile</a>


      	<?php if(isset($_SESSION['permission']) && $_SESSION['permission'] >= 1) : ?>

		<?php endif; ?>
		<a class="nav-item nav-link text" href="index.php?P=logout">Logout</a>
      <?php endif; ?>
    </div>
  </div>
</nav>