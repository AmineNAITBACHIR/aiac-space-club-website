<?php
//include categoryclass

session_start();
include('../backend/categoryClass.php');
$category = $_POST['category'];



if (isset($_POST['textSearched'])) {
    $searchedText = $_POST['textSearched'];

    if (isset($_SESSION['filter'][$category]) && $_SESSION['filter'][$category] != array() ) {

        MYCATEGORY::getSearchedAndFilteredItemsByOrder($category, $searchedText);
    } else {

        MYCATEGORY::getSearchedItemsByOrder($category, $searchedText);
        print_r($_SESSION[$category]);
    }
}

//else ==Post Filter

else {

    //check if $_SESSION['filter'][$category] exist if not initialize it
    //check if the item is already in ,$_SESSION['filter'][$category]
    //if yes    : remove it from session -> get array with the new filter
    //if No : add it from session ->get array with the new filter

    //handle the case when we uncheck the  last value cad if array is empty

    if (!isset($_SESSION['filter'][$category])) {
        $_SESSION['filter'][$category] = array();
        $_SESSION['filter'][$category] = array_diff([$_POST['categorySelected']], $_SESSION['filter'][$category]);


    } 

    else {

        if (in_array($_POST['categorySelected'], $_SESSION['filter'][$category])) {
            $_SESSION['filter'][$category] = array_diff($_SESSION['filter'][$category], [$_POST['categorySelected']]);
        } 
        
        else {
            array_push($_SESSION['filter'][$category], $_POST['categorySelected']);
        }


    }


    if ($_SESSION['filter'][$category] == array()) {

        MYCATEGORY::getAllItemsByOrder($category);

    } 
    else {

        MYCATEGORY::getFilteredItemsByOrder($category);

    }
}

header('Location:/tests/space_club/views/test.php');
