<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Array</h1>
    <?php 
    $WDJ=array('2yubi', 'Kassy', 'yechan', 'hyeonjong');
    echo $WDJ[1].'<br>';
    echo $WDJ[2].'<br>';
    echo $WDJ[3].'<br>';
    var_dump (count($WDJ));
    array_push($WDJ, 'jinhong');
    var_dump($WDJ);
    ?>
    
</body>
</html>