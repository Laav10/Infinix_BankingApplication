<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Project_101";
$putsuccess = False;
session_start();

$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_error($con));
}
if($_SERVER['REQUEST_METHOD']=='POST'){
    $Passwd=$_POST['password'];
    $PANP=$_POST['PANP'];
    $AMNT=$_POST['amt'];


$sql = "SELECT AMT FROM `regis` WHERE PAN='".$_SESSION['PAN']."'";
$result = mysqli_query($con, $sql);

if ($result) {
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        // Fetch the row as an associative array
        $row = mysqli_fetch_assoc($result);
        $amt = $row['AMT']; // Access the AMT column value

        if (($amt - $AMNT) >= 0) {
            $sql1 = "UPDATE `regis` SET AMT = AMT + '$AMNT' WHERE PAN='$PANP'";
            $result = mysqli_query($con, $sql1);
            $sql2 = "UPDATE `regis` SET AMT = AMT - '$AMNT' WHERE PAN='".$_SESSION['PAN']."'";
            $result = mysqli_query($con, $sql2);
            $putsuccess = True;
        } else {
            echo "<h1>Too Low Balance!!</h1>";
        }
    } else {
        echo "<h1>No results found</h1>";
    }
} else {
    echo "<h1> Critical Error: Query failed</h1>";
}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Infinity Dashboard</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #080710;
            color: #ffffff;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #080710;
            padding: 20px;
            box-sizing: border-box;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.13);
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Infinix</a>
        </div>
    </nav>

    <div class="row">
        <div class="col-3 sidebar">
            <h3>Infinix</h3>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <b>Balance: Rs. <?php 
            $sqlx= "SELECT AMT FROM `regis` where PAN='".$_SESSION['PAN']."'";
            $result = mysqli_query($con, $sqlx);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $amntt = $row['AMT'];
                echo $amntt;
            }                    ?></b>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log out</a>
                </li>
            </ul>
        </div>
        <div class="col-9 main-content">
        <?php
    if($putsuccess) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Transaction Successful!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          </div>';
    }
    ?>
            <h1>Welcome 
            <?php 
$sqlx= "SELECT Name FROM `regis` where PAN='".$_SESSION['PAN']."'";
$result = mysqli_query($con, $sqlx);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nmm = $row['Name'];
    echo $nmm;
}              
             ?></h1><br><br>
            <h2>Transaction</h2>
            <div class="form-container">
                <form action="transaction.php" method="post">
                    <div class="mb-3">
                        <label for="PANP" class="form-label">PAN</label>
                        <input type="text" class="form-control" id="PANP" name="PANP" placeholder="Enter PAN">
                    </div>
                    <div class="mb-3">
                        <label for="amt" class="form-label">AMT</label>
                        <input type="text" class="form-control" id="amt" name="amt" placeholder="Enter AMT">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Transact</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
