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

/*
 * The registration form, the user uses it to register as an official member
 * of the computer science club.
 *
 * DEPENDENCIES
 * ------------
 * 
 * This template uses one of the post variables to indicate an error if the
 * criteria was not found (such as a student's email or id).
 * 
 * $first_name
 * $last_name
 * $student_number
 * $email
 *
 */
?>
<section id="register">
    <div class="page-header">
        <h1>Registration Form</h1>
    </div>
    <div class="row">
        <div class="span8">
            <form class="well form-horizontal" action="active.php" method="post" accept-charset="UTF-8">
                <fieldset>
                    <!-- Passphrase -->
                    <div class="control-group">
                        <label for="passphrase" class="control-label"><strong>Passphrase:</strong></label>                
                        <div class="controls">
                            <input id="passphrase" name="passphrase" required type="text" maxlength="64" pattern="^[a-z]+$" placeholder="Enter a passphrase..."/>            
                        </div>
                    </div>
                    <!--  First & Last Name -->
                    <div class="control-group">
                        <label for="first_name" class="control-label">First Name:</label>                
                        <div class="controls">
                            <input id="first_name" name="first_name" required type="text" maxlength="31" pattern="^(([A-Za-z]+)|\s{1}[A-Za-z]+)+$" placeholder="First name..."/>            
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="last_name" class="control-label">Last Name:</label>             
                        <div class="controls">
                            <input id="last_name" name="last_name" required type="text" maxlength="31" pattern="^(([A-Za-z]+)|\s{1}[A-Za-z]+)+$" placeholder="Last name..."/>                       
                        </div>
                    </div>
                    <!-- Enter your student number... -->
                    <div class="control-group">
                        <label for="student_number" class="control-label">Student Number:</label>               
                        <div class="controls">
                            <input id="student_number" name="student_number" required type="text" maxlength="9" pattern="^\d{9}$" placeholder="100123456..."/>              
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="control-group">
                        <label for="email" class="control-label">Email:</label>               
                        <div class="controls">
                            <input id="email" name="email" required type="email" maxlength="63" placeholder="your@email.com..."/>              
                        </div>
                    </div>
                    <!-- Username -->
                    <div class="control-group">
                        <label for="username" class="control-label">Username:</label>               
                        <div class="controls">
                            <input id="username" name="username" required type="text" maxlength="31" pattern="^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$" placeholder="Username..."/>              
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="control-group">
                        <label for="password" class="control-label">Password:</label>               
                        <div class="controls">
                            <input id="password" name="password" type="password" maxlength="31" pattern="^[a-zA-Z0-9\`\~\!\@\#\$\%\^\&amp;\*\(\)\-\_\=\+\|\&lt;\&gt;\?]{6,31}$" placeholder="Password..."/>              
                        </div>
                    </div>
                    <!-- Submit as Active User -->
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" id="submit" name="submit" class="btn btn-inverse">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</section>
