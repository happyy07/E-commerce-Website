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
define('F_NAME_MAX_LEN', 20);
define('L_NAME_MAX_LEN', 20);
define('ADDRESS_MAX_LEN', 25);
define('CITY_MAX_LEN', 25);
define('PROVINCE_MAX_LEN', 25);
define('POSTAL_CODE_MAX_LEN', 7);
define('USER_NAME_MAX_LEN', 12);
define('PASSWORD_MAX_LEN', 15);


class customer
{
    #declared private varibles which were assigned with empty values 
    private $customer_uuid = " ";
    private $firstname = " ";
    private $lastname = " ";
    private $address = " ";
    private $city = " ";
    private $province = " ";
    private $postal_code = " ";
    private $username = " ";
    private $password = " ";
    
    #declard public empty array to store the errors
    public $error = array();
    
    #declared constructor
    public function __construct($p_customer_uuid = " ", $p_firstname = " ", $p_lastname = " ", $p_address = " ", $p_city = " ", $p_province = " ", $p_postal_code = " ", $p_username = " ", $p_password = " ") 
    {
        if($p_customer_uuid != " ")
        {
            $this->customer_uuid = $p_customer_uuid;
            $this->firstname = $p_firstname;
            $this->lastname = $p_lastname;
            $this->address = $p_address;
            $this->city  = $p_city ;
            $this->province  = $p_province ;
            $this->postal_code  = $p_postal_code ;
            $this->username = $p_username;
            $this->password = $p_password;
        }
    }
    
    #this function returns the first name
    function getFirstname()
    {
        return $this->firstname ;
    }
    
    #this function validate the first name
    function setFirstname($newFirstname)
    {
        if(mb_strlen($newFirstname) == 0)
        {
            $this->error['firstnameErrorMessage'] = "The firstname cannot be empty";                    
        }
        else
        {
            if(mb_strlen($newFirstname) > F_NAME_MAX_LEN)
            {
                $this->error['firstnameErrorMessage'] = "The firstname cannot be more than ". F_NAME_MAX_LEN. " characters";                
            }
            else
            {
                $this->firstname = $newFirstname;                
            }
        }
    }
    
    #this function returns the last name
    function getLastname()
    {
        return $this->lastname ;
    }
    
    #this function validate the last name
    function setLastname($newLastname)
    {
        if(mb_strlen($newLastname) == 0)
        {
            $this->error['lastnameErrorMessage'] = "The lastname cannot be empty";           
        }
        else
        {
            if(mb_strlen($newLastname) > L_NAME_MAX_LEN)
            {
                $this->error['lastnameErrorMessage'] = "The lastname cannot be more than ". L_NAME_MAX_LEN. " characters";    
            }
            else
            {
                $this->lastname = $newLastname;                
            }
        }
    }
    
    #this function returns the address
    function getAddress()
    {
        return $this->address ;
    }
    
    #this function validate the address
    function setAddress($newAddress)
    {
        if(mb_strlen($newAddress) == 0)
        {
            $this->error['addressErrorMessage'] = "The address cannot be empty";
        }
        else
        {
            if(mb_strlen($newAddress) > ADDRESS_MAX_LEN)
            {
                $this->error['addressErrorMessage'] = "The address cannot be more than ". ADDRESS_MAX_LEN. " characters";      
            }
            else
            {
                $this->address = $newAddress;                
            }
        }
    }
    
    #this function returns the city
    function getCity()
    {
        return $this->city ;
    }
    
    #this function validate the city
    function setCity($newCity)
    {
        if(mb_strlen($newCity) == 0)
        {
            $this->error['cityErrorMessage'] = "The city cannot be empty";
        }
        else
        {
            if(mb_strlen($newCity) > CITY_MAX_LEN)
            {
                $this->error['cityErrorMessage'] = "The city cannot be more than ". CITY_MAX_LEN. " characters";               
            }
            else
            {
                $this->city = $newCity;                
            }
        }
    }
    
    #this function returns the province
    function getProvince()
    {
        return $this->province ;
    }
    
    #this function validate the province
    function setProvince($newProvince)
    {
        if(mb_strlen($newProvince) == 0)
        {
            $this->error['provinceErrorMessage'] = "The province cannot be empty";           
        }
        else
        {
            if(mb_strlen($newProvince) > PROVINCE_MAX_LEN)
            {
                $this->error['provinceErrorMessage'] = "The province cannot be more than ". PROVINCE_MAX_LEN. " characters";               
            }
            else
            {
                $this->province = $newProvince;
            }
        }
    }
    
    #this function returns the postal code
    function getPostalCode()
    {
        return $this->postal_code ;
    }
    
    #this function validate the postal code
    function setPostalCode($newPostalCode)
    {
        if(mb_strlen($newPostalCode) == 0)
        {
            $this->error['postalcodeErrorMessage'] = "The postal code cannot be empty";
        }
        else
        {
            if(mb_strlen($newPostalCode) > POSTAL_CODE_MAX_LEN)
            {
                $this->error['postalcodeErrorMessage'] = "The postal code cannot be more than ". POSTAL_CODE_MAX_LEN. " characters";              
            }
            else
            {
                $this->postal_code = $newPostalCode;                
            }
        }
    }
    
    #this function returns the user name
    function getUsername()
    {
        return $this->username ;
    }
    
    #this function validate the user name
    function setUsername($newUsername)
    {
        if(mb_strlen($newUsername) == 0)
        {
            $this->error['usernameErrorMessage'] = "The username cannot be empty";
        }
        else
        {
            if(mb_strlen($newUsername) > USER_NAME_MAX_LEN)
            {
                $this->error['usernameErrorMessage'] = "The username cannot be more than ". USER_NAME_MAX_LEN. " characters";               
            }
            else
            {
                $this->username = $newUsername;
            }
        }
    }
    
    #this function returns the password
    function getPassword()
    {
        return $this->password ;
    }
    
    #this function validate the password
    function setPassword($newPassword)
    {
        if(mb_strlen($newPassword) == 0)
        {
            $this->error['passwordErrorMessage'] = "The password cannot be empty";
        }
        else
        {
            if(mb_strlen($newPassword) > PASSWORD_MAX_LEN)
            {
                $this->error['passwordErrorMessage'] = "The password cannot be more than ". PASSWORD_MAX_LEN. " characters";               
            }
            else
            {
                $this->password = $newPassword;
                //return " "; #optional
            }
        }
    }
    
    //load method of customer class give the all data of logged in user 
    public function load($customer_uuid)
    {
        #connection to the database
        global $connection;

        $sqlQuery = "CALL get_customer_row(:pk)";

        #prepare SQL and bind parameters
         $PDOStatement = $connection->prepare($sqlQuery);

         #bind parameters
         $PDOStatement->bindParam(':pk',$customer_uuid);

         $PDOStatement->execute();

        #Its safer to write this
        #loop in the results to show them to the user
        #foreach is not safer
        if($row = $PDOStatement->fetch(PDO::FETCH_ASSOC))
        {
            $this->customer_uuid = $row['customer_uuid'];                
            $this->firstname = $row['firstname'];
            $this->lastname = $row['lastname'];
            $this->address = $row['address'];
            $this->city = $row['city'];
            $this->province = $row['province'];
            $this->postal_code = $row['postal_code'];
            $this->username = $row['username'];          
        }
    }
    
    #login method take username an password as parameter and give the firstname and lastname using customer_logged_in procedure 
    public function login($p_username, $p_password) 
    {
        #Connect to the database with PDO(use constant)
        global $connection;

        $sqlQuery = "CALL customer_logged_in(:user_name, :pass_word)";               

        #prepare SQL and bind parameters
        $PDOStatement = $connection->prepare($sqlQuery);

        #bind parameters
        $PDOStatement->bindParam(':user_name', $p_username);
        $PDOStatement->bindParam(':pass_word', $p_password);

        $PDOStatement->execute();

        #Its safer to write this
        #loop in the results to show them to the user
        #foreach is not safer
        if($row = $PDOStatement->fetch(PDO::FETCH_ASSOC))
        {
            #for the welcome message after user is logged in
            $_SESSION['welcomeMessage'] =  "Welcome " . $row['firstname']." ".$row['lastname'];

            #store the primary key of logged in user
            $_SESSION['user'] = $row['customer_uuid'];
        }

    }

    #save method either insert the new row(data) in database or update the data in database
    public function save()
    {
        #Connect to the database with PDO(use constant)
        global $connection;

        #for insert
        if($this->customer_uuid == " ")
        {
            #convert into hash pasword
            $hashpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sqlQuery = "CALL customers_insert(:firstname, :lastname, :address, :city, :province, :postal_code, :username, :password)";

            #prepare SQL and bind parameters
            $PDOStatement = $connection->prepare($sqlQuery);

            #bind parameters
            $PDOStatement->bindParam(':firstname',$this->firstname);
            $PDOStatement->bindParam(':lastname',$this->lastname);
            $PDOStatement->bindParam(':address',$this->address);
            $PDOStatement->bindParam(':city',$this->city);
            $PDOStatement->bindParam(':province',$this->province);
            $PDOStatement->bindParam(':postal_code',$this->postal_code);                
            $PDOStatement->bindParam(':username',$this->username);
            $PDOStatement->bindParam(':password',$hashpassword);

            $PDOStatement->execute();

            return true;
        }
        #for update
        else
        {
            $hashpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $sqlQuery = "CALL customers_update(:pk, :firstname, :lastname, :address, :city, :province, :postal_code, :username, :password)";

            #prepare SQL and bind parameters
            $PDOStatement = $connection->prepare($sqlQuery);

            #bind parameters
            $PDOStatement->bindParam(':pk',$this->customer_uuid);
            $PDOStatement->bindParam(':firstname',$this->firstname);
            $PDOStatement->bindParam(':lastname',$this->lastname);
            $PDOStatement->bindParam(':address',$this->address);
            $PDOStatement->bindParam(':city',$this->city);
            $PDOStatement->bindParam(':province',$this->province);
            $PDOStatement->bindParam(':postal_code',$this->postal_code);                              
            $PDOStatement->bindParam(':username',$this->username);
            $PDOStatement->bindParam(':password',$hashpassword);

            $PDOStatement->execute();

            return true;
        }
                    
    }
        
        #for delete the row from database
        public function delete()
        {
            #Connect to the database with PDO(use constant)
            global $connection;
            
            $sqlQuery = "CALL customers_delete(:customer_uuid)";
            
            #prepare SQL and bind parameters
            $PDOStatement = $connection->prepare($sqlQuery);
            
            #bind parameters
            $PDOStatement->bindParam(':customer_uuid',$this->customer_uuid);
            
            $affectedRows = $PDOStatement->execute();
            
            return $affectedRows;
        }
        
        #this function returns all the errors during validation
        function getErrors(){           
            return $this->error;
        }
}

?>