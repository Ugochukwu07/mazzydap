<?php 
include(ROOT_PATH . '/app/database/db.php');
include(ROOT_PATH . '/app/helpers/funds.php');
include(ROOT_PATH . '/app/helpers/mailer.php');
include(ROOT_PATH . '/app/helpers/paging.php');
include(ROOT_PATH . '/app/helpers/middleware.php');
include(ROOT_PATH . '/app/helpers/validate.php');
$errors = array();
$error = array();

#create account var
$errors['name'] = $errors['exn'] = $errors['address'] = $errors['currency'] = '';
$errors['currencyMatch'] = $name = $address = $currency = '';

#deposit
$errors['account'] = $errors['amount'] = $errors['plan_id'] = $errors['enough'] = ''; 
$plan_id = $account_id = $amount  = $user_address = $trans_hash = "";

#account
$errors['amount'] = $errors['currency'] = $errors['account'] = $errors['etp'] = $errors['address'] = '';
$currency = $amount = $account = $errors['emp'] = '';

#confirm
$errors['user_address'] = $errors['trans_hash'] = '';

#tables
$table = 'accounts';
$table2 = 'transactions';

#functionalities
if(isset($_GET['coin'])){
    $id = $_GET['coin'];
    $account = selectOne($table, ['id' => $id]);
    $name = $account['name'];
    $address = $account['address'];
    $currency = $account['currency'];
}

if(isset($_GET['trans_id'])){
    $id = $_GET['trans_id'];
    $transaction = selectOne($table2, ['trans_id' => $id]);
    $account = selectOne($table, ['id' => $transaction['account_id']]);
    $amount = $transaction['amount'];
    $currency = $account['currency'];
    $id = $transaction['id'];
}

#accept & reverse deposit
if(isset($_GET['id']) && isset($_GET['action'])){
    adminOnly();
    if ($_GET['action'] === 'accept') {
        $deposit = update($table2, $_GET['id'], ['status' => 1]);
        $transaction = selectOne($table2, ['id' => $_GET['id'], 'nature' => 1]);
        $user = selectOne('users', ['id' => $transaction['user_id']]);
        if($user['ref'] > 0){
            $ref_bouns = 0.03 * $transaction['amount'];
            $ref_user = selectOne('users', ['id' => $user['ref']]);
            $balance = $ref_bouns + $ref_user['balance'];
            $newBalance = update('users', $user['ref'], ['balance' => $balance]);
        }
        $account = selectOne('accounts', ['id' => $transaction['account_id']]);
        $plan = selectOne('plans', ['id' => $transaction['plan_id']]);
        $start = date('Y-m-d'); $end = date('Y-m-d', strtotime($start . ' + '. $plan['ROI'] . ' days'));
        $funds = create('funds', ['currentInvestment' => $transaction['amount'], 'trans_id' => $transaction['trans_id'], 'user_id' => $transaction['user_id'], 'plan_id' => $transaction['plan_id'], 'start' => date('Y-m-d'), 'end' => $end]);
        $message = 'Admin ' . $_SESSION['firstname'] . ' accepted a deposit';
        $feeds = create('feeds', ['user_id' => $transaction['user_id'], 'type' => 'success', 'message' => $message, 'status' => 1]);
        $user = selectOne('users', ['id' => $transaction['user_id']]);
        $template_file = '../../app/lib/deposit-success.php';
        $logo = BASE_URL . '/assets/open/images/logo.png';
        $swap_var = array(
            "#name#" => $user['firstname'] . ' ' . $user['lastname'],
            "{EMAIL_TITLE}" => 'Deposit Request Successful', 
            "{TO_EMAIL}" => $user['email'],
            "#trans_id#" => $transaction['trans_id'],
            "#wallet#" => $transaction['receiver_address'],
            "#amount#" => $transaction['amount'], 
            "#currency#" => $account['name'],
            'TOP' => XMAIL['top'],
            'BOTTOM' => XMAIL['bottom']
        );
        mailing($template_file, $swap_var);
        $_SESSION['message'] = 'Deposit Accepted Successfully';
        $_SESSION['type'] = 'success';
    }else{
        $fund = update($table2, $_GET['id'], ['status' => 0]); #change deposit status to false
        $transaction = selectOne($table2, ['id' => $_GET['id']]); #select the new updated deposit
        $funds = selectOne('funds', ['user_id' => $transaction['user_id'], 'trans_id' => $transaction['trans_id']]); //select fund so i can get old currentInvestment value
        $current = delete('funds', $funds['id']);
        $message = 'Admin ' . $_SESSION['firstname'] . ' reversed a deposit';
        $feeds = create('feeds', ['user_id' => $transaction['user_id'], 'type' => 'primary', 'message' => $message, 'status' => 1]);
        $_SESSION['message'] = 'Deposit Reversed Successfully';
        $_SESSION['type'] = 'primary';
    }
}

#accept & reverse withdrawals
if(isset($_GET['with_id']) && isset($_GET['action'])){
    adminOnly();
    if($_GET['action'] === 'accept'){
        $transaction = update($table2, $_GET['with_id'], ['status' => 1]);
        $transactions = selectOne($table2, ['id' => $_GET['with_id']]);
        $account = selectOne('accounts', ['id' => $transactions['account_id']]);
        $user = selectOne('users', ['id' => $transactions['user_id']]);
        $balance = $user['balance'] - $transactions['amount'];
        $newUser = update('users', $user['id'], ['balance' => $balance]);
        $template_file = '../../app/lib/withdraw-success.php';
        $logo = BASE_URL . '/assets/open/images/logo.png';
        $swap_var = array(
            "#name#" => $user['firstname'] . ' ' . $user['lastname'],
            "{EMAIL_TITLE}" => 'Withdrawal Request Successful', 
            "{TO_EMAIL}" => $user['email'],
            "#trans_id" => $transaction['trans_id'],
            "#wallet#" => $transaction['receiver_address'],
            "#amount#" => $transaction['amount'], 
            "#currency#" => $account['name'],
            "#reason#" => $account['name'],
            'TOP' => XMAIL['top'],
            'BOTTOM' => XMAIL['bottom']
        );
        mailing($template_file, $swap_var);
        $_SESSION['message'] = 'Withdrawal Accepted';
        $_SESSION['type'] = 'success';
        header('location:' . BASE_URL . '/dashboard/admin/withdrawal.php');
        exit();
    }
}

#addAccount
if(isset($_POST['addAccount'])){
    adminOnly();
    $genErrors = accoutVal($_POST);
    $errors = $genErrors[0];
    $subMainError = $genErrors[1];
    if(count($subMainError) === 0){
        unset($_POST['addAccount']);
        $_POST['user_id'] = $_SESSION['id'];
        $account_id = create($table, $_POST);
        $message = 'Admin User ' . $_SESSION['firstname'] . '  created an account';
        $feeds = create('feeds', ['user_id' => $_SESSION['id'], 'message' => $message, 'type' => 'primary', 'status' => 1]);
        $_SESSION['message'] = $_POST['name'] . ' account created';
        $_SESSION['type'] = 'success';
        header('location:' .  BASE_URL . '/dashboard/admin/');
        exit();
    }else{
        $name = $_POST['name'];
        $address = $_POST['address'];
        $currency = $_POST['currency'];
    }
}

#updateAccount
if(isset($_POST['updateAccount'])){
    adminOnly();
    $genErrors = accoutVal($_POST);
    $errors = $genErrors[0];
    $subMainError = $genErrors[1];
    if(count($subMainError) === 0){
        $id = $_POST['id'];
        unset($_POST['updateAccount'], $_POST['id'], $_POST['passcode']);
        $_POST['user_id'] = $_SESSION['id'];
        $account_id = update($table, $id, $_POST);
        $message = 'Admin User ' . $_SESSION['firstname'] . '  updated ' . $_POST['name'] . ' account';
        $feeds = create('feeds', ['user_id' => $_SESSION['id'], 'message' => $message, 'type' => 'primary', 'status' => 1]);
        $_SESSION['message'] = $_POST['name'] . ' updated created';
        $_SESSION['type'] = 'success';
        header('location:' .  BASE_URL . '/dashboard/admin/');
        exit();
    }else{
        $id = $_POST['id'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $currency = $_POST['currency'];
    }
}

#deposit-btn
if(isset($_POST['deposit-btn'])){
    usersOnly();
    $genErrors = depositVal($_POST);
    $errors = $genErrors[0];
    $subMainError = $genErrors[1];
    if(count($subMainError) === 0){
        unset($_POST['deposit-btn']);
        $_POST['trans_id'] = generateRandomString($p_code, 5);
        #deposit has a nature of 1 while withdrawal has a nature of 0
        $account = selectOne('accounts', ['id' => $_POST['account_id']]);
        $_POST['nature'] = 1;
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['receiver_address'] = $account['address'];
        $_POST['status'] = 0;
        $deposit_id = create($table2, $_POST);
        $message = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' made a deposit request';
        $feeds = create('feeds', ['user_id' => $_SESSION['id'], 'message' => $message, 'type' => 'success', 'status' => 1]);
        $message = 'You made a deposit request';
        $feeds = create('feeds', ['user_id' => $_SESSION['id'], 'message' => $message, 'type' => 'success', 'status' => 0]);
        $template_file = '../../app/lib/deposit-request.php';
        $logo = BASE_URL . '/assets/open/images/logo.png';
        $swap_var = array(
            "#name#" => $_SESSION['firstname'] . ' ' . $_SESSION['lastname'],
            "{EMAIL_TITLE}" => 'Deposit Request',
            "{TO_EMAIL}" => $_SESSION['email'],
            "#amount#" => $_POST['amount'],
            "#logo#" => $logo,
            "#trans_id#" => $_POST['trans_id'],
            "#wallet#" => $account['address'],
            'TOP' => XMAIL['top'],
            'BOTTOM' => XMAIL['bottom']
        );
        mailing($template_file, $swap_var);
        $swap_var = array("{TO_EMAIL}" => MCC);
        mailing($template_file, $swap_var);
        header('location:' . BASE_URL . '/dashboard/user/promt.php?trans_id=' . $_POST['trans_id']);
        exit();
    }else{
        $plan_id = $_POST['plan_id'];
        $account_id = $_POST['account_id'];
        $amount = $_POST['amount'];
    }
}

#withdraw
if (isset($_POST['withdraw'])) {
    usersOnly();
    $genErrors = withdrawVal($_POST);
    $errors = $genErrors[0];
    $subMainError = $genErrors[1];
    if(count($subMainError) === 0){
        $_POST['receiver_address'] = $_POST['account'];
        $account = selectOne('accounts', ['id' => $_POST['currency']]);
        unset($_POST['withdraw'], $_POST['account'], $_POST['currency']);
        $_POST['nature'] = 0;
        $_POST['status'] = 0;
        $_POST['trans_id'] = generateRandomString($p_code, 5);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['account_id'] = $account['id'];
        $transaction = create($table2, $_POST);
        $message = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ' made a withdrawal request';
        $feeds = create('feeds', ['user_id' => $_SESSION['id'], 'message' => $message, 'type' => 'warning', 'status' => 1]);
        $message = 'You made a withdrawal request';
        $feeds = create('feeds', ['user_id' => $_SESSION['id'], 'message' => $message, 'type' => 'success', 'status' => 0]);
        $logo = BASE_URL . '/assets/open/images/logo.png';
        $template_file = '../../app/lib/withdraw-request.php';
        $swap_var = array(
            "#name#" => $_SESSION['firstname'] . ' ' . $_SESSION['lastname'],
            "{TITLE}" => 'Withdrawal Request',
            "{EMAIL_TITLE}" => 'Withdrawal Request',
            "{TO_EMAIL}" => $_SESSION['email'],
            "#wallet#" => $_POST['receiver_address'],
            "#currency#" => $account['name'],
            "{REASON}" => 'Withdrawal Request',
            "#amount#" => $_POST['amount'],
            "{LOGO}" => $logo,
            "#trans_id#" => $_POST['trans_id'],
            'TOP' => XMAIL['top'],
            'BOTTOM' => XMAIL['bottom']
        );
        mailing($template_file, $swap_var);
        $swap_var = array("{TO_EMAIL}" => MCC);
        mailing($template_file, $swap_var);
        $_SESSION['message'] = '<b>Withdrawal Request</b> made successfully';
        $_SESSION['type'] = 'success';
        header('location:' . BASE_URL . '/dashboard/user/');
        exit();
    }else{
        $amount = $_POST['amount'];
        $currency = $_POST['currency'];
        $account = $_POST['account'];
    }
}


#confirmDeposit
if(isset($_POST['confirmDeposit']) || isset($_POST['confirmWithdrawal'])){
    $genErrors = confirmVal($_POST);
    $errors = $genErrors[0];
    $subMainError = $genErrors[1];
    if(count($subMainError) === 0){
        $id = $_POST['id'];
        unset($_POST['amount'], $_POST['currency'], $_POST['id']);
        if(isset($_POST['confirmDeposit'])){
            usersOnly();
            unset($_POST['confirmDeposit']);
            update($table2, $id, $_POST);
            $transaction = selectOne($table2, ['id' => $id]);
            $account = selectOne('accounts', ['id' => $transaction['account_id']]);
            #send mail to user
            $logo = BASE_URL . '/assets/open/images/logo.png';        
                $template_file = 'dconfirm.php';
                $swap_var = array(
                "#fullname#" => $_SESSION['firstname'] . ' ' . $_SESSION['lastname'],
                "#currency#" => $account['name'],
                "{EMAIL_TITLE}" => 'Deposit Confirmation',
                "{TO_EMAIL}" => $_SESSION['email'],
                "#wallet#" => $transaction['receiver_address'],
                "#cwallet#" => $transaction['user_address'],
                "#has#" => $transaction['trans_hash'],
                '#type#' => 'Deposit Confirmation',
                "#remarks#" => $account['name'] . ' Deposit Method',
                "#amount#" => $transaction['amount'],
                "{LOGO}" => $logo,
                '#datetime#' => date('Y-m-d : h:i:s a'),
                "{FNAME}" => $_SESSION['firstname'],
                "{LNAME}" => $_SESSION['lastname'],
                'TOP' => XMAIL['top'],
                'BOTTOM' => XMAIL['bottom']
            );
            mailing($template_file, $swap_var);
            $transaction = selectOne($table2, ['id' => $id]);
            $message = 'You confirmed your deposit of Trans ID:' . $transaction['trans_id'] . ' Zilex Trade Team will confirm the transaction soon';
            $feed_id = create('feeds', ['user_id' => $_SESSION['id'], 'message' => $message, 'type' => 'success']);
            $_SESSION['message'] = $message;
            $_SESSION['type'] = 'success';
            header('location: ' . BASE_URL . '/dashboard/user/');
            exit();
        }else{
            adminOnly();
            unset($_POST['confirmWithdrawal']);
            update($table2, $id, $_POST);
            $transaction = update($table2, $id, ['status' => 1]);
            $transaction = selectOne($table2, ['id' => $id]);
            $account = selectOne('accounts', ['id' => $transaction['account_id']]);
            $user = selectOne('users', ['id' => $transaction['user_id']]);
            $balance = $user['balance'] - $transaction['amount'];
            $newUser = update('users', $user['id'], ['balance' => $balance]);
            #send mail to user
            $logo = BASE_URL . '/assets/open/images/logo.png';         
                $template_file = '../../../app/lib/withdraw-success.php';
                $swap_var = array(
                "#name#" => $user['firstname'] . ' ' . $user['lastname'],
                "#currency#" => $account['name'],
                "{EMAIL_TITLE}" => 'Withdrawal Notification Successful Service',
                "{TO_EMAIL}" => $user['email'],
                "#cwallet#" => $transaction['receiver_address'],
                "#wallet#" => $transaction['user_address'],
                "#batch#" => $transaction['trans_hash'],
                '#type#' => 'Withdrawal Successful',
                "#reason#" => $account['name'],
                "#amount#" => '$' . $transaction['amount'],
                "#trans_id#" => $transaction['trans_id'],
                '#datetime#' => date('Y-m-d : h:i:s a'),
                "{FNAME}" => $user['firstname'],
                'TOP' => XMAIL['top'],
                'BOTTOM' => XMAIL['bottom']
            );
            mailing($template_file, $swap_var);
            #send mail to user
            $transaction = selectOne($table2, ['id' => $id]);
            $message = 'You confirmed and Accepted the withdrawal of Trans ID:' . $transaction['trans_id'];
            $feed_id = create('feeds', ['user_id' => $_SESSION['id'], 'message' => $message, 'type' => 'success']);
            $_SESSION['message'] = $message;
            $_SESSION['type'] = 'success';
            header('location: ' . BASE_URL . '/dashboard/admin/withdrawal/');
            exit();

        }
    }else{
        $id = $_POST['id'];
        $amount = $_POST['amount'];
        $currency = $_POST['currency'];
        $user_address = $_POST['user_address'];
        $trans_hash = $_POST['trans_hash'];
    }

}

?>
