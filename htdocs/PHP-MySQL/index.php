<?php  
$conn = mysqli_connect("localhost:3306", "root", "ghkd0729", "opentutorials");
$sql = "SELECT * FROM topic";
$result = mysqli_query($conn, $sql);
$list = '';
while($row = mysqli_fetch_array($result)){
    $escape_title = htmlspecialchars($row['title']);
    $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$escape_title}</a></li>";
}


$article = array(
    'title'=>'Welcome',
    'description'=>'Hello, web'
);
 
if(isset($_GET['id'])){
    $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM topic WHERE id={$filtered_id}";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $article['title'] = htmlspecialchars($row['title']); 
    $article['description'] = htmlspecialchars($row['description']);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WEB</title>
</head>
<body>
    <h1><a href="index.php">WEB</a></h1>
    <ol>
        <?=$list?>
    </ol>
    <a href="create.php">create</a>
    <h2><?=$article['title']?></h2>
    <?=$article['description']?>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum quod dolorum ratione sunt necessitatibus. A eum atque libero nostrum cumque, iure nobis magni perspiciatis delectus natus corrupti consequuntur dolorum fugit!
</body>
</html>