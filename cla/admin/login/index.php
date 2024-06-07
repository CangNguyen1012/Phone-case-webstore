<?php
    require_once("../../Connection/connection.php");
?>

<?php
    if(isset($_POST['login'])) {
        try {
            $sql = "select * from admin where adminID = ? and password = ? ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $_POST['adminID']);
            $stmt->bindParam(2, $_POST['password']);
            $stmt->execute();
            $row = $stmt->fetch();
            if($row == FALSE)
                echo "Wrong user name or password";
            else {
                session_start();
                $_SESSION['adminID'] = $row['adminID'];
                $_SESSION['adminFullname'] = $row['fullname'];
                $_SESSION['adminEmail'] = $row['email'];
                header("Location: ../index.php");
            }
        } catch(PDOException $ex) {
            echo 'Error: ' . $ex->getMessage();
        }
    }
?>
<html>
    <!DOCTYPE html>
    <head>
        <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><link rel="stylesheet" href="./style.css">
    </head>
    <body>
       <h1 id="heading1">Login Here</h1>
       <img src="https://img.icons8.com/cute-clipart/344/login-rounded-right.png" alt="Login Logo" style="width:100px; height:100px;">
     <div>
         <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="myForm" name="myForm" method="post" >
             <div class="input-container">
                 <i class="fa fa-envelope icon"></i>
                 <input type="text" placeholder="Admin ID" name="adminID" class="input-field" required>
             </div>
             <div class="input-container">
                <i class="fa fa-key icon"></i>
                <input type="password" placeholder="Password" name="password" class="input-field"  required>
               </div>
            <div>
                <input type="submit" class="bttn" value="Login" name="login">
            </div>
         </form>
     </div>
    </body>
</html>