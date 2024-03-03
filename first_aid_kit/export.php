<?php
include 'config.php';

// Check if download button is clicked
if (isset($_POST['downloadUserPhotos'])) {
    downloadUserPhotos();
    exit;
}

// Check if download button is clicked
if (isset($_POST['downloadSignaturePhotos'])) {
    downloadSignaturePhotos();
    exit;
}

// Function to download images
function downloadImages($imageUrls, $folderName) {
    // Create folder if not exists
    if (!is_dir($folderName)) {
        mkdir($folderName);
    }

    // Loop through image URLs and download them
    foreach ($imageUrls as $imageUrl) {
        $fileName = basename($imageUrl);
        $filePath = $folderName . '/' . $fileName;
        file_put_contents($filePath, file_get_contents($imageUrl));
    }

    // Zip the folder
    $zipFile = $folderName . '.zip';
    $zip = new ZipArchive();
    if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($folderName),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($folderName) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
    }

    // Delete the folder after zipping
    array_map('unlink', glob("$folderName/*"));
    rmdir($folderName);

    // Download the zip file
    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename=' . $zipFile);
    header('Content-Length: ' . filesize($zipFile));
    readfile($zipFile);

    // Delete the zip file after download
    unlink($zipFile);
}

// Function to download user photos
function downloadUserPhotos() {
    global $conn;
    $sql = "SELECT userPhoto FROM households";
    $result = $conn->query($sql);
    if ($result) {
        $imageUrls = array();
        while ($row = $result->fetch_assoc()) {
            if (!empty($row['userPhoto'])) {
                $imageUrls[] = $row['userPhoto'];
            }
        }
        downloadImages($imageUrls, 'user_photos');
    } else {
        echo "Error executing query: " . $conn->error;
    }
}

// Function to download signature photos
function downloadSignaturePhotos() {
    global $conn;
    $sql = "SELECT signature FROM households";
    $result = $conn->query($sql);
    if ($result) {
        $imageUrls = array();
        while ($row = $result->fetch_assoc()) {
            if (!empty($row['signature'])) {
                $imageUrls[] = $row['signature'];
            }
        }
        downloadImages($imageUrls, 'signature_photos');
    } else {
        echo "Error executing query: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export data</title>
    <link rel="stylesheet" href="sidebar.css"> 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
    <style>
    /* Your CSS styles here */
    body {
            font-family: Arial, sans-serif;
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
            overflow-x: auto; 
        }

        h1 {
            margin-top: 0;
        }

        table {
            width: 100%;
            max-width: 800px; 
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

        .search-container input[type=text], .search-container select, .search-container input[type=date] {
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
        .download-btn {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-right: 10px; /* Adjust as needed */
    }

    .download-btn:hover {
        background-color: #45a049;
    }

    /* Additional styles for download buttons */
    .download-btn.user-photos {
        background-color: #007bff; /* Change color for user photos */
    }

    .download-btn.signature-photos {
        background-color: #007bff; /* Change color for signature photos */
    }
    </style>
</head>
<body>
    <!-- Your HTML content here -->
    <div class="sidebar">
        <?php include 'sidebar.php'; ?> 
    </div>
    <div class="content">
        <h1>Export data</h1>
        <form action="logout.php" method="POST">
            <button class="logout-btn" type="submit" name="logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
        <div class="search-container">
            <form method="GET">
                <input type="text" name="name" placeholder="Search by Name...">
                <input type="text" name="email" placeholder="Search by Email...">
                <input type="text" name="gender" placeholder="Search by Gender...">
                <input type="text" name="mobileNo" placeholder="Search by Mobile No...">
                <input type="text" name="adharNo" placeholder="Search by Aadhar No...">
                <input type="text" name="familyMembers" placeholder="Search by Family Members...">
                <input type="text" name="adults" placeholder="Search by Adults...">
                <input type="text" name="children" placeholder="Search by Children...">
                <input type="text" name="address" placeholder="Search by Address...">
                <input type="text" name="pinCode" placeholder="Search by Pin Code...">
                <input type="text" name="district" placeholder="Search by District...">
                <select name="knowsFirstAid">
                    <option value="">Knows First Aid</option>
                    <option value="1">True</option>
                    <option value="0">False</option>
                </select>
                <select name="hasCprTraining">
                    <option value="">Has CPR Training</option>
                    <option value="1">True</option>
                    <option value="0">False</option>
                </select>
                <input type="date" name="published_date" placeholder="Search by Published Date...">
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
                    <th>Aadhar No</th>
                    <th>Family Members</th>
                    <th>Adults</th>
                    <th>Children</th>
                    <th>Address</th>
                    <th>Pin Code</th>
                    <th>District</th>
                    <th>Knows First Aid</th>
                    <th>Has CPR Training</th>
                    <th>User Photo</th>
                    <th>Signature</th>
                    <th>Published Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Constructing the SQL query
                $sql = "SELECT * FROM households";

                // Add search conditions for all parameters except name
                $searchConditions = array();
                foreach ($_GET as $key => $value) {
                    if (!empty($value) && $key !== 'name') {
                        $searchConditions[] = "$key='$value'";
                    }
                }

                // Add search condition for name separately
                if (!empty($_GET['name'])) {
                    $name = $_GET['name'];
                    // Assuming 'name' is a varchar field, use LIKE for partial matching
                    $searchConditions[] = "name LIKE '%$name%'";
                }

                // Combining all search conditions
                if (!empty($searchConditions)) {
                    $sql .= " WHERE " . implode(" AND ", $searchConditions);
                }

                echo "SQL Query: $sql"; // Debugging output

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['gender']}</td>
                                <td>{$row['mobileNo']}</td>
                                <td>{$row['adharNo']}</td>
                                <td>{$row['familyMembers']}</td>
                                <td>{$row['adults']}</td>
                                <td>{$row['children']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['pinCode']}</td>
                                <td>{$row['district']}</td>
                                <td>{$row['knowsFirstAid']}</td>
                                <td>{$row['hasCprTraining']}</td>
                                <td><a href={$row['userPhoto']} target='_blank'>{$row['userPhoto']}</a></td>
                                <td><a href={$row['signature']} target='_blank'>{$row['signature']}</a></td>
                                <td>" . (isset($row['published_date']) ? $row['published_date'] : '') . "</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='16'>No data available</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <!-- Download Images Buttons -->
        <form action="" method="POST">
            <button type="submit" name="downloadUserPhotos" class="download-btn user-photos">Download User Photos</button>
            <button type="submit" name="downloadSignaturePhotos" class="download-btn signature-photos">Download Signature Photos</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#householdsTable').DataTable({
                dom: 'Bfrtip', 
                buttons: [
                    {
                        extend: 'csvHtml5', 
                        dateFormat: 'dd-mm-yyyy',
                        customize: function (csv) {
                            // Replace image URLs with file paths
                            var rows = csv.split('\n');
                            for (var i = 1; i < rows.length; i++) {
                                var cells = rows[i].split(',');
                                // Replace user photo URL
                                cells[13] = 'user_photos/' + cells[13].split('/').pop();
                                // Replace signature URL
                                cells[14] = 'signature_photos/' + cells[14].split('/').pop();
                                rows[i] = cells.join(',');
                            }
                            return rows.join('\n');
                        }
                    }
                ],
                searching: false
            });
        });
    </script>
</body>
</html>
