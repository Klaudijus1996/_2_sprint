<?php 
    $role = 'role';
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
                *Enter name (must contain only alphabetic symbols): <input type='text' name='fname' placeholder='*name'>
                *Enter last name (must contain only alphabetic symbols): <input type='text' name='lname' placeholder='*lastname'>
                *Enter job description: <input type='text' name='role' placeholder='*role'>
                Enter project ID: <input type='text' name='pID' placeholder='Project ID'>
                <input class='button' type='submit' name='addstaff' value='Submit'>
            </form>
            <a class='back-btn' href='admin_staff.php'>Back</a>
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
    $create_project_form = "
            <form class='upd-form' action='' method='post'>
                *Enter name: <input type='text' name='project_name' placeholder='*name'>
                *Enter deadline: <input type='text' name='deadline' placeholder='*YYYY-MM-DD'>
                <input class='done base-btn' type='submit' name='create_new_project' value='Submit'>
                <a class='back base-btn' href='admin_projects.php'>Back</a>
            </form>
                ";
    $create_project_form_sp = "
            <form style='display: inline-table' class='upd-form' action='' method='post'>
                *Enter name: <input type='text' name='project_name' placeholder='*name'>
                *Enter deadline: <input type='text' name='deadline' placeholder='*YYYY-MM-DD'>
                <input class='done base-btn' type='submit' name='create_new_project' value='Submit'>
                <a class='back base-btn' href='admin_SP.php'>Back</a>
            </form>
                ";
    function check_numbers($user_input) {
        $isNum = false;
        for($i=0; $i < strlen($user_input); $i++) {
            if(is_numeric($user_input[$i])) {
                $isNum = true;
                break;
            } else {
                $isNum = false;
            }
        }
        return $isNum;
    }
    function check_id($user_input) {
        $isID = false;
        $count_index = 0;
        for ($i = 0; $i < strlen($user_input); $i++) {
            $count_index++;
        }
        if ($count_index > 2 || $count_index == null) {
            $isID = true;
        } else {
            $isID = false;
        }
        return $isID;
    }
    function check_symbols($user_input) {
        $symbols = '!@#$%^&*-_=+`~,.?;"<>|][ '."&nbsp;";
        $is_symbol = false;
        for ($i=0;$i<strlen($user_input);$i++) {
            for ($j=0;$j<strlen($symbols);$j++) {
                if ($user_input[$i] == $symbols[$j]) {
                    $is_symbol = true;
                break;
                } else {
                    $is_symbol = false;
                }
            }
        }
        return $is_symbol;
    }
    function check_string($user_input) {
        $is_num = false;
        $is_symbol = false;
        $is_correct = true;
        $symbols = '!@#$%^&*-_=+`~,.?;"<>|][ '."&nbsp;";
        for ($i=0; $i < strlen($user_input); $i++) { 
            if (is_numeric($user_input[$i])) {
                $is_num = true;
            break;
            } else {
                for ($j=0; $j < strlen($symbols); $j++) { 
                    if ($user_input[$i] == $symbols[$j]) {
                        $is_symbol = true;
                    break;
                    }
                }
            }
        }
        if ($is_num || $is_symbol) {
            $is_correct = false;
        }
        return $is_correct;
    }
                    
?>  