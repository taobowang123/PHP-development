<html>

<head>
    <title>orders</title>
    <link rel="stylesheet" type="text/css" href="index.css" />
    <h1 class="text_need_align">ORDERS</h1>
</head>

<body>
    <header>
                        <?php include "navbar.php" ?>
    </header>
    <main>


<!--        Error handling function-->
        <?php   
        // Error handling function
        function customError($errno, $errstr) {
        echo "<b>Error:</b> [$errno] $errstr<br>";
        echo "Ending Script";
        die();
        }
        // Set error handler
        set_error_handler("customError");
        
        
        //connect to db
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "classicmodels";
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (! $conn) {
            die("Connection failed: " . mysqli_connect_error());
       }
        
        //the first table   
        $in_process = "SELECT orderNumber, orderDate,status FROM orders where status ='in process'";
        $result = mysqli_query($conn, $in_process);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        echo "<div id='subtitle'>All orders currently 'In process'</div>";
        echo "<table id='in_process'>";
        echo "<tr><th>orderNumber</th><th>orderDate</th><th>status</th></tr>";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td><a href='orders.php?orderNumber=".$row["orderNumber"]."#details'>" . $row["orderNumber"]. " </td><td> " . $row["orderDate"] . "</td><td>". $row["status"] . "</td></tr>";
            }
        } 
        echo "</table>";
        
//        the second table
        $cancelled = "SELECT orderNumber, orderDate,status FROM orders where status ='cancelled'";

        $result = mysqli_query($conn, $cancelled);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        echo "<div id='subtitle'>All cancelled orders</div>";
        echo "<table id='cancelled'>";
        echo "<tr><th>orderNumber</th><th>orderDate</th><th>status</th></tr>";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td><a href='orders.php?orderNumber=".$row["orderNumber"]."#details'>" . $row["orderNumber"]. " </td><td> " . $row["orderDate"] . "</td><td>". $row["status"] . "</td></tr>";
            }
        } 
        echo "</table>";
        
//        the third table
        $most_20 = "SELECT orderNumber, orderDate,status FROM orders order by orderNumber DESC limit 20";
        $result = mysqli_query($conn, $most_20);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        echo "<div id='subtitle'>The 20 most recnet orders</div>";
        echo "<table id='most_20'>";
        echo "<tr><th>orderNumber</th><th>orderDate</th><th>status</th></tr>";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td><a href='orders.php?orderNumber=".$row["orderNumber"]."#details'>" . $row["orderNumber"]. " </td><td> " . $row["orderDate"] . "</td><td>". $row["status"] . "</td></tr>";
            }
        } 
        echo "</table>";
        
        
//        in details
        if(isset($_GET["orderNumber"])){
            $orderNumber=$_GET["orderNumber"];
            $orderdetails="select products.productCode,products.productLine,products.productName,orders.comments from products,orders,orderdetails where orderdetails.orderNumber=orders.orderNumber AND orderdetails.productCode=products.productCode AND orders.orderNumber='$orderNumber'";
            $result=mysqli_query($conn, $orderdetails);
            if (mysqli_num_rows($result) > 0) {
            // output data of each row
            echo "<div id='subtitle'><div id='info'><a name='details'>Details of orderNumber: ".$_GET["orderNumber"]."</a></div></div>";
            echo "<table id='order_in_details'>";
            echo "<tr><th>productCode</th><th>productLine</th><th>productName</th><th>comments</th></tr>";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row["productCode"]. " </td><td> " . $row["productLine"] . "</td><td>". $row["productName"] . "</td><td>". $row["comments"] . "</td></tr>";
            }
        } 
        echo "</table>";
        }
        
        ?>

    </main>

    <footer>
                <?php include "footer.php" ?>
    </footer>

</body>




</html>
