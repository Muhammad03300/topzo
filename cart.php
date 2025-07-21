<?php
include("header.php");
include("connect_db.php");
$user_name = "";
if (!isset($_SESSION['user_name'])) {
    header("Location: user-login.php");
    exit();
}

$user_name = $_SESSION['user_name'];

function getUserId($user_name, $conn)
{
    // Prepare and execute the query to fetch user ID for the given user_name
    $query = "SELECT user_id FROM user WHERE name = '$user_name'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if (!$result) {
        die("Error in query: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];

    return $user_id;
}

$user_id = getUserId($user_name, $conn);

function getCartItems($user_id, $conn)
{
    $query = "SELECT p.product_title, c.quantity, p.regular_price AS regular_price, c.product_id
              FROM carts c
              JOIN product p ON c.product_id = p.product_id
              WHERE c.user_id = '$user_id'";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error in query: " . mysqli_error($conn));
    }

    // Fetch the results into an associative array
    $cartItems = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $cartItems[] = $row;
    }

    return $cartItems;
}

$cartItems = getCartItems($user_id, $conn);
?>

<div class="container mt-4">
    <div class="cart">
        <h2>Shopping Cart</h2>

        <table class="table table-bordered cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Regular Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $cartItem) : ?>
                <tr>
                    <td><?php echo $cartItem['product_title']; ?></td>
                    <td><?php echo $cartItem['quantity']; ?></td> <!-- Display quantity -->
                    <td><?php echo 'PKR: ' . $cartItem['regular_price']; ?></td>
                    <td>
                        <button class="btn btn-success mb-2 mr-2" onclick="orderItem(<?php echo $cartItem['product_id']; ?>)">Order</button>
                        <button class="btn btn-danger" onclick="deleteItem(<?php echo $cartItem['product_id']; ?>)">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function deleteItem(productId) {
        var confirmDelete = confirm("Are you sure you want to delete this item?");
        if (confirmDelete) {
            // Use AJAX to send a request to delete the item
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Reload the page after successful deletion
                    location.reload();
                }
            };
            xhr.open("GET", "delete-item.php?product_id=" + productId, true);
            xhr.send();
        }
    }

    function orderItem(productId) {
        window.location.href = "order-details.php?product_id=" + productId;
    }
</script>
