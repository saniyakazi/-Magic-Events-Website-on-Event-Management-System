<?php
include_once("Database/connect.php");
include_once("session.php");
include_once("header.php");

if (!isset($_SESSION['uname'])) {
    echo "<h3 style='text-align:center; color:red;'>You need to login to view your bookings.</h3>";
    include_once("footer.php");
    exit();
}

$user_email = $_SESSION['uname']; // Assuming uname stores email

// Fetch only the bookings of the logged-in user
$list = mysqli_query($con, "SELECT * FROM booking WHERE email = '$user_email'");

echo "<div class='codes'>
        <div class='container'>
        <h3 class='w3ls-hdg' align='center'>Your Booked Events</h3>
        <div class='grid_3 grid_5 '><br/>
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Mobile No</th>
                    <th>Theme Image</th>
                    <th>Theme Name</th>
                    <th>Price</th>
                    <th>Event Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>";

while ($q = mysqli_fetch_assoc($list)) {
    echo "<tr>
            <td><span class='badge'>{$q['id']}</span></td>
            <td>{$q['uname']}</td>
            <td>{$q['email']}</td>
            <td>{$q['mobile']}</td>
            <td><img src='../images/{$q['theme']}' height='150' width='220'></td>
            <td>{$q['theme_name']}</td>
            <td>{$q['price']}</td>
            <td>{$q['date']}</td>
            <td><a href='delete_book.php?id={$q['id']}' onClick=\"return confirm('Do you want to delete this booking?')\">Delete</a></td>
          </tr>";
}

echo "  </tbody>
        </table>
        </div>
        </div>
        </div>";

include_once("footer.php");
?>
