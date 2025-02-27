<!-- <?php
include('config.php');

if(isset($_POST['delete'])){

    $id =$_POST['id'];
    $image = $_POST['image'];
    $delete_image_query= "DELETE FROM IMAGES WHERE id='$id'";
    $delete_image_query_run = mysqli_query($conn, delete_image_query);

    if($delete_image_query_run)
    {
        unlink("images/".$image);
        $_SESSION['status'] = "Image deleted successfully!";
        header('location:upload.php');
    }
    else{
        $_SESSION['status'] = "Image not deleted";
        header('location : upload.php');
    }
}



?> -->

<?php
include('config.php');
session_start(); // Start the session for status messages

if(isset($_POST['Delete'])) {
    $id = $_POST['id'];
    $image = $_POST['image'];

    // Query to delete the image from the database
    $delete_image_query = "DELETE FROM images WHERE id='$id'";
    $delete_image_query_run = mysqli_query($conn, $delete_image_query);

    if($delete_image_query_run) {
        // Delete the actual image file from the folder
        if(file_exists("Images/".$image)) {
            unlink("Images/".$image);
        }

        $_SESSION['status'] = "Image deleted successfully!";
    } else {
        $_SESSION['status'] = "Image not deleted!";
    }

    // Redirect to the upload page
    header('Location: upload.php');
    exit();
}
?>
