<?php
include 'connect.php';
$id=$_GET['childupdateid'];
$sql="select * from `child_details` where woman_id=$id";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$woman_id = $row['woman_id'];
$child_name = $row['child_name'];
$child_age = $row['child_age'];
$child_dob = $row['child_dob'];

if(isset($_POST['submit'])){
    $child_name = $_POST['childName'];
    $mother_id = $_POST['mother_id'];
    $child_age = $_POST['childAge'];
    $child_dob = $_POST['childDOB'];
    $father_name = $_POST['childFName'];
    $mother_name = $_POST['childMName'];
    $no_of_family_members = $_POST['familyMembersNo'];
    $child_guardian_phone_no = $_POST['Guardian_no'];

    $sql="update `child_details` 
          set child_id='$id',woman_id='$mother_id',child_name='$firstName',child_age='$lastName',child_dob='$dob',father_name='$age',mother_name='$aadhaar',
          no_of_family_members='$address',child_guardian_phone_no='$city'
          where child_id=$id";
    $result = mysqli_query($con, $sql);

    if ($result) {
              header("Location:child_update.php");
              exit();
    } 
    else {
            echo "failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- CSS -->
<style>
  body {
    margin: 0;
    padding: 0;
  }

  header {
    background-color: #f2f2f2;
    padding: 20px;
  }

  .top-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #333;
    padding: 25px;
    color: #fff;
    font-family: Arial, sans-serif;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 1px;
  }

  .site-name {
    display: flex;
    align-items: center;
  }

  .site-name h1 {
    font-size: 24px;
    margin-right: 10px;
  }

  .site-name h2 {
    font-size: 18px;
    font-weight: normal;
  }

  .form-container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .form-container h2 {
    margin-bottom: 30px;
  }
</style>
</head>
<body>
<header>
    <div class="top-section">
      <div class="site-name">
        <h1>PAALAN</h1>
        <h2 class="subheading">CHILD DETAILS</h2>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="form-container">
      <h2>Registration Form</h2>
      
      <form action="form1.php" method="POST" id="registrationForm" onsubmit="return validateForm()">
        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <label for="name">Mother id:</label>
              <input type="text" class="form-control" id="m_id" name="mother_id" placeholder="Enter Mother's id no" required>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="name">Child Name:</label>
              <input type="text" class="form-control" id="name" name="childName" placeholder="Enter your name" required>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="age">Child Age:</label>
              <input type="number" class="form-control" id="age" name="childAge" placeholder="Enter your age" required>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="dob">Date of Birth:</label>
              <input type="date" class="form-control" id="dob" name="childDOB" required>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <label for="fatherName">Father's Name:</label>
              <input type="text" class="form-control" id="fatherName" name="childFName" placeholder="Enter your father's name" required>
            </div>
          </div>
        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <label for="motherName">Mother's Name:</label>
              <input type="text" class="form-control" id="motherName" name="childMName" placeholder="Enter your mother's name" required>
            </div>
          </div>
        <div class="form-group">
          <label for="phone">Child Guardian Phone Number:</label>
          <input type="tel" class="form-control" id="phone" name="Guardian_no" placeholder="Enter your phone number" required>
        </div>
        <div class="form-group">
          <label for="familyMembers">Number of Family Members:</label>
          <input type="number" class="form-control" id="familyMembers" name="familyMembersNo" placeholder="Enter the number of family members" required>
        </div>
        <div class="form-group">
          <label for="income">Annual Income:</label>
          <input type="text" class="form-control" id="income" name="annualIncome" placeholder="Enter your annual income" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>
</body>
</html>