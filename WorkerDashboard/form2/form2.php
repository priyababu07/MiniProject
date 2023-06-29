<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "Paalan";

$data = mysqli_connect($host, $user, $password, $db);

if ($data == false) {
    die("Connection error: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    // Personal Details
    $firstName = mysqli_real_escape_string($data, $_POST['first_name']);
    $lastName = mysqli_real_escape_string($data, $_POST['last_name']);
    $dob = mysqli_real_escape_string($data, $_POST['DOB']);
    $age = mysqli_real_escape_string($data, $_POST['Age']);
    $aadhaar = mysqli_real_escape_string($data, $_POST['Aadhaar']);
    $address = mysqli_real_escape_string($data, $_POST['Address']);
    $city = mysqli_real_escape_string($data, $_POST['City']);
    $postalCode = mysqli_real_escape_string($data, $_POST['PostalCode']);
    $contactNumber = mysqli_real_escape_string($data, $_POST['Ph_num']);
    $email = mysqli_real_escape_string($data, $_POST['Email']);

    // Pregnancy Details
    $deliveryDate = mysqli_real_escape_string($data, $_POST['delivery_date']);
    $lmp = mysqli_real_escape_string($data, $_POST['lastMdate']);
    $numPregnancies = mysqli_real_escape_string($data, $_POST['noOfPregnancies']);
    $numLiveBirths = mysqli_real_escape_string($data, $_POST['liveN']);
    $numMiscarriages = mysqli_real_escape_string($data, $_POST['missN']);
    $currentWeight = mysqli_real_escape_string($data, $_POST['wt']);
    $numAbortions = mysqli_real_escape_string($data, $_POST['abN']);

    // Medical History
    $existingConditions = mysqli_real_escape_string($data, $_POST['existing_conditions']);
    $previousComplications = mysqli_real_escape_string($data, $_POST['previous_conditions']);
    $currentMedications = mysqli_real_escape_string($data, $_POST['current_medications']);
    $allergies = mysqli_real_escape_string($data, $_POST['Allergies']);
    $bloodType = mysqli_real_escape_string($data, $_POST['blood_type']);

    $sql1 = "INSERT INTO `women_personal_details` (`firstName`, `lastName`, `dob`, `age`, `aadharNo`, `address`, `city`, `pCode`, `contactNumber`, `emailAddress`) 
        VALUES ('$firstName', '$lastName', '$dob', '$age', '$aadhaar', '$address', '$city', '$postalCode', '$contactNumber', '$email')";
    $result1 = mysqli_query($data, $sql1);

    $sql2 = "INSERT INTO `women_pregnancy_details` (`expectedDeliveryDate`, `lmp`, `numberOfPregnancies`, `NumberOfLiveBirths`, `numberOfMiscarriages`, `numberOfAbortions`, `currentWeight`) 
        VALUES ('$deliveryDate', '$lmp', '$numPregnancies', '$numLiveBirths', '$numMiscarriages', '$numAbortions', '$currentWeight')";
    $result2 = mysqli_query($data, $sql2);

    $sql3 = "INSERT INTO `women_medical_history_details` (`existingMedicalConditions`, `previousPregnancyComplications`, `currentMedications`, `allergies`, `bloodType`)
        VALUES ('$existingConditions', '$previousComplications', '$currentMedications', '$allergies', '$bloodType')";
    $result3 = mysqli_query($data, $sql3);

    if ($result1 && $result2 && $result3) {
        header("Location: form2.html");
        exit();
    } else {
        echo "Failed to insert data: " . mysqli_error($data);
    }
}

mysqli_close($data);
?>

