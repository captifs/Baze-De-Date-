<?php
include("config.php");
include("session.php");

    if(!isset($_SESSION))
    {
        session_start();
    }


?>

<html>

   <head>
      <title>CarDealership | Management</title>
      
<style type = "text/css">
    img {
        display: block;
        margin: 0 auto;
    }
    
        h1,h2 {
        text-align: center;
    }
</style>
      
<img src="deal.png" alt="Toyota Logo" width="500" height="150">
      
      
      
      
   </head>

    <h1>Car Dealership Management</h1>
     <h2>Welcome, Administrator! | <a href = "logout.php">Sign Out</a></h1>
 
     
     <button type="button" style="margin:auto;display:block" onclick="addNewEmployee()">New Employee</button>
    
     
   

   
   <body>
       <?php
       

       
    
       
$units_sold = "SELECT COUNT(*) as 'total', SUM(PRICE) AS 'sum' FROM sell, vehicles WHERE sell.VIN = vehicles.VIN";

       $query = "SELECT p.TRANSID as 'tid' FROM purchase p 
INNER JOIN contracts c ON p.CSIN = c.CSIN  
WHERE p.CSIN IN (
SELECT CSIN FROM contracts 
WHERE 3 >= LEASE)";

       $query2 = "SELECT  dname as 'dir' ,COUNT(*) as 'num'
    FROM employee
    WHERE dname in
    (SELECT dname FROM employee
    GROUP BY dname 
    HAVING COUNT(*)>1)
    GROUP BY dname
    LIMIT 1
";
          
       
       

    $result = $db->query($units_sold);
    if($result->num_rows > 0){           //check if query results in more than 0 rows
        while($row = $result->fetch_assoc()){   //loop until all rows in result are fetched
            
            $total_count = "<br><h2>" . "Total vehicles sold: " . $row["total"] . "</h2>";
            $total_sales = "<h2>Total company sales: $" . number_format($row["sum"]) . "</h2><br>";
            echo $total_count;
            echo $total_sales;
        }
       
    }


       $result2 = $db->query($query);
       echo "<h2>Transaction-ID for leasing contracts made for a period shorter than 3 months: " . "<br />\n";
       if($result2->num_rows > 0){           //check if query results in more than 0 rows
           while($row = $result2->fetch_assoc()){   //loop until all rows in result are fetched

               echo $row['tid'] . "<br />\n";
           }


       }

       $result3 = $db->query($query2);
       echo "<h2>The name of the director with the most employees and the number of its employees. " . "<br />\n";
       if($result3->num_rows > 0){           //check if query results in more than 0 rows
           while($row = $result3->fetch_assoc()){   //loop until all rows in result are fetched

               echo $row['dir'] . "<br />\n";
               echo $row['num'] . "<br />\n";
           }


       }

       
       ?>



       <br>
       <button type="button" style="margin:auto;display:block" onclick="transactionSearch()">Transaction Search</button>
       
<script>
function addNewEmployee() {
    window.open("newEmployee.php");
}

function transactionSearch() {
    window.open("transactionSearch.php");
}
</script>


   

   
   </body>

    
    
</html>