<?php
// Start the session to access session variables
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question</title>
    <link rel="stylesheet" href="questions.css">
</head>
<body>
<?php
$questionArray = [
    '' => 'حوصله آشپزی دارید؟',
    '1' => 'پلو مخلوط دوست دارید؟',
    '2' => 'دوست دارید بیرون غذا بخورید؟',
    '1,1' => 'دوست داری همراه غذا سبزیجات بخورید؟',
    '1,2' => 'در خانه بالکن دارید؟',
    '2,1' => 'عجله دارید؟',
    '2,2' => 'می خواهید شام بپزید؟',
    '1,1,1' => 'فشارخون دارید؟',
    '1,1,2' => 'در خانه حبوبات دارید؟',
    '1,2,1' => 'فشارخون دارید؟',
    '1,2,2' => 'کنار دریا زندگی می کنید؟',
    '2,1,1' => 'گیاهخوارید؟',
    '2,1,2' => 'فشارخون دارید؟',
    '2,2,1' => 'گیاهخوارید؟',
    '2,2,2' => 'گیاهخوارید؟',
];
// Check if the session variable is set
if (isset($_SESSION['pNumber'])) {
    // Display the updated array value
    $pNumber=$_SESSION['pNumber'];
    $prefList=($_SESSION['updatedArray']);
   // echo '<div id="updatedArrayValue">' .'user preference: '.  print_r($prefList) .' <br>page number: '. $_SESSION['pNumber'] .'</div>';
} else {
    $pNumber=1;
    $_SESSION['updatedArray'] = [];
    // echo '<div>No array value found.</div>';
}
$answer = implode(',', $_SESSION['updatedArray']);
?>



<div id="arrayValues" ><h1><?php echo $questionArray[$answer]; ?></h1></div>

<div class="btn-group mr-2" role="group" style="text-align: center;">
<button onclick="updateArray('button1')" class="button">بله</button>
<button onclick="updateArray('button2')" class="button">خیر</button>
</div>


<script>
    function updateArray(button) {
        // Use AJAX to send the button clicked information to the server (PHP)
        var xmlhttp = new XMLHttpRequest();
        var pNumber= <?php echo  $pNumber ?>;
       xmlhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
                // Redirect to another HTML file after receiving the response
                if(pNumber==4){
                    window.location.href = 'result.php';
                }
                else{
                    window.location.href = 'index.php';
                }
           }
      };
        xmlhttp.open("POST", "arrayData.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("updateValue=" + button+'&pNumber='+<?php echo  $pNumber ?>);
    }
</script>
<?php
if( $pNumber==5)
    {
         session_destroy();
    }
 ?>
</body>
</html>
