<?php 
    require(__DIR__ . '/util/db.connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="./resources/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/home.css">

    <title>Satellite Tracker</title>

    
    <script src="./scripts/libraries/p5.min.js" type="text/javascript"></script>
    <script src="./scripts/libraries/mappa.js" type="text/javascript"></script>

    <script src="./scripts/sketch.js" type="text/javascript"></script>
</head>
<body>
    <div class="container">
        <header>
            <a href="./index.php" class="logo">
                <i class="fas fa-satellite"></i>
                <h1>Satellite Tracker</h1>
            </a>
            <nav>
                <?php
                    if(isset($_COOKIE["cid"])) {
                        $nameSql = "SELECT company_name FROM Companies WHERE company_id = '".$_COOKIE["cid"]."'";

                        if ($result = $mysqli->query($nameSql)) {
                            $name = $result->fetch_object()->company_name;
                            echo '<p>Welcome, ' . $name . '</p>';
                            echo '<a href="./pages/insertSatellite.php">Add New Satellite</a>';
                            echo '<a href="./pages/updateSatellite.php">Update Satellite</a>';
                            echo '<a href="?logout">Logout</a>';
                        } 

                        if(isset($_GET['logout'])) {
                            unset($_COOKIE['cid']); 
                            setcookie('cid', "", time()-3600, '/'); 
                            header("Location: ./index.php");
                        }
                    } else {
                        echo '<a href="./login/login.php">Login</a>';
                    }
                ?>
            </nav>
        </header>

        <main>
            <div class="company-select">
                <h1>Space X</h1>
                <form method="get">
                    <select name="company" id="company">
                        <option value="spacex">Space X</option>
                    </select>
                </form>
            </div>
            <div id="map"></div>
            <div id="info">
                <div>
                    <h2>Satellites in orbit</h2>
                    <table id="orbit-table">
                        <tr>
                            <th>Launch Date</th>
                            <th>Launch Site Latitude</th>
                            <th>Launch Site Longitude</th>
                            <th>Altitude</th>
                            <th>Inclination</th>
                            <th>Color</th>
                            <th>Display</th>
                        </tr>
                        <tr>
                            <td>10/18/2021</td>
                            <td>28.6272</td>
                            <td>-80.6209</td>
                            <td>408</td>
                            <td>30.2</td>
                            <td class="map-label"><span class="orbit-color"></td>
                            <td><input type="checkbox" checked>
                        </tr>
                        <tr>
                            <td>8/22/2020</td>
                            <td>37.09</td>
                            <td>-40.92</td>
                            <td>602</td>
                            <td>-70.3</td>
                            <td class="map-label"><span class="orbit-color"></td>
                            <td><input type="checkbox" checked>
                        </tr>
                        <tr>
                            <td>2/9/2019</td>
                            <td>34.5813</td>
                            <td>-120.6266</td>
                            <td>543</td>
                            <td>50.1</td>
                            <td class="map-label"><span class="orbit-color"></td>
                            <td><input type="checkbox" checked>
                        </tr>
                    </table>
                </div>

                <div>
                    <h2>Satellites waiting to be launched</h2>
                    <table id="launch-table">
                        <tr>
                            <th>Pending Launch Date</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Color</th>
                            <th>Display</th>
                        </tr>
                        <tr>
                            <td>10/2/2022</td>
                            <td>28.6272</td>
                            <td>-80.6209</td>
                            <td class="map-label"><span class="site-color"></td>
                            <td><input type="checkbox" checked>
                        </tr>
                        <tr>
                            <td>5/30/2024</td>
                            <td>34.5813</td>
                            <td>-120.6266</td>
                            <td class="map-label"><span class="site-color"></td>
                            <td><input type="checkbox" checked>
                        </tr>
                    </table>
                </div>
            </div>
        </main>

        <footer>
            <p>CSCI 4370 Group 5 &copy Satellite Tracker Group </p>
        </footer>
    </div>
</body>
</html>
