<?php
include 'config.php'; 

$today = date("Y-m-d");


$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT district, COUNT(*) AS kits_given FROM households WHERE DATE(published_date) = '$today'";


if (!empty($search)) {
    $sql .= " AND (district LIKE '%$search%')";
}

$sql .= " GROUP BY district";

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            "district" => $row['district'],
            "kits_given" => intval($row['kits_given'])
        );
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Specific Data</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
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
        }

        .content {
            flex: 1;
            padding: 20px;
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
        
        .search-container {
            margin-bottom: 20px;
        }

        .search-container input[type=text] {
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .search-container button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?> 

    <div class="content">
        <h1>Kits Given Today by District</h1>
        <form action="logout.php" method="POST">
            <button class="logout-btn" type="submit" name="logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
        
        <!-- Search container -->
        <div class="search-container">
            <form method="GET">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit">Search</button>
            </form>
        </div>
        
        <table id="kitsTable" class="display">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>District</th>
                    <th>Kits Given</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= $today ?></td>
                        <td><?= $row['district'] ?></td>
                        <td><?= $row['kits_given'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#kitsTable').DataTable({
                searching: false
            });
        });
    </script>
</body>
</html>
