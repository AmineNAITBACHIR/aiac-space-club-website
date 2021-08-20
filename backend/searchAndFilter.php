<?php
//include categoryclass+create newObject
session_start();
include('../backend/categoryClass.php');
$category = $_POST['category'];

print_r($_SESSION);




if(isset($_POST['textSearched'])){
    $searchedText=$_POST['textSearched'];

    if(isset($_SESSION['filter'][$category])){
        echo('am in search and filter :');
        MYCATEGORY::getSearchedAndFilteredItemsByOrder($category,$searchedText,$_SESSION['filter'][$category]);
        print_r($_SESSION[$category]->fetch());

    }


    else{
        echo('am in search :------------------------------------ ');
        MYCATEGORY::getSearchedItemsByOrder($category,$searchedText);
        
        echo ('----------After-------------------------'); 
        print_r($_SESSION[$category]);
  
    }

}

//else ==Post Filter
else{
    echo 'am in filter';
    echo $_POST;

//obtainsAllCategoriesin filter+addItemsToFilter+filter


}
header('Location:/tests/aiac_space_club_website/views/test.php')

?>
