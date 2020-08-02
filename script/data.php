<?php 
    $login_warning = "
            <h1>Sign in</h1>
            <div class='form'>
                <form action='' method='post'>
                    <input type='text' name='username' placeholder='*name'>
                    <input type='password' name='password' placeholder='*password'>
                    <input class='btn' type='submit' name='login' value='Login'>
                </form>
            <div class='warning'>Wrong username or password, try again.</div>
            </div>
            ";
    $login_form = "
            <h1>Sign in</h1>
            <div class='form'>
                <form action='' method='post'>
                    <input type='text' name='username' placeholder='*name'>
                    <input type='password' name='password' placeholder='*password'>
                    <input class='btn' type='submit' name='login' value='Login'>
                </form>
            </div>
            ";
    $add_staff_form = "
            <form action='' method='post'>
                <input type='text' name='fname' placeholder='*name'>
                <input type='text' name='lname' placeholder='*lastname'>
                <input type='text' name='role' placeholder='*role'>
                <input type='text' name='pID' placeholder='Project ID'>
                <input type='submit' name='addstaff' value='Submit'>
            </form>
            <a href='staff.php'>Back</a>
                ";
    $add_staff_form_error = "
            <form action='' method='post'>
                <input type='text' name='fname' placeholder='*name'>
                <input type='text' name='lname' placeholder='*lastname'>
                <input type='text' name='role' placeholder='*role'>
                <input type='text' name='pID' placeholder='Project ID'>
                <input type='submit' name='addstaff' value='Submit'>
            </form>
            <h4>Invalid information has been added</h4>
            <a href='staff.php'>Back</a>";
                    
?>  