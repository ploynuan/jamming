<?php  
$values2 = $_GET['freq2'];
$starttime2 = $_GET['starttime2'];
$endtime2 = $_GET['endtime2'];
include_once('connect.php'); 
$output = '';
if(isset($_POST["export"]))
{
    $query="SELECT * FROM ".$values2."_every_round WHERE Date BETWEEN '$starttime2'AND'$endtime2'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0)
    {
        $filename = 'Report_' . $starttime2 . '_to_' . $endtime2 . '.xls';
        $output .= '
            <table>
                <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Frequency (MHz)</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Power Peak Mean (dB)</th>
                <th>Power Average Mean (dB)</th>
                <th>Number of Satellites</th>
                <th>CNR Average Mean</th>
                <th>Type of Device</th>
                <th>RFI Level</th>
                </tr>
        ';
        while($row = mysqli_fetch_array($result))
        {
            $output .= '
                <tr>
                    <td>'.$row["Date"].'</td>
                    <td>'.$row["Time"].'</td>
                    <td>'.$row["Frequency_MHz"].'</td>
                    <td>'.$row["Latitude"].'</td>
                    <td>'.$row["Longitude"].'</td>
                    <td>'.$row["Power_Peak_dB"].'</td>
                    <td>'.$row["Power_Mean_dB"].'</td>
                    <td>'.$row["Number_of_Satellites"].'</td>
                    <td>'.$row["Mean_CNR"].'</td>
                    <td>'.$row["Type_of_Device"].'</td>
                    <td>'.$row["RFI_Level"].'</td>
                </tr>
            ';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename='.$filename);
        echo $output;
        }
}
?>
