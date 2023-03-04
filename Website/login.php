<?php
        session_start();
?>

<!DOCTYPE html>
<html>
        <head>
        </head>
        <body>
        <h1>SQL Results</h1>
        <?php
                $username=$_POST['username'];
                $password=$_POST['password'];

                $password = md5($password);

                require 'sql.php';//include the credentials
                //prepare and bind
                //NOTE we cannot do select * from
                //we MUST specify what is to be returned!!
                $stmt = $conn->prepare("SELECT forename,surname,street,town,postcode,email,username,access_level FROM users WHERE username = ? AND password = ?");

                $stmt->bind_param("ss", $username, $password);//things to send

                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($forename,$surname,$street,$town,$postcode,$email,$username,$access_level); //things to retrieve

                $row_count = $stmt->num_rows; //get the number of rows! If it is 1 we are logged in! If 0 we found no match!

                echo 'number of rows.....'.$row_count.'<br>';

                while ($stmt->fetch()) {
                        echo $forename.'<br>';
                        echo $surname.'<br>';
                        echo $street.'<br>';
                        echo $town.'<br>';
                        echo $postcode.'<br>';
                        echo $email.'<br>';
                        echo $username.'<br>';
                        echo $access_level.'<br>';
                };

                $stmt->close(); //close the sql
                $conn->close(); //close the connection



                //so how do we tell we are logged in??

                if ($row_count ==1)
                  {
                        echo 'Logged in!<br>';
                        $_SESSION['loggedin'] = 'yes';
                        echo '<pre>';
                        print_r($_SESSION);
                        echo '</pre>';

                        if($access_level == 1){
                                $_SESSION['admin'] = 'yes';
                                header('location:admin.php');
                        }else{
                                header('location:protected.php');
                        };


                  } else {
                        session_unset();
                        session_destroy();
                        header('location:index.html');
                };

                //What about access level?
                echo 'Access level = '.$access_level;

        ?>

        </body>
</html>
