<?php


// echo "<pre>";
// print_r($_SERVER['REQUEST_URI']);
// echo "</pre>";

$data = explode('/',$_SERVER['REQUEST_URI']);

// echo "<pre>Data: ";
// print_r($data);
// echo "</pre>";


$controller = $data[1];
$action = $data[2];

switch($controller)
{
    case 'timeline':
        include ('../modules/Application/src/Application/controllers/timeline.php');
        break;
    default:
        include 'index.html';
    
}
