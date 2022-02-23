<?php


function show($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

function get_var($key)
{
    if (isset($_POST[$key])) {
        return $_POST[$key];
    }
    return "";
}

function get_date($date)
{

    return date("jS F, Y", strtotime($date));
}

function view_path($view)
{
    return '../app/views/' . $view . '.view.php';
}

function has_taken_test($test_id)
{

    return false;
}
