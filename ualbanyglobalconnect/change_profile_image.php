<?php
session_start();

// Include necessary files
include("classes/connect.php");
include("classes/login.php");
include("classes/User.php");
include("classes/Post.php");

// Check if user is logged in
$login = new Login();
$user_data = $login->check_login($_SESSION['ualbanyglobalconnect_userid']);

// Handle image upload
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
        // Check if the file type is JPEG
        if ($_FILES['file']['type'] == "image/jpeg" || $_FILES['file']['type'] == "image/jpg") {
            // Check if the file size is within the allowed limit (3 MB)
            $allowed_size = (1024 * 1024) * 3;
            if ($_FILES['file']['size'] < $allowed_size) {
                // Define upload directory and file path
                $upload_dir = "uploads/";
                $filename = $upload_dir . $_FILES['file']['name'];

                // Move uploaded file to designated directory
                if (move_uploaded_file($_FILES['file']['tmp_name'], $filename)) {
                    // Determine image change mode (profile or cover)
                    $change = isset($_GET['change']) ? $_GET['change'] : "profile";

                    // Update database based on change mode
                    $userid = $user_data['userid'];
                    $query = ($change == "cover") ? 
                        "UPDATE users SET cover_image = '$filename' WHERE userid = '$userid' LIMIT 1" :
                        "UPDATE users SET profile_image = '$filename' WHERE userid = '$userid' LIMIT 1";
                    
                    // Execute query
                    $DB = new Database();
                    $DB->save($query);

                    // Redirect to profile page after successful update
                    header("Location: profile.php");
                    exit;
                } else {
                    // Display error message if file upload fails
                    echo "<div style='text-align:center;font-size:12px;color:black;background-color:grey;'>";
                    echo "<br>The following errors took place:<br><br>";
                    echo "Failed to upload image. Please try again!";
                    echo "</div>";
                }
            } else {
                // Display error message if file size exceeds the allowed limit
                echo "<div style='text-align:center;font-size:12px;color:black;background-color:grey;'>";
                echo "<br>The following errors took place:<br><br>";
                echo "Only images of size 3 MB or lower are allowed!";
                echo "</div>"; 
            }
        } else {
            // Display error message if file type is not JPEG
            echo "<div style='text-align:center;font-size:12px;color:black;background-color:grey;'>";
            echo "<br>The following errors took place:<br><br>";
            echo "Only images of JPEG type are allowed!";
            echo "</div>"; 
        }
    } else {
        // Display error message if no file selected
        echo "<div style='text-align:center;font-size:12px;color:black;background-color:grey;'>";
        echo "<br>The following errors took place:<br><br>";
        echo "Please select an image to upload!";
        echo "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ualbanyglobalconnect | Change Profile Image</title>
    <!-- CSS styles -->
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body style="font-family: tahoma; background-color: #ffdab9;">
    <!-- Include header -->
    <?php include("header.php"); ?>

    <!-- Main Content -->
    <div style="width: 500px; margin: auto; min-height: 290px;">
        <!-- Profile Information -->
        <!-- Your profile information here -->

        <!-- Main Content Layout -->
        <div style="display: flex;">
            <!-- Right Content Area -->
            <div style="min-height: 400px; flex: 2.5;padding: 20px;padding-right: 0px;">
                <form method="post" enctype="multipart/form-data">
                    <div style="border:solid thin #aaa; padding: 10px;">
                        <input type="file" name="file"><br>
                        <input id="post_button" type="submit" value="Change">
                        <br>



                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
