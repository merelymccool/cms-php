$(document).ready(function(){

  var user_href;
  var user_href_split;
  var user_id;
  var image_src;
  var image_src_split;
  var image_id;
  var photo_id;

 $(".modal_thumbnails").click(function(){
   $("#set_user_image").prop('disabled', false);

   user_href = $("#user-id").prop('href');
   user_href_split = user_href.split("=");
   user_id = user_href_split[user_href_split.length -1];

   image_src = $(this).prop('src');
   image_src_split = image_src.split("/");
   image_id = image_src_split[image_src_split.length -1];

   photo_id = $(this).attr('data');
   $.ajax({
    url: "includes/ajax_code.php",
    data:{photo_id: photo_id},
    type: "POST",
    success:function(data){
      if(!data.error){
        $("#modal_sidebar").html(data);
      }
    }
  })
 });

 $("#set_user_image").click(function(){
  $.ajax({
    url: "includes/ajax_code.php",
    data:{image_id: image_id, user_id: user_id},
    type: "POST",
    success:function(data){
      if(!data.error){
        location.reload(true);
      }
    }
  })
 })

 $(".info-box-header").click(function() {
   $('.inside').slideToggle("fast");

   $("#toggle").toggleClass("glyphicon glyphicon-menu-down pull-right, glyphicon glyphicon-menu-up pull-right")
 })

$(".delete-link").click(function() {
  confirm("Are you sure you want to delete this?");
})

  // tinymce.init({
  //   selector: 'textarea',
  //   plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
  //   toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
  //   toolbar_mode: 'floating',
  //   tinycomments_mode: 'embedded',
  //   tinycomments_author: 'Author name',
  // });
});