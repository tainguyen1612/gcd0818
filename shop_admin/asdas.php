<?php
    include_once('database.php');
    include_once('function_category.php');
    include_once('function_user.php');
    include_once('function_product.php');
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
        case 'list_category':
            include_once('list_category.php');
            break;
        case 'check_login_system':
            $username = filter_input(INPUT_POST, 'username');
            $password = filter_input(INPUT_POST, 'password');
            if(check_user($username,$password))
            {   
                if(($username=="admin")&&($password=="admin"))
                {
                    include_once('list_category.php');
                }
                if(($username=="admin1")&&($password=="admin1"))
                {
                    include_once('adminPage.php');
                }
                
            }   
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

    //comtrol for product
    switch ($action) {
        case 'add_new_product':
            include_once('add_product.php');
            break;
        case 'save_new_product':
            if($_FILES){
                //get file name
                $name = $_FILES['file_image']['name'];
                $name = "img/product/".$name;
                //movefile
                move_uploaded_file($_FILES['file_image']['tmp_name'], $name);
                // get file
                $image = $_FILES['file_image']['name'];
            } 
            else
            {
                $image = '';
            }
            $productname = filter_input(INPUT_POST, 'productname');
            $categoryid = filter_input(INPUT_POST, 'categoryid');
            $price = filter_input(INPUT_POST, 'price');
            $description = filter_input(INPUT_POST, 'description');
            $by_user = filter_input(INPUT_POST, 'by_user');
            add_product($productname,$categoryid,$price, $description,$image, $by_user);
            
            $product = get_product();
            include_once('list_product.php');

            break;
            case 'list_product':
                $product = get_product();
                include_once('list_product.php');
                break;
            break;
            case 'edit_product':
                $productid = filter_input(INPUT_GET, 'productid');
                $product = get_product_by_id($productid);
                include_once('edit_product.php');
                break;
            case 'update_product':
                if($_FILES){
                //get file name
                $name = $_FILES['file_image']['name'];
                $name = "img/product/".$name;
                //movefile
                move_uploaded_file($_FILES['file_image']['tmp_name'], $name);
                // get file
                $image = $_FILES['file_image']['name'];
            } 
            else
            {
                $image = '';
            }
            $productid = filter_input(INPUT_POST, 'productid');
            $productname = filter_input(INPUT_POST, 'productname');
            $categoryid = filter_input(INPUT_POST, 'categoryid');
            $price = filter_input(INPUT_POST, 'price');
            $description = filter_input(INPUT_POST, 'description');
            $by_user = filter_input(INPUT_POST, 'by_user');
            update_product($productid,$productname,$categoryid,$price, $description,$image, $by_user);
            
            $product = get_product();
            include_once('list_product.php');
            break;
            case 'delete_product':
            $productid = filter_input(INPUT_GET, 'productid');
            delete_product_by_id($productid);
            $product = get_product();
            include_once('list_product.php');
            break;
        
    }
?>
