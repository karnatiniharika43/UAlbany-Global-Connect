<?php
session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/User.php");
include("classes/Post.php");


$login = new Login();
$user_data = $login->check_login($_SESSION['ualbanyglobalconnect_userid']);

echo "<pre>";
print_r($_GET);
echo "</pre>";


// Handle post submission
// posting starts here 
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $post = new Post();
    $id = $_SESSION['ualbanyglobalconnect_userid'];
    $result = $post->create_post($id, $_POST);

    if($result == "")
    {
        header("Location: profile.php");
        die;
    }else
    {
        echo "<div style='text-align:center;font-size:12px;color:black;background-color:grey;'>";
        echo "<br>The following errors took place:<br><br>";
        echo $result;
        echo "</div>";
    }
    
}

//collect posts 
$post = new Post();
$id = $_SESSION['ualbanyglobalconnect_userid'];

$posts = $post->get_posts($id);

//collect friends 
$user = new User();
$id = $_SESSION['ualbanyglobalconnect_userid'];

$friends = $user->get_friends($id);


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
            margin-top: -200px;
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
    <!-- Header -->
    <br>
    <?php include("header.php"); ?>

    <!-- Main Content -->
    <div style="width: 500px; margin: auto; min-height: 290px;">
        <!-- Profile Information -->
        <div style="background-color: white; text-align: center; color: #CC5801;">

        <?php

              $image = "";
              if(file_exists($user_data['profile_image'] ))
              {
                $image = $user_data['profile_image'];
              }


            ?>
            
        <img src="cover.png" style="width: 80%;">
            
            <span style = "font-size: 11px;">
            
                <img id="profile_pic" src="<?php echo $image ?>"><br/>
                
                <a style="text-decoration: none;color:#f0f;" href="change_profile_image.php?change=profile">change profile image</a>
                
            </span>
            <br>
            <div style="font-size: 25px;">Niharika Karnati</div>
            <br>
            <a href="index.php"><div class="menu-buttons">Timeline</div></a>
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
                Friends<br>

                <?php
                
                    if($friends)
                    {
                        foreach ($friends as $FRIEND_ROW) 
                        {
                            
                            include("user.php");

                        }
                    }
            
                     
                    
                ?>

                

                
            </div>

            <!-- Right Content Area -->
            <div style="min-height: 400px; flex: 2.5;padding: 20px;padding-right: 0px;">
                <div style="border:solid thin #aaa; padding: 10px;">
                <form method="post" action="">
                    <textarea name="post" placeholder="Enter your post content"></textarea>
                    <button type="submit">Submit</button>
                </form>
     
                </div>

                <!-- Post Bar -->
                <div id="post_bar">
                      

                <?php
                
                    if($posts)
                    {
                        foreach ($posts as $ROW) 
                        {
                            $user = new User();
                            $ROW_USER = $user->get_user($ROW['userid']);

                            include("post.php");

                        }
                    }
            
                     
                    
                ?>

                </div>
                
            </div>
        </div>
    </div>
</body>
</html>
