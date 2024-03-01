<?php

  // employee

  // Find all employee, ordered employee_last_name, employee_first_name
  function find_all_employee() {
    global $db;

    $sql = "SELECT * FROM employee ";
    $sql .= "ORDER BY employee_last_name ASC, employee_first_name ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_admin_by_id($id) {
    global $db;

    $sql = "SELECT * FROM employee ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }

  function find_admin_by_employee_username($employee_username) {
    global $db;

    $sql = "SELECT * FROM employee ";
    $sql .= "WHERE employee_username='" . db_escape($db, $employee_username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }

  function validate_admin($admin, $options=[]) {

    $password_required = $options['password_required'] ?? true;

    if(is_blank($admin['employee_first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($admin['employee_first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }

    if(is_blank($admin['employee_last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($admin['employee_last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank($admin['employee_email'])) {
      $errors[] = "employee_email cannot be blank.";
    } elseif (!has_length($admin['employee_email'], array('max' => 255))) {
      $errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_employee_email_format($admin['employee_email'])) {
      $errors[] = "employee_email must be a valid format.";
    }

    if(is_blank($admin['employee_username'])) {
      $errors[] = "employee_username cannot be blank.";
    } elseif (!has_length($admin['employee_username'], array('min' => 8, 'max' => 255))) {
      $errors[] = "employee_username must be between 8 and 255 characters.";
    } elseif (!has_unique_employee_username($admin['employee_username'], $admin['id'] ?? 0)) {
      $errors[] = "employee_username not allowed. Try another.";
    }

    if($password_required) {
      if(is_blank($admin['password'])) {
        $errors[] = "Password cannot be blank.";
      } elseif (!has_length($admin['password'], array('min' => 12))) {
        $errors[] = "Password must contain 12 or more characters";
      } elseif (!preg_match('/[A-Z]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 symbol";
      } elseif($admin['employee_username'] == $admin['password']) {
        $errors[] = "employee_username and password must be different";
      }

      if(is_blank($admin['confirm_password'])) {
        $errors[] = "Confirm password cannot be blank.";
      } elseif ($admin['password'] !== $admin['confirm_password']) {
        $errors[] = "Password and confirm password must match.";
      }
    }

    return $errors;
  }

  function insert_admin($admin) {
    global $db;

    $errors = validate_admin($admin);
    if (!empty($errors)) {
      return $errors;
    }

    $employee_hashed_password  = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO employee ";
    $sql .= "(employee_first_name, employee_last_name, employee_email, employee_username, employee_hashed_password ) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $admin['employee_first_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['employee_last_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['employee_email']) . "',";
    $sql .= "'" . db_escape($db, $admin['employee_username']) . "',";
    $sql .= "'" . db_escape($db, $employee_hashed_password ) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_admin($admin) {
    global $db;

    $password_sent = !is_blank($admin['password']);

    $errors = validate_admin($admin, ['password_required' => $password_sent]);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE employee SET ";
    $sql .= "employee_first_name='" . db_escape($db, $admin['employee_first_name']) . "', ";
    $sql .= "employee_last_name='" . db_escape($db, $admin['employee_last_name']) . "', ";
    $sql .= "employee_email='" . db_escape($db, $admin['employee_email']) . "', ";
    if($password_sent) {
      $employee_hashed_password  = password_hash($admin['password'], PASSWORD_BCRYPT);
      $sql .= "employee_hashed_password ='" . db_escape($db, $employee_hashed_password ) . "', ";
    }
    $sql .= "employee_username='" . db_escape($db, $admin['employee_username']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function delete_admin($admin) {
    global $db;

    $sql = "DELETE FROM employee ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
    $sql .= "LIMIT 1;";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

?>
