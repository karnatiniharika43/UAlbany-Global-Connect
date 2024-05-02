<div id="post">
    <div>

    <?php
        $image = "images/male.png";
        if($ROW_USER['gender'] == "Female") 
        {
             $image = "images/female.png";
        }
    ?>

    
<img src="<?php echo $image ?>" />

    </div>

    <div>
        <div id="post_text">
            <?php echo $ROW_USER['First_name'] . " " .$ROW_USER['Last_name']; ?>
            </div>
        <?php echo $ROW['post']; ?>

        <br/><br/>
        
        <a href="">like</a>  . <a href="">comment</a> . 
        
        <span style="color: #999;">

            <?php echo $ROW['date'] ?>
    
        </span>
    </div>
</div>
