  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- WYSIWYG -->
    <script src="https://cdn.tiny.cloud/1/c9qei5zuq3vl6djvvvzbyoko8husi4rw2ojb670fx88zuqwl/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script src="js/scripts.js"></script>

    <script src="js/dropzone.js"></script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Views',     <?php echo $session->count; ?>],
          ['Comments',      <?php echo Comment::count_all(); ?>],
          ['Users',  <?php echo User::count_all(); ?>],
          ['Photos', <?php echo Photo::count_all(); ?>],
          // ['Sleep',    7]
        ]);

        var options = {
          title: '',
          legend: 'none',
          pieSliceText: 'label',
          backgroundColor: 'transparent'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

</body>

</html>
