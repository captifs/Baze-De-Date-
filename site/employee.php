
<html">
   
   <head>
      <title>CarDealership | Sales Representative </title>
      
      <style type = "text/css">
    img {
        display: block;
        margin: 0 auto;
    }
    
        h1,h2 {
        text-align: center;
    }
    
        th, td {
    padding: 15px;
    text-align: left;
</style>
      
<img src="deal.png" alt="Toyota Logo" width="500" height="150">
      
      
   </head>
        <body>
              <h1>Car Dealership Sales Representative</h1>
     <h2>Welcome, Lisa Scott! | <a href = "logout.php">Sign Out</a></h1>
            
            
             <button type="button" style="margin:auto;display:block" onclick="newSale()">New Sale</button>
             
             
             <script>

function newSale() {
    window.open("newPurchase.php");
}



</script>    
             
             
             
        </body>

        

   
   

   
</html>


<?php
include("config.php");
include("session.php");

if(!isset($_SESSION))
{
    session_start();
}


$units_sold = "SELECT COUNT(*) as 'total', SUM(PRICE) AS 'sum' FROM sell, vehicles WHERE sell.eid = 8 AND sell.VIN = vehicles.VIN";

    $result = $db->query($units_sold);
    if($result->num_rows > 0){           //check if query results in more than 0 rows
        $row = $result->fetch_assoc();   //loop until all rows in result are fetched
           
            echo "<br>" . "Vehicles sold so far: " . $row["total"] . "<br>";
            echo "Total sales: $" . number_format($row["sum"]) . "<br>";
    }
    else {
        echo "No sales to show";
    }
       


?>

<table style="width:100%">
    <thead>
            <tr>
                <th>Trans No.</th>
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
                <th>Price</th>
        
            </tr>
    </thead>

    
    <tbody>
        <?php
        
        

   $emp_sales = "SELECT * FROM sell, vehicles, purchase WHERE sell.eid = 8 AND sell.vin = purchase.VIN AND sell.vin = vehicles.VIN";

   $query = "SELECT CName as 'name'
FROM vehicles
INNER JOIN sell ON sell.vin = vehicles.VIN 
INNER JOIN customer ON sell.eid= customer.eid
WHERE PRICE IN (
SELECT PRICE FROM vehicles
WHERE year = 2017
ORDER BY PRICE ASC  )
";
$query2 = "SELECT Model as 'mod' FROM vehicles
WHERE VIN NOT IN 
(SELECT TVIN FROM Truck) 
AND VIN IN
(SELECT VIN FROM SUV)
AND YEAR IN (
SELECT YEAR  From VEHICLES WHERE YEAR BETWEEN  CURDATE() - INTERVAL 5 YEAR AND CURDATE()
) 
ORDER BY PRICE DESC
LIMIT 1
";

        $result2 = $db->query($query);
        echo "<h2>Name of customer/customers for the 2016 year:" . "<br />\n";
        if($result2->num_rows > 0){           //check if query results in more than 0 rows
            while($row = $result2->fetch_assoc()){   //loop until all rows in result are fetched

                echo $row['name'] . "<br />\n";
            }


        }

        $result3 = $db->query($query2);
        echo "<h2>Display the most expensive vehicle apart from trucks, which have been traded in the last 5 years" . "<br />\n";
        if($result3->num_rows > 0){           //check if query results in more than 0 rows
            while($row = $result3->fetch_assoc()){   //loop until all rows in result are fetched

                echo $row['mod'] . "<br />\n";
            }


        }



    
    $result = $db->query($emp_sales);
    if($result->num_rows > 0){           //check if query results in more than 0 rows
        while($row = $result->fetch_assoc()){   //loop until all rows in result are fetched
        ?>    
          <tr>
        <td><?php echo $row["TRANSID"]?></td>
        <td><?php echo $row["MAKE"]?></td>
        <td><?php echo $row["MODEL"]?></td>
        <td><?php echo $row["YEAR"]?></td>
        <td><?php echo $row["PRICE"]?></td>
  </tr>




                
        <?php
        
        }
        
       
    }
    else {
        echo "No sales to show.";
    }
     ?>
    </tbody>
    
    
    
  

  
</table>