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

session_start();


if(!isset($_SESSION['user']))
{                       
    header("Location: login.php");
    exit();
}

#include all required file for this page
include_once('purchase.php');
include_once('purchases.php'); 
include_once('product.php');
include_once('products.php');
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
    displayTitle('Buy');  
    
    //call the function pageHeader() from phpFunctions.php(where it is declared)
    pageHeader();
    
    //this function prints welcome message if user is logged in
    printWelcomemessage();
    
    //declare empty array which receive all the errors during validatin from class purchase
    $errors = array();
    
    //declare empty array which receive all the values from form
    $value = array();
    
    //create an object $purchase of class purchase
    $purchase = new purchase();
   
    //variable tax will be used to count tax
    $tax = 12.05;
    
    //if buy(key) exist in $_POST
    if(isset($_POST['buy']))
    {   
        $value["comments"] = htmlspecialchars($_POST["comments"]);
        $value["quantity"] = htmlspecialchars($_POST["quantity"]);
        
        //create object of class customer
        $customer = new customer();
        
        //create object of class product
        $product = new product();
        
        //load method of customer class give the all data of logged in user   
        $customer->load(htmlspecialchars($_SESSION['user']));
        
        //load method of product class give the product code and price of the product           
        $product->load(htmlspecialchars($_POST["product"]));
        
        //all the set methods of purchase class validate data which is exist in $_POST in form of buy page
        $purchase->setProductUUID($_POST['product']);
        $purchase->setCustomerUUID($_SESSION['user']);
        $purchase->setProductCode($product->getProductCode());
        $purchase->setFirstname($customer->getFirstname());
        $purchase->setLastname($customer->getLastname());
        $purchase->setCity($customer->getCity());
        $purchase->setComments($_POST["comments"]);
        $purchase->setPrice($product->getPrice());
        $purchase->setQuantity($_POST["quantity"]);
        
        //get the product price using getPrice() method of product class
        $price = $product->getPrice();
        $quantity = $_POST["quantity"];
        
        //calculation of sub total
        $subtotal = $price * $quantity;
        
        //calculation of tax
        $taxesAmount = ($subtotal * $tax)/100;
        
        //calculation of grand total
        $grandTotal = $subtotal + $taxesAmount;
        
        $purchase->setSubTotal($subtotal);
        $purchase->setTax($taxesAmount);
        $purchase->setGrandTotal($grandTotal);
        
        //after the validation it gets all the errors in array using getErrors() method which is declared on purchase class                  
        $errors = $purchase->getErrors();        
      
        //if size of array is 0 means there is no error during validation than it calls save method of purchase class to update the data in database            
        if(sizeof($errors) == 0)
        {
            $purchase->save();
        }       
    }
    
    //call the function displayBuyForm() from phpFunctions.php(where it is declared)
    displayBuyForm($errors, $value);
    
    //call the function pageFooter() from phpFunctions.php(where it is declared)    
    pageFooter();

?>
