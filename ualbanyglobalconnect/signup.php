<?php
include("classes/connect.php");
include("classes/signup.php");

$first_name = "";
$last_name = "";
$gender = "";
$email = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if POST data is set
    if(isset($_POST["first_name"])) {
        $first_name = $_POST["first_name"];
    }
    if(isset($_POST["last_name"])) {
        $last_name = $_POST["last_name"];
    }
    if(isset($_POST["gender"])) {
        $gender = $_POST["gender"];
    }
    if(isset($_POST["email"])) {
        $email = $_POST["email"];
    }

    $signup = new SignUp();
    $result = $signup->evaluate($_POST);

    if($result != "") {
        echo "<div style='text-align:center;font-size:12px;color:black;background-color:grey;'>";
        echo "<br>The following errors took place:<br><br>";
        echo $result;
        echo "</div>";
    } else {
        header("Location: login.php");
        die;
    }
}
?>

<html>
<head>
    <title>ualbanyglobalconnect | SignUp</title>
</head>
<style>
    /* Your CSS styles here */
</style>
<body style="font-family: Verdana, Geneva, Tahoma, sans-serifo;background-color: #e9abee;">
<div id="bar">
    <div style="font-size: 35px;">ualbanyglobalconnect</div>
    <div id="SignUp_button">Log in</div>
</div>
<div id="bar2">
    Sign Up to ualbanyglobalconnect<br><br>
    <form method="post" action="">
        <input value= "<?php echo $first_name ?>" name="first_name" type="text" id="text" placeholder="First name"><br><br>
        <input value= "<?php echo $last_name ?>" name="last_name" type="text" id="text" placeholder="Last name"><br><br>
        <span style="font-weight: normal;">Gender:</span><br>
        <select id="text" name="gender">
            <option value="Male" <?php if ($gender == "Male") echo "selected"; ?>>Male</option>
            <option value="Female" <?php if ($gender == "Female") echo "selected"; ?>>Female</option>
        </select>
        <br><br>
        <input value= "<?php echo $email ?>" name="email" type="text" id="text" placeholder="Email"><br><br>
        <input name="password" type="password" id="text" placeholder="password"><br><br>
        <input name="password2" type="password" id="text" placeholder="Retype password"><br><br>
        <input type="submit" id="button" value="SignUp">
        <br><br>
    </form>
</div>
</body>
</html>
