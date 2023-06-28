<!DOCTYPE html>
<html>
<head>
  <title>Anganwadi Worker Dashboard</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<body>
  <header>
    <div class="top-section">
      <div class="site-name">
        <!-- <h1>PAALAN</h1> -->
        <a href="../LandingPage/index1.php" style="text-decoration: none;" ><h1 style="color: white;">PAALAN</h1></a>
        <h2 class="dashboard">Dashboard</h2>
      </div>

      <div class="left-section">
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
          <li><a id="messages-button" href="../AdminDashboard/registration/msg.php">Messages</a></li>
        </ul>
      </div>
    </div>
  </header>


  <div class="sidebar">
    <ul>
      <li><a href="#">Message</a></li>
      <li><a href="#visualization">Charts</a></li>
      <li><a href="#bmi">BMI</a></li>
      <li><a href="feedback.php">Feedback</a></li>
      <li><a href="logout.php">Logout</a></li>
      <li><a href="#">Help</a></li>
    </ul>
  </div>



  <h1 id="dashboard-title">Welcome to the <span>Anganwadi Worker Dashboard</span></h1>
  <p id="welcome-para">Your dedicated platform for managing child welfare programs<br>and empowering young minds.</p>



  <div class="container">
    <div class="box" onclick="window.location.href='form1/form1.html';">
      <div class="image-section">
        <img src="motherChild2.jpg" alt="Image 1">
      </div>
      <div class="description">
        <h3>CHILD REGISTRATION</h3>
        <p>Click to Register</p>
      </div>
    </div>
    <div class="box" onclick="window.location.href='form2/personal_details.html';">
      <div class="image-section">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSPSH7JSJFyx67kbyZS6DdwmoVfMDYobHNGkA&usqp=CAU" alt="Image 2">
      </div>
      <div class="description">
        <h3>PREGNANT WOMEN REGISTRATION</h3>
        <p>Click to Register</p>
      </div>
    </div>
    <div class="box" onclick="window.location.href='form3/form3.html';">
      <div class="image-section">
        <img src="motherChild1.jpg" alt="Image 3">
      </div>
      <div class="description">
        <h3>UPDATE DETAILS</h3>
        <p>Click to Update</p>
      </div>
    </div>
  </div>
  
  <!-- data visualization -->

  <div class="graph-container" section id="visualization">
    <div class="graph-box">
      <div class="canvas-container">
        <canvas id="lineChart"></canvas>
      </div>
    </div>
    <div class="graph-box">
      <div class="canvas-container">
        <canvas id="barChart"></canvas>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="chart.js"></script>

  <div class="form-container"section id="bmi">
  <form class="bmi">
    <h3>Child BMI Result</h3>
    <table class="table table-striped table-dark table-hover" width=80%>
      <thead class="table-primary">
        <tr>
          <th>Child Name</th>
          <th>Age</th>
          <th>BMI Percentage</th>
          <th>Comment</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "paalan";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($conn == false) {
            die("connection error");
        }
        // Fetch data from the 'child_details' table
        $query = "SELECT * FROM child_details";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
          $childName = $row['child_name'];
          $childAge = $row['child_age'];
          $height = $row['height'];
          $weight = $row['weight'];

          // Skip children with missing height or weight values
          if (empty($height) || empty($weight)) {
            continue;
          }

          $bmiPercentage = ($weight / ($height * $height * 0.0001));
          $comment = '';

          // Determine the comment based on the BMI percentage value
          if ($bmiPercentage < 5) {
            $comment = 'Underweight';
          } elseif ($bmiPercentage >= 5 && $bmiPercentage < 85) {
            $comment = 'Healthy weight';
          } elseif ($bmiPercentage >= 85 && $bmiPercentage < 95) {
            $comment = 'Overweight';
          } elseif ($bmiPercentage >= 95) {
            $comment = 'Obese';
          }
          ?>
          <tr>
            <td><?php echo $childName; ?></td>
            <td><?php echo $childAge; ?></td>
            <td><?php echo $bmiPercentage; ?></td>
            <td><?php echo $comment; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </form>
</div>


</body>
</html> 


