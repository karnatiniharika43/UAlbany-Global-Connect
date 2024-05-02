<?php
    session_start();
    include("classes/connect.php");
    include("classes/login.php");

    $email = "";
    $password = "";
    
    
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $login = new Login(); // Instantiate Login object
        $result = $login->evaluate($_POST);
 

        if($result != "")
        {
            echo "<div style='text-align:center;font-size:12px;color:black;background-color:grey;'>";
            echo "<br>The following errors took place:<br><br>";
            echo $result;
            echo "</div>";
        }
        else 
        {
            header("Location: profile.php");
            die;
        }

        $email = $_POST['email'];
        $password = $_POST['password'];   
    }
?>

<html>
    <head>
        <title>ualbanyglobalconnect | Log in</title>
    </head>
    <style>
        #bar {
            height:100px;
            background-color: #CC5801;
            color: black;
            font-size: 42px;
            padding: 4px;
        }
        
        #SignUp_button {
            background-color: blueviolet;
            width: 150px;
            text-align: center;
            padding: 2px;
            border-radius: 25px;
            float: right;
        }

        #bar2 {
            background-color: aliceblue;
            width: 600px;
            margin:auto;
            margin-top: 30px;
            padding:10px;
            padding-top: 50px;
            text-align: center;
            font-weight: bold;
        }

        #text {
            height: 40px;
            width: 300px;
            border-radius: 4px;
            border:solid;
            padding: 4px;
            font-size: 14px;
        }

        #button {
            width: 300px;
            height: 40px;
            border-radius: 4px;
            border: none;
            background-color: #CC5801;
            color: black;
        }
    </style>
    <body style="font-family: Verdana, Geneva, Tahoma, sans-serifo;background-color: #e9abee;">
        <div id="bar">
            <div style="font-size: 35px;">ualbanyglobalconnect</div>
            <div id="SignUp_button">SignUp</div>
        </div>
        <div id="bar2">
            <form method="post" > 
                Log in to ualbanyglobalconnect<br><br>
                <input value="<?php echo $email ?>" type="text" id="text" name="email" placeholder="Email"><br><br>
                <input value="<?php echo $password ?>" type="password" id="text" name="password" placeholder="password"><br><br>
                <input type="submit" id="button" value="Login">
                <br><br>
            </form>
        </div>
    </body>
</html>
