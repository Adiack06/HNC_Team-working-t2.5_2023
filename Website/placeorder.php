
<?php   session_start();

        include 'sql.php';//go inlude the database credentials!


        echo '<pre>';
        print_r($_POST);

        print_r($_SESSION);
        echo '</pre>';

        foreach($_SESSION as $key => $value){
                echo $key.'&nbsp'.$value.'<br>';
        };




        $user_id = $_SESSION['userid'];

        echo 'USERID'.$user_id;

        $stmt = $conn->prepare("INSERT INTO orders (user_id) VALUES (?)");
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        echo $userid;

        //now go get the orderno:
        $stmt = $conn->prepare("SELECT orderno FROM orders WHERE user_id = ? ORDER BY orderno DESC LIMIT 1");
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($orderno);
        $stmt->fetch();

        echo '<br>Orderno: '.$orderno.'<br>';


        $total=0;


        foreach($_POST as $stockno => $qty){
                if($qty > 0){


                        $stmt = $conn->prepare("SELECT price FROM stock WHERE stockno = ?");
                        $stmt->bind_param("s",$stockno);//things to send
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($price); //things to retrieve

                        while ($stmt->fetch()) {
                                $total = $total+($price*$qty);
                        };//end while loop

                        echo $stockno.'--'.$qty.'--'.$price.'<br>';


                        $stmt = $conn->prepare("INSERT INTO orderline VALUES (?,?,?)");
                        $stmt->bind_param("isi",$orderno,$stockno,$qty);
                        $stmt->execute();


                        $stmt_update = $conn->prepare("UPDATE stock SET qtyinstock = (qtyinstock - ?) WHERE stockno = ?");
                        $stmt_update->bind_param("is",$qty,$stockno);
                        $stmt_update->execute();


                };
        };



        echo $total.'<br>';
        echo $total*1.2;

?>
