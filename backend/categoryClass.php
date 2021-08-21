<?php


class MYCATEGORY
{

    public $category;
    //Methods
    function __construct($category)
    {
        $this->category = $category;
    }

    public  static function getAllItemsByOrder($category)
    {
        include('../dB/config.php');
        //store all the records in this array

        $request = $db->query('SELECT * FROM ' . $category . ' ORDER BY dateTime DESC; ');
        $_SESSION[$category] = array();
        while ($response = $request->fetch()) {
            array_push($_SESSION[$category], $response);
        }
    }
    public static function getTupleCategories($category)
    {

        $tupleCategories = '(';
        foreach ($_SESSION['filter'][$category] as $myCategory) {

            if ($myCategory == end($_SESSION['filter'][$category])) {
                $tupleCategories = $tupleCategories . "'" . $myCategory . "')";
            } else {
                $tupleCategories = $tupleCategories . "'" . $myCategory . "' , ";
            }
        }




        return ($tupleCategories);
    }

    public static function getFilteredItemsByOrder($category)
    {

        include('../dB/config.php');

        $tupleCategories = MYCATEGORY::getTupleCategories($category);

        $query = 'SELECT * FROM ' . $category . ' WHERE category IN ' . $tupleCategories . ' ORDER BY dateTime DESC; ';
        $request = $db->query($query);


        $_SESSION[$category] = array();
        while ($response = $request->fetch()) {
            array_push($_SESSION[$category], $response);
        }
    }
    public static function getSearchedItemsByOrder($category, $searchText)
    {
        include('../dB/config.php');
        //store all the records in this array

        $request = $db->query('SELECT * FROM ' . $category . ' WHERE title LIKE \'%' . $searchText . '%\' OR text LIKE \'%' . $searchText . '%\'  ORDER BY dateTime DESC; ');
        $_SESSION[$category] = array();
        while ($response = $request->fetch()) {
            array_push($_SESSION[$category], $response);
        }
    }
    public static function getSearchedAndFilteredItemsByOrder($category, $searchText)
    {


        include('../dB/config.php');
        $tupleCategories = MYCATEGORY::getTupleCategories($category);

        $query = 'SELECT * FROM ' . $category . ' WHERE ( title LIKE \'%' . $searchText . '%\' OR text LIKE \'%' . $searchText . '%\'  ) AND  ( category IN ' . $tupleCategories . ' ) ORDER BY dateTime DESC; ';
        $request = $db->query($query);

        $_SESSION[$category] = array();
        while ($response = $request->fetch()) {
            array_push($_SESSION[$category], $response);
        }
    }
    public static function getAllCategories($category)
    {
        include('../dB/config.php');
        $categories = array();
        $request = $db->query('SELECT DISTINCT category FROM ' . $category);
        while ($myCategory = $request->fetch()) {
            array_push($categories, $myCategory['category']);
        }
        return ($categories);
    }
}
