<?php

class ITEM{
    public $category;
    public $itemId;
    public $itemArray;
  

    //Methods
    function __construct($category,$itemArray) {
        $this->category = $category;
        $this->itemArray=$itemArray;
      }

    protected function gnlRequest($parameter){
        
        return($this->itemArray[$parameter]);

    }

    function getTitle(){
        echo $this->gnlRequest('title');

    }
    function getIcon(){
        echo $this->gnlRequest('icon');

    }
    function getPicture(){
        echo $this->gnlRequest('picture');
        
    }
    function getText(){
        return($this->gnlRequest('text'));

        
    }
    function getTheme(){
        echo $this->gnlRequest('category');

    }
    
    function getFirstLines(){
        $myText=$this->getText();
        $lines=explode("\n", $myText);
        echo $lines['0'] ;
        
        
    }
    function getDateTime(){
        $dateTime = new DateTime($this->gnlRequest('dateTime'));
        $stringAfterDay='';
        $day=$dateTime->format('d');
        

        switch($day){
            case(1):
                $stringAfterDay='st';
                break;
            case(2):
                $stringAfterDay='nd';
                break;
            case(3):
                $stringAfterDay='rd';
                break;
            default:
                $stringAfterDay='th';


        }
      
        $date=$dateTime->format('M d');
        echo $date ;
        echo $stringAfterDay.' , ';
        echo $dateTime->format('Y');

      


        
        
    }
    function getDuration(){
        //should return how many time ago



    }


    function __destruct() {}
  


}

class ARTICLES extends ITEM{
    public $category='articles';
    function getAuthorInformations($parameter){

        include('../dB/config.php');
        $response = $db->query('SELECT '.$parameter.'FROM authors WHERE id= '.$this->gnlRequest('authorId'));
        $data = $response->fetch();
        $result=$data[$parameter];
        return($result);

    }
    function getAuthorName(){
        echo $this->getAuthorInformations('name');


    }
    function getAuthorPicture(){
        echo $this->getAuthorInformations('picture');

    }
    function getAuthorQuote(){
        echo $this->getAuthorInformations('quote');

    }
  

}


class ACTIVITIES extends ITEM{
    public $category='activities';
    function getTypeAssets(){
        return($this->gnlRequest('typeAsset'));
    }
  
  
 
}
