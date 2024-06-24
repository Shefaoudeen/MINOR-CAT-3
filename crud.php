//create
<?php
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $username, $email, $password);
        if ($stmt->execute()) {
            echo "User created successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
?>

//read
<?php
  $sql = "SELECT id, username, email FROM users";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      echo "<table border='1'>
              <tr>
                  <th>ID</th>
                  <th>Username</th>
                  <th>Email</th>
              </tr>";
      while($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>" . $row["id"]. "</td>
                  <td>" . $row["username"]. "</td>
                  <td>" . $row["email"]. "</td>
                </tr>";
      }
      echo "</table>";
  } else {
      echo "0 results";
  }
?>

//update

<?php
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    $sql = "UPDATE users SET ";
    $params = [];
    $types = "";

    if ($username) {
        $sql .= "username = ?, ";
        $params[] = $username;
        $types .= "s";
    }

    if ($email) {
        $sql .= "email = ?, ";
        $params[] = $email;
        $types .= "s";
    }

    if ($password) {
        $sql .= "password = ?, ";
        $params[] = $password;
        $types .= "s";
    }

    $sql = rtrim($sql, ", ") . " WHERE id = ?";
    $params[] = $id;
    $types .= "i";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param($types, ...$params);
        if ($stmt->execute()) {
            echo "User updated successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
?>