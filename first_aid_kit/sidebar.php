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
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
        }

        .tabs li a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <a href="dashboard.php" style="color: white; text-decoration: none;">Admin Dashboard</a> 
        </div>
        
        <ul class="tabs">
            <li><a href="org.php">Tab 1</a></li>
            <li><a href="specific.php">Tab 2</a></li> 
            <li><a href="export.php">Tab 3</a></li>
        </ul>
    </div>
</body>
</html>
