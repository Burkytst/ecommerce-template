<?php include('layout/header.php');?>
<a href="../src/registerValidation.php">Hej</a>
<div id="wrapper">
    <form action="../src/registerValidation.php" id="regForm" name="regForm" method="post" class="">
        <h1>Register:</h1>
        <!-- One "tab" for each step in the form: -->
        <div class="tab">Name:
            <p><input id="first_name" placeholder="First name..." name="first_name"></p>
            <p><input id="last_name" placeholder="Last name..."  name="last_name"></p>
        </div>
        <div class="tab">Contact Info:
            <p><input id="email" placeholder="E-mail..."  name="email"></p>
            <p><input id="phone" placeholder="Phone..."  name="phone"></p>
            <p><input id="street" placeholder="Street..."  name="street"></p>
            <p><input id="city" placeholder="City..."  name="city"></p>
            <p><input id="postal_code" placeholder="Postal code..."  name="postal_code"></p>
            <p><input id="country" placeholder="Country"  name="country"></p>
        </div>
        <div class="tab">Login Info:
            <p><input id="password_1" placeholder="Password..."  name="password_1" type="password"></p>
            <p><input id="password_2" placeholder="Password..."  name="password_2" type="password"></p>
        </div>
        <div style="overflow:auto;">
            <div style="float:right;">
            <input type="submit" value="Submit" name="regForm">
            </div>
        </div>
              
    </form>
</div>
