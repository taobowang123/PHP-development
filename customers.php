
<html>

<head>
    <title>customers</title>
    <link rel="stylesheet" type="text/css" href="index.css" />
    <h1 class="text_need_align">CUSTOMERS</h1>
</head>

<body>
    <header>
                <?php include "navbar.php" ?>    
    </header>
    <main>
        <?php
        // Error handling function
        function customError($errno, $errstr) {
        echo "<b>Error:</b> [$errno] $errstr<br>";
        echo "Ending Script";
        die();
        }
        // Set error handler
        set_error_handler("customError");
        
        
//        connect to db
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
       
        
        
        $customers = "SELECT customerName, country,city,phone FROM customers order by country";

        $result = mysqli_query($conn, $customers);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        echo "<table id='customers'>";
        echo "<tr><th class='text_need_align'>CustomerName</th><th class='text_need_align'>Country</th><th class='text_need_align'>City</th><th class='text_need_align'>Phone</th></tr>";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row["customerName"]. " </td><td> " . $row["country"] . "</td><td>". $row["city"] . "</td><td>". $row["phone"] . "</td></tr>";
            }
        } 
        echo "</table>";
        ?>

    </main>

    <footer>
                <?php include "footer.php" ?>
    </footer>

</body>




</html>


