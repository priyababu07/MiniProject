<?php
require_once 'imp.php';


function display_data($search = '') {
    global $con;
    
    $query = "SELECT * FROM worker_approval";
    
    if (!empty($search)) {
        $search = mysqli_real_escape_string($con, $search);
        $query .= " WHERE panchayath LIKE '%$search%'";
    }
    
    $result = mysqli_query($con, $query);
    return $result;
}
?>
?>