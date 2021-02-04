//############################################Revision History################################################
//
//Happy Patel (2013214)		13-10-2020		Create project folder 
//Happy Patel (2013214)		13-10-2020		Create index file  
//Happy Patel (2013214)		18-10-2020		Create all functions and css file   
//Happy Patel (2013214)		18-10-2020		Create home page and buying page    
//Happy Patel (2013214)		19-10-2020		working on validation part    
//Happy Patel (2013214)		20-10-2020	  	validation part  complete   
//Happy Patel (2013214)		28-10-2020              text file part complete order page designing done									   
//Happy Patel (2013214)		29-10-2020	  	fetch data on page 3    
//Happy Patel (2013214)		29-10-2020	  	90%  work complete  
//Happy Patel (2013214)		31-10-2020	  	last page done   
//Happy Patel (2013214)		26-11-2020	  	login and register design done, database creation done       
//Happy Patel (2013214)		28-11-2020	  	design of all forms done   
//Happy Patel (2013214)		30-11-2020	  	validation done using classes   
//Happy Patel (2013214)		5-12-2020	  	registration done, buy page done       
//Happy Patel (2013214)		5-12-2020	  	login page done   
//Happy Patel (2013214)		8-12-2020	  	account page, pur_chases page complete(100%)
//Happy Patel (2013214)		10-12-2020	  	rename the page pur_chases to orders
//
//############################################################################################################

//debugging function
function displayElementProperties(elementID)
{
    //optional
}

//for the errors
function handleError(error)
{
    alert('js error' + error);
}

//function searchOrders() for displaying orders of particular user in table
function searchOrders()
{
    try{
        //variable to perform ajax request
       var xhr = new XMLHttpRequest(); 
       
       xhr.onreadystatechange = function()
       {
           //AJAX ready states
           //0 = uninitialized
           //1 = loading
           //2 = loaded
           //3 = interactive
           //4 = complete
           
           //use constants
           if(xhr.readyState == 4 && xhr.status == 200)
           {
               //response can be XML 
               //xhr.responseXML
               
               //response can be HTML
               //xhr.responseText
               
               document.getElementById('searchResults').innerHTML = xhr.responseText;
                              
           }
       }
       xhr.open("POST", "orders.php");
       
       //specify that request does not contain binary data
       xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
       
       var searchTextbox = document.getElementById('searchQuery');
       var searchQuery = searchTextbox.value;
       
       xhr.send("searchQuery=" + searchQuery); //searchQuery= 2020-12-01(date)
    }
    catch(error){
        handleError(error);
    }
}

function getXmlHttpRequest()
{
    try{
       var xhr = null ;
       if(window.XMLHttpRequest()) //for firefox and almost all browsers
       {
           xhr = new XMLHttpRequest();
       }
       else
       {
           
       }
       return xhr;
    }
    catch(error){
        handleError(error);
    }
}