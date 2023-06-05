<?php
// Database credentials
$host = "localhost";
$username = "root";
$password = "";
$dbname = "paalan";

// Establish a connection to the database
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process the form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $child_name = $_POST['childName'];
    $child_age = $_POST['childAge'];
    $child_dob = $_POST['childDOB'];
    $child_mp = $_POST['childMP'];
    $child_blockNumber = $_POST['childBlockNo'];
    $child_city = $_POST['childCity'];
    $child_district = $_POST['childDistrict'];
    $father_name = $_POST['childFName'];
    $father_occupation = $_POST['childFO'];
    $mother_name = $_POST['childMName'];
    $mother_occupation = $_POST['childMO'];
    $no_of_family_members = $_POST['familyMembersNo'];
    $annual_income = $_POST['annualIncome'];
    // $if_child_medical_issues = $_POST['contact'];
    $medical_issue_details = $_POST['medical_issue_details'];
    $child_guardian_phone_no = $_POST['Guardian_no'];

    // SQL query to insert the form data into the table
    $sql = "INSERT INTO child_details (child_name, child_age, child_dob, child_mp, child_blockNumber, child_city, child_district, father_name, father_occupation,mother_name,mother_occupation,no_of_family_members,annual_income,medical_issue_details,child_guardian_phone_no )
            VALUES ('$child_name', '$child_age', '$child_dob', '$child_mp', '$child_blockNumber', '$child_city', '$child_district', '$father_name', '$father_occupation','$mother_name','$mother_occupation','$no_of_family_members','$annual_income','$medical_issue_details','$child_guardian_phone_no')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>













<!-- if(isset($_POST['submit'])){ // Fetching variables of the form which travels in URL
 $child_name = $_POST['childName']; -->







<!-- $sql="insert into child_details(child_name) values ('$child_name')
$query = mysqli_query(");
echo "<br/><br/><span>Data Inserted successfully...!!</span>";
}
else{
echo "<p>Insertion Failed <br/> Some Fields are Blank....!!</p>";
}
}
mysql_close($connection); // Closing Connection with Server
?> -->



