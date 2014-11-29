<?php



if(!isset($action))
    $action = 'select';


switch ($action)
{
    case 'insert':
        //echo getcwd();
        include_once '../modules/Application/src/forms/timelineForm.php';
        include_once '../modules/Application/src/drawForm.php';
        
        echo drawForm($timeline_form, 'action.php');
        echo "esto es insert";
    break;
    case 'update':
        echo "esto es update";
        break;
    case 'select':
        
        echo "esto es select";
    break;
    case 'delete':
        echo "esto es delete";
        break;
}