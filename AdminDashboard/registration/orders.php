<!DOCTYPE html>
<html>
<head>
    <title>Stock Approval and Consumption</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top: 70px; 
            
        }

        #chart-container {
            width: 600px;
            height: 400px;
            
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
            margin-bottom: 10px;
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

    </style>
</head>
<body>
<div class="navbar">
    <p class="logo"><span>Paa</span>lan</p>
    </div>

    <div class="sidebar">
        <ul>
            <li><a href="stockapprove.php">Home</a></li>
            
        </ul>
    </div>
    <div class="container">
        <h1>Stock Approval and Consumption</h1>
        <div id="chart-container">
            <canvas id="chart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function fetchData() {
            fetch('fetch_stock_data.php')
                .then(response => response.json())
                .then(data => drawChart(data))
                .catch(error => console.error('Error:', error));
        }

        function drawChart(data) {
            var ctx = document.getElementById('chart').getContext('2d');
            var labels = data.map(item => item.stock_item);
            var quantities = data.map(item => item.quantity);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Stock Consumption',
                        data: quantities,
                        backgroundColor: ' yellow'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Fetch data and draw the chart initially
        fetchData();

        
    </script>

    <?php
        $conn = new mysqli("localhost", "root", "", "Stock");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT stock_item, quantity FROM stock_approved";
        $result = $conn->query($sql);

        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        $conn->close();

        echo '<script>var stockData = ' . json_encode($data) . ';
        
        
        </script>';
    ?>

   
</body>
</html>


