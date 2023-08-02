
<?php
require_once 'config/imp.php';
require_once 'config/function2.php';

// Check if the search parameter is present in the URL
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Retrieve data from the database and filter based on the search parameter
$result = display_data($search);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Pregnant Women Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            color: #fff;
            padding: 15px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
        }

        .navbar h1 {
            margin: 0;
        }
        .navbar-brand{
            color:white;
        }

        .sidebar {
            width: 180px;
            background-color: #f4f4f4;
            padding: 15px;
            height: calc(100vh - 70px);
            position: fixed;
            top: 70px;
            left: 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar li {
            margin-bottom: 19px;
        }

        .sidebar a {
            display: block;
            text-decoration: none;
            color: #333;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #555;
            color: #fff;
        }

        .content {
            margin-left: 200px;
            padding: 20px;
            margin-top: 70px;
        }
       
        .container {
            margin-top: 80px;
        }
       
        h1 {
            margin-top: 0;
            color:#000;
        }

        table {
            border-collapse: collapse;
            margin-bottom: 150px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #dddddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            display: inline-block;
        }

        button {
            padding: 5px 10px;
            margin-right: 5px;
            border-radius: 3px;
            border: none;
            cursor: pointer;
        }
        
    </style>
</head>
<body>
<nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                Paalan
            </a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 sidebar">
                
                <ul>
                    <li><a href="main.php">Home</a></li>
                    
                </ul>
    
    
            </div>
            
            <div class="col-md-9 content">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <form action="" method="GET" class="mb-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search by City" value="<?php echo $search; ?>">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>
 
                            
                                <table class="table">
                                <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Age</th>
                                            <th>City</th>
                                            <th>Pincode</th>
                                            
                                            <!-- <th>Edit</th>
                                            <th>Delete</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['firstName']; ?></td>
                                                <td><?php echo $row['lastName']; ?></td>
                                                <td><?php echo $row['age']; ?></td>
                                                <td><?php echo $row['city']; ?></td>
                                                <td><?php echo $row['pCode']; ?></td>
                                                
                                                <!-- <td><a href="#" class="btn btn-primary">Edit</a></td>
                                                <td><a href="#" class="btn btn-danger">Delete</a></td> -->
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-d6f5/2EnLdIYfqP1IWE3wq75T17yYED8MO4KEnX5bT63JfgIpq62mk1TsTZyS3HZ" crossorigin="anonymous"></script>
</body>
</html>
