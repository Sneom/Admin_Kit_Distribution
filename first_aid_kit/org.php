<?php
include 'config.php'; 


$sql = "SELECT district, COUNT(*) AS kits_given FROM households GROUP BY district";
$result = $conn->query($sql);

$data = array();


$districtCounts = array();


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            "district" => $row['district'],
            "kits_given" => intval($row['kits_given']) 
        );

      
        $districtCounts[$row['district']] = intval($row['kits_given']);
    }
}


$sqlDistinctDistricts = "SELECT DISTINCT district FROM households";
$resultDistinctDistricts = $conn->query($sqlDistinctDistricts);


if ($resultDistinctDistricts->num_rows > 0) {
    while ($row = $resultDistinctDistricts->fetch_assoc()) {
        $district = $row['district'];
   
        if (!array_key_exists($district, $districtCounts)) {
            $data[] = array(
                "district" => $district,
                "kits_given" => 0
            );
        }
    }
}

usort($data, function($a, $b) {
    return strcmp($a['district'], $b['district']);
});

$data_json = json_encode($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organize Data in Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
        }
        
        .sidebar {
            width: 200px;
            background-color: #333;
            color: #fff;
            overflow: hidden;
            height: 100vh; 
        }

        .sidebar-header {
            padding: 10px;
            text-align: center;
            background-color: #222;
        }

        .tabs {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .tabs li {
            border-bottom: 1px solid #444;
        }

        .tabs li a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
        }

        .tabs li a:hover {
            background-color: #555;
        }

        .chart-container {
            flex: 1; 
            padding: 20px; 
            box-sizing: border-box; 
            overflow-x: auto; 
        }

        #orgChart {
          
            width: 100%;
        }
        .logout-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            position: absolute; 
            top: 20px; 
            right: 20px; 
        }

        .logout-btn i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?> 
    <div class="chart-container">
        <h1>Organization Data</h1>
        <form action="logout.php" method="POST">
                <button class="logout-btn" type="submit" name="logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        <canvas id="orgChart" width="400" height="200"></canvas>

        <script>
          
            var data = <?php echo $data_json; ?>;

            
            var districts = data.map(function(item) {
                return item.district;
            });

            var kitsGiven = data.map(function(item) {
                return item.kits_given;
            });

           
            districts.sort(function(a, b) {
                return a.localeCompare(b, undefined, {numeric: true, sensitivity: 'base'});
            });

         
            var ctx = document.getElementById('orgChart').getContext('2d');
            var orgChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: districts,
                    datasets: [{
                        label: 'Kits Given',
                        data: kitsGiven,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize: 1, 
                                precision: 0 
                            }
                        }]
                    }
                }
            });
        </script>
    </div>
</body>
</html>
