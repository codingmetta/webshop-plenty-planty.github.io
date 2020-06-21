<?php
/**@file        order-submit.php 
 * @brief      Script connects to database and saves the order 
 *             purchased by the user to table 'Orders'. 
 * 
 * @author     Talia Deckardt
 */ 
require 'login.php';

    $conn = new mysqli($servername, $username, $password, $dbname);
    session_start();

    $product_id = $_POST['product_id'];
    $order_amount = 1;
    $today = date("Y-m-d");
    

    if (isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];
        $loggedin = TRUE;
    }
    else $loggedin = FALSE;


    update_orders($conn, $product_id, $username, $order_amount, $today);
    update_individual_amount($conn, $product_id, $order_amount);
 
/** @fn 'Update Orders' 
 * @brief Add new Order to table 'Orders' for individual user
 */
    function update_orders($conn, $pid, $un, $oa, $td)
    {
    $sql = "INSERT INTO Orders (product_id, username, order_amount, order_date) VALUES ('$pid','$un','$oa', '$td')";
        if ($conn->query($sql) === TRUE) {
        echo "New Order sent.";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

/** @fn 'Update Product Amount' 
 * @brief Updates Amount  'Admin' to table 'Users'
 */
function update_individual_amount($conn, $pid, $nam)
{

    $query = "SELECT amount FROM Products WHERE product_id='$pid'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $old_amount =$row["amount"];
    }
    } else {
    echo "0 results";
    }
    
    $new_amount = $old_amount-$nam;
    
    $sql = "UPDATE Products SET amount='$new_amount' WHERE product_id='$pid'";
    if ($conn->query($sql) === TRUE) {
    echo "Product Amount successfully updated.";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
}



?>