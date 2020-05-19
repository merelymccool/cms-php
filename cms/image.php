<?php 

require_once("admin/includes/init.php");

if(empty($_GET['id'])) {
    redirect('index.php');
}

$photo = Photo::find_id($_GET['id']);

if(isset($_POST['submit'])) {
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);

    $new_comment = Comment::create_photo_comment($photo->id, $author, $body);

    if($new_comment) {
        $new_comment->save_all();
        redirect("image.php?id={$_GET['id']}");
    } else {
        $messsage = "Oops! Something went wrong.";
    }
} else {
    $body = "";
    $author = "";
}

$comments = Comment::find_photo_comment($photo->id);

?>
<?php include("includes/header.php"); ?>

    <main id="photo-container">
        <section class="post-box">
            <h1><?php echo $photo->photo_title; ?></h1>
            <p>
                <?php $user = User::find_id($photo->user_id); ?>
                posted by <a href="foto.php?id=<?php echo $photo->user_id; ?>"><?php echo $user->user_name; ?></a> 
            </p>

            <!-- Preview Image -->
            <img class="img-responsive" src="admin/<?php echo $photo->photo_path(); ?>" alt="<?php echo $photo->photo_alt; ?>">

            <!-- Post Content -->
            <p class="caption"><?php echo $photo->photo_cap; ?></p>
            <div class="post-text">
                <p><?php echo $photo->photo_desc; ?></p>
            </div>
        </section>
                <hr>
        <section class="comment-form">
            <h4 class="left" >Leave a Comment:</h4>
            <form method="post" role="form">
                <div class="author-input">
                    <span class="left"><label for="author">Name:</label></span><br>
                    <input class="author-box" type="text" name="author">
                </div>
                <div class="comment-input">
                    <span class="left"><label for="body">Comment:</label></span><br>
                    <textarea class="comment-box" name="body" rows="3"></textarea>
                </div>
                <div class="comment-btn">
                <input class="submit-comment-btn" type="submit" name="submit" value="Submit">
                </div>
            </form>
        </section>
        <hr>
        <!-- Comment -->
        <section class="comments">
            <?php foreach($comments as $comment):  ?>
            <div class="comment-body">
                <img class="media-object" src="http://placehold.it/164x34" alt="">
                <h4 class="comment-author"><?php echo $comment->author; ?>
                    <small><?php echo date('l jS \of F Y h:i:s A');; ?></small>
                </h4>
                <?php echo $comment->body; ?>
            </div>
            <?php endforeach; ?>
        </section>
    </main>

<?php include("includes/footer.php"); ?>
