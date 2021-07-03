<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
    <h1 class="text-center text-white bg-dark">Stickers Datbase</h1>
    <br>
    <table class="table table-bordered table-striped table-hover">
    <thread>
    <th> Stickers :) </th>
    </thread>
   <tbody>

<?php


$con = mysqli_connect('localhost','root');
mysqli_select_db($con,'displayupload');
if(isset($_POST['submit'])){

$files = $_FILES['file'];
print_r($files);

$filename = $files['name'];
$fileerror = $files['error'];
$filetemp = $files['tmp_name'];

$fileext = explode('.',$filename);
$filecheck = strtolower(end($fileext));

$fileextstored = array('png', 'jpg', 'jpeg','gif');

if(in_array($filecheck,$fileextstored)){
    $destinationfile = 'Stickerss/'.$filename;
    move_uploaded_file($filetemp,$destinationfile);


    $q = "INSERT INTO `imgupload`(`image`) VALUES ('$destinationfile')";

    $query  = mysqli_query($con,$q);

    $display = "select * from imgupload";
    $qdisplay = mysqli_query($con,$display);

    // $rows = mysqli-num_rows($qdisplay);

    while($result = mysqli_fetch_array($qdisplay)){
        ?>
        
        <tr>
        <td><img src="<?php echo $result['image'];?>" height="100px" width="100px"></td>
        </tr>

        <?php
    }
}


}




?>



</tbody>
    </table>
    </div>
</body>
</html>