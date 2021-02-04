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
include_once('db_connection.php');
include_once 'PHP/phpFunctions.php';
include_once('customer.php');
 

#send network header
networkHeader();

#for error and exception handling
error_reporting(0);       
//error_Handle();
//exception_Handle();
set_error_handler("errorMessage");
set_exception_handler("exceptionMessage");

    //call the function displayTitle() from phpFunctions.php(where it is declared)
    displayTitle('Login');  
    
    //call the function pageLoginHeader() from phpFunctions.php(where it is declared)
    pageHeader();
    
    //this loop return message to user for logging to wesite using requestLogin() function
    if(!isset($_SESSION['user']))
    {     
        requestLogin();                
    }
    
    #variables
    $password = ' ';
    $username = ' ';
    $result = 0;
    $errors = [];
    
    #create an object of class customer
    $customer = new customer();
   
    //if login(key) exist in $_POST
    if(isset($_POST['login']))
    {
        $username = htmlspecialchars($_POST['username']);           

        #Connect to the database with PDO(use constant)
        global $connection; 

        #use customer_login procedure for login to the website
        $sql_query = 'CALL customer_login(:username);';

        #prepare SQL and bind parameters
        $PDOStatement = $connection->prepare($sql_query);

        #bind parameters
        $PDOStatement->bindParam(':username', $_POST['username']);

        $PDOStatement->execute();

        #Its safer to write this
        #loop in the results to show them to the user
        #foreach is not safer
        if($row = $PDOStatement->fetch(PDO::FETCH_ASSOC))        
        {              
            $password = $row['PASSWORD'];
            #to verify the password
            if(password_verify($_POST['password'], $password))
            {                   
                echo '<br><br>Password match';

                $result = 1;
            } 
            else 
            {
                $errors['loginPasswordErrorMessage'] = "please type correct password:";
                $result = 0;
            }               
        }
        else
        {
            $errors['loginUsernameErrorMessage'] = "please type correct username:";
            $errors['loginPasswordErrorMessage'] = "please type correct password:";
            $result = 0;
        }

      $PDOStatement = null;

        #if password and username match it redirect the page to home page
        if($result == 1)
        {
            $customer->login($username, $password);
            header("Location: index.php");
        }
    }
              
    //call the function displayLoginForm() from phpFunctions.php(where it is declared)
    displayLoginForm($errors);
    
    //call the function pageFooter() from phpFunctions.php(where it is declared)    
    pageFooter();
    
    

?>
