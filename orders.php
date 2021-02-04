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

#for starting the session
session_start();

#if session is not set means user didn't log in then it goes to the login page
if(!isset($_SESSION['user']))
{                        
    header("Location: login.php");
    exit();
}

#include all required file for this page
include_once './PHP/phpFunctions.php';
include_once 'purchases.php';
 
#for error and exception handling
error_reporting(0);       
//error_Handle();
//exception_Handle();
set_error_handler("errorMessage");
set_exception_handler("DMExceptionMessage");
#send network header
networkHeader();   

    //call the function displayTitle() from phpFunctions.php(where it is declared)
    displayTitle('Orders');  
    
    //call the function pageHeader() from phpFunctions.php(where it is declared)
    pageHeader();
    
    //call the function printWelcomemessage() from phpFunctions.php(where it is declared)
    printWelcomemessage();
    
    //call the function displayOrdersForm() from phpFunctions.php(where it is declared)
    displayOrdersForm();
     
    //if searchQuery(key) exist in $_POST
    if(isset($_POST["searchQuery"]))
    {   
        #Connect to the database with PDO(use constant)
        global $connection;
        
        $sqlQuery = "CALL purchases_sort(:date,:customerUUID)";
        
        #prepare SQL and bind parameters
        $PDOStatement = $connection->prepare($sqlQuery);  
        
        #bind parameters
        $PDOStatement->bindParam(':date', $_POST["searchQuery"]);
        $PDOStatement->bindParam(':customerUUID', $_SESSION["user"]);
        $PDOStatement->execute();        
?>  

<!--creating table-->
<section style="min-height:300px; padding-top:150px;">   
    <table width="1000" border="1px" cellpadding="0" cellspacing="0" align="center" style="background-color: #E6E6FA;">
            <tr>
               <th>Delete</th>
               <th>Product Code</th>               
               <th>City</th>
               <th>Comments</th>
               <th>Price</th>
               <th>Quantity</th>
               <th>Subtotal</th>
               <th>Tax</th>
               <th>Grand Total</th>
            </tr>
     
<?php
while($result = $PDOStatement->fetch(PDO::FETCH_ASSOC))
{
    echo "<tr>";
    echo '<td align="center" color = "gray"><form method="post"><input type="hidden" name="deleteID" value="'.$result['purchase_uuid'].'"> <button type="submit" name = "delete">delete</button></td>';
    echo '<td>'. $result['product_code']."</td>";
    echo '<td>'. $result['city']."</td>";
    echo '<td>'. $result['comments']."</td>";
    echo '<td>$'. $result['price']."</td>";
    echo '<td>'. $result['quantity']."</td>";
    echo '<td>$'. $result['sub_total']."</td>";
    echo '<td>$'. $result['tax']."</td>";
    echo '<td>$'. $result['grand_total']."</td>";
    echo '</tr>';
  }
}   
 ?>
    </table>
</section>
    
<?php 
    //if delete(key) exist in $_POST
    if(isset($_POST['delete']))
    {       
        global $connection;
        $sqlQuery = "CALL purchases_delete(:date)";
        $PDOStatement = $connection->prepare($sqlQuery);
                
        $PDOStatement->bindParam(':date',$_POST['deleteID']);
       
        $PDOStatement->execute();
               
    }
    
    //call the function pageFooter() from phpFunctions.php(where it is declared)    
    pageFooter();
    
?>
