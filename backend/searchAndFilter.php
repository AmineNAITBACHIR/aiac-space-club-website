<?php
//include categoryclass+create newObject
session_start();
include('../backend/categoryClass.php');
$category = $_POST['category'];
echo 'Before:';

print_r($_SESSION['filter'][$category]);
echo '</br>--------------------------------------</br>';




if (isset($_POST['textSearched'])) {
    $searchedText = $_POST['textSearched'];

    if (isset($_SESSION['filter'][$category])) {
        echo ('am in search and filter :');
        MYCATEGORY::getSearchedAndFilteredItemsByOrder($category, $searchedText);
        print_r($_SESSION[$category]->fetch());
    } else {
        echo ('am in search :------------------------------------ ');
        MYCATEGORY::getSearchedItemsByOrder($category, $searchedText);

        echo ('----------After-------------------------');
        print_r($_SESSION[$category]);
    }
}

//else ==Post Filter
else {
    //check if $_SESSION['filter'][$category] exist if not initialize it
    //check if the item is already in ,$_SESSION['filter'][$category]
    //if yes    : remove it from session -> get array with the new filter
    //if No : add it from session ->get array with the new filter
    echo 'am in filter </br>';
    echo 'Post : ' . $_POST['categorySelected'];
    echo '</br>--------------------------------------</br>';


    if (!isset($_SESSION['filter'][$category])) {
        $_SESSION['filter'][$category] = array();
        $_SESSION['filter'][$category] = array_diff([$_POST['categorySelected']], $_SESSION['filter'][$category]);

    } else {

        if (in_array($_POST['categorySelected'], $_SESSION['filter'][$category])) {
            $_SESSION['filter'][$category] = array_diff($_SESSION['filter'][$category], [$_POST['categorySelected']]);
        } else {
            array_push($_SESSION['filter'][$category], $_POST['categorySelected']);
        }
    }
    echo 'After:';

    print_r($_SESSION['filter'][$category]);


    MYCATEGORY::getFilteredItemsByOrder($category);
}

//header('Location:/tests/aiac_space_club_website/views/test.php')
