<?php


class MYCATEGORY{

    public $category;
    //Methods
    function __construct($category) {
        $this->category = $category;
     
    }

    public  static function getAllItemsByOrder($category){
        include('../dB/config.php');
        //store all the records in this array
        
        $request= $db->query('SELECT * FROM '.$category.' ORDER BY dateTime DESC; ');
        $_SESSION[$category]=array();
        while($response=$request->fetch()){
            array_push($_SESSION[$category],$response);

        }

    }

    public static function getFilteredItemsByOrder($category,$categoriesSelected){

        include('../dB/config.php');
        //store all the records in this array
        //implode("','", array_map('mysql_real_escape_string', $arr))
        
        $request = $db->query('SELECT * FROM '.$category.'WHERE category IN ('.implode("','", array_map('mysql_real_escape_string', $categoriesSelected)).') ORDER BY dateTime DESC; ');
        $_SESSION[$category]=array();
        while($response=$request->fetch()){
            array_push($_SESSION[$category],$response);

        }
       

    }
    public static function getSearchedItemsByOrder($category,$searchText){
        include('../dB/config.php');
        //store all the records in this array
     
        $request = $db->query('SELECT * FROM '.$category.' WHERE title LIKE \'%'.$searchText.'%\' OR text LIKE \'%'.$searchText.'%\'  ORDER BY dateTime DESC; ');
        $_SESSION[$category]=array();
        while($response=$request->fetch()){
            array_push($_SESSION[$category],$response);

        }
        
     


    }
    public static function getSearchedAndFilteredItemsByOrder($category,$searchText,$categoriesSelected){
        include('../dB/config.php');
     
        $request= $db->query('SELECT * FROM '.$category.'WHERE title LIKE \'%'.$searchText.'%\' OR text LIKE \'%'.$searchText.'%\' AND  category IN ('.implode("','", array_map('mysql_real_escape_string', $categoriesSelected)).') ORDER BY dateTime DESC; ');
        $_SESSION[$category]=array();
        while($response=$request->fetch()){
            array_push($_SESSION[$category],$response);

        }
      
        

    }
    public static function getAllCategories($category){
        include('../dB/config.php');
        $categories=array();
        $request=$db->query('SELECT DISTINCT category FROM '.$category);
        while($myCategory=$request->fetch()){
            array_push($categories,$myCategory['category']);
        }
        return($categories);
        


    }
    
    


    


    
}

?>
