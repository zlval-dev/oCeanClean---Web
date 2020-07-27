<?php
//include database configuration file
require_once 'conn.php';

//get records from database
$query = "select * from reportlitter";
$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) > 0){
    $delimiter = ",";
    date_default_timezone_set("UTC");
    $filename = "litter_" . date('Y-m-d/H:i:s') . ".csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('ID', 'Category', 'Description', 'Latitude', 'Longitude', 'Photo', 'Removed');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = mysqli_fetch_assoc($result)){
        $remove = ($row['remove'] == '1')?'Yes':'No';
        $photo_id = $row['id_photo'];
        $query_photo = "select * from photo where id='$photo_id'";
        $result_photo = mysqli_query($con, $query_photo);
        $photo_assoc = mysqli_fetch_assoc($result_photo);
        $photo = $photo_assoc['url'];
        $lineData = array($row['id'], $row['category'], $row['description'], $row['lang'], $row['longi'], $photo, $remove);
        fputcsv($f, $lineData, $delimiter);
    }
    
    //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;

?>