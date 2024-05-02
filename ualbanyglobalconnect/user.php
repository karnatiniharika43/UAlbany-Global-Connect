<div class="Friends">

<?php
        $image = "images/male.png";
        if($FRIEND_ROW['gender'] == "Female") 
        {
             $image = "images/female.png";
        }
?>
    <img class="Friends_img" src="<?php echo $image ?>">
    <br>
   
    
    <?php echo $FRIEND_ROW['First_name'] . " " .  $FRIEND_ROW['Last_name']; ?>

</div>


                
