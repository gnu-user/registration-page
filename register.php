<?php
/*
 *  Registration Page
 *
 *  Copyright (C) 2013 Jonathan Gillett, Computer Science Club
 *  All rights reserved.
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as
 *  published by the Free Software Foundation, either version 3 of the
 *  License, or (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once "inc/auth.php";
require_once "inc/db_interface.php";
require_once "inc/validate.php";

session_start();

$errors = array();
$mysqli_conn = new mysqli("localhost", $db_user, $db_pass, $db_name);

/* check connection */
if (!valid_mysqli_connect($mysqli_conn))
{
    printf("Connection failed: %s\n", mysqli_connect_error());
    exit();
}

/* Validate the POST data, add the user as a new member if everything is valid */
if (   isset($_POST['passphrase'])  && isset($_POST['first_name']) 
    && isset($_POST['last_name'])   && isset($_POST['student_number'])
    && isset($_POST['email'])       && isset($_POST['username'])
    && isset($_POST['password']))
    
{
    $data = array();

    /* Validate each form entry, add any errors to list */
    if (valid_passphrase($_POST['passphrase']) 
        && correct_passphrase($mysqli_conn, $_POST['passphrase']))
    {
        $data['passphrase'] = $_POST['passphrase'];
    }
    else
    {
        array_push($errors, 
            "<strong>Invalid passphrase!</strong> Please enter the passphrase given to you! " .
            "If you do not have a passphrase please contact the " .
            '<a target="_blank" href="mailto:admin@cs-club.ca">Club Executives</a>' .
            " to receive a passphrase!");
    }

    if (valid_first_name($_POST['first_name']) && valid_last_name($_POST['last_name']))
    {
        $data['first_name'] = $_POST['first_name'];
        $data['last_name'] = $_POST['last_name'];
    }
    else
    {
        array_push($errors, "<strong>Invalid name!</strong> Please enter a valid first and/or last name!");
    }

    if (valid_student_num($_POST['student_number']))
    {
        if (unqiue_student_id($mysqli_conn, $_POST['student_number'], $AES_KEY))
        {
            /* Salt the student number */
            $data['student_number'] = $_POST['student_number'];
            salt_sensitive_data($data['student_number']);
        }
        else
        {
            array_push($errors, "<strong>Student Id is already in use!</strong> Please make sure you are using the"
                                . " correct student id or make sure you are not already a club member!");
        }
    }
    else
    {
        array_push($errors, "<strong>Invalid student number!</strong> Please enter a valid student number!");
    }

    if (valid_email($_POST['email']))
    {
        $data['email'] = $_POST['email'];
    }
    else
    {
        array_push($errors, "<strong>Invalid email!</strong> Please enter a valid email address");
    }

    if (valid_username($_POST['username']))
    {
        if (unique_username($mysqli_conn, $_POST['username']))
        {
            $data['username'] = $_POST['username'];
        }
        else
        {
            array_push($errors, "<strong>Username already taken!</strong> Please use a different username!");
        }
    }
    else
    {
        array_push($errors, "<strong>Invalid username!</strong> Please enter a valid username a-z/0-9/_ only!");
    }

    if (valid_password($_POST['password']))
    {
        /* Salt the password */
        $data['password'] = $_POST['password'];
        salt_sensitive_data($data['password']);
    }
    else
    {
        array_push($errors, "<strong>Invalid password!</strong> Only characters " .
            "<strong>a-z/A-Z/0-9/`~!@#$%^&amp;*()-_=+&lt;&gt;?</strong> may be used!");
    }


    /* If there are NO errors then add the new member to the database */
    if (empty($errors))
    {
        update_passphrase($mysqli_conn, $data['passphrase']);
        add_new_member($mysqli_conn, $data, $AES_KEY);

        /* Finally call a script to send the new club member a friendly
         * "Welome to CS-CLUB" email with information about the club.
         */
        system( "scripts/welcome-email.sh " . $data['first_name'] . " " . $data['last_name'] . 
                " " . $data['email'] . " >/dev/null &",$retval);

        $_SESSION['new_member'] = "new_member";
        header('Location: index.php');
    }
    else
    {
        /* Invalid data, redirect to main page */
        $_SESSION['errors'] = $errors;
        header('Location: index.php');
    }
}
else
{
    /* Invalid data, redirect to main page */
    array_push($errors, "<strong>Invalid Information Provided!</strong> The information you " .
        "provided is not valid please enter valid information");
    $_SESSION['errors'] = $errors;
    header('Location: index.php');
}

/* close connection */
$mysqli->close();
exit();
?>