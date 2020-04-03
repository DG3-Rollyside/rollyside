<!DOCTYPE html>
<html>

<head>

</head>

<body>
    

    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select featured image to upload:
        <input type="file" name="fileToUpload" id="featured">
        Select multiple images to upload:
        <input type="file" name="bulkImg[]" multiple>
        <input type="submit" value="Upload Image" name="submit">
    </form>



</body>

</html>