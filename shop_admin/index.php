<?php
    include_once('database.php');
    include_once('function_category.php');
    $action = filter_input(INPUT_POST,'action');
    if(empty($action))
    {
        $action = filter_input(INPUT_GET,'action');
        if(empty($action))
        {
            $action = 'login_system';
        }
    }

    switch($action)
    {
        case 'login_system':
        include_once('login.php');
        break;
        case 'check_login_system':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        if(check_user($username,$password))
        {
            include_once('list_category.php');
        }   
        break;  
        break;
        case 'list_category':
        include_once('list_category.php');
        break;
        case 'add_new_category':
            include_once('add_category.php');
            break;
        case 'save_new_category':
            $categoryname = filter_input(INPUT_POST, 'categoryname');
            $description = filter_input(INPUT_POST, 'description');
            $by_user = filter_input(INPUT_POST, 'by_user');
            add_category($categoryname, $description, $by_user);
            include_once('list_category.php');
            break;
        case 'edit_category':
            $categoryid = filter_input(INPUT_GET, 'categoryid');
            $category = get_category_by_id($categoryid);
            include_once('edit_category.php');
            break;
        case 'update_category':
            $categoryname = filter_input(INPUT_POST, 'categoryname');
            $description = filter_input(INPUT_POST, 'description');
            $by_user = filter_input(INPUT_POST, 'by_user');
            $categoryid = filter_input(INPUT_GET, 'categoryid');
            update_category($categoryid,$categoryname, $description, $by_user);
            include_once('list_category.php');
            break;
        case 'delete_category':
            $categoryid = filter_input(INPUT_GET, 'categoryid');
            delete_category_by_id($categoryid);
            include_once('list_category.php');
            break;
    }


?>
