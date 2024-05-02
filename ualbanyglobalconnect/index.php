<?php

session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/User.php");
include("classes/Post.php");


$login = new Login();
$user_data = $login->check_login($_SESSION['ualbanyglobalconnect_userid']);

?>
<!DOCTYPE html>
<html>
<head>
    <title>ualbanyglobalconnect | profile</title>
    <style>
        /* Styling for the header */
        #blue_bar {
            height: 50px;
            background-color: #CC5801;
            color: black;
        }

        #search_box {
            width: 400px;
            height: 20px;
            border-radius: 5px;
            padding: 4px;
            font-size: 14px;
            background-image: url(search.png);
            background-repeat: no-repeat;
            background-position: right;
        }

        #profile_pic {
            width: 150px;
            border-radius: 50%;
            border: solid 2px white;
        }

        /* Styling for the menu buttons */
        .menu-buttons {
            width: 100px;
            display: inline-block;
            margin: 2px;
        }

        /* Styling for the friends list */
        .Friends_img {
            width: 45px;
            float: right;
            margin: 8px;
        }

        #Friends_bar {
            min-height: 900px;
            margin-top: 20px;
            color: #aaa;
            padding: 8px;
            text-align: center;
            font-size: 20px;
            color: #CC5801;
        }

        .Friends {
            clear: both;
            font-size: 8px;
            font-weight: bold;
            color: #CC5801;
        }

        /* Styling for the text area and post button */
        textarea {
            width: 100%;
            border: none;
            font-family: tahoma;
            font-size: 12px;
            height: 70px;
        }

        #post_button {
            float: right;
            background-color: #cb410b;
            border: none;
            color: whitesmoke;
            padding: 4px;
            font-size: 14px;
            border-radius: 2px;
            width: 50px;
        }

        /* Styling for the post bar */
        #post_bar {
            margin-top: 20px;
            background-color: whitesmoke;
            padding: 10px;
        }

        /* Styling for individual posts */
        #post {
            padding: 4px;
            font-size: 13px;
            display: flex;
            margin-bottom: 20px;
        }

        #post img {
            width: 75px;
            margin-right: 4px;
        }

        #post_text {
            font-weight: bold;
            color: #CC5801;
        }
    </style>
</head>
<body style="font-family: tahoma; background-color: #ffdab9;">


<?php include("header.php"); ?>

    <!-- Main Content -->
    <div style="width: 500px; margin: auto; min-height: 290px;">
        <!-- Profile Information -->
        <div style="background-color: white; text-align: center; color: #CC5801;">
            <img src="cover.png" style="width: 80%;">
            <img id="profile_pic" src="niharika.png">
            <br>
            <div style="font-size: 25px;">Niharika Karnati</div>
            <br>
            <div class="menu-buttons">Timeline</div>
            <div class="menu-buttons">About</div>
            <div class="menu-buttons">Friends</div>
            <div class="menu-buttons">Photos</div> 
            <div class="menu-buttons">Settings</div>
        </div>

        <!-- Main Content Layout -->
        <div style="display: flex;">
            <!-- Left Content Area -->
            <div style="min-height: 400px; flex: 1;"></div>

            <!-- Friends List -->
            <div id="Friends_bar">

                <img src="niharika.png" id="profile_pic"><br>
                
                <a href="profile.php">
                <?php echo $user_data['First_name'] . "<br>" .$user_data['Last_name'] ?>
                </a>
                
            </div>

            <!-- Right Content Area -->
            <div style="min-height: 400px; flex: 2.5;padding: 20px;padding-right: 0px;">
                <div style="border:solid thin #aaa; padding: 10px;">
                    <textarea placeholder="Kindly don't hesitate to express your ideas"></textarea>
                    <input id="post_button" type="submit" value="post">
                    <br>
                </div>

                <!-- Post Bar -->
                <div id="post_bar">
                    <div id="post 1">
                        <div>
                            <img src="user1.png">
                        </div>
                        <div>
                            <div id="post_text">Rose</div>
                            Greetings to the upcoming class of fall 2024. We are thrilled to have you here. 
                            <br/><br/>
                            
                            <a href="">like</a>  . <a href="">comment</a> . <span style="color: #999;">april 28 2024</span>
                        </div>
                    </div>
                </div>
                <div id="post_bar">
                    <div id="post 2">
                        <div>
                            <img src="user2.png">
                        </div>
                        <div>
                            <div id="post_text">Clarie</div>
                            
                            Find your home away from home and your circle of friends in a foreign land. Welcome to a place where accommodation is more than just a roof over your head; it's a community waiting to embrace you. Discover comfort, connections, and companionship as you embark on your journey as an international student.
                            <br/><br/>
                            
                            <a href="">like</a>  . <a href="">comment</a> . <span style="color: #999;">april 28 2024</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
