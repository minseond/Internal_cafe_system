<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메뉴 이미지 업로드 폼</title>
</head>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="image">이미지 선택:</label>
    <input type="file" name="image" id="image">
    <input type="submit" value="업로드">
</form>

</body>
</html>