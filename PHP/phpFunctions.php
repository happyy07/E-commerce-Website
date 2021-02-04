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

#constants for the images
define('FOLDER_IMAGES', 'Images/');
define('LOGO', FOLDER_IMAGES.'logo.jpg');
define('MAIN', FOLDER_IMAGES.'main.jpg');
define('WOMAN_1', FOLDER_IMAGES.'skecher-woman-1.jpg');
define('WOMAN_2', FOLDER_IMAGES.'skecher-woman-2.jpg');
define('MAN_1', FOLDER_IMAGES.'skechers-man-1.jpg');
define('MAN_2', FOLDER_IMAGES.'skechers-man-2.jpg');

#constants for the pages
define('PAGE_LOGIN', 'login.php');
define('PAGE_LOGOUT', 'logout.php');
define('PAGE_HOME', 'index.php');
define('PAGE_BUY', 'buy.php');
define('PAGE_ORDERS', 'orders.php');
define('PAGE_ACCOUNT', 'account.php');

#constant for css 
define('FOLDER_CSS', 'CSS/');
define('FILE_CSS', FOLDER_CSS.'styles.css');

#constant for javascript 
define('FOLDER_JS', 'AJAX/');
define('FILE_JS', FOLDER_JS.'ajax.js');

$advertisingShoes = array(MAIN,WOMAN_1,WOMAN_2,MAN_1,MAN_2);

#variable for welcome message
global $welcomeMessage;

#title for all 4 pages
function displayTitle($title)
{
?>  
            <!DOCTYPE HTML>
            <html>
            <head>
                <meta charset="UTF-8">
                <title><?php echo $title; ?></title>
                <link rel="stylesheet" href="<?php echo FILE_CSS; ?>">
                <script language="javascript" type="text/javascript" src="<?php echo FILE_JS; ?>"></script>       
            </head>
                       
            <body>
                
<?php
}
#header for login page
function pageLoginHeader()
{
?>
                <header>
                    <?php
                        displayLogo();
                    ?>
                </header>
<?php
    
}
#header for all 4 pages
function pageHeader()
{
?>
                <header>
                    <?php
                        displayLogo();
                        navigationMenu();
                    ?>
                </header>
<?php
}


#footer for all 4 pages
function pageFooter()
{   
?>
                <footer>
                    <?php
                    displayCopyright();
                    ?>
                </footer>
            
            </body>
            </html>
<?php
}

#for network header
function networkHeader()
{
#   php header that send utf-8 header    
   header('Content-Type: text/html; charset=utf-8');
#   function that will pass header in begining of page 
   header("Expires: Fri, 02 Dec 1994 05:00:00 GMT");
#  clear cache of web page
   header("Cache-Control: no-cache");
   header("Pragma: no-cache");
}

#for error handling
//function error_Handle()
//{
    #function that handle error in pages and put it in log file
    function errorMessage($errorNum, $errorString, $errorfile, $errorline, $errorconn)
    {
        $debug = true;
        if($debug)
        {              
            #write all error in log file
            $error = array($errorNum, htmlspecialchars($errorfile), $errorline, $errorconn, $errorString);            
            $errorString = json_encode($error);              
            file_put_contents('logfile.txt', $errorString.PHP_EOL,FILE_APPEND);
                
        }                      
    }       
//}

//#for exception handling
//function exception_Handle()
//{
//    #function that handle exception in pages and put it in log file
//    function ExceptionMessageold($exception)
//    {
//        $debug = true;
//
//        if($debug)
//        {
//            $exception = array($exception->getMessage(),$exception->getFile(),$exception->getLine(),Date("Y/m/d h:i:sa"));            
//            $exceptionString = json_encode($exception);            
//            file_put_contents('logfile.txt', $exceptionString.PHP_EOL,FILE_APPEND);
//        }                     
//    }        
//}

function ExceptionMessage($exception)
{
    $debug = true;

    if($debug)
    {
        $exception = array($exception->getMessage(),$exception->getFile(),$exception->getLine(),Date("Y/m/d h:i:sa"));            
        $exceptionString = json_encode($exception);            
        file_put_contents('logfile.txt', $exceptionString.PHP_EOL,FILE_APPEND);
    }                     
}

#for logo
function displayLogo()
{    
    echo '<img class = "logo" id="logo" src = " '.LOGO.'">';    
}

#for copy-right
function displayCopyright()
{   
    
    echo "<span> &copy; Happy Patel(2013214) ".date("Y")."</span>";
    
}

#for navigation menu
function navigationMenu()
{
?>   
        <nav>
          <ul>
            <li>
              <a href = "<?php echo PAGE_HOME; ?>">Home</a>
            </li>
            <li>
              <a href = "<?php echo PAGE_BUY; ?>">Buy</a>
            </li>
            <li>
              <a href = "<?php echo PAGE_ORDERS; ?>">Orders</a>
            </li>
            <li>
              <a href = "<?php echo PAGE_ACCOUNT; ?>">Account</a>
            </li>
            <li>
                <?php
                    if(isset($_SESSION['user'])){
                        echo '<a href = "logout.php">Logout</a>';
                    }else{
                        echo '<a href = login.php>Login</a>';
                    }
                ?>
              
            </li>
          </ul>

        </nav>
<?php    
}

#content for home page
function displayContent()
{
?>
    <section class = "for-content">
        <h1>Hello Clients..!</h1>
        <h2>Your feet will never feel the same again.</h2>
        <h3>Skechers is your place for athletic and easygoing shoes for the entire family from many name brands. 
            You’ll discover styles for ladies, men and children from brands like Nike, Converse, Vans, Sperry, Madden Girl, Skechers, ASICS and then some! 
            With stores in the Canada furthermore, U.S. and much more choice online at Famous.com and FamousFootwear.ca, Skechers is a main family footwear goal for the popular brands you know and love.
            Skechers is a piece of parent Inc., an assorted arrangement of worldwide footwear brands. 
            Joined, these brands enable make to parent an organization with both an inheritance and a mission. 
            Parent organization’ inheritance incorporates over 130-long stretches of craftsmanship, an enthusiasm for fit and a business canny, with a mission to keep on rousing individuals to feel better… feet first.
        </h3>
        <a href="cheatsheet.txt" download="cheatsheet">Download Cheatsheet </a>
    </section>
<?php
}

#create form for login page
function displayLoginForm($errors)
{
?>    
        <section class = "for-form">
            <form action="login.php" method="POST">
            <p>
                <label>Username:</label><br>
                <input type = "text" name="username"><br>               
                <span class="red"><?php if(isset($errors['loginUsernameErrorMessage'])){echo $errors['loginUsernameErrorMessage'];} ?></span>
            </p>
            <p>
                <label>Password:</label><br>
                <input type = "text" name="password"><br> 
                <span class="red"><?php if(isset($errors['loginPasswordErrorMessage'])){echo $errors['loginPasswordErrorMessage'];} ?></span>
            </p> 
            <p>
                <input type = "submit" value="login" name="login"/><br>               
            </p>
            <h3>Need a user account? <a href="register.php">Register</a> </h3>
            
            </form>
        </section>
        <br><br><br>
                
<?php            
}

#create form for register page
function displayRegisterForm($errors, $value)
{    
?>    
        <section class = "for-form">
            <form action="register.php" method="POST">           
            <p>
                <label>First Name<span class = "red">*</span></label><br>
                <input type = "text" name="firstname" value = "<?php if(isset($value['firstname'])) {echo $value["firstname"];} ?>"><br> 
                <span class="red"><?php if(isset($errors['firstnameErrorMessage'])){echo $errors['firstnameErrorMessage'];} ?></span>
            </p>
            <p>
                <label>Last Name<span class = "red">*</span></label><br>
                <input type = "text" name="lastname" value = "<?php if(isset($value['lastname'])) {echo $value["lastname"];} ?>"><br> 
                <span class="red"><?php if(isset($errors['lastnameErrorMessage'])){echo $errors['lastnameErrorMessage'];} ?></span>
            </p>            
            <p>
                <label>Address<span class = "red">*</span></label><br>
                <input type = "text" name="address" value = "<?php if(isset($value['address'])){echo $value["address"];} ?>"><br> 
                <span class="red"><?php if(isset($errors['addressErrorMessage'])){echo $errors['addressErrorMessage'];} ?></span>            
            </p> 
            <p>
                <label>City<span class = "red">*</span></label><br>
                <input type = "text" name="city" value = "<?php if(isset($value['city'])){echo $value["city"];} ?>"><br>  
                <span class="red"><?php if(isset($errors['cityErrorMessage'])){echo $errors['cityErrorMessage'];} ?></span>          
            </p> 
            <p>
                <label>Province<span class = "red">*</span></label><br>
                <input type = "text" name="province" value = "<?php if(isset($value['province'])){echo $value["province"];} ?>"><br> 
                <span class="red"><?php if(isset($errors['provinceErrorMessage'])){echo $errors['provinceErrorMessage'];} ?></span>           
            </p> 
            <p>
                <label>Postal code<span class = "red">*</span></label><br>
                <input type = "text" name="postalcode" value = "<?php if(isset($value['postalcode'])){echo $value["postalcode"];} ?>"><br>  
                <span class="red"><?php if(isset($errors['postalcodeErrorMessage'])){echo $errors['postalcodeErrorMessage'];} ?></span>          
            </p> 
            <p>
                <label>Username<span class = "red">*</span></label><br>
                <input type = "text" name="username" value = "<?php if(isset($errors['username'])){ echo $value["username"];} ?>"><br>  
                <span class="red"><?php if(isset($errors['usernameErrorMessage'])){echo $errors['usernameErrorMessage'];} ?></span>           
            </p>
            <p>
                <label>Password<span class = "red">*</span></label><br>
                <input type = "text" name="password" value = "<?php if(isset($value['password'])){echo $value["password"];} ?>"><br>   
                <span class="red"><?php if(isset($errors['passwordErrorMessage'])){echo $errors['passwordErrorMessage'];} ?></span>           
            </p> 
            <p>
                <input type = "submit" value="Register" name="register"/><br>               
            </p>
            </form>
        </section>
                
<?php            
}

#create form for buy page
function displayBuyForm($errors, $value)
{
?>    
        <section class = "for-form">
            <form action="buy.php" method="POST">
            <p>
                <label>Product Code:</label><span class = "red">*</span><br>
                 <select name="product" id="cars">
                    <?php 
                    $products = new products();
                    foreach($products->items as $product)
                    {                         
                        echo '<option value = "'.$product->getProductUUID().'">'.$product->getProductCode().' - '.$product->getDescription().'</option>';
                    }
                    ?>
                 </select> 
                
            </p>
            <p>
                <label>Comments:</label><br>
                <input type = "text" name="comments" value = "<?php if(isset($value['comments'])){echo $value["comments"];} ?>"><br>
                <span class="red"><?php if(isset($errors['commentsErrorMessage'])){echo $errors['commentsErrorMessage'];} ?></span>
         
            </p> 
            <p>
                <label>Quantity:</label><span class = "red">*</span><br>
                <input type = "text" name="quantity" value = "<?php if(isset($value['quantity'])){echo $value["quantity"];} ?>"><br> 
                <span class="red"><?php if(isset($errors['quantityErrorMessage'])){echo $errors['quantityErrorMessage'];} ?></span>        
            </p> 
            <p>
                <input type = "submit" value="Buy" name="buy"/><br>               
            </p>
            </form>
        </section>
        <br><br><br>
                
<?php            
}

#create form for orders page
function displayOrdersForm()
{
?>    
        <section class = "for-form">
            <form action="orders.php" method="POST">            
                <label>Show purchases made on this date or later:</label><br>
                <input type = "date" id = "searchQuery" name="searchQuery"><br>                  
                <br><button name = "search" onclick="searchOrders();" >Search</button>
                <br><div id="searchResults"></div>
            </form>
        </section>
<?php            
}

#create form for account page
function displayAccountForm($errors, $value)
{
?>    
        <section class = "for-form">
            <form action="account.php" method="POST">           
            <p>
                <label>First Name<span class = "red">*</span></label><br>
                <input type = "text" name="firstname" value = "<?php if(isset($value['firstname'])) {echo $value["firstname"];} ?>" ><br>
                <span class="red"><?php if(isset($errors['firstnameErrorMessage'])){echo $errors['firstnameErrorMessage'];} ?></span>
            </p>
            <p>
                <label>Last Name<span class = "red">*</span></label><br>
                <input type = "text" name="lastname" value = "<?php if(isset($value['lastname'])) {echo $value["lastname"];} ?>"><br> 
                <span class="red"><?php if(isset($errors['lastnameErrorMessage'])){echo $errors['lastnameErrorMessage'];} ?></span>
            </p> 
            <p>
                <label>Address<span class = "red">*</span></label><br>
                <input type = "text" name="address" size="60" value ="<?php if(isset($value['address'])){echo $value["address"];} ?>"><br> 
                <span class="red"><?php if(isset($errors['addressErrorMessage'])){echo $errors['addressErrorMessage'];} ?></span>            
            </p> 
            <p>
                <label>City<span class = "red">*</span></label><br>
                <input type = "text" name="city" value = "<?php if(isset($value['city'])){echo $value["city"];} ?>"><br>
                <span class="red"><?php if(isset($errors['cityErrorMessage'])){echo $errors['cityErrorMessage'];} ?></span>          

            </p> 
            <p>
                <label>Province<span class = "red">*</span></label><br>
                <input type = "text" name="province" value = "<?php if(isset($value['province'])){echo $value["province"];} ?>"><br> 
                <span class="red"><?php if(isset($errors['provinceErrorMessage'])){echo $errors['provinceErrorMessage'];} ?></span>           
            </p> 
            <p>
                <label>Postal code<span class = "red">*</span></label><br>
                <input type = "text" name="postalcode" value = "<?php if(isset($value['postalcode'])){echo $value["postalcode"];} ?>"><br> 
                <span class="red"><?php if(isset($errors['postalcodeErrorMessage'])){echo $errors['postalcodeErrorMessage'];} ?></span>          
            </p> 
            <p>
                <label>Username<span class = "red">*</span></label><br>
                <input type = "text" name="username" value = "<?php if(isset($value['username'])){echo $value["username"];} ?>"><br>
                <span class="red"><?php if(isset($errors['usernameErrorMessage'])){echo $errors['usernameErrorMessage'];} ?></span>           
            </p>
            <p>
                <label>Password<span class = "red">*</span></label><br>
                <input type = "text" name="password" value = "<?php if(isset($value['password'])){echo $value["password"];} ?>"><br> 
                <span class="red"><?php if(isset($errors['passwordErrorMessage'])){echo $errors['passwordErrorMessage'];} ?></span>           
            </p> 
            <p>
                <input type = "submit" value="Update" name="update"/><br>               
            </p>
            </form>
        </section>
                
<?php            
}

#function for the display request message for login to website
function requestLogin()
{
    echo "<h2 style='color:blue;text-align:center'>Please login first...</h2>";
}

#function for the welcome message
function printWelcomemessage(){
    echo "<br>";
    if(isset($_SESSION['welcomeMessage'])){
        echo "<h2 style='color:blue;text-align:center'>".$_SESSION['welcomeMessage']."</h2>";
    }
}
?>