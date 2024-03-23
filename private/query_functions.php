<?php

  // account

  // Find all account, ordered last_name, account_username
  function find_all_account() {
    global $db;

    $sql = "SELECT * FROM account ";
    $sql .= "ORDER BY account_username ASC, account_username ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  // Single qoute also prevent SQL Injection - 
  function find__by_id($id) {
    global $db;

    $sql = "SELECT * FROM account ";
    $sql .= "WHERE account_id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $account = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $account; // returns an assoc. array
  }

  function find_account_by_username($account_username) {
    global $db;

    $sql = "SELECT * FROM account ";
    $sql .= "WHERE account_username='" . db_escape($db, $account_username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $account = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $account; // returns an assoc. array
  }

  function validate_account($account, $options=[]) {

    $password_required = $options['password_required'] ?? true;

    if(is_blank($account['account_username'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($account['account_username'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }

    if($password_required) {
      if(is_blank($account['account_password'])) {
        $errors[] = "Password cannot be blank.";
      } elseif (!has_length($account['account_password'], array('min' => 12))) {
        $errors[] = "Password must contain 12 or more characters";
      } elseif (!preg_match('/[A-Z]/', $account['account_password'])) {
        $errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $account['account_password'])) {
        $errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $account['account_password'])) {
        $errors[] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $account['account_password'])) {
        $errors[] = "Password must contain at least 1 symbol";
      } elseif($account['account_username'] == $account['account_password']) {
        $errors[] = "Username and password must be different";
      }

    }

    return $errors;
  }

  function insert_account($account) {
    global $db;

    $errors = validate_account($account);
    if (!empty($errors)) {
      return $errors;
    }

    $hashed_password = password_hash($account['account_password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO account ";
    $sql .= "(account_username, account_password) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $account['account_username']) . "',";
    $sql .= "'" . db_escape($db, $account['account_password']) . "',";
    $sql .= "'" . db_escape($db, $hashed_password) . "'";
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

  // function update_account($account) {
  //   global $db;

  //   $password_sent = !is_blank($account['password']);

  //   $errors = validate_account($account, ['password_required' => $password_sent]);
  //   if (!empty($errors)) {
  //     return $errors;
  //   }

  //   $sql = "UPDATE account SET ";
  //   $sql .= "account_username='" . db_escape($db, $account['account_username']) . "', ";
  //   $sql .= "last_name='" . db_escape($db, $account['last_name']) . "', ";
  //   $sql .= "email='" . db_escape($db, $account['email']) . "', ";
  //   if($password_sent) {
  //     $hashed_password = password_hash($account['password'], PASSWORD_BCRYPT);
  //     $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "', ";
  //   }
  //   $sql .= "username='" . db_escape($db, $account['username']) . "' ";
  //   $sql .= "WHERE id='" . db_escape($db, $account['id']) . "' ";
  //   $sql .= "LIMIT 1";
  //   $result = mysqli_query($db, $sql);

  //   // For UPDATE statements, $result is true/false
  //   if($result) {
  //     return true;
  //   } else {
  //     // UPDATE failed
  //     echo mysqli_error($db);
  //     db_disconnect($db);
  //     exit;
  //   }
  // }

  // function delete_account($account) {
  //   global $db;

  //   $sql = "DELETE FROM account ";
  //   $sql .= "WHERE id='" . db_escape($db, $account['id']) . "' ";
  //   $sql .= "LIMIT 1;";
  //   $result = mysqli_query($db, $sql);

  //   // For DELETE statements, $result is true/false
  //   if($result) {
  //     return true;
  //   } else {
  //     // DELETE failed
  //     echo mysqli_error($db);
  //     db_disconnect($db);
  //     exit;
  //   }
  // }



 








