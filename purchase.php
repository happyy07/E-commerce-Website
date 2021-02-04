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

#for connecting to database
include_once('db_connection.php');

#define constants which will be helpful in validation
define('COMMENTS_MAX_LEN', 200);

class purchase
{
    #declared private varibles which were assigned with empty values 
    private $purchase_uuid = " ";
    private $product_uuid = " ";
    private $customer_uuid = " ";
    private $product_code = " ";
    private $firstname = " ";
    private $lastname = " ";
    private $city = " ";
    private $comments = " ";
    private $price = " ";
    private $quantity = " ";
    private $sub_total = " ";
    private $tax = " ";
    private $grand_total = " ";

   #declard public empty array to store the errors
    public $error = [];
      
    #declared constructor
    public function __construct($p_purchase_uuid = " ", $p_product_uuid = " ", $p_customer_uuid = " ",$p_product_code = " ", $p_firstname= " ", $p_lastname = " ", $p_city= " ", $p_comments = " ", $p_price = " ", $p_quantity = " ", $p_sub_total = " ", $p_tax = " ", $p_grand_total = " ")
    {
        if($p_product_uuid != " ")
        {
            $this->purchase_uuid = $p_purchase_uuid;
            $this->product_uuid = $p_product_uuid;
            $this->customer_uuid = $p_customer_uuid;
            $this->product_code = $p_product_code;
            $this->firstname = $p_firstname;
            $this->lastname = $p_lastname;
            $this->city = $p_city;
            $this->comments = $p_comments;
            $this->price = $p_price;
            $this->quantity = $p_quantity;
            $this->sub_total = $p_sub_total;
            $this->tax = $p_tax;
            $this->grand_total = $p_grand_total;           
        }
    }
    
    
    function getPurchaseUUID(){
        return $this->purchase_uuid;
    }
    
    function getCustomerUUID(){
        return $this->customer_uuid;
    }
    
    
    #set the product uuid  
    function setProductUUID($newProductUUID)
    {
        $this->product_uuid = $newProductUUID;
    }

    #set the customer uuid 
    function setCustomerUUID($newCustomerUUID)
    {
        $this->customer_uuid = $newCustomerUUID;
    }
    
    #this function returns the product code
    function getProductCode()
    {
        return $this->product_code;
    }
    
    #set the product uuid 
    function setProductCode($newProductCode)
    {
        $this->product_code = $newProductCode;
    }
    
    function setFirstname($newFirstName)
    {
        $this->firstname = $newFirstName;
    }
    
    function setLastname($newLastName)
    {
        $this->lastname = $newLastName;
    }
    #this function returns the city
    function getCity()
    {
        return $this->city;
    }
    
    #set the city
    function setCity($newCity)
    {
        $this->city = $newCity;
    }
    
    #this function returns the comments
    function getComments()
    {
        return $this->comments ;
    }
    
    #this function validate the comments
    function setComments($newComments)
    {
        if(mb_strlen($newComments) > COMMENTS_MAX_LEN)
            {
                $this->error['commentsErrorMessage']="The comments cannot be more than ". COMMENTS_MAX_LEN. " characters";                            
            }
            else
            {
                $this->comments = $newComments;
                //return " "; #optional
            }
    }
    
    #this function returns the price
    function getPrice()
    {        
        return $this->price;                       
    }
    
    #set the price 
    function setPrice($newPrice)
    {        
        $this->price = $newPrice;                       
    }
    
    #this function returns the quantity
    function getQuantity()
    {
        return $this->quantity ;
    }
    
    #this function validate the quantity
    function setQuantity($newQuantity)
    {
        if($newQuantity < 0)
        {
            $this->error['quantityErrorMessage']="quantity must be positive";

        }
        else if($newQuantity > 10000)
        {
            $this->error['quantityErrorMessage']="quantity value should not be greater than 10000$";

        }
        else if(!is_numeric($newQuantity))
        {
            $this->error['quantityErrorMessage']="quantity must be numeric value";

        }
        else if(!((int)$newQuantity == (float)$newQuantity))
        {
            $this->error['quantityErrorMessage']="quantity must be integer value";                    
        }
        else 
        {
            if($newQuantity == "")
            {
                $this->error['quantityErrorMessage']="quantity can not be empty";
            }
            else
            {
                $this->quantity = $newQuantity;              
            }
        }               
    }
   
    #this function returns the sub total
    function getSubTotal()
    {       
        return $this->sub_total;                       
    }
    
    #set the sub total 
    function setSubTotal($newSubTotal)
    {       
        $this->sub_total = $newSubTotal;                        
    }
    
    #this function returns the tax value
    function getTax()
    {        
        return $this->tax;                       
    }
    
    #set the tax value 
    function setTax($newTax)
    {        
        $this->tax = $newTax;                       
    }
    
    #this function returns the grand total
    function getGrandTotal()
    {        
        return $this->grand_total;                        
    }
    
    #set the grand total
    function setGrandTotal($newGrandTotal)
    {        
        $this->grand_total = $newGrandTotal;                        
    }
    
    #save method either insert the new row(data) in database or update the data in database
    public function save()
    {
        #Connect to the database with PDO(use constant)
        global $connection;

        #for insert
        if($this->purchase_uuid == " ")
        {
            $sqlQuery = "CALL purchases_insert(:product_uuid, :customer_uuid, :product_code, :firstname, :lastname, :city, :comments, :price, :quantity, :sub_total, :tax, :grand_total)";

            #prepare SQL and bind parameters
            $PDOStatement = $connection->prepare($sqlQuery);

            #bind parameters
            $PDOStatement->bindParam(':product_uuid',$this->product_uuid);
            $PDOStatement->bindParam(':customer_uuid',$this->customer_uuid);
            $PDOStatement->bindParam(':product_code',$this->product_code);
            $PDOStatement->bindParam(':firstname',$this->firstname);
            $PDOStatement->bindParam(':lastname',$this->lastname);
            $PDOStatement->bindParam(':city',$this->city);
            $PDOStatement->bindParam(':comments',$this->comments);
            $PDOStatement->bindParam(':price',$this->price);        
            $PDOStatement->bindParam(':quantity',$this->quantity);
            $PDOStatement->bindParam(':sub_total',$this->sub_total);
            $PDOStatement->bindParam(':tax',$this->tax);
            $PDOStatement->bindParam(':grand_total',$this->grand_total);

            $PDOStatement->execute();

            return true;
        }
        #for update
        else
        {
            $sqlQuery = "CALL purchases_update(:pk, :product_uuid, :customer_uuid, :product_code, :firstname, :lastname, :city, :comments, :price, :quantity, :sub_total, :tax, :grand_total)";

            #prepare SQL and bind parameters
            $PDOStatement = $connection->prepare($sqlQuery);

            #bind parameters
            $PDOStatement->bindParam(':pk',$this->purchase_uuid);
            $PDOStatement->bindParam(':product_uuid',$this->product_uuid);
            $PDOStatement->bindParam(':customer_uuid',$this->customer_uuid);
            $PDOStatement->bindParam(':product_code',$this->product_code);
            $PDOStatement->bindParam(':firstname',$this->firstname);
            $PDOStatement->bindParam(':lastname',$this->lastname);
            $PDOStatement->bindParam(':city',$this->city);
            $PDOStatement->bindParam(':comments',$this->comments);
            $PDOStatement->bindParam(':price',$this->price);        
            $PDOStatement->bindParam(':quantity',$this->quantity);
            $PDOStatement->bindParam(':sub_total',$this->sub_total);
            $PDOStatement->bindParam(':tax',$this->tax);
            $PDOStatement->bindParam(':grand_total',$this->grand_total);

            $PDOStatement->execute();

            return true;
        }
                    
    }
    
    #for delete the row from database
    public function delete()
    {
        #Connect to the database with PDO(use constant)
        global $connection;

        $sqlQuery = "CALL purchases_delete(:purchase_uuid)";

        #prepare SQL and bind parameters
        $PDOStatement = $connection->prepare($sqlQuery);

        #bind parameters
        $PDOStatement->bindParam(':purchase_uuid',$this->purchase_uuid);

        $affectedRows = $PDOStatement->execute();

        return $affectedRows;
    }

    #this function returns all the errors during validation
    function getErrors()
    {     
        return $this->error;
    }
}
?>