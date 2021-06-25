<?php 
require('lib/print.php');
require('view/top.php');
?>
    <a href="create.php">create</a>
    <?php if(isset($_GET['id'])){ ?>
        <a href="update.php?id=<?=$_GET['id']?>">update</a>
    <?php } ?>

    <h2>
    <?php 
         print_title();
        ?>
    </h2>
    <?php 
    print_description();
    ?>

    <form action="update_process.php" method="post">
        <input type="hidden" name="old_title" value="<?=$_GET['id'] ?>">
            <p>
                <input type="text" name="title" placeholder="Tile" value="<?=print_title();?>">
            </p>
            <p>
                <textarea name="description" placeholder="description"> <?=print_description(); ?> 
                </textarea>
            </p>
            <input type="submit">
    </form>
<?php  
require('view/bottom.php');
?>