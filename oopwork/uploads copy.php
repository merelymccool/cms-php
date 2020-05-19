<?php 
if(isset($_POST['upload'])) {
    $upload_errors = array(
        UPLOAD_ERR_OK         => "There is no error.",
        UPLOAD_ERR_INI_SIZE   => "The uploaded file exceeds the upload_max_filesize directive.",
        UPLOAD_ERR_FORM_SIZE  => "The uploaded file exceeds the MAX_FILE_SIZE directive.",
        UPLOAD_ERR_PARTIAL    => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE    => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE => "Failed to write to disk.",
        UPLOAD_ERR_EXTENSION  => "A PHP entension stopped the file upload.",
    );

    $tmp_name = $_FILES['file_upload']['tmp_name'];
    $name = $_FILES['file_upload']['name'];
    $dir = "uploads";

    if(move_uploaded_file($tmp_name, $dir . "/" . $name)) {
        $message = "File uploaded successfully.";
    } else {
        $error = $_FILES['file_upload']['error'];
        $message = $upload_errors[$error];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Uploads</title>
</head>
<body>

    <h2>
    <?php 
    if(!empty($upload_errors)) {
        echo $message;
    }
    ?>
    </h2>

    <form action="uploads.php" enctype="multipart/form-data" method="post">
        <input type="file" name="file_upload">

        <input type="submit" name="upload" value="Upload">
    </form>

</body>
</html>