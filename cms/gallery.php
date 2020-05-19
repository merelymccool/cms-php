<?php include("includes/header.php"); ?>
<?php 
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per = 12; // or set LIMIT in sql
$total = Photo::count_all();
$paginate = new Paginate($page, $items_per, $total);

$sql = "SELECT * FROM photos ORDER BY id DESC LIMIT " . $items_per . " OFFSET " . $paginate->offset();
$photos = Photo::find_query($sql);
// $photos = Photo::find_all();

?>

    <main class="gal-container">
        <h1>Gallery</h1>

        <section class="gal-box">
            <?php foreach($photos as $photo): ?>
            <div class="thumbnail">
                <a href="image.php?id=<?php echo $photo->id ?>">
                    <img class="gal-photo" src="admin/<?php echo $photo->photo_path(); ?>" alt="">
                </a>
            </div>
            <?php endforeach; ?>
        </section>

        <section class="pagination">
            <ul class="pager">
                <?php  // $total_pages = ceil($total/$items_per);
                if($paginate->total_pages() > 1) {
                    if($paginate->has_next()) {
                        echo "<li class='next'><a href='gallery.php?page={$paginate->next()}'>Next</a></li>";
                    }

                    // for($i = 1; $i <= $total_pages; $i++) {
                    //     if($i = $paginate->current_page) {
                    //         echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";
                    //     } else {
                    //         echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";
                    //     }
                    // }

                    if($paginate->has_previous()) {
                        echo "<li class='previous'><a href='gallery.php?page={$paginate->previous()}'>Previous</a></li>";
                    }
                } ?>
            </ul>
        </section>
    </main>

<?php include("includes/footer.php"); ?>
