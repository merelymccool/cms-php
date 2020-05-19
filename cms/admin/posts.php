<?php include("includes/header.php"); ?>
<?php if(!$session->get_signed_in()){redirect('login.php');} ?>

<?php 
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per = 50; // or set LIMIT in sql
$total = Blog::count_all();
$paginate = new Paginate($page, $items_per, $total);

$sql = "SELECT * FROM posts ORDER BY id DESC LIMIT " . $items_per . " OFFSET " . $paginate->offset();
$blogs = Blog::find_query($sql);

$cat = new Category();
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
                        Posts
                        <small>View All</small>
                    </h1>
                    <p class="bg-success">
                        <?php echo $msg; ?>
                    </p>
                    <a id="new-post-btn" class="btn btn-primary" href="create_post.php">Create New</a>
                    <!-- Pagination -->
                    <div class="row">
                        <ul class="pager">
                            <?php 
                            if($paginate->total_pages() > 1) {
                                if($paginate->has_next()) {
                                    echo "<li class='next'><a href='comments.php?page={$paginate->next()}'>Next</a></li>";
                                }

                                if($paginate->has_previous()) {
                                    echo "<li class='previous'><a href='comments.php?page={$paginate->previous()}'>Previous</a></li>";
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <!-- End Pagination -->

                    <div class="col-md-12">
                    <table id="post-table" class="table table-hover">
                        <thead id="table-head">
                            <tr>
                                <th id="col-id">ID</th>
                                <th id="col-photo">Photo</th>
                                <th id="col-cat">Category</th>
                                <th id="col-title">Title</th>
                                <th id="col-author">Author</th>
                                <th id="col-tags">Tags</th>
                                <!-- <th>Description</th> -->
                            </tr>
                        </thead>
                        <tbody id="table-body">
                        <?php 
                        foreach ($blogs as $blog): ?>
                             <tr>
                                        <td class="cell-id"><?php echo $blog->id; ?></td>
                                        <td class="cell-photo">
                                            <img class="admin-thumb" src='<?php echo $blog->default_blog_photo(); ?>' ><br>
                                            <div class="manage_links">
                                                <a class="view-link" href="../post.php?id=<?php echo $blog->id; ?>">View</a> | 
                                                <a class="edit-link" href="edit_post.php?id=<?php echo $blog->id; ?>">Edit</a> | 
                                                <a class="delete-link" href="delete_post.php?id=<?php echo $blog->id; ?>">Delete</a>
                                            </div>
                                        </td>
                                        <td class="cell-cat">
                                            <?php
                                            $int = intval($blog->blog_cat);
                                            $cat->find_id($int);
                                            echo $blog->blog_cat . $cat->cat_title; ?>
                                        </td>
                                        <td class="cell-title"><a href="../post.php?id=<?php echo $blog->id; ?>"><?php echo $blog->blog_title; ?></a></td>
                                        <td class="cell-author"><?php echo $blog->blog_author; ?></td>
                                        <td class="cell-tags"><?php echo $blog->blog_tags; ?></td>
                                    </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>

                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Blank Page
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>