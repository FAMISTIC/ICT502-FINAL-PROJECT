<!DOCTYPE html>
<html>
<head>
    <title>Customer List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .dropbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #3e8e41;
}

#myInput {
  box-sizing: border-box;
  background-image: url('searchicon.png');
  background-position: 14px 12px;
  background-repeat: no-repeat;
  font-size: 16px;
  padding: 14px 20px 12px 45px;
  border: none;
  border-bottom: 1px solid #ddd;
}

#myInput:focus {outline: 3px solid #ddd;}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f6f6f6;
  min-width: 230px;
  overflow: auto;
  border: 1px solid #ddd;
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>
    </style>
</head>
<body>
    <h2>Customer List</h2>

    <?php
    // Include your Oracle connection code here
    include_once 'connection.php';

    // Retrieve the customer data from the database
    $query = "SELECT * FROM customer";
    $stmt = oci_parse($connection, $query);
    oci_execute($stmt);


    echo '<div class="dropdown">';
    echo '<button onclick="myFunction()" class="dropbtn">Dropdown</button>';
    echo '<div id="myDropdown" class="dropdown-content">';
    echo '<input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">';
    // Display the customer data in a table
    echo '<table>';
    echo '<tr>';
    echo '<th>Customer ID</th>';
    echo '<th>Customer Name</th>';
    echo '<th>Phone</th>';
    echo '<th>Email</th>';
    echo '<th>Password</th>';
    echo '<th>Action</th>';

    echo '</tr>';
    
    while ($row = oci_fetch_assoc($stmt)) {
        echo '<tr>';
        echo '<td>' . $row['CUSTOMER_ID'] . '</td>';
        echo '<td>' . $row['CUSTOMER_NAME'] . '</td>';
        echo '<td>' . $row['PHONE'] . '</td>';
        echo '<td>' . $row['EMAIL'] . '</td>';
        echo '<td>' . $row['PASSWORD'] . '</td>';
        echo '<td>';
        echo '<a href="update-customer.php?customer_id=' . $row['CUSTOMER_ID'] . '">Edit</a>';
        echo ' | ';
        echo '<a href="delete-customer.php?customer_id=' . $row['CUSTOMER_ID'] . '">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</div></div>';
    echo '</table>';

    // Close the Oracle connection
    oci_close($connection);
    ?>
<script>
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("tr");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}
</script>
</body>
</html>
