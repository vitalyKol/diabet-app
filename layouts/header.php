<?php
$links = [
        ['dayshow.php', 'Day'],
        ['calendarshow.php', 'Calendar'],
        ['#', 'Statistics'],
        ['#', 'Profile']
];
preg_match('#.+?\.php#', $_SERVER['REQUEST_URI'], $str);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4">Diabet App</span>
        </a>

        <ul class="nav nav-pills">
            <?php
                foreach ($links as $link){
                    if($str[0] == ('/' . $link[0])){
                        echo "<li class=\"nav-item\"><a href=\"$link[0]\" class=\"nav-link active\" aria-current=\"page\">$link[1]</a></li>";
                    }else{
                        echo "<li class=\"nav-item\"><a href=\"$link[0]\" class=\"nav-link\" aria-current=\"page\">$link[1]</a></li>";
                    }

                }
            ?>
        </ul>
    </header>
</div>
