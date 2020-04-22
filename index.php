<html>

<head>
    <title>product lines</title>
    <link rel="stylesheet" type="text/css" href="stype.css" />
    <h1 class="text_need_align">PRODUCTLINES</h1>
</head>

<body>
    <header>
        <?php include "navbar.php"; ?>
    </header>
    <main>
        <?php
    
    
//        Error handling function
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
        
        //data select
        $productline = "SELECT productLine, textDescription FROM productlines";
        $result = mysqli_query($conn, $productline);
        // output data of each row
        echo "<table>";
        echo "<tr><th class='text_need_align'>ProductLine</th><th class='text_need_align'>TextDescription</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td><a href='index.php?proLine=".$row["productLine"]."#details'>".$row["productLine"]."</a></td><td> ".$row["textDescription"]."</td></tr>";

        }
        echo "</table>";
        
        
        //the second table
        if(isset($_GET["proLine"])){
            $productline=$_GET["proLine"];
            $productlist= "SELECT productCode,productName,productLine,productScale,productvendor,productDescription,quantityInStock,buyPrice,MSRP FROM products where productLine='$productline'";
            $result2 = mysqli_query($conn, $productlist);
  
            // output data of each row
            echo "<div id='subtitle'><a name='details' id='subtitle'>Details of : ".$_GET["proLine"]."</a></div>";
            echo "<table id='productlist'>";
            echo "<tr><th class='text_need_align'>productCode</th><th class='text_need_align'>productName</th><th class='text_need_align'>productLine</th><th class='text_need_align'>productScale</th><th class='text_need_align'>productvendor</th><th class='text_need_align'>productDescription</th><th class='text_need_align'>quantityInStock</th><th>buyPrice</th><th class='text_need_align'>MSRP</th></tr>";
            while($row = mysqli_fetch_assoc($result2)) {
                echo "<tr><td>".$row["productCode"] . "</td><td>" . $row["productName"]. "</td><td> " . $row["productLine"] . "</td><td>".$row["productScale"] ."</td><td>" . $row["productvendor"]. "</td><td>".$row["productDescription"] . "</td><td>" . $row["quantityInStock"]. "</td><td>".$row["buyPrice"] ."</td><td>" . $row["MSRP"]. "</td></tr>";
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


