<?php
require_once('libraries/Renderer.php');
?>
<?php


if(@$_SERVER['user_data']['id'] == 1)
{      
        foreach($images as $image){
    ?>
            
        <img src="../Uploads/<?= $image ?>" width="50px">
     <?php
        }
    ?>
    <h1><?= $product['name'] ?></h1>

    <form action="<?= $product['id'] ?>/update" method="post">  
        <input type="hidden" name="id" value="<?= $product['id'] ?>"/>          
        <button class="#" type="submit" name="updateProduct">Update</button>
    </form>
 <?php

} 
else
{
        foreach($images as $image){
        ?>         
            <img src="../Uploads/<?= $image ?>" width="50px">
        <?php
        }
    ?>
    <h1><?= $product['name'] ?></h1>

    <?php

    if ( isset ( $_SESSION['user_data']))
    {
    ?>
        <form action="" method="post">  
            <select name="product_quantity" id="product_quantity">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <input type="hidden" name="id_Product" value="<?= $product['id'] ?>">
            <button class="#" type="submit" name="addBag">Add</button>
        </form>
    <?php
    }
    ?>
<section class="sectionComments"> 
    
    <?php
        foreach ( $allComments as $comment)
        {
    ?>
        <article>
            <p>Posté par : <?= $comment['prenom'] ?> le : <?= $comment['datefr'] ?> à <?= $comment['heurefr'] ?></p>
            <p><?= $comment['comment'] ?></p>

            <?php
            $i = 0;
            while ( $i < $comment['note']){
            ?>
                <label for="">★</label>

            <?php
            $i++;
            }
            ?>

        </article>
    <?php
        }
            if ( isset ( $_SESSION['user_data']))
        {    
    ?>

    <form action="" method="post">
        
        <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Add a comment"></textarea><br>
        <input type="hidden" value="<?= $product['id'] ?>" name="id_product">
        <?= $errorComment ?><br>

        <span>Notez le produit</span>
        <div class="rating">
            <input id="star5" name="star" type="radio" value="5" class="radio-btn hide" />
            <label for="star5" >☆</label>
            <input id="star4" name="star" type="radio" value="4" class="radio-btn hide" />
            <label for="star4" >☆</label>
            <input id="star3" name="star" type="radio" value="3" class="radio-btn hide" />
            <label for="star3" >☆</label>
            <input id="star2" name="star" type="radio" value="2" class="radio-btn hide" />
            <label for="star2" >☆</label>
            <input id="star1" name="star" type="radio" value="1" class="radio-btn hide" />
            <label for="star1" >☆</label>
        </div>

        <input type="submit" name="addComment" id="addComment" value="Comment">
    </form>
    </section>
    <?php
    } else {
    ?>
        <p>Veuillez vous <a href="<?= url ?>users/register">inscrire</a> / <a href="<?= url ?>users/login">connectez</a> pour ajouter un commentaire</p>
    <?php 
    }
}


       
         
