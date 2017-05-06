<?php
if (isset($_FILES['img'])) {
    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
    $uploadedFile = $_FILES['img']['tmp_name'];
    $fileType = finfo_file($fileInfo, $uploadedFile);
    if (strpos($fileType, 'image') !== false) {
        echo "file is an image";
    } else {
        echo "File is not a fucking image you asshole";
    }
}
?>
<html>
    <form action ="test.php" method="post" enctype="multipart/form-data">
        <input type='file' name='img'>
        <input type='submit' value = 'Upload'>
    </form>
</html>