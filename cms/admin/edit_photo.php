<?php include("includes/header.php"); ?>
<?php if(!$session->get_signed_in()){redirect('login.php');} ?>
<?php $photos = Photo::find_all(); ?>

<?php 
if(empty($_GET['id'])) {
    redirect('photos.php');
} else {
    $photo = Photo::find_id($_GET['id']);

    if(isset($_POST['submit'])) {
        if($photo) {
            $photo->photo_title = $_POST['title'];
            $photo->photo_cap = $_POST['caption'];
            $photo->photo_alt = $_POST['alt-text'];
            $photo->photo_desc = $_POST['description'];

            $photo->save();
            $session->message("Photo ID {$photo->id} successfully updated!");
            redirect("photos.php");
        }
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
                        Edit Photos
                        <small>ID <?php echo $photo->id; ?></small>
                    </h1>

                    <div class="col-md-8">
                        <form action="" method="post">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo $photo->photo_title; ?>">
                    </div>
                    <div class="form-group">
                    <a class="thumbnail" href=""><img src="<?php echo $photo->photo_path(); ?>" alt=""></a>
                    </div>
                    <div class="form-group">
                        <label for="caption">Caption</label>
                        <input type="text" name="caption" class="form-control" value="<?php echo $photo->photo_cap; ?>">
                    </div>
                    <div class="form-group">
                        <label for="alt-text">Alt Text</label>
                        <input type="text" name="alt-text" class="form-control" value="<?php echo $photo->photo_alt; ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10"><?php echo $photo->photo_desc; ?></textarea>
                    </div>
                    </div>

                    <div class="col-md-4" >
                            <div  class="photo-info-box">
                                <div class="info-box-header">
                                   <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                </div>
                            <div class="inside">
                              <div class="box-inner">
                                 <p class="text">
                                   <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                                  </p>
                                  <p class="text ">
                                    Photo Id: <span class="data photo_id_box"><?php echo $photo->id; ?></span>
                                  </p>
                                  <p class="text">
                                    Filename: <span class="data"><?php echo $photo->photo_file; ?></span>
                                  </p>
                                 <p class="text">
                                  File Type: <span class="data"><?php echo $photo->photo_ext; ?></span>
                                 </p>
                                 <p class="text">
                                   File Size: <span class="data"><?php echo $photo->photo_size; ?></span>
                                 </p>
                              </div>
                              <div class="info-box-footer clearfix">
                                <div class="info-box-delete pull-left">
                                    <a href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
                                </div>
                                <div class="info-box-update pull-right ">
                                    <input type="submit" name="submit" value="Update" class="btn btn-primary btn-lg ">
                                </div>   
                              </div>
                            </div>          
                        </div>
                    </div>
                        </form>

                </div>
            </div>
            <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>