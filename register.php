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

#for starting session
session_start();


#include all required file for this page
include_once('customer.php');
include_once('customers.php');
include_once('PHP/phpFunctions.php');

#send network header
networkHeader();

#for error and exception handling
error_reporting(0);       
//error_Handle();
//exception_Handle();
set_error_handler("errorMessage");
set_exception_handler("exceptionMessage");

    //call the function displayTitle() from phpFunctions.php(where it is declared)
    displayTitle('Register');  
    
    //call the function pageLoginHeader() from phpFunctions.php(where it is declared)
    pageLoginHeader();
    
    //declare empty array which receive all the errors during validatin from class customer
    $errors = array();
    
    //declared empty array to store the values
    $value = array();
    
    //create an object $customer of class customer
    $customer = new customer();
    
    //if register(key) exist in $_POST
    if(isset($_POST['register']))
    {       
        $value["firstname"] = htmlspecialchars($_POST["firstname"]);
        $value["lastname"] = htmlspecialchars($_POST["lastname"]);
        $value["address"] = htmlspecialchars($_POST["address"]);
        $value["city"] = htmlspecialchars($_POST["city"]);
        $value["province"] = htmlspecialchars($_POST["province"]);
        $value["postalcode"] = htmlspecialchars($_POST["postalcode"]);
        $value["username"] = htmlspecialchars($_POST["username"]);
        $value["password"] = htmlspecialchars($_POST["password"]);
        
        //all the set methods of customer class validate data which is exist in $_POST in form of account page
        $customer->setFirstname($_POST["firstname"]);
        $customer->setLastname($_POST["lastname"]);
        $customer->setAddress($_POST["address"]);
        $customer->setCity($_POST["city"]);
        $customer->setProvince($_POST["province"]);
        $customer->setPostalCode($_POST["postalcode"]);
        $customer->setUsername($_POST["username"]);
        $customer->setPassword($_POST["password"]);
        
        //receive all the errors with the help of getErrors() function which is declared in customer class
        $errors = $customer->getErrors();
        
        //if size of array is 0 means there is no error in validation than it will save the data in database 
        //with the help of save method which is declared in customer class
        if(sizeof($errors) == 0)
        {
            $customer->save();
            header("Location: login.php");
        }
        
    }
        
    //call the function displayRegisterForm()() from phpFunctions.php(where it is declared)
    displayRegisterForm($errors, $value);
    
    //call the function pageFooter() from phpFunctions.php(where it is declared)    
    pageFooter();   
?>
