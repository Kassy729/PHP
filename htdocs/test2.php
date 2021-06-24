<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <li><a href="index.php?name=HTML">html</a></li>
    <li><a href="index.php?id=CSS">css</a></li>
    <li><a href="index.php?id=JavaScript">javascript</a></li>

    <?php 
     echo $_GET['name'];?>;이고 
     <?php 
      echo $_GET['address'];?>삽니다
    
    
</body>
</html>