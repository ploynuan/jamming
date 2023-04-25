<?php
    session_start(); 
    if (!isset($_SESSION["uname"])) {
        header("Location:loginpage.php");
        die;
    }
    if(isset($_POST["sign_out"]))
    {
        unset($_SESSION["uname"]);
        unset($_SESSION["freq1"]);
        unset($_SESSION["datetime"]);
        unset($_SESSION["freq2"]);
        unset($_SESSION["starttime2"]);
        unset($_SESSION["endtime2"]);
        unset($_SESSION["freq3"]);
        unset($_SESSION["starttime3"]);
        unset($_SESSION["endtime3"]);
        header("Location:loginpage.php");
        die;
    }

    if (!empty($_POST["freq1"]))
    {
        $_SESSION['freq1'] = $_POST["freq1"];
        $_SESSION['datetime'] = $_POST['datetime'];
    }
    if (!empty($_SESSION['freq1']))
    {
        $_POST["freq1"] = $_SESSION['freq1'];
        $_POST['datetime'] = $_SESSION['datetime'] ;
    }
    if (!empty($_POST["freq2"]))
    {
        $_SESSION['freq2'] = $_POST["freq2"];
        $_SESSION['starttime2'] = $_POST['starttime2'];
        $_SESSION['endtime2'] = $_POST['endtime2']; 
    }
    if (!empty($_SESSION["freq2"]))
    {
        $_POST["freq2"] = $_SESSION['freq2'];
        $_POST['starttime2'] = $_SESSION['starttime2'] ;
        $_POST['endtime2'] = $_SESSION['endtime2'] ; 
    }
    if (!empty($_POST["freq3"]))
    {
        $_SESSION['freq3'] = $_POST["freq3"];
        $_SESSION['starttime3'] = $_POST['starttime3'];
        $_SESSION['endtime3'] = $_POST['endtime3'];
    }
    if (!empty($_SESSION["freq3"]))
    {
        $_POST["freq3"] = $_SESSION['freq3'];
        $_POST['starttime3'] = $_SESSION['starttime3'] ;
        $_POST['endtime3'] = $_SESSION['endtime3'] ;
    }
   
    if(isset($_POST["freq1"]))
    {
        $freq1_selected = $_POST["freq1"];
        $freq1_selected_array = explode('_', $freq1_selected);
    }
    if(isset($_POST["freq2"]))
    {
        $freq2_selected = $_POST["freq2"];
        $freq2_selected_array = explode('_', $freq2_selected);
    }
    if(isset($_POST["freq3"]))
    {
        $freq3_selected = $_POST["freq3"];
        $freq3_selected_array = explode('_', $freq3_selected);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mainpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
	<title>GNSS Jamming Detection System</title>
</head>
<body>
    <header class="main">
        <div class=container>
            <div class="circle"></div>
            <div class="circle2"></div>
            <div class="header-info">
                    <center>
                        <h1 >GNSS Jamming Detection System</h1><br>
                        <h3>King Mongkut's Institute of Technology Ladkrabang</h3>
                        <h3>Telecommunications and Network Engineering , Faculty of Engineering</h3>
                    </center> 
            </div>
            <nav>
                <div class="nav-bar">
                    <span class="logo">
                        <img src = "logo.svg" alt=""/>
                        <a href="https://www.kmitl.ac.th/">KMITL</br>
                        <p>Telecommunications</p></a>
                    </span>
                    <i class='bx bx-menu sidebarOpen' ></i>
                    <div class="menu">
                        <div class="logo-toggle">
                            <i class='bx bx-x siderbarClose'></i>
                        </div>
                        <ul class="nav-links">
                            <li><a href="#">Main</a></li>
                            <li><a href="#spectrum">Spectrum</a></li>
                            <li><a href="#report">Report</a></li>
                            <li><a href="#types">Types</a></li>
                            <li><a href="#aboutuspage">About us</a></li>
                            <li>
                                <form action="" method="POST">
                                <input type="submit" class="btn-signout" value="Sign out" name="sign_out">
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- spectrum -->
    <header class="page" id="spectrum">
        <a class="gotop" href="#"><i class="fa-solid fa-arrow-up" id="logoontop"></i></a>
        <div class="container">
            <div class="spectrum">
                <div class="headerpage">
                    <form action="" method="POST" name="spectrum">
                        <center>
                            <p class="namehead" >Spectrum</p>
                                <div class="option">
                                    <div class="freq">
                                        <label for="freq" >Frequency Band : </label>
                                        <select name="freq1" >
                                            <?php
                                                if(!isset($freq1_selected)) {
                                                    echo "<option value='' disables='' selected=''>Select</option>";
                                                }
                                                elseif(empty($_POST['freq1'])) {
                                                    echo "<option value='' disables='' selected=''>Select</option>";
                                                }
                                                else {
                                                    echo "<option value='$freq1_selected' selected='' hidden>$freq1_selected_array[0]</option>";
                                                }
                                            ?>
                                            <option value="L1_Data">L1</option>
                                            <option value="L2_Data">L2</option>
                                            <option value="L5_Data">L5</option>
                                            <option value="clear" style=" color: #182bd9" >Clear</option>
                                        </select>
                                    </div>
                                    <div class="datetime">
                                        <label for="datetime">Select Date : </label>
                                        <input type="date" id="datetime" name="datetime" value="<?php if(isset($_POST['datetime'])) {echo $_POST['datetime'];}?>">
                                        <input type="submit" class="submit">
                                    </div>
                                </div>
                        </center>  
                    </form>  
                </div>
                <?php include_once('connect.php'); 
                if(empty($_POST['freq1'])&&empty($_POST['datetime'])){
                    ?><P class="noinfo">Please Select Frequency band and Datetime </P> <?php
                }
                elseif(isset($_POST['freq1'])&&empty($_POST['datetime'])&& $_POST['freq1'] !== "clear"){
                    ?><P class="noinfo">Please Select Datetime </P><?php
                }
                elseif(isset($_POST['datetime'])&&empty($_POST['freq1'])&& $_POST['freq1'] !== "clear"){
                    ?><P class="noinfo">Please Select Frequency band </P> <?php
                }
                elseif(empty($_POST['datetime'])&&$_POST['freq1'] == "clear"){
                    ?><P class="noinfo">Please Select Frequency band and Datetime </P><?php
                }
                elseif(isset($_POST['datetime'])&&$_POST['freq1'] == "clear"){
                    ?><P class="noinfo">Please Select Frequency band</P><?php
                }
                elseif(isset($_POST['freq1']) && isset($_POST['datetime']) && $_POST['freq1'] !== "clear") 
                {
                    $values1=$_POST['freq1'];
                    $starttime=$_POST['datetime'];
                    ?>
                    <div class="show">
                        <div class=rfi1>
                            <div class="rfi"><?php
                                $query="SELECT * FROM ".$values1."_Red WHERE Date = '$starttime' ORDER BY id DESC LIMIT 1;";
                                $query_run=mysqli_query($conn,$query);
                                if(mysqli_num_rows($query_run)>0)
                                {
                                    foreach($query_run as $row)
                                    {
                                        echo '<img src="data:image/png;utf8_general_ci;base64,'.($row['Figure']). '" width="160" height="120" />';?>
                                        <div class="value"><span class="typerfi_r">Red</span> <span class="powervalue_r">Power peak : <?php echo number_format($row['Power_Peak_dB'], 2); ?> dB</span></div><?php
                                    }
                                }
                                else {
                                    ?>
                                        <img src="red.jpg">
                                        <div class="value"><span class="typerfi_r">Red</span> <span class="powervalue_r">Power peak :  --.-- dB</span></div><?php
                                }
                                ?>
                            </div>
                            <div class="rfi"><?php
                                $query="SELECT * FROM ".$values1."_Orange WHERE Date = '$starttime' ORDER BY id DESC LIMIT 1;";
                                $query_run=mysqli_query($conn,$query);
                                if(mysqli_num_rows($query_run)>0)
                                {
                                    foreach($query_run as $row)
                                    {
                                        echo '<img src="data:image/png;utf8_general_ci;base64,'.($row['Figure']). '" width="160" height="120" />';?>
                                        <div class="value"><span class="typerfi_o">Orange</span> <span class="powervalue_o">Power peak :<?php echo number_format($row['Power_Peak_dB'], 2); ?> dB</span></div><?php
                                   }
                                }
                                else {
                                    ?>
                                        <img src="orange.jpg">
                                        <div class="value"><span class="typerfi_o">Orange</span> <span class="powervalue_o">Power peak :  --.-- dB</span></div><?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class=rfi1>
                            <div class="rfi"><?php
                                $query="SELECT * FROM ".$values1."_Yellow WHERE Date = '$starttime' ORDER BY id DESC LIMIT 1;";
                                $query_run=mysqli_query($conn,$query);
                                if(mysqli_num_rows($query_run)>0)
                                {
                                    foreach($query_run as $row)
                                    {
                                        echo '<img src="data:image/png;utf8_general_ci;base64,'.($row['Figure']). '" width="160" height="120" />';?>
                                        <div class="value"><span class="typerfi_y">Yellow</span> <span class="powervalue_y">Power peak : <?php echo number_format($row['Power_Peak_dB'], 2); ?> dB</span></div><?php
                                    }
                                }
                                else {
                                    ?>
                                        <img src="yellow.jpg">
                                        <div class="value"><span class="typerfi_y">Yellow</span> <span class="powervalue_y">Power peak :  --.-- dB</span></div><?php
                                }
                                ?>
                            </div>
                            <div class="rfi"><?php
                            $query="SELECT * FROM ".$values1."_Green WHERE Date = '$starttime' ORDER BY id DESC LIMIT 1;";
                                $query_run=mysqli_query($conn,$query);
                                if(mysqli_num_rows($query_run)>0)
                                {
                                    foreach($query_run as $row)
                                    {
                                        echo '<img src="data:image/png;utf8_general_ci;base64,'.($row['Figure']). '" width="160" height="120" />';?>
                                        <div class="value"><span class="typerfi_g">Green</span> <span class="powervalue_g">Power peak : <?php echo number_format($row['Power_Peak_dB'], 2); ?> dB</span></div><?php
                                    }
                                }
                                else {
                                    ?>
                                        <img src="green.jpg">
                                        <div class="value"><span class="typerfi_g">Green</span> <span class="powervalue_g">Power peak :  --.-- dB</span></div><?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>                            
                    <?php
                }
                ?>
            </div> 
        </div>
    </header>    
    
    <!-- REPORT -->
    <header class="page" id="report">
    <a class="gotop" href="#"><i class="fa-solid fa-arrow-up" id="logoontop"></i></a>
        <div class="container"> 
            <div class="headerpage">
                <form action="" method="POST" name="report">
                    <center>
                        <p class="namehead" >Report</p>
                            <div class="option2">
                                <div class="freq">
                                    <label for="freq" >Frequency Band : </label>
                                    <select name="freq2" >
                                        <?php
                                            if(!isset($freq2_selected)) {
                                                echo "<option value='' disables='' selected=''>Select</option>";
                                            }
                                            elseif(empty($_POST['freq2'])){
                                                echo "<option value='' disables='' selected=''>Select</option>";
                                            }
                                            else{
                                                echo "<option value='$freq2_selected' selected='' hidden>$freq2_selected_array[0]</option>";
                                            }
                                        ?>
                                        <option value="L1_Data">L1</option>
                                        <option value="L2_Data">L2</option>
                                        <option value="L5_Data">L5</option>
                                        <option value="clear" style=" color: #182bd9" >Clear</option>
                                    </select>
                                </div>
                                <div class="startdate2">
                                    <label for="datetime">Start date : </label>
                                    <input type="date" id="starttime2" name="starttime2" value="<?php if(isset($_POST['starttime2'])) {echo $_POST['starttime2'];}?>">
                                </div>
                                <div class="enddate2">
                                    <label for="datetime" >End date : </label>
                                    <input type="date" id="endtime2" name="endtime2" value="<?php if(isset($_POST['endtime2'])) {echo $_POST['endtime2'];}?>">
                                    <input type="submit" class="submit2">
                                </div>
                                <div class="submitres">
                                    <input type="submit" class="submitres">
                                </div>
                            </div>
                    </center>  
                </form>  
            </div>
            <?php include_once('connect.php'); 
            if(empty($_POST['freq2'])&&empty($_POST['starttime2'])&&empty($_POST['endtime2'])){
                ?><P class="noinfo">Please Select Frequency band and Datetime </P><?php
            }
            elseif(isset($_POST['freq2'])&&empty($_POST['starttime2'])&&empty($_POST['endtime2'])&& $_POST['freq2'] !== "clear"){
                ?><P class="noinfo">Please Select Datetime </P><?php
            }
            elseif((isset($_POST['freq2'])&&($_POST['freq2']!==''))&&isset($_POST['starttime2'])&&empty($_POST['endtime2'])&& $_POST['freq2'] !== "clear"){
                ?><P class="noinfo">Please Select Endtime </P><?php
            }
            elseif((isset($_POST['freq2'])&&($_POST['freq2']!==''))&&isset($_POST['endtime2'])&&empty($_POST['starttime2'])&& $_POST['freq2'] !== "clear"){
                ?><P class="noinfo">Please Select Starttime </P><?php
            }
            elseif((isset($_POST['freq2'])&&$_POST['freq2']=='')&&empty($_POST['starttime2'])&&isset($_POST['endtime2'])&& $_POST['freq2'] !== "clear"){
                ?><P class="noinfo">Please Select Frequency and Starttime </P><?php
            }
            elseif((isset($_POST['freq2'])&&$_POST['freq2']=='')&&isset($_POST['starttime2'])&&empty($_POST['endtime2'])&& $_POST['freq2'] !== "clear"){
                ?><P class="noinfo">Please Select Frequency and Endtime </P><?php
            }
            elseif(isset($_POST['starttime2'])&&isset($_POST['endtime2'])&&empty($_POST['freq2'])&& $_POST['freq2'] !== "clear"){
                ?><P class="noinfo">Please Select Frequency </P><?php
            }
            elseif(empty($_POST['starttime2'])&&empty($_POST['endtime2'])&&$_POST['freq2'] == "clear"){
                ?><P class="noinfo">Please Select Frequency band and Datetime</P><?php
            }
            elseif(isset($_POST['starttime2'])&&empty($_POST['endtime2'])&&$_POST['freq2'] == "clear"){
                ?><P class="noinfo">Please Select Frequency band and Endtime</P><?php
            }
            elseif(empty($_POST['starttime2'])&&isset($_POST['endtime2'])&&$_POST['freq2'] == "clear"){
                ?><P class="noinfo">Please Select Frequency band and Starttime</P><?php
            }
            elseif(isset($_POST['starttime2'])&&isset($_POST['endtime2'])&&$_POST['freq2'] == "clear"){
                ?><P class="noinfo">Please Select Frequency band</P><?php
            }
            elseif(isset($_POST['freq2'])&&isset($_POST['starttime2'])&&isset($_POST['endtime2'])&& $_POST['freq2'] !== "clear"&& $_POST['freq2'] == "L1_Data")
            {
                $values2=$_POST['freq2'];
                $starttime2=$_POST['starttime2'];
                $endtime2=$_POST['endtime2'];
                $query="SELECT * FROM $values2 WHERE Date BETWEEN '$starttime2'AND'$endtime2'";
                $query_run=mysqli_query($conn,$query);
                if(mysqli_num_rows($query_run)>0)
                {
                    ?>
                    <div class="info">
                        <div class="show2" style="overflow-x: auto;">
                            <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Frequency </br>(MHz)</th>
                                    <th>Average Number </br>of Satellite</th>
                                    <th>Average CNR</th>
                                    <th>Type of Device</th>
                                </tr>
                                </thead>
                                <tbody>
                            <?php
                            foreach($query_run as $row)
                            {
                            ?>
                                <tr>
                                <td><?php echo $row['Date'];?></td>
                                <td><?php echo $row['Start_Time'];?></td>
                                <td><?php echo $row['Frequency_MHz'];?></td>
                                <td><?php echo number_format($row['Avg_Num_Sat'], 2); ?></td>
                                <td><?php echo number_format($row['Avg_CNR'], 2); ?></td>
                                <td><?php echo $row['Type_of_Device'];?></td>
                                </tr>
                                <?php
                            }
                            ?></tbody>
                            </table>
                        </div>
                        <form method="post" action="export.php?freq2=<?php echo $values2 ?>&starttime2=<?php echo $starttime2 ?>&endtime2=<?php echo $endtime2 ?>">
                            <input type="submit" name="export" class="btn btn-success" value="Export" />
                        </form>
                    </div>
                    <?php  
                }
                else{
                    ?><P class="noinfo">No information in this period of time</P><?php
                }                     
            }
            elseif(isset($_POST['freq2'])&&isset($_POST['starttime2'])&&isset($_POST['endtime2'])&& $_POST['freq2'] !== "clear"&& $_POST['freq2'] != "L1_Data")
            {
                $values2=$_POST['freq2'];
                $starttime2=$_POST['starttime2'];
                $endtime2=$_POST['endtime2'];
                $query="SELECT * FROM $values2 WHERE Date BETWEEN '$starttime2'AND'$endtime2'";
                $query_run=mysqli_query($conn,$query);
                if(mysqli_num_rows($query_run)>0)
                {
                    ?>
                    <div class="info">
                        <div class="show2" style="overflow-x: auto;">
                            <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Frequency (MHz)</th>
                                    <th>Power Peak Mean (dB)</th>
                                    <th>Power Average Mean (dB)</th>
                                    <th>Type of Device</th>
                                </tr>
                                </thead>
                                <tbody>
                            <?php
                            foreach($query_run as $row)
                            {
                            ?>
                                <tr>
                                <td><?php echo $row['Date'];?></td>
                                <td><?php echo $row['Start_Time'];?></td>
                                <td><?php echo $row['Frequency_MHz'];?></td>
                                <td><?php echo number_format($row['Power_Peak_Mean_dB'], 2); ?></td>
                                <td><?php echo number_format($row['Power_Average_Mean_dB'], 2); ?></td>
                                <td><?php echo $row['Type_of_Device'];?></td>
                                </tr>
                                <?php
                            }
                            ?></tbody>
                            </table>
                        </div>
                        <form method="post" action="export.php?freq2=<?php echo $values2 ?>&starttime2=<?php echo $starttime2 ?>&endtime2=<?php echo $endtime2 ?>">
                            <input type="submit" name="export" class="btn btn-success" value="Export">
                        </form>
                    </div>
                    <?php 
                }
                else{
                    ?><P class="noinfo">No information in this period of time</P><?php
                }                     
            }
            ?>
        </div>     
    </header>
    
    <!-- types -->
    <header class="page" id="types" >
    <a class="gotop" href="#"><i class="fa-solid fa-arrow-up" id="logoontop"></i></a>
        <div class="container">
            <div class="headerpage">
                <form action="" method="POST" name="type">
                    <center>
                        <p class="namehead">Types</p>
                            <div class="option2">
                                <div class="freq">
                                    <label for="freq">Frequency Band : </label>
                                    <select name="freq3" >
                                        <?php
                                            if(!isset($freq3_selected)){
                                                echo "<option value='' disables='' selected=''>Select</option>";
                                            }
                                            elseif(empty($_POST['freq3'])){
                                                echo "<option value='' disables='' selected=''>Select</option>";
                                            }
                                            else {
                                                echo "<option value='$freq3_selected' selected='' hidden>$freq3_selected_array[0]</option>";
                                            }
                                        ?>
                                        <option value="L1_Data">L1</option>
                                        <option value="L2_Data">L2</option>
                                        <option value="L5_Data">L5</option>
                                        <option value="clear" style=" color: #182bd9" >Clear</option>
                                    </select>
                                </div>
                                <div class="startdate2">
                                    <label for="datetime">Start date : </label>
                                    <input type="date" id="starttime3" name="starttime3" value="<?php if(isset($_POST['starttime3'])) {echo $_POST['starttime3'];}?>">
                                </div>
                                <div class="enddate2" >
                                    <label for="datetime">End date : </label>
                                    <input type="date" id="endtime3" name="endtime3" value="<?php if(isset($_POST['endtime3'])) {echo $_POST['endtime3'];}?>">
                                    <input type="submit" class="submit2">
                                </div>
                                <div class="submitres">
                                    <input type="submit" class="submitres">
                                </div>
                            </div>
                    </center>  
                </form>
            </div>
            <?php include_once('connect.php'); 
             if(empty($_POST['freq3'])&&empty($_POST['starttime3'])&&empty($_POST['endtime3'])){
                ?><P class="noinfo">Please Select Frequency band and Datetime </P><?php
            }
            elseif(isset($_POST['freq3'])&&empty($_POST['starttime3'])&&empty($_POST['endtime3'])&& $_POST['freq3'] !== "clear"){
                ?><P class="noinfo">Please Select Datetime </P><?php
            }
            elseif((isset($_POST['freq3'])&&($_POST['freq3']!==''))&&isset($_POST['starttime3'])&&empty($_POST['endtime3'])&& $_POST['freq3'] !== "clear"){
                ?><P class="noinfo">Please Select Endtime </P><?php
            }
            elseif((isset($_POST['freq3'])&&($_POST['freq3']!==''))&&isset($_POST['endtime3'])&&empty($_POST['starttime3'])&& $_POST['freq3'] !== "clear"){
                ?><P class="noinfo">Please Select Starttime </P><?php
            }
            elseif((isset($_POST['freq3'])&&$_POST['freq3']=='')&&empty($_POST['starttime3'])&&isset($_POST['endtime3'])&& $_POST['freq3'] !== "clear"){
                ?><P class="noinfo">Please Select Frequency and Starttime </P><?php
            }
            elseif((isset($_POST['freq3'])&&$_POST['freq3']=='')&&isset($_POST['starttime3'])&&empty($_POST['endtime3'])&& $_POST['freq3'] !== "clear"){
                ?><P class="noinfo">Please Select Frequency and Endtime </P><?php
            }
            elseif(isset($_POST['starttime3'])&&isset($_POST['endtime3'])&&empty($_POST['freq3'])&& $_POST['freq3'] !== "clear"){
                ?><P class="noinfo">Please Select Frequency </P><?php
            }
            elseif(empty($_POST['starttime3'])&&empty($_POST['endtime3'])&&$_POST['freq3'] == "clear"){
                ?><P class="noinfo">Please Select Frequency band and Datetime</P><?php
            }
            elseif(isset($_POST['starttime3'])&&empty($_POST['endtime3'])&&$_POST['freq3'] == "clear"){
                ?><P class="noinfo">Please Select Frequency band and Endtime</P><?php
            }
            elseif(empty($_POST['starttime3'])&&isset($_POST['endtime3'])&&$_POST['freq3'] == "clear"){
                ?><P class="noinfo">Please Select Frequency band and Starttime</P><?php
            }
            elseif(isset($_POST['starttime3'])&&isset($_POST['endtime3'])&&$_POST['freq3'] == "clear"){
                ?><P class="noinfo">Please Select Frequency band</P><?php
            }
            elseif(isset($_POST['freq3'])&&isset($_POST['starttime3'])&&isset($_POST['endtime3'])&& $_POST['freq3'] !== "clear")
            {
                $values3=$_POST['freq3'];
                $starttime3=$_POST['starttime3'];
                $endtime3=$_POST['endtime3'];
                $query="SELECT * FROM $values3 WHERE Date BETWEEN '$starttime3'AND'$endtime3'";
                $query_run=mysqli_query($conn,$query);
                if(mysqli_num_rows($query_run)>0)
                {
                    ?><div class="show2" style="overflow-x: auto;">
                        <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Total Time (Sec)</th>
                                <th>RFI Level</th>
                            </tr>
                            </thead>
                            <tbody>
                        <?php
                        foreach($query_run as $row)
                        {
                        ?>
                            <tr>
                            <td><?php echo $row['Date'];?></td>
                            <td><?php echo $row['Start_Time'];?></td>
                            <td><?php echo $row['End_Time'];?></td>
                            <td><?php echo number_format($row['Total_Time'], 2); ?></td>
                            <td><?php echo $row['RFI_Level'];?></td>
                            </tr>
                            <?php
                        }
                        ?></tbody>
                        </table>
                    <div><?php
                }
                else
                {
                    ?><P class="noinfo">No information in this period time</P><?php
                }                     
            }
            ?>
        </div>
    </header>

    <!-- aboutus -->
    <header class="aboutus" id="aboutuspage">
    <a class="gotop" href="#"><i class="fa-solid fa-arrow-up" id="logoontop"></i></a>
        <div id="aboutus" class="name">
            <div class="uni">
                <p>About us</br></p>
                <div class="box"></div>
                Department of Telecomunications</br>
                Engineering</br>
                King Mongkut's Institure of Technology</br>
                Ladkrabang,</br>
                Bangkok, Thailand, 10520</br>
                Tel : 02-329-8324</br>
                Email : telecom@kmitl.ac.th
            </div>
            <div class="member">
                Made by</br>
                Pornnapas Ngampanitchayakit</br>
                Ploynuan Chanaboon</br>
                Paniprak Kakhong</br></br>
                Advisor : Prof.Dr.Pornchai Supnithi

            </div>
        </div>
    </header>
	
	<script>
		const body = nav = document.querySelector("nav"),
			sidebarOpen = document.querySelector(".sidebarOpen"),
			siderbarClose = document.querySelector(".siderbarClose");

		sidebarOpen.addEventListener("click" , () =>{
			nav.classList.add("active");
		});

		body.addEventListener("click" , e =>{
			let clickedElm = e.target;

			if(!clickedElm.classList.contains("sidebarOpen") && !clickedElm.classList.contains("menu")){
				nav.classList.remove("active");
			}
		});

	</script>
</body>
</html>