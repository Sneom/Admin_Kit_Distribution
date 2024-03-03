<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="sidebar.css"> 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            position: relative; 
        }

        .dashboard-container {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 200px;
            background-color: #333;
            color: #fff;
            overflow: hidden;
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

        .content {
            flex: 1;
            padding: 20px;
            position: relative; 
        }

        h1 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
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
        
        .sidebar {
            width: 200px;
            background-color: #333;
            color: #fff;
            overflow: hidden;
        }

        .sidebar-header {
            padding: 10px;
            text-align: center;
            background-color: #222;
        }
    </style>
</head>
<body>
   
    <div class="dashboard-container">
         <div class="sidebar">
        <?php include 'sidebar.php'; ?> 
    </div>
        <div class="content">
            <h1>Households Data</h1>
            <form action="logout.php" method="POST">
                <button class="logout-btn" type="submit" name="logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
            <div class="search-container">
            <form method="GET">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit">Search</button>
            </form>
        </div>
            <table id="householdsTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Mobile No</th>
                        <th>Family Members</th>
                        <th>District</th>
                        <th>Published Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'config.php';

                    if (isset($_GET['search'])) {
                        $search = $_GET['search'];
                        $sql = "SELECT * FROM households WHERE 
                                name LIKE '%$search%' OR 
                                email LIKE '%$search%' OR 
                                gender LIKE '%$search%' OR 
                                mobileNo LIKE '%$search%' OR 
                                adharNo LIKE '%$search%' OR 
                                address LIKE '%$search%' OR 
                                pinCode LIKE '%$search%' OR 
                                district LIKE '%$search%' OR 
                                knowsFirstAid LIKE '%$search%' OR 
                                hasCprTraining LIKE '%$search%' OR 
                                date LIKE '%$search%'";
                    } else {
                        $sql = "SELECT * FROM households";
                    }

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['name']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['gender']}</td>
                                    <td>{$row['mobileNo']}</td>
                                    <td>{$row['familyMembers']}</td>
                                    <td>{$row['district']}</td>
                                    <td>" . (isset($row['date']) ? $row['date'] : '') . "</td>
                                    <td><a href=\"dashboard.php?delete={$row['id']}\">Delete</a></td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No data available</td></tr>";
                    }

                    if (isset($_GET['delete'])) {
                        $deleteId = $_GET['delete'];
                        $deleteSql = "DELETE FROM households WHERE id = $deleteId";

                        if ($conn->query($deleteSql) === TRUE) {
                            echo "<script>alert('Record deleted successfully');</script>";
                            echo "<script>window.location.href = 'dashboard.php';</script>";
                        } else {
                            echo "Error deleting record: " . $conn->error;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#householdsTable').DataTable({
                searching: false
            });
        });
    </script>
</body>
</html>
