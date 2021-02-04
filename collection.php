<?php
############################################Revision History################################################

#Happy Patel (2013214)		13-10-2020		Create project folder 
#Happy Patel (2013214)		13-10-2020		Create index file  
#Happy Patel (2013214)		18-10-2020		Create all functions and css file   
#Happy Patel (2013214)		18-10-2020		Create home page and buying page    
#Happy Patel (2013214)		19-10-2020		working on validation part    
#Happy Patel (2013214)		20-10-2020	  	validation part  complete   
#Happy Patel (2013214)		28-10-2020              text file part complete order page designing done									   
#Happy Patel (2013214)		29-10-2020	  	fetch data on page 3    
#Happy Patel (2013214)		29-10-2020	  	90%  work complete  
#Happy Patel (2013214)		31-10-2020	  	last page done   
#Happy Patel (2013214)		26-11-2020	  	login and register design done, database creation done       
#Happy Patel (2013214)		28-11-2020	  	design of all forms done   
#Happy Patel (2013214)		30-11-2020	  	validation done using classes   
#Happy Patel (2013214)		5-12-2020	  	registration done, buy page done       
#Happy Patel (2013214)		5-12-2020	  	login page done   
#Happy Patel (2013214)		8-12-2020	  	account page, pur_chases page complete(100%)
#Happy Patel (2013214)		10-12-2020	  	rename the page pur_chases to orders

############################################################################################################

#include all required file for this page
include_once './PHP/phpFunctions.php';

class collection{
    
    public $items = array();
    
    public function add($primarykey, $item) {
        
        $this->items[$primarykey] = $item; 
        
    }
    
    public function remove($primarykey) {
        
        if(isset($this->items[$primarykey]))
        {
            unset($this->items[$primarykey]);
        }
             
    }
    
    public function get($primarykey) {
        
        if(isset($this->items[$primarykey]))
        {
            return $this->items[$primarykey];
        }
             
    }
    
    public function count() {
        
        return count($this->items);
             
    }
    
}
?>