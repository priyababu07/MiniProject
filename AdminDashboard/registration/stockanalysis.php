<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .chart-container {
            width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-sizing: border-box;
        }

        .chart-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .chart-pie {
            width: 300px;
            height: 300px;
            margin: 0 auto;
            position: relative;
        }

        .chart-pie::before {
            content: "";
            position: absolute;
            top: calc(50% - 150px);
            left: calc(50% - 150px);
            width: 300px;
            height: 300px;
            border-radius: 50%;
            border: 1px solid #ccc;
        }

        .chart-slice {
            position: absolute;
            top: calc(50% - 150px);
            left: calc(50% - 150px);
            width: 300px;
            height: 300px;
            border-radius: 50%;
            clip: rect(0, 150px, 300px, 0);
            transform-origin: center center;
        }

        .chart-label {
            position: absolute;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            top: 50%;
            left: 50%;
            width: 100px;
            transform: translate(-50%, -50%);
        }

        .chart-label span {
            display: block;
            font-size: 14px;
            font-weight: normal;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="chart-container">
        <h2 class="chart-title">Quantity Consumed in a Month (Pie Chart)</h2>
        <div class="chart-pie">
            <?php
            // Create a database connection
            $conn = mysqli_connect("localhost", "root", "", "Stock");

            // Check if the connection is successful
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch the quantity consumed in a month
            $sql = "SELECT MONTH(consumption_date) AS month, SUM(quantity) AS total_quantity FROM stock_approved GROUP BY MONTH(consumption_date)";
            $result = mysqli_query($conn, $sql);

            // Prepare the data for visualization
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $month = $row['month'];
                $quantity = intval($row['total_quantity']);
                $data[] = [$month, $quantity];
            }

            // Close the database connection
            mysqli_close($conn);
            ?>

            <?php
            $total = array_sum(array_column($data, 1));
            $startAngle = 0;

            foreach ($data as $item) {
                $percentage = ($item[1] / $total) * 100;
                $endAngle = $startAngle + $percentage * 3.6;

                $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));

                echo '<div class="chart-slice" style="background-color: ' . $color . '; transform: rotate(' . $startAngle . 'deg)"></div>';
                echo '<div class="chart-label" style="transform: rotate(' . (($startAngle + $endAngle) / 2) . 'deg)">';
                echo '<span>' . $item[0] . '</span>';
                echo '<span>' . $item[1] . '</span>';
                echo '<span>' . round($percentage, 1) . '%</span>';
                echo '</div>';

                $startAngle = $endAngle;
            }
            ?>
        </div>
    </div>
</body>
</html>
