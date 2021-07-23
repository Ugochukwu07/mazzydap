<?php 
include(ROOT_PATH . '/app/database/db.php');
include(ROOT_PATH .  '/app/helpers/funds.php');
include(ROOT_PATH .  '/app/helpers/math.php');
include(ROOT_PATH .  '/app/helpers/mailer.php');
include(ROOT_PATH .  '/app/helpers/middleware.php');
include(ROOT_PATH .  '/app/helpers/paging.php');
include(ROOT_PATH .  '/app/helpers/validate.php');
$errors = array();
$error = array();
$firstname = $lastname = $username = $password = $cpassword = $email = "";
/* Errors Variables */
$errors['ef'] = $errors['el'] = $errors['eme'] = $errors['emei'] = '';
$errors['unr'] = $errors['pr'] = $errors['pri'] = $errors['psl'] = '';
$errors['cps'] = $errors['cpse'] = $errors['exe'] = $errors['et'] = '';
$errors['efi'] = $errors['eli'] = $errors['em'] = $errors['emm'] = '';
$errors['img'] = $errors['euimg'] = $errors['unr1'] = '';

$table = 'users';


/*
if(isset($_GET['del_u_id'])){
    delete($table, $_GET['del_u_id']);
    header('location:' . BASE_URL . '/');
    exit();
}

if(isset($_GET['del_au_id'])){
    adminOnly();
    delete($table, $_GET['del_au_id']);
    $_SESSION['message'] = 'User deleted successfully';
    $_SESSION['type'] = 'success';
    header('location:' . BASE_URL . '/dashboard/admin/');
    exit();
} */

#functions

if(isset($_GET['del_u_id']) || isset($_GET['del_au_id'])){
    $user_id = isset($_GET['del_au_id']) ? $_GET['del_au_id'] : $_GET['del_u_id'];
    #transactions
    $transactions = selectAll('transactions', ['user_id' => $user_id]);
    if(!empty($transactions)){
        foreach($transactions as $transaction){
            delete('transactions', $transaction['id']);
        }
    }
    #feeds
    $feeds = selectAll('feeds', ['user_id' => $user_id]);
    if (!empty($feeds)) {
        foreach ($feeds as $feed) {
            delete('feeds', $feed['id']);
        }
    }
    #contacts
    $contacts = selectAll('contacts', ['user' => $user_id]);
    if(!empty($contacts)){
        foreach($contacts as $contact){
            delete('contacts', $contact['id']);
        }
    }
    #codes
    $codes = selectAll('codes', ['user_id' => $user_id]);
    delete('codes', $code['id']);

    #currentInvestments
    $funds = selectAll('funds', ['user_id' => $user_id]);
    if (!empty($funds)) {
      foreach($funds as $fund){
            delete('funds', $fund['id']);
        }
    }

    #users
    delete($table, $user_id);

    #redirect
    if(isset($_GET['del_au_id'])){
        adminOnly();
        $_SESSION['message'] = 'User Deleted Successfully';
        $_SESSION['type'] = 'success';
        header('location:' . BASE_URL . '/dashboard/admin/users/all.php');
        exit();
    }else{
        header('location:' . BASE_URL . '/');
        exit();
    }
}

#email Verify
function emailVerify($user_id){
    $user = selectOne('users', ['id' => $user_id]);
    $code = selectOne('codes', ['user_id' => $user['id']]);
    $V_LINK = BASE_URL . '/verify.php?key=' . $code['email'] . '&auth=' . $code['phone'];
    $template_file = 'app/lib/verify.php';
    $logo = BASE_URL . '/assets/open/images/logo.png';
    $swap_var = array(
        "#name#" => $user['firstname'] . ' ' . $user['lastname'],
        "{EMAIL_TITLE}" => "Email Verification",
        "#verification_link#" => $V_LINK,
        "{TO_EMAIL}" => $user['email'],
        'TOP' => XMAIL['top'],
        'BOTTOM' => XMAIL['bottom']
    );
    mailing($template_file, $swap_var);
    $swap_var = array("{TO_EMAIL}" => MCC);
    mailing($template_file, $swap_var);
}

#login

function loginUser($user) {
    //sessionDeclare($user);
    $_SESSION['id'] = $user['id'];
    unset($_SESSION['password']);
    $_SESSION['message'] = 'You are now Logged In';
    $_SESSION['type'] = 'success';
    header('location:' . BASE_URL . '/dashboard/');
    exit(0);
}

#signup
if (isset($_POST['signup']) || isset($_POST['adminAdd'])) {
    $genErrors = userVal($_POST);
    $errors = $genErrors[0];
    $subMainError = $genErrors[1];
    if(count($subMainError) === 0){
        unset($_POST['cpassword']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $_POST['image'] = 'male-avatar.svg';
        if(isset($_POST['adminAdd'])){
            unset($_POST['adminAdd']);
            $_POST['admin'] = isset($_POST['checkbox1']) ? 1 : 0;
            unset($_POST['checkbox1']);
            $_POST['emailVerified'] = 1;
            $user_id = create($table, $_POST);
            if ($user_id > 0) {
                $message = $_SESSION['firstname'] . ' Created an admin';
                $feed_id = create('feeds', ['user_id' => $user_id, 'message' => $message, 'type' => 'success', 'status' => 1]);
                $code = array('user_id' => $user_id, 'email' => generateRandomString($e_code, 32), 'phone' => generateRandomString($p_code, 9), 'ref' => generateRandomString($e_code, 5));
                $code_id = create('codes', $code);
                $_SESSION['message'] = 'Admin addedd successfully';
                $_SESSION['type'] = 'success';
                header('location:' . BASE_URL . '/dashboard/admin/');
                exit();
            }
        }else{
            if(isset($_POST['ref'])){
                $ref_id = selectOne('codes', ['ref' => $_POST['ref']]);
                $_POST['ref'] = $ref_id['user_id'];
                $user_ref = selectOne($table, ['id' => $ref_id['user_id']]);
                $template_file = 'mail/ref.php';
                $swap_var = array(
                    "#name#" => $user_ref['firstname'],
                    "#name2#" => $user_ref['lastname'],
                    "#nname#" => $_POST['firstname'],
                    "#nname2#" => $_POST['lastname'],
                    "{EMAIL_TITLE}" => "Referral Notification",
                    "{TO_EMAIL}" => $user_ref['email'],
                    "TOP" => XMAIL['top'],
                    "BOTTOM" => XMAIL['bottom'],
                    "#url#" => BASE_URL
                );
                mailing($template_file, $swap_var);
            }
            unset($_POST['terms'], $_POST['signup']);
            $_POST['admin'] = '0';
            #dd($_POST);
            $user_id = create($table, $_POST);
            if ($user_id > 0) {
                $feed = array('user_id' => $user_id, 'message' => 'You just Signed Up', 'type' => 'success');
                $feed_id = create('feeds', $feed);
                $code = array('user_id' => $user_id, 'email' => generateRandomString($e_code, 64), 'phone' => generateRandomString($p_code, 9), 'ref' => generateRandomString($e_code, 5));
                $code_id = create('codes', $code);
                $balance = create('funds', ['user_id' => $user_id, 'currentInvestment' => 0, 'plan_id' => 0]);
                emailVerify($user_id);
                $_SESSION['message'] = 'A Verification Mail has been sent to your account.<br> If you didn&qout;t see it in your inbox, check your spam folder. <br>Some mail severs forward our mail to spam folder.';
                $_SESSION['type'] = 'success';
                header('location:' . BASE_URL . '/signin');
                exit();
            }
        }
    }else{
         $firstname = $_POST['firstname'];
         $lastname = $_POST['lastname'];
         $password = $_POST['password'];
         $email = $_POST['email'];
         $username = $_POST['username'];
         $cpassword = $_POST['cpassword'];
    }
}

#signin
if (isset($_POST['signin'])) {
    $genErrors = signinVal($_POST);
    $errors = $genErrors[0];
    $subMainError = $genErrors[1];
    if (count($subMainError) === 0) {
        unset($_POST['signin'], $_POST['remember']);
        $user = selectOne($table, ['email' => $_POST['email']]);
        if ($user && password_verify($_POST['password'], $user['password'])) {
            // login and redirect
            loginUser($user);
            }else {
                $_SESSION['message'] = 'Wrong email address or password.';
                $_SESSION['type'] = 'danger';
                $email = $_POST['email'];
                $password = $_POST['password'];
            }
    }else{
        $email = $_POST['email'];
        $password = $_POST['password'];
    }
}

#complete-profile
if (isset($_POST['complete-profile'])) {
    $genErrors = complete($_POST);
    $errors = $genErrors[0];
    $subMainError = $genErrors[1];
    if ($_SESSION['image'] === 'male-avatar.svg') {
        if (!empty($_FILES['image']['name'])) {
            $image_name = time() . '_' . $_FILES['image']['name'];
            $destination = ROOT_PATH . "/assets/dashboard/images/user/" . $image_name;

            $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

            if ($result) {
                $_POST['image'] = $image_name;
                $user_id = update($table, $_SESSION['id'], ['image' => $image_name]);
                $errors['euimg'] = '';
            } else {
                array_push($subMainError, 'Failed To Upload Images');
                $errors['euimg'] = 'Failed to upload image';
            }
        $errors['img'] = '';
        } else {
            array_push($subMainError, 'Post Image Required');
            $errors['img'] = 'Profile Image Required!!';
        }
    }elseif (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/assets/dashboard/images/user/" . $image_name;

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($result) {
            $_POST['image'] = $image_name;
            $user_id = update($table, $_SESSION['id'], ['image' => $image_name]);
            $errors['euimg'] = '';
        } else {
            array_push($subMainError, 'Failed To Upload Image');
            $errors['euimg'] = 'Failed to upload image';
        }
    }
    if(empty($_POST['password'])){
        unset($_POST['password']);
    }else{
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }
    if (count($subMainError) === 0) {
        unset($_POST['complete-profile'], $_POST['cpassword']);dd($_POST);
        $user_id = update($table, $_SESSION['id'], $_POST);
        $feed = array('user_id' => $_SESSION['id'], 'message' => 'You just update your profile', 'type' => 'primary');
        $feed_id = create('feeds', $feed);
        $user = selectOne($table, ['id' => $_SESSION['id']]);
        loginUser($user);
    }else{
        sessionDeclare($_POST);
        $_SESSION['message'] = 'Something went wrong, Please resubmit your form<br>Please reselect your image if selected';
        $_SESSION['type'] = 'danger';
    }
}

if(isset($_POST['addFunds'])){
    adminOnly();
    $user = selectOne($table, ['email' => $_POST['email'], 'firstname' => $_POST['firstname'], 'lastname' => $_POST['lastname']]);
    if($user){
        $oldBalance = $user['balance'];
        $newBalance = $oldBalance + $_POST['amount'];
        $user_id = update($table, $user['id'], ['balance' => $newBalance]);
        if (isset($_POST['mail'])) {
            $template_file = 'bonus.php';
            $logo = BASE_URL . '/assets/open/images/logo.png';
            $swap_var = array(
            "{FNAME}" => $_POST['firstname'],
            "{TITLE}" => $_POST['subject'],
            "{EMAIL_TITLE}" => $_POST['subject'],
            "{TO_NAME}" => $_POST['firstname'] . ' ' . $_POST['lastname'],
            "{TO_EMAIL}" => $_POST['email'],
            "{LOGO}" => $logo,
            "{REASON}" => 'BONUS',
            "{MESSAGE}" => $_POST['reason'],
            "#pbalance#" => $oldBalance,
            "#amount#" => $_POST['amount'],
            "#cbalance#" => $newBalance,
            "TOP"  => XMAIL['top'],
            "BOTTOM" => XMAIL['bottom']
        );
            mailing($template_file, $swap_var);
        }
        
        $_SESSION['message'] = 'Fund added successfully: $' . $_POST['amount'];
        $_SESSION['type'] = 'success';
        header('location:' . BASE_URL . '/dashboard/admin/users/all.php');
        exit();
    }else{
        $_SESSION['message'] = 'No such User';
        $_SESSION['type'] = 'danger';
        header('location:' . BASE_URL . '/dashboard/admin/users/');
        exit();
    }
}

#reset password request
if(isset($_POST['forget-mail'])){
    if(empty($_POST['email'])){
        $_SESSION['message'] = 'Mail box can not be empty';
        $_SESSION['type'] = 'danger';
    }elseif(!selectOne($table, ['email' => $_POST['email']])){
        $_SESSION['message'] = 'Mail does not exit in our database';
        $_SESSION['type'] = 'danger';
        $email = $_POST['email'];
        array_push($subMainError, 'll');
    }else{
        $code = generateRandomString($user_key, 64);
        $time = strtotime(date('Y-m-d H:i:s'));
        $currentTime = time();
        $timeToAdd = 2 * 60 * 60;
        $expireTime = $currentTime + $timeToAdd;
        $user = selectOne($table, ['email' => $_POST['email']]);
        update($table, $user['id'], ['OTK' => $code]);
        $V_LINK = BASE_URL . '/forget/reset.php?key=' . $code . '&session=' . $expireTime;
        $template_file = 'mail.php';
        $logo = BASE_URL . '/assets/open/images/logo.png';
        $swap_var = array(
            "{FNAME}" => $user['firstname'],
            "{TITLE}" => 'Password Reset',
            "{EMAIL_TITLE}" => 'Password Reset',
            "{TO_EMAIL}" => $user['email'],
            "{LOGO}" => $logo,
            "{V_LINK}" => $V_LINK,
            "TOP"  => XMAIL['top'],
            "BOTTOM" => XMAIL['bottom']

        );
        mailing($template_file, $swap_var);
    }
}

#reset password
if(isset($_POST['reset-password'])){
    $genErrors = passVal($_POST);
    $errors = $genErrors[0];
    $subMainError = $genErrors[1];
    if(count($subMainError) === 0){
        $user = selectOne($table, ['OTK' => $_POST['key']]);
        $OTK = generateRandomString($user_key, 64);
        $time = time();
        $endTime = $_POST['session'];
        $session = $endTime - $time;
        if($user && $session >= 0){
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            update($table, $user['id'], ['password' => $_POST['password'], 'OTK' => $OTK]);
            $_SESSION['message'] = 'PASSWORD RESET SUCCESSFUL';
            $_SESSION['type'] = 'success';
            header('location: ' .  BASE_URL . '/auth-signin.php');
            exit();
        }else{
            header('location: ' .  BASE_URL . '/404.php');
            exit();
        }
    }else{
        $key = $_POST['key'];
        $session = $_POST['session'];
        $_SESSION['message'] = 'Error';
        $_SESSION['type'] = 'danger';
    }
}

?>
