
<?php
        session_start();
?>

<!DOCTYPE html>
<html>
        <head>
        </head>
        <body>
        <h3>Logged out</h3>

        <a href="index.html">Index</a>

        <?php
                session_unset(); //unset the variables

                session_destroy(); //destroy the session

                echo '<pre>';
                        print_r($_SESSION);
                echo '</pre>';
        ?>

        </body>
</html>
