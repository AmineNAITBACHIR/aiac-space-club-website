<form action="../backend/searchAndFilter.php">
        <?php
        //get all categories

        $categories = MYCATEGORY::getAllCategories($category);
        foreach ($categories as $myCategory) {

        ?>
        

            <input type="checkbox" name="<?php echo $myCategory ?>" value="<?php echo $myCategory ?>">
            <label for="<?php echo $myCategory ?>"><?php echo $myCategory ?></label>



        <?php } ?>

        <input type="hidden" name="category" value="news">
        <input type="submit" value="Filter">
    </form>