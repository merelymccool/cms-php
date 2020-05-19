<header class="hero-image">
    <div class="hero-text">
        <h1 style="font-size:50px">Merely McCool</h1>
        <h3>Hike. Code.</h3>
        <h3>Boat. Repeat.</h3>
    </div>
</header>
<nav class="navbar" role="navigation">
    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="journal.php">Journal</a>
    <a href="gallery.php">Gallery</a>
    <?php if(!$session->get_signed_in()){
        echo "<a href='admin/login.php'>Login</a>";} ?>
    <?php if($session->get_signed_in()){
        echo "<a href='admin/index.php'>Admin</a>";} ?>
</nav>