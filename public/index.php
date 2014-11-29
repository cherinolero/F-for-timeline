<?php


// echo "<pre>";
// print_r($_SERVER['REQUEST_URI']);
// echo "</pre>";

$data = explode('/',$_SERVER['REQUEST_URI']);

// echo "<pre>Data: ";
// print_r($data);
// echo "</pre>";

echo <<<END
<!DOCTYPE html>
<html>
    <head>
        <title>Test Bootstrap</title>
        <meta charset="utf-8">
        <base href="http://localhost" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    </head>
    <body>
        <div class="container">
END;

$controller = $data[1];
$action = $data[2];

$data = explode('/',$_SERVER['REQUEST_URI']);

echo "<pre>Data: ";
print_r($data);
echo "</pre>";


switch($controller)
{
    case 'timeline':
        include ('../modules/Application/src/Application/controllers/timeline.php');
        break;
    case 'ffortimeline':
        if ($action == 'action.php')
        {
            include ('../modules/Application/src/action.php');
        }
        break;        
    default:        
        include ('../modules/Application/src/Application/controllers/error.php');
        break;    
    
}

echo <<<END
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>
</html>
END;
