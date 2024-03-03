<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            height: 100vh; 
            width: 200px;
            background-color: #333;
            color: #fff;
            overflow: hidden;
            display: flex; 
            flex-direction: column; 
        }

        .sidebar-header {
            padding: 10px;
            text-align: center;
            background-color: #222;
            font-size: 1.2em;
            font-weight: bold;
        }

        .sidebar-header img {
            width: 176px; 
            height: auto; 
            margin-bottom: 10px;
        }

        .tabs {
            list-style-type: none;
            padding: 0;
            margin: 0;
            flex-grow: 1; 
        }

        .tabs li {
            border-bottom: 1px solid #444;
        }

        .tabs li a {
            display: block;
            padding: 15px 20px;
            text-decoration: none;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .tabs li a:hover {
            background-color: #555;
        }

       
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <a href="specific.php">
                <img src="BWF_logo.jpeg" alt="BWF Logo">
            </a>
        </div>
        
        <ul class="tabs">
            
            <!-- <li><a href="dashboard.php">Dashboard</a></li> -->
            <li><a href="specific.php">Kits Delivered</a></li> 
            <li><a href="export.php">Data / Export CSV</a></li>
            <li><a href="org.php">Graph</a></li>
        </ul>
    </div>
</body>
</html>
