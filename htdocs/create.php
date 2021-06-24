<?php 
 function print_title(){
    if(isset($_GET['id'])){
        echo $_GET['id'];
    }else{
        echo "Welcome";
    }
 }
?>

<?php 
 function print_list(){
    $list=scandir('./data');
 $i = 0;
 while($i < count($list)){
     if($list[$i] != '.'){
         if($list[$i] != '..'){
             echo "<li><a href=\"index.php?id=$list[$i]\">$list[$i]</a></li>\n";
         }
     }
     $i = $i + 1;
 }
 }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        <?php 
         print_title();
        ?>
        </title>
</head>
<body>
    <h1><a href = "index.php">WEB</a></h1>
    <ol>
    <?php 
        print_list();
    ?>
    </ol>
    <a href="create.php">create</a>
    <form action="create_process.php" method="post">
        <p>
            <input type="text" name="title" placeholder="Tile">
        </p>
        <p>
            <textarea name="description" placeholder="Title"></textarea>
        </p>
        <input type="submit">
    </form>
</body>
</html>