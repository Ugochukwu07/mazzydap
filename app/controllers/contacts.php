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
$subject = $firstname = $lastname = $phone = $email = $message = '';

#tables
$table = 'contact';

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
        header('location:' . BASE_URL . '/dashboard/admin/contact/');
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






?>