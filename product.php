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
define('PRODUCT_CODE_MAX_LEN', 12);
define('DESCRIPTION_MAX_LEN', 100);

class product
{
    #declared private varibles which were assigned with empty values 
    private $product_uuid = " ";
    private $product_code = " ";
    private $price = " ";
    private $description = " ";
    
    #declard public empty array to store the errors
    public $error = [];
    
    #declared constructor
    public function __construct($p_product_uuid = " ", $p_product_code = " ", $p_price = " ", $p_description = " ")
    {
        if($p_product_uuid != " ")
        {
            $this->product_uuid = $p_product_uuid;
            $this->product_code = $p_product_code;
            $this->price = $p_price;
            $this->description = $p_description;
        }
    }
    
    #this function returns the product uuid
    function getProductUUID()
    {
        return $this->product_uuid ;
    }
    
    #this function returns the product code
    function getProductCode()
    {
        return $this->product_code ;
    }
    
    #this function validate the product code
    function setProductCode($newProductCode)
    {
        if(strtoupper(substr($newProductCode, 0,1)) != 'P')
                {
                    $error['$productcodeErrorMessage']="The product code must always begin with letter p or P ";
                }
                else if( mb_strlen($newProductCode) > PRODUCT_CODE_MAX_LEN)
                {
                    $error['$productcodeErrorMessage']="The product code cannot be cannot be more than ".PRODUCT_CODE_MAX_LEN. " characters";
                }
                else 
                {
                    if(mb_strlen($newProductCode) == 0)
                    {
                        $error['$productcodeErrorMessage']="The product code cannot be empty"; 
                    }
                    else
                    {
                        $this->product_code = $newProductCode;
                        //return " "; #optional
                    }
                }
    }
    
    #this function returns the price
    function getPrice()
    {
        return $this->price ;
    }
    
    #this function validate the price
    function setPrice($newPrice)
    {
        if($newPrice < 0)
        {
            $error['$priceErrorMessage']="price value must be positive";

        }
        else if($newPrice > 10000)
        {
            $error['$priceErrorMessage']="price value should not be greater than 10000$";

        }
        else if(!is_numeric($newPrice))
        {
            $error['$priceErrorMessage']="price must be numeric value";

        }
        else 
        {
            if($newPrice == "")
            {
                $error['$priceErrorMessage']="price value can not be empty";

            }
            else
            {
                $this->price = $newPrice;
                //return " "; #optional
            }

        }                
    }
    
    #this function returns the description
    function getDescription()
    {
        return $this->description ;
    }
    
    #this function validate the description
    function setDescription($newDescription)
    {
        if(mb_strlen($newDescription) >= DESCRIPTION_MAX_LEN)
        {
            $error['$descriptionErrorMessage']="The description cannot be more than ". DESCRIPTION_MAX_LEN. " characters";                            
        }
        else
        {
            $this->description = $newDescription;
        }
    }
    
    //load method of product class give the product code and price of product(shoes)
    public function load($product_uuid)
    {
        #Connect to the database with PDO(use constant)
        global $connection;
        
         $sqlQuery = "CALL get_product(:pk)";

         #prepare SQL and bind parameters
         $PDOStatement = $connection->prepare($sqlQuery);

         #bind parameters
         $PDOStatement->bindParam(':pk',$product_uuid);

         $PDOStatement->execute();

        #Its safer to write this
        #loop in the results to show them to the user
        #foreach is not safer
         if($row = $PDOStatement->fetch(PDO::FETCH_ASSOC))
         {
             $this->price = $row['price'];
             $this->product_code = $row['product_code'];
         }
         else 
         {
             echo "false";
             return false;
         }
    }
    
    #save method either insert the new row(data) in database or update the data in database
    public function save()
    {
        #Connect to the database with PDO(use constant)
        global $connection;

        #for insert
        if($this->product_uuid == " ")
        {              
            $sqlQuery = "CALL products_insert(:product_code, :price, :description)";

            #prepare SQL and bind parameters
            $PDOStatement = $connection->prepare($sqlQuery);

            #bind parameters
            $PDOStatement->bindParam(':product_code',$this->product_code);
            $PDOStatement->bindParam(':price',$this->price);
            $PDOStatement->bindParam(':description',$this->description);

            $PDOStatement->execute();

            return true;
        }
        #for update
        else
        {                
            $sqlQuery = "CALL products_update(:pk, :product_code, :price, :description)";

            #prepare SQL and bind parameters
            $PDOStatement = $connection->prepare($sqlQuery);

            #bind parameters
            $PDOStatement->bindParam(':pk',$this->product_uuid);                
            $PDOStatement->bindParam(':product_code',$this->product_code);
            $PDOStatement->bindParam(':price',$this->price);
            $PDOStatement->bindParam(':description',$this->description);

            $PDOStatement->execute();

            return true;
        }

    }
        
    public function delete()
    {
        #Connect to the database with PDO(use constant)
        global $connection;

        $sqlQuery = "CALL products_delete(:product_uuid)";

        #prepare SQL and bind parameters
        $PDOStatement = $connection->prepare($sqlQuery);

        #prepare SQL and bind parameters
        $PDOStatement->bindParam(':product_uuid',$this->product_uuid);

        $affectedRows = $PDOStatement->execute();

        return $affectedRows;
    }
                               
    function getErrors()
    {           
        return $this->error;
    }
}

?>