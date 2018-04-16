<?php
session_start();

//Verify user is logged in
if(!$_SESSION['loggedInUser']) {
  header("Location: index.php");
}

include('includes/connection.php');
$query = "SELECT * FROM clients";
$result = mysqli_query($conn, $query);

//Check query string
if(isset($_GET['alert'])) {
  //New clients added
  if($_GET['alert']=='success') {
    //get clients
    $alertMessage = "<div class='alert alert-success'>New client added! <a class='close' data-dismiss='alert'>&times;</a></div>";
  } else if( $_GET['alert'] == 'updatesuccess' ) {
    //client updated
    $alertMessage = "<div class='alert alert-success'>Client updated! <a class='close' data-dismiss='alert'>&times;</a></div>";
  } else if( $_GET['alert'] == 'deleted' ) {
      $alertMessage = "<div class='alert alert-success'>Client deleted! <a class='close' data-dismiss='alert'>&times;</a></div>";
  }
}

mysqli_close($conn);

include('includes/header.php');
?>

<h1>Client Address Book</h1>

<?php echo $alertMessage ?>

<table class="table table-striped table-bordered">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Company</th>
        <th>Notes</th>
        <th>Edit</th>
    </tr>
    <?php

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td><td>" . $row['email'] . "</td><td>" . $row['phone'] . "</td><td>" . $row['address'] . "</td><td>" . $row['company'] . "</td><td>" . $row['notes'] . "</td>";
        echo '<td><a href="edit.php?id=' . $row['id'] . '" type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"</a></td>';
        echo "</tr>";
      }
    } else {
      echo "<div class='alert alert-warning'>No clients found.</div>";
    }

    mysqli_close($conn);

     ?>
    <!-- <tr>
        <td>John Doe</td>
        <td>john@doe.com</td>
        <td>(123) 456-7890</td>
        <td>111 Address Street, Calgary, AB  T1G 2KY</td>
        <td>Brightside Studios Inc.</td>
        <td>Usually pays early. He's awesome.</td>
        <td><a href="edit.php" type="button" class="btn btn-default btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span></a></td>
    </tr>
    <tr>
        <td>Jane Doe</td>
        <td>jane@doe.com</td>
        <td>(123) 456-7890</td>
        <td>12a Address Avenue, Calgary, AB  T1G 2KY</td>
        <td>Brightside Studios Inc.</td>
        <td>Nice lady. Pays in high fives though...</td>
        <td><a href="edit.php" type="button" class="btn btn-default btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span></a></td>
    </tr> -->

    <tr>
        <td colspan="7"><div class="text-center"><a href="add.php" type="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Add Client</a></div></td>
    </tr>
</table>

<?php
include('includes/footer.php');
?>
