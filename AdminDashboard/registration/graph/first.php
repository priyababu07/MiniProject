<?php
require_once 'config/imp.php';
require_once 'config/function2.php';

// Retrieve data from the database
$result = display_data('');

// Prepare the data for city analysis
$city = array();
$counts = array();

while ($row = mysqli_fetch_assoc($result)) {
    $city = $row['city'];

    // Increment the count for each city
    if (isset($counts[$city])) {
        $counts[$city]++;
    } else {
        $counts[$city] = 1;
        $cities[] = $city;
    }
}

// Sort the cities array in alphabetical order
sort($cities);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Pregnant Women Details - City Analysis</title>
    <style>
        /* CSS styles */
    </style>
</head>
<body>
    <!-- HTML content -->

    <div class="container">
        <div class="row">
            <div class="col">
                <h2>City Analysis</h2>
                <canvas id="cityChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // JavaScript code for chart generation
        var cityData = {
            labels: <?php echo json_encode($city); ?>,
            datasets: [{
                label: 'Count',
                data: <?php echo json_encode(array_values($counts)); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        window.addEventListener('DOMContentLoaded', function() {
            // Generate city bar chart
            var cityChart = new Chart(document.getElementById('cityChart'), {
                type: 'bar',
                data: cityData,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
