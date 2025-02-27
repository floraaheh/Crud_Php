<?php
include('config.php');

if(isset($_POST['submit']) && isset($_FILES['images'])) {
    $file_names = $_FILES['images']['name'];
    $temp_names = $_FILES['images']['tmp_name'];

    
    if (!empty($file_names[0])) {
        foreach ($file_names as $key => $file_name) {
            $tempName = $temp_names[$key];
            $folder = 'Images/' . $file_name;

            $query = mysqli_query($conn, "INSERT INTO images (file) VALUES ('$file_name')");

       
            if(move_uploaded_file($tempName, $folder)){
                echo "<h2 class='success-msg'>File '$file_name' uploaded successfully</h2>";
            } else {
                echo "<h2 class='error-msg'>File '$file_name' not uploaded</h2>";
            }
        }
    } else {
        echo "<h2 class='error-msg'>No files selected for upload</h2>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple Image Upload</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            max-width: 500px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        h2 {
            color: #333;
        }
        .success-msg {
            color: green;
        }
        .error-msg {
            color: red;
        }
        input[type="file"] {
            margin: 10px 0;
            padding: 8px;
            width: 90%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #218838;
        }
        .delete-btn {
            background-color: #dc3545;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
        .image-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }
        .image-gallery img {
            width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Upload Multiple Images</h2>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="images[]" multiple required/>
        <br>
        <button type="submit" name="submit">Upload</button>
    </form>
</div>

<div class="container">
    <h2>Delete Image</h2>
    <form action="delete.php" method="post">
        <input type="number" name="id" placeholder="Enter Image ID" required>
        <button type="submit" name="Delete" class="delete-btn">Delete</button>
    </form>
</div>

<h2>Uploaded Images</h2>
<div class="image-gallery">
    <?php
    $res = mysqli_query($conn, "SELECT * FROM images");
    while($row = mysqli_fetch_assoc($res)) {
        echo '<img src="Images/' . $row['file'] . '" alt="Uploaded Image">';
    }
    ?>
</div>

</body>
</html>
