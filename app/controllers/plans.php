<?php 
include(ROOT_PATH . '/app/database/db.php');
include(ROOT_PATH . '/app/helpers/mailer.php');
include(ROOT_PATH . '/app/helpers/middleware.php');
include(ROOT_PATH . '/app/helpers/validate.php');
$errors = array();
$error = array();
$errors['name'] = $name = $ROI = $min = $max = $dailyPercent = $errors['image'] = $errors['image1'] = '';
$errors['ROI'] = $errors['min'] = $errors['max'] = $errors['dailyPercent'] = '';
$errors['namei'] = $errors['plan_id'] = '';

$table = 'plans';
$plans = selectAll($table);

if(isset($_GET['plan_id'])){
    $id = $_GET['plan_id'];
    $plan = selectOne($table, ['id' => $id]);
    $name = $plan['name'];
    $ROI = $plan['ROI'];
    $min = $plan['min'];
    $max = $plan['max'];
    $dailyPercent = $plan['dailyPercent'];
}

#addPlan
if(isset($_POST['addPlan'])){
    adminOnly();
    $genErrors = planVal($_POST);
    $errors = $genErrors[0];
    $subMainError = $genErrors[1];
    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/assets/dashboard/images/plans/" . $image_name;

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($result) {
            $_POST['image'] = $image_name;
        } else {
            array_push($subMainError, 'Failed To Upload Image');
            $errors['image'] = 'Failed to upload image';
            $errors['image1'] = '';
        }
    } else {
        array_push($subMainError, 'Post Image Required');
        $errors['image1'] = 'Profile Image Required!!';
        $errors['image'] = '';
    }
    #dd($subMainError);
    if(count($subMainError) === 0){
        unset($_POST['addPlan']);
        $_POST['user_id'] = $_SESSION['id'];
        $plan_id = create($table, $_POST);
        $message = 'Admin ' . $_SESSION['firstname'] . ' created a new plan.';
        $feed_id = create('feeds', ['user_id' => $_POST['user_id'], 'message' => $message, 'type' => 'primary', 'status' => 1]);
        $_SESSION['message'] = 'Plan created successfully';
        $_SESSION['type'] = 'success';
        header('location:' . BASE_URL . '/dashboard/admin/plan/index.php');
        exit();
    }else{
        $name = $_POST['name'];
        $ROI = $_POST['ROI'];
        $min = $_POST['min'];
        $max = $_POST['max'];
        $dailyPercent = $_POST['dailyPercent'];
    }
}

#updatePlan
if(isset($_POST['updatePlan'])){
    adminOnly();
    $genErrors = planVal($_POST);
    $errors = $genErrors[0];
    $subMainError = $genErrors[1];
    if (isset($_POST['image'])) {
        if (!empty($_FILES['image']['name'])) {
            $image_name = time() . '_' . $_FILES['image']['name'];
            $destination = ROOT_PATH . "/assets/dashboard/images/plans/" . $image_name;

            $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

            if ($result) {
                $_POST['image'] = $image_name;
            } else {
                array_push($subMainError, 'Failed To Upload Image');
                $errors['image'] = 'Failed to upload image';
                $errors['image1'] = '';
            }
        } else {
            array_push($subMainError, 'Post Image Required');
            $errors['image1'] = 'Profile Image Required!!';
            $errors['image'] = '';
        }
    }
    if(count($subMainError) === 0){
        $id = $_POST['id'];
        $_POST['user_id'] = $_SESSION['id'];
        unset($_POST['updatePlan'], $_POST['id']);
        $plan_id = update($table, $id, $_POST);
        $message = 'Admin ' . $_SESSION['firstname'] . ' updated a plan:' . $_POST['name'];
        $feed_id = create('feeds', ['user_id' => $_POST['user_id'], 'message' => $message, 'status' => 1]);
        $_SESSION['message'] = 'Plan updated successfully';
        $_SESSION['type'] = 'success';
        header('location:' . BASE_URL . '/dashboard/admin/plan/index.php');
        exit();
    }else{
        $name = $_POST['name'];
        $ROI = $_POST['ROI'];
        $min = $_POST['min'];
        $max = $_POST['max'];
        $dailyPercent = $_POST['dailyPercent'];
    }
}

#upgrade
if(isset($_POST['upgradePlan'])){
    if(empty($_POST['plan_id'])){
        $_SESSION['message'] = 'Please select a valid Plan';
        $_SESSION['type'] = 'danger';
        header('location: ' . BASE_URL . '/dashboard/admin/#trans-history');
        exit();
    }else{
        $errors['plan_id'] = '';
        $user = selectOne('users', ['email' => $_POST['email'], 'firstname' => $_POST['firstname'], 'lastname' => $_POST['lastname']]);
        $plan = selectOne($table, ['id' => $_POST['plan_id']]);
        $transaction = selectOne('transactions', ['trans_id' => $_POST['trans_id']]);
        $availableBalance = $user['balance'] + $transaction['amount'];
        $fund11 = selectOne('funds', ['trans_id' => $transaction['trans_id']]);
        $transs_id = $transaction['id'];
        $newBalance = $availableBalance - $plan['min'];
        $old_trans_id = $transaction['trans_id'];
        $old_amount = $transaction['amount'];
        $old_plan = selectOne($table, ['id' => $transaction['plan_id']]);
        $transaction['trans_id'] = generateRandomString($p_code, 5);
        $transaction['amount'] = $plan['min']; $transaction['plan_id'] = $plan['id'];
        unset($transaction['created_at'], $transaction['id']);
        if($newBalance > 0 || $newBalance == 0){
            $newTrans = create('transactions', $transaction);
            $funds = array();
            $funds['user_id'] = $transaction['user_id']; $funds['currentInvestment'] = $transaction['amount'];
            $funds['plan_id'] = $transaction['plan_id']; $funds['trans_id'] = $transaction['trans_id'];
            $funds['start'] = date('Y-m-d h:i:s'); $funds['end'] = date('Y-m-d h:i:s', strtotime($funds['start'] . ' + '. $plan['ROI'] . ' days'));
            $fund = create('funds', $funds);
            $template_file = '../../app/lib/upgrade-success.php';
            $logo = BASE_URL . '/assets/open/images/logo.png';
            $swap_var = array(
                "#name#" => $user['firstname'] . ' ' . $user['lastname'],
                "{EMAIL_TITLE}" => 'Plan Upgrade',
                "{TO_EMAIL}" => $user['email'],
                "#logo#" => $logo,
                "#old_trans_id#" => $old_trans_id,
                "#new_trans_id#" => $transaction['trans_id'],
                "#new_amount#" => $plan['min'],
                "#old_amount#" => $old_amount,
                "#balance#" => $newBalance,
                "#old_plan_name#" => $old_plan['name'],
                "#new_plan_name#" => $plan['name'],
                'TOP' => XMAIL['top'],
                'BOTTOM' => XMAIL['bottom']
            );
            mailing($template_file, $swap_var);
            $id = $transaction['user_id'];
            $user = update('users', $id, ['balance' => $newBalance]);
            #$old_trans = update('funds', $fund11['id'], ['currentInvestment' => 0, 'status' => 1, 'paid' => 1, 'end' => $end]);
            delete('funds', $fund11['id']);
            delete('transactions', $transs_id);
            $_SESSION['message'] = 'User: ' . $user['firstname'] . ' has been upgraded successfully';
            $_SESSION['type'] = 'success';
            header('location: ' . BASE_URL . '/dashboard/admin/');
            exit();
        }else{
            $account = selectOne('accounts', ['id' => $transaction['account_id']]);
            $transaction['status'] = 0;
            $newTrans = create('transactions', $transaction);
            $message = 'You upgraded ' . $_POST['firstname'] . ' plan to ' . $plan['name'];
            $feeds = create('feeds', ['user_id' => $_SESSION['id'], 'message' => $message, 'type' => 'success', 'status' => 1]);
            $message = 'Admin upgraded Your Plan to ' . $old_plan['name'] . ' Please Deposit to activate.';
            $feeds = create('feeds', ['user_id' => $_SESSION['id'], 'message' => $message, 'type' => 'success', 'status' => 0]);
            $template_file = '../../app/lib/upgrade-request.php';
            $logo = BASE_URL . '/assets/open/images/logo.png';
            $swap_var = array(
                "#name#" => $user['firstname'] . ' ' . $user['lastname'],
                "{EMAIL_TITLE}" => 'Plan Upgrade',
                "{TO_EMAIL}" => $user['email'],
                "#logo#" => $logo,
                "#old_trans_id#" => $old_trans_id,
                "#new_trans_id#" => $transaction['trans_id'],
                "#new_amount#" => $plan['min'] - $transaction['amount'],
                "#wallet#" => $account['address'],
                "#old_amount#" => $old_amount,
                "#balance#" => $newBalance,
                "#currency#" => $account['currency'],
                "#old_plan_name#" => $old_plan['name'],
                "#new_plan_name#" => $plan['name'],
                'TOP' => XMAIL['top'],
                'BOTTOM' => XMAIL['bottom']
            );
            mailing($template_file, $swap_var);
            $_SESSION['message'] = 'User: ' . $user['firstname'] . ' has been upgraded successfully';
            $_SESSION['type'] = 'success';
            header('location: ' . BASE_URL . '/dashboard/admin/');
            exit();
        }
    }
}
?>
