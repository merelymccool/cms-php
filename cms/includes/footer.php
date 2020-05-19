
        <footer>
            <section class="blog-cats">
                <h4>Blog Categories</h4>
                <ul class="blog-cats-list">
                    <?php $cats = Category::find_all();
                    foreach($cats as $cat): ?>
                    <li><a href="cat.php?id=<?php echo $cat->id; ?>"><?php echo $cat->cat_title; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </section>
            <section class="blog-search">
                <h4>Blog Search</h4>
                <div class="input-group">
                    <input type="text" class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <span class="glyphicon glyphicon-search">Search</span>
                        </button>
                    </span>
                </div>
                <p id="footer">Copyright &copy; Merely McCool <?php echo date('Y'); ?></p>
            </section> 
        </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
