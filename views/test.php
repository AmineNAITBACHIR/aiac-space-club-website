<?php
session_start();
//get all the items
require_once('../backend/categoryClass.php');

$category = 'news';






if (!isset($_SESSION[$category])) {

    MYCATEGORY::getAllItemsByOrder($category);
}


?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>

<body>

    <form action="../backend/searchAndFilter.php" method="POST">

        <input type="text" name='textSearched' placeholder="search for.......">

        <input type="hidden" name="category" value="news">
        <input type="submit" value="search">



    </form>
    <div class="pill-container">
        <?php
        //get all categories

        $categories = MYCATEGORY::getAllCategories($category);
        foreach ($categories as $myCategory) {

        ?>

            <form action="../backend/searchAndFilter.php"  method="POST">
                <?php
                if (in_array($myCategory, $_SESSION['filter'][$category])){

         
                 ?>
                
                <input type="checkbox"  name="selector" value="<?php echo $myCategory ?>" onChange='submit();' checked>
                <?php  } else{?>
                    <input type="checkbox"  name="selector" value="<?php echo $myCategory ?>" onChange='submit();'>
                

                <?php } ?>
           
                <input type="hidden" name="categorySelected" value="<?php echo $myCategory ?>">
                <label><?php echo $myCategory ?></label>
                <input type="hidden" name="category" value="news">
            </form>
        <?php } ?>





    </div>
 








    <?php
    $items = $_SESSION[$category];
    require_once('../backend/categoryClass.php');
    require_once('../backend/itemClass.php');
    foreach ($items as $itemArray) {


        $item = new ITEM($category, $itemArray);
    ?>

        <table>


            <ul>
                <tr>
                    <?php $item->getTitle() ?>

                </tr>
                <tr>
                    <th>
                        <img src=" <?php $item->getIcon() ?>" style="width=20 ; height=20;" alt="">



                    </th>
                    <th>
                        <?php $item->getFirstLines() ?>

                    </th>

                </tr>
                <tr>
                    <?php $item->getDateTime() ?>
                    <?php $item->getTheme() ?>


                </tr>




            </ul>



        </table>
    <?php } ?>




</body>

</html>