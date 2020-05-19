<?php include("includes/header.php"); ?>
<?php if(!$session->get_signed_in()){redirect('login.php');} ?>

<?php 
$message = "";
if(isset($_FILES['file'])) {
    $photo = new Photo();
    $photo->photo_title = $db->escape($_POST['title']);
    // $photo->photo_desc = $db->escape($_POST['description']);
    $photo->set_file($_FILES['file']);

    if ($photo->save()) {
        $message = "Photo uploaded successfully!";
    } else {
        $message = join("<br>", $photo->custom_errors);
    }
}


?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

            <!-- Brand and toggle get grouped for better mobile display -->
            <!-- Top Menu Items -->
            <?php include("includes/top_nav.php"); ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include("includes/sidenav.php"); ?>

            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Upload
                        <small>new photo</small>
                    </h1>
                    <h2> <?php echo $message; ?></h2>

                    <div class="row">
                    <div class="col-md-6">
                        <form action="upload.php" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input class="form-control" type="text" name="title">
                            </div>
                            <div class="form-group">
                                <label for="file">Choose Photo</label>
                                <input type="file" name="file">
                            </div>
                            <!-- <div class="form-group">
                                <label for="caption">Caption</label>
                                <input class="form-control" type="text" name="caption">
                            </div> -->
                            <!-- <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                            </div> -->
                            <input type="submit" name="upload" value="Upload">
                        </form>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-lg-12">
                        <h3>Upload Multiple</h3>
                        <form action="upload.php" class="dropzone"></form>
                    </div>
                    </div>


                    </div>
                </div>
            </div>
            <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>