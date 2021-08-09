<?php 
include(ROOT_PATH . '/app/database/db.php');
include(ROOT_PATH . '/app/helpers/mailer.php');
include(ROOT_PATH . '/app/helpers/middleware.php');
include(ROOT_PATH . '/app/helpers/paging.php');
include(ROOT_PATH . '/app/helpers/validate.php');

$error = array();
$errors = array();

#error variables
$errors['subject'] = $errors['firstname'] = $errors['lastname'] = $errors['phone'] = $errors['email'] = $errors['message'] = '';
$subject = $firstname = $lastname = $phone = $email = $message = $body = $errors['body'] = '';
$errors['subject_match'] = '';

#tables
$table = 'contact';
$table2 = 'mail';

$mails = selectAll($table2);

#User contact
if(isset($_POST['contact-user'])){
    usersOnly();
    $genErrors = contactVal($_POST);
    $errors = $genErrors[0];
    $subMainError = $genErrors[1];
    if(count($subMainError) === 0){
        unset($_POST['contact-user']);
        $_POST['user'] = $_SESSION['id'];
        $_POST['ref_id'] = generateRandomString($user_key, 11);
        $contact_id = create($table, $_POST);
        $feeds = create('feeds', ['user_id' => $_SESSION['id'], 'message' => 'You contacted an admin', 'type' => 'primary', 'status' => 0]);
        
        $template_file = '../../app/lib/user_contact.php';
        $logo = BASE_URL . '/assets/open/images/logo.png';
        $swap_var = array(
            "#name#" => $_POST['firstname'] . ' ' . $_POST['lastname'],
            "{EMAIL_TITLE}" => "User " . $_POST['firstname'] . " Contacted",
            "{TO_EMAIL}" => $_POST['email'],
            "#logo#" => $logo,
            "#message#" => $_POST['message'],
            'TOP' => XMAIL['top'],
            'BOTTOM' => XMAIL['bottom']
        );
        mailing($template_file, $swap_var);
        $swap_var = array(
            "{TO_EMAIL}" => 'support@karken.live',
        );
        mailing($template_file, $swap_var);
        $_SESSION['message'] = 'Admin Contacted successfully';
        $_SESSION['type'] = 'primary';
        header('location:' . BASE_URL . '/dashboard/user/');
        exit();
    }else{
        $subject = $_POST['subject']; 
        $message = $_POST['message'];
    }
}

#admin Reply
if(isset($_POST['re-contact'])){
    adminOnly();
    $message = array('reply' => htmlentities($_POST['message']), 'reid' => $_SESSION['id'], 'status' => '1');
    $message1 = update($table, $_POST['id'], $message);
        $template_file = '../../../app/lib/reply.php';
        $logo = BASE_URL . '/assets/open/images/logo.png';
        $swap_var = array(
            "#name#" => $_POST['firstname'] . ' ' . $_POST['lastname'],
            "{EMAIL_TITLE}" => "RE: " . $_POST['firstname'] . " on " . $_POST['subject'],
            "{TO_EMAIL}" => $_POST['email'],
            "#logo#" => $logo,
            "#message#" => $_POST['message'],
            'TOP' => XMAIL['top'],
            'BOTTOM' => XMAIL['bottom']
        );
        mailing($template_file, $swap_var);
        $_SESSION['message'] = 'User Contacted successfully';
        $_SESSION['type'] = 'primary';
        header('location:' . BASE_URL . '/dashboard/contact/');
        exit();
}

#submit
if(isset($_POST['form-submit'])){
    $_POST['token'] = generateRandomString($token, 5);
    unset($_POST['form-submit']);
    $message = create($table, $_POST);
    $template_file = 'app/lib/openContact.php';
    $swap_var = array(
        "#fullName#" => $_POST['fullName'],
        "{EMAIL_TITLE}" => "Ticket From Mazzy Dap",
        "{TO_EMAIL}" => $_POST['email'],
        "#email#" => $_POST['email'],
        "#message#" => $_POST['message'],
        "#requirements#" => $_POST['requirements'],
        "#token#" => $_POST['token'],
        "#phone#" => $_POST['phone'],
        "#BASE_URL#" => BASE_URL,
        'TOP' => XMAIL['top'],
        'BOTTOM' => XMAIL['bottom']
    );
    mailing($template_file, $swap_var);
    $swap_var["{TO_EMAIL}"] = MCC;
    mailing($template_file, $swap_var);
    $_SESSION['message'] = 'Admin Contacted Successfully! Your Reference ID: <code>' . $_POST['token'] . '</code>';
    $_SESSION['type'] = 'success';
}

if(isset($_POST['adminContactU'])){
    adminOnly();
    $template_file = '../../../app/lib/reply.php';
    $logo = BASE_URL . '/assets/open/images/logo.png';
    $swap_var = array(
        "{EMAIL_TITLE}" => $_POST['subject'],
        "#name#" => $_POST['firstname'] . ' ' . $_POST['lastname'],
        "{TO_EMAIL}" => $_POST['email'],
        "#logo#" => $logo,
        "#message#" => $_POST['message'],
        'TOP' => XMAIL['top'],
        'BOTTOM' => XMAIL['bottom']
    );
    mailing($template_file, $swap_var);
    $_SESSION['message'] = 'User Contacted successfully';
    $_SESSION['type'] = 'primary';
    header('location:' . BASE_URL . '/dashboard/user/');
    exit();
}

/* 8888888888888888888888888888888888888888888888888888888888888888888888888888888888888 */

#addTemp
if(isset($_POST['addTemp'])){
    adminOnly();
    $genErrors = tempVal($_POST);
    $errors = $genErrors[0];
    $subMainError = $genErrors[1];
    if(count($subMainError) === 0){
        unset($_POST['addTemp']);
        $XMAIL['top'] = str_replace("' . LOGO . '", LOGO, XMAIL['top']);
        $body = $XMAIL['top'] . $_POST['body'] . XMAIL['bottom'];
        $_POST['body'] = htmlentities($body);
        $_POST['user_id'] = $_SESSION['id'];
        $mail = create($table2, $_POST);
        $_POST['subject'] = str_replace(' ', '', $_POST['subject']);
        $filename = $_POST['subject'] . '.php';
        $myfile = fopen($filename, "w") or die("Unable to open file!");
        $content = $_POST['body'];
        fwrite($myfile, $content);
        fclose($myfile);
        $message = 'Admin ' . $xUser['firstname'] . ' ' . $xUser['lastname'] . ' created a template';
        //$feeds = create('feeds', ['user_id' => $_SESSION['id'], 'type' => 'primary', 'status' => 1, 'message' => $message]);
        setMsg($message, 'primary', '/dashboard/email/');
    }else{
        $subject = $_POST['subject'];
        $body = $_POST['body'];
    }
}

#updateTemp
if(isset($_POST['updateTemp'])){
    adminOnly();
    $genErrors = tempVal($_POST);
    $errors = $genErrors[0];
    $subMainError = $genErrors[1];
    if(count($subMainError) === 0){
        $id = $_POST['id'];
        unset($_POST['updateTemp'], $_POST['id']);
        $XMAIL['top'] = str_replace("' . LOGO . '", LOGO, XMAIL['top']);
        $body = $XMAIL['top'] . $_POST['body'] . XMAIL['bottom'];
        $_POST['body'] = $body;
        $_POST['user_id'] = $_SESSION['id'];
        $mail = update($table2, $id, $_POST);
        $_POST['subject'] = str_replace(' ', '', $_POST['subject']);
        $filename = $_POST['subject'] . '.php';
        $myfile = fopen($filename, "w") or die("Unable to open file!");
        $content = $_POST['body'];
        fwrite($myfile, $content);
        fclose($myfile);
        $message = 'Admin ' . $xUser['firstname'] . ' ' . $xUser['lastname'] . ' updated a template';
        //$feeds = create('feeds', ['user_id' => $_SESSION['id'], 'type' => 'primary', 'status' => 1, 'message' => $message]);
        setMsg($message, 'info', '/dashboard/email/');
    }else{
        $subject = $_POST['subject'];
        $body = $_POST['body'];
    }
}

#privateSend
if(isset($_POST['privateSend'])){
    if($_POST['email'] == 0){
        $_SESSION['message'] = 'Please Select an Email';
        $_SESSION['type'] = 'danger';
        header('location: ' . BASE_URL . '/dashboard/email/private.php?id=' . $_POST['id']);
        exit();
    }else{
        $mail = selectOne($table2, ['id' => $_POST['id']]);
        $user = selectOne('users', ['id' => $_POST['email']]);
        $filename = str_replace(' ', '', $mail['subject']);
        $template_file = $filename . '.php';
        $email_from = $user['email'];
        foreach($user as $key => $value){
        $swap_var['{' . $key . '}'] = $value;}
        $swap_vars = array(
            "{TITLE}" => $mail['subject'],
            "{EMAIL_TITLE}" => $mail['subject'],
            "{TO_NAME}" => $user['firstname'] . ' ' . $user['lastname'], 
            "{TO_EMAIL}" => $email_from
        );
        foreach($swap_vars as $key => $value){
            $swap_var[$key] = $value;}
        mailing($template_file, $swap_var);
        setMsg('User : ' . $user['firstname'] . ' ' . $user['lastname'] . ' Mail sent Successfully', 'success', '/dashboard/email/');
    }
}

#send to all
if(isset($_GET['all_id'])){
    $mail_id = $_GET['all_id'];
    $mail = selectOne($table2, ['id' => $mail_id]);
    $users = selectAll('users', ['status' => 1]);
    $filename = str_replace(' ', '', $mail['subject']);
    $template_file = $filename . '.php';
    foreach($users as $user){
        foreach($user as $key => $value){
            $swap_var['{' . $key . '}'] = $value;
        }
        $swap_vars = array(
            "{TITLE}" => $mail['subject'],
            "{EMAIL_TITLE}" => $mail['subject'],
            "{TO_NAME}" => $user['firstname'] . ' ' . $user['lastname'], 
            "{TO_EMAIL}" => $user['email']
        );
        foreach($swap_vars as $key => $value){
            $swap_var[$key] = $value;
        }
        mailing($template_file, $swap_var);
    }
    setMsg('Mail sent to all users Successfully', 'success', '/dashboard/email/');
}

#delete template
if(isset($_GET['del_id'])){
    $id = $_GET['del_id'];
    $mail = selectOne($table2, ['id' => $id]);
    $filename = str_replace(' ', '', $mail['subject']) . '.php';
    delete($table2, $id);
    unlink($filename);
    $_SESSION['message'] = 'Mail Template deleted Successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/dashboard/email/');
    exit();
}