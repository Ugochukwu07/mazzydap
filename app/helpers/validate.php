<?php 
function userVal($user){
        $errors = array();
        $error = array();
        $regexemail = "/^[a-zA-Z\d\._]+@[a-zA-Z\d\.]+$/";
        $regexname = "/^[a-zA-Z\s.]{1}+[a-zA-Z\s]+$/";
        $regexpassword = "/^[a-zA-Z\d]+$/";
        $lenght = strlen($user['password']);
        
        #fname
        if(empty($user['firstname'])){
            array_push($error, 'First Name Required');
            $errors['ef'] = "First Name Required";
        }else{
            $errors['ef'] = '';
        }
        if(!empty($user['firstname']) && !preg_match($regexname, $user['firstname'])){
            array_push($error, 'Invalid Charatcers In FirstName');
            $errors['efi'] = 'Invalid Charatcers In FirstName';
        }else{
            $errors['efi'] = '';
        }
    
        #lname
        if(empty($user['lastname'])){
            array_push($error, 'Last Name Required');
            $errors['el'] = 'Last Name Required';
        }else{
            $errors['el'] = '';
        }
        if(!empty($user['lastname']) && !preg_match($regexname, $user['lastname'])){
            array_push($error, 'Invalid Charatcers In LastName');
            $errors['eli'] = 'Invalid Charatcers In LastName';
        }else{
            $errors['eli'] = '';
        }
    
        #email
        if (empty($user['email'])) {
            array_push($error, 'Email Required');
            $errors['eme'] = 'Email Required';
        }else{
            $errors['eme'] = '';
        }
        if (!empty($user['email']) && !preg_match($regexemail, $user['email'])) {
            array_push($error, 'Email:Invalid characters');
            $errors['emei'] = 'Email:Invalid characters';
        }else{
            $errors['emei'] = '';
        }

        #password
        if (empty($user['password'])) {
            array_push($error, 'Password Required');
            $errors['pr'] = 'Password Required';
        }else{
            $errors['pr'] = '';
        }
        if (!empty($user['password']) && !preg_match($regexpassword, $user['password'])) {
            array_push($error, 'Password:Invalid characters');
            $errors['pri'] = 'Password:Invalid characters';
        }else{
            $errors['pri']  = '';
        }
        if ($lenght <= 8 || $lenght >= 16) {
           array_push($error, ucwords('Password Must contain 8 to 16 characters'));
           $errors['psl'] = "Password Must contain 8 to 16 characters";
        }else{
            $errors['psl'] = '';
        }
        
        #cpassword
        if (empty($user['cpassword'])) {
            array_push($error, 'Confirm Passwords is empty');
            $errors['cpse'] = 'Confirm Passwords is empty';
        }else{
            $errors['cpse'] = '';
        }
        if ($user['cpassword'] !== $user['password']) {
            array_push($error, 'Passwords do not match');
            $errors['cps'] = 'Passwords do not match';
        }else{
            $errors['cps'] = '';
        }
    

        #existing
        $existingEmail = selectOne('users', ['email' => $user['email']]);
        if($existingEmail){
                array_push($error, 'Email Already Exists');
                $errors['exe'] = 'Email Already Exists'; 
        }else{
            $errors['exe']= '';
        }

        #username
        if (empty($user['username'])) {
            array_push($error, 'Username Required');
            $errors['unr1'] = 'Username Required';
        }else{
            $errors['unr1'] = '';
        }

        if (!empty($user['username'])) {
            $existingUsername = selectOne('users', ['username' => $user['username']]);
            if ($existingUsername) {
                array_push($error, 'Username Already Exists');
                $errors['unr'] = 'Username Already Exists';
            } else {
                $errors['unr']= '';
            }
        }else{
            $errors['unr'] = '';
    }

        $genErrors = array($errors, $error);
        return $genErrors;
}

function signinVal($user){
    $errors = array();
    $error = array();
    $regexemail = "/^[a-zA-Z\d\._]+@[a-zA-Z\d\.]+$/";
    $regexpassword = "/^[a-zA-Z\d]+$/";
    $lenght = strlen($user['password']);

    #email
    if(empty($user['email'])){
        array_push($error, '11');
        $errors['em'] = 'Email must not be empty.';
    }else{
        $errors['em'] = '';
    }
    if(!empty($user['email']) && !preg_match($regexemail, $user['email'])){
        array_push($error, '12');
        $errors['emm'] = 'Email flied has invalid characters';
    }else{
        $errors['emm'] = '';
    }

    #password
    if (empty($user['password'])) {
        array_push($error, 'Password Required');
        $errors['pr'] = 'Password Required';
    }else{
        $errors['pr'] = '';
    }
    if (!empty($user['password']) && !preg_match($regexpassword, $user['password'])) {
        array_push($error, 'Password:Invalid characters');
        $errors['pri'] = 'Password:Invalid characters';
    }else{
        $errors['pri']  = '';
    }
    if ($lenght <= 8 || $lenght >= 16) {
       array_push($error, ucwords('Password Must contain 8 to 16 characters'));
       $errors['psl'] = "Password Must contain 8 to 16 characters";
    }else{
        $errors['psl'] = '';
    }
    $genErrors = array($errors, $error);
    return $genErrors;
}

function complete($user){
    $error = array();
    $errors = array();
    $regexpassword = "/^[a-zA-Z\d]+$/";
    $lenght = strlen($user['password']);

    #password
    if (!empty($user['password'])) {
        if ($lenght <= 8 || $lenght >= 16) {
        array_push($error, ucwords('Password Must contain 8 to 16 characters'));
        $errors['psl'] = "Password Must contain 8 to 16 characters";
        }else{
            $errors['psl'] = '';
        }
        if(!empty($user['password']) && !preg_match($regexpassword, $user['password'])) {
            array_push($error, 'Password:Invalid characters');
            $errors['pri'] = 'Password:Invalid characters';
        }else{
            $errors['pri']  = '';
        }
    }else{
        $errors['psl'] = '';
        $errors['pri']  = '';
        unset($user['password']);
    }

    #cpassword
    if (!empty($user['password'])) {
        if ($user['cpassword'] !== $user['password']) {
            array_push($error, 'Passwords do not match');
            $errors['cps'] = 'Passwords do not match';
        } else {
            $errors['cps'] = '';
        }
    } else {
        $errors['cps'] = '';
        unset($user['cpassword']);
    }

    #existing
    $existingEmail = count(selectAll('users', ['email' => $user['email']]));
    if($existingEmail > 1){
            array_push($error, 'Email Already Exists');
            $errors['exe'] = 'Email Already Exists'; 
    }else{
        $errors['exe']= '';
    }
    if (!empty($user['username'])) {
        $existingUsername = count(selectALl('users', ['username' => $user['username']]));
        if ($existingUsername > 1) {
            array_push($error, 'Username Already Exists');
            $errors['unr'] = 'Username Already Exists';
        } else {
            $errors['unr']= '';
        }
    }
    $genErrors = array($errors, $error);
    return $genErrors;
}

function accoutVal($account){
    $error = array();
    $errors = array();
    #regex
    $regexname = "/^[a-zA-Z\s.]{1}+[a-zA-Z\s]+$/";
    $regexcurrency = "/^[A-Z]+$/";

    #account/name
    if(empty($account['name'])){
        array_push($error, '11');
        $errors['name'] = 'Name cannot be empty';
    }else{
        $errors['name'] = '';
    }
    if(!empty($account['name']) && !preg_match($regexname, $account['name'])){
        array_push($error, '11');
        $errors['exn'] = 'Invalid characters in account name';
    }else{
        $errors['exn'] = '';
    }

    #address
    if(empty($account['address'])){
        array_push($error, '22');
        $errors['address'] = 'Address must not left empty';
    }

    #account/name
    if(empty($account['currency'])){
        array_push($error, '11');
        $errors['currency'] = 'Cannot be empty';
    }else{
        $errors['currency'] = '';
    }
    if(!empty($account['currency']) && !preg_match($regexcurrency, $account['currency'])){
        array_push($error, '11');
        $errors['currencyMatch'] = 'Invalid characters';
    }else{
        $errors['currencyMatch'] = '';
    }


    #existing
    $existingName = selectAll('accounts', ['name'=> $account['name']]);
    if(isset($account['updateAccount'])){
        if($existingName){
            if($existingName[0]['name']=== $account['name']){
                $errors['exn'] = '';
            }else{
                array_push($error, '11');
                $errors['exn'] = 'Account name already existing.';
            }
        }else{
            $errors['exn'] = '';
        }
    }elseif($existingName){
        array_push($error, '11');
        $errors['exn'] = 'Account name already existing.';
    }else{
        $errors['exn'] = '';
    }
    
    $genErrors = array($errors, $error);
    return $genErrors;
}

function planVal($plan){
    $error = array();
    $errors = array();
    $regexname = "/^[a-zA-Z\s.]{1}+[a-zA-Z\s]+$/";

    #name
    if(empty($plan['name'])){
        array_push($error, '11');
        $errors['name'] = 'Title cannot be empty';
    }else{
        $errors['name'] = '';
    }

    #dailyPercent
    if (empty($plan['dailyPercent'])) {
        array_push($error, 'll');
        $errors['dailyPercent'] = 'Cannot be empty';
    }else{
        $errors['dailyPercent'] = '';
    }

    #ROI
    if (empty($plan['ROI'])) {
        array_push($error, 'll');
        $errors['ROI'] = 'Cannot be empty';
    }else{
        $errors['ROI'] = '';
    }

    #min
    if (empty($plan['min'])) {
        array_push($error, 'll');
        $errors['min'] = 'Cannot be empty';
    }else{
        $errors['min'] = '';
    }

    #max
    if (empty($plan['max'])) {
        array_push($error, 'll');
        $errors['max'] = 'Cannot be empty';
    }else{
        $errors['max'] = '';
    }

    if(!empty($plan['name']) && !preg_match($regexname, $plan['name'])){
        array_push($error, '11');
        $errors['namei'] = 'Invalid characters in plan name';
    }else{
        $errors['namei'] = '';
    }

    $genErrors = array($errors, $error);
    return $genErrors;
}
function updatePlanVal($plan){
    $error = array();
    $errors = array();
    $regexname = "/^[a-zA-Z\s.]{1}+[a-zA-Z\s]+$/";

    #titlep
    if(empty($plan['titlep'])){
        array_push($error, '11');
        $errors['titlep'] = 'Title cannot be empty';
    }else{
        $errors['titlep'] = '';
    }

    #dailyPercent
    if (empty($plan['dailyPercent'])) {
        array_push($error, 'll');
        $errors['dailyPercent'] = 'Cannot be empty';
    }else{
        $errors['dailyPercent'] = '';
    }

    #ROI
    if (empty($plan['ROI'])) {
        array_push($error, 'll');
        $errors['ROI'] = 'Cannot be empty';
    }else{
        $errors['ROI'] = '';
    }

    #min
    if (empty($plan['min'])) {
        array_push($error, 'll');
        $errors['min'] = 'Cannot be empty';
    }else{
        $errors['min'] = '';
    }

    #max
    if (empty($plan['max'])) {
        array_push($error, 'll');
        $errors['max'] = 'Cannot be empty';
    }else{
        $errors['max'] = '';
    }

    if(!empty($plan['titlep']) && !preg_match($regexname, $plan['titlep'])){
        array_push($error, '11');
        $errors['titlei'] = 'Invalid characters in plan name';
    }else{
        $errors['titlei'] = '';
    }

    $genErrors = array($errors, $error);
    return $genErrors;
}

function depositVal($data){
    $error = array();
    $errors = array();

    #plans
    if(empty($data['plan_id'])){
        array_push($error, 'kk');
        $errors['plan_id'] = 'Choose a plan';
    }else{
        $errors['plan_id'] = '';
    }

    #amount
    if(empty($data['amount'])) {
        array_push($error, 'kk');
        $errors['amount'] = 'Input an Amount';
    }else{
        $errors['amount'] = '';
    }

    #account
    if(empty($data['account_id'])){
        array_push($error, 'll');
        $errors['account'] = 'Select a deposit currency';
    }else{
        $errors['account'] = '';
    }
    if (!empty($data['plan_id'])) {
        $plan_detail = selectOne('plans', ['id' => $data['plan_id']]);
        if (!empty($data['amount'])) {
            if ($data['amount'] < $plan_detail['min'] || $data['amount'] > $plan_detail['max']) {
                array_push($error, 'k');
                $errors['enough'] = 'Min. Amount:' . $plan_detail['min'] . ' and max:' . $plan_detail['max'] . '.';
            }
        }
    }else{
        $errors['enough'] = '';
    }
    $genErrors = array($errors, $error);
    return $genErrors;
}

function withdrawVal($data){
    $error = array();
    $errors = array();

    #currency
    if(empty($data['currency'])){
        array_push($error, 'hh');
        $errors['currency'] = 'Must select a currency';
    }else{
        $errors['currency'] = '';
    }

    #amount
    if (empty($data['amount'])) {
        array_push($error, 'jj');
        $errors['amount'] = 'Must not be left empty';
    }else{
        $errors['amount'] = '';
    }

    #account
    if(empty($data['account'])){
        array_push($error, 'lll');
        $errors['account'] = 'Must select an account';
    }else{
        $errors['account'] = '';
    }
    $genErrors = array($errors, $error);
    return $genErrors;
}

function contactVal($message){
    $error = array();
    $errors= array();

    #subject
    if(empty($message['subject'])){
        array_push($error, 'll');
        $errors['subject'] = 'Cannot be left empty';
    }else{
        $errors['subject'] = '';
    }

    #email
    if(empty($message['email'])){
        array_push($error, 'll');
        $errors['email'] = 'Cannot be left empty';
    }else{
        $errors['email'] = '';
    }

    #message
    if(empty($message['message'])){
        array_push($error, 'll');
        $errors['message'] = 'Cannot be left empty';
    }else{
        $errors['message'] = '';
    }

    #phone
    if(empty($message['phone'])){
        array_push($error, 'll');
        $errors['phone'] = 'Cannot be left empty';
    }else{
        $errors['phone'] = '';
    }

    #firstname
    if(empty($message['firstname'])){
        array_push($error, 'll');
        $errors['firstname'] = 'Cannot be left empty';
    }else{
        $errors['firstname'] = '';
    }

    #lastname
    if(empty($message['lastname'])){
        array_push($error, 'll');
        $errors['lastname'] = 'Cannot be left empty';
    }else{
        $errors['lastname'] = '';
    }
    
    $genErrors = array($errors, $error);
    return $genErrors;
}

function categoryVal($category){
    $error = array();
    $errors = array();

    $regexname = "/^[a-zA-Z\s.]{1}+[a-zA-Z\s]+$/";

    #title
    if(empty($category['title'])){
        array_push($error, 'jj');
        $errors['title'] = 'can not be empty';
    }else{
        $errors['title'] = '';
    }

    #about
    if(empty($category['about'])){
        array_push($error, 'jj');
        $errors['about'] = 'can not be empty';
    }else{
        $errors['about'] = '';
    }

    #exisiting
    $existingCategory = selectOne('category', ['title' => $category['title']]);

    if($existingCategory){
        if (isset($category['updateCategory']) && $existingCategory['id'] != $category['id']) {
            array_push($errors, 'category Name Already Exists');
            $errors['extitle'] = 'Category Name Already Exists';
        }else{
            $errors['extitle'] = '';
        }
        if (isset($category['addCategory'])) {
            array_push($errors, 'category Name Already Exists');
        }else{
            $errors['extitle'] = '';
        }     
    }else{
        $errors['extitle'] = '';
    }
    
    $genErrors = array($errors, $error);
    return $genErrors;
}

function postVal($post) {
    $errors  = array();
    $error  = array();

    if (empty($post['title'])) {
        array_push($error, 'Title Required');
        $errors['title'] = 'Title Required';
    }else{
        $errors['title'] = '';
    }
    if (empty($post['body'])) {
        array_push($error, 'Body of Post Required');
        $errors['body'] = 'Body of Post Required';
    }else{
        $errors['body'] = '';
    }

    if (empty($post['cat_id'])) {
        array_push($error, 'Please Select A Topic');
        $errors['cat_id'] = 'Please Select A Topic';
    }else{
        $errors['cat_id'] = '';
    }
    
    $existingPost = selectOne('posts', ['title' => $post['title']]);

    if($existingPost){
        if (isset($post['updatePost']) && $existingPost['id'] != $post['id']) {
            array_push($error, 'Post Title Already Exists');
            $errors['expost'] = 'Post Title Already Exists';
        }else{
            $errors['expost'] = '';
        }
        if (isset($post['addPost'])) {
            array_push($errors, 'Post Title Already Exists');
            $errors['expost'] = 'Post Title Already Exists';
        }else{
            $errors['expost'] = '';
        }      
    }else{
        $errors['expost'] = '';
    }
    $genErrors = array($errors, $error);
    return $genErrors;
}

function credentialsVal($data){
    $errors = $error = array();

    #mode
    if(empty($data['mode'])){
        array_push($error, 'kk');
        $errors['mode'] = 'Choose a Mode of Verification';
    }else{
        $errors['mode'] = '';
    }

    #fullname
    if(empty($data['fullName'])){
        $errors['fullName'] = 'Can not be left empty';
        array_push($error, 'll');
    }else{
        $errors['fullName'] = '';
    }

    #dob
    if(empty($data['dob'])){
        $errors['dob'] = 'Can not be left empty';
        array_push($error, 'll');
    }else{
        $errors['dob'] = '';
    }

    #address
    if(empty($data['address'])){
        $errors['address'] = 'Can not be left empty';
        array_push($error, 'll');
    }else{
        $errors['address'] = '';
    }

    #city
    if(empty($data['city'])){
        $errors['city'] = 'Can not be left empty';
        array_push($error, 'll');
    }else{
        $errors['city'] = '';
    }

    #state
    if(empty($data['state'])){
        $errors['state'] = 'Can not be left empty';
        array_push($error, 'll');
    }else{
        $errors['state'] = '';
    }

    #country
    if(empty($data['country'])){
        $errors['country'] = 'Can not be left empty';
        array_push($error, 'll');
    }else{
        $errors['country'] = '';
    }

    #occupation
    if(empty($data['occupation'])){
        $errors['occupation'] = 'Can not be left empty';
        array_push($error, 'll');
    }else{
        $errors['occupation'] = '';
    }

    #expiringDate
    if(empty($data['expiringDate'])){
        $errors['expiringDate'] = 'Can not be left empty';
        array_push($error, 'll');
    }else{
        $errors['expiringDate'] = '';
    }

    $genErrors = array($errors, $error);
    return $genErrors;
}

function portVal($data){
    $errors = $error = array();

    #title
    if(empty($data['title'])){
        $errors['title'] = 'Can not be left empty';
        array_push($error, 'll');
    }else{
        $errors['title'] = '';
    }

    #subTitle
    if(empty($data['subTitle'])){
        $errors['subTitle'] = 'Can not be left empty';
        array_push($error, 'll');
    }else{
        $errors['subTitle'] = '';
    }

    #description
    if(empty($data['description'])){
        $errors['description'] = 'Can not be left empty';
        array_push($error, 'll');
    }else{
        $errors['description'] = '';
    }
    
    $genErrors = array($errors, $error);
    return $genErrors;
}

function confirmVal($data){
    $errors = $error = array();

    #user_address
    if(empty($data['user_address'])){
        array_push($error, 'll');
        $errors['user_address'] = 'Can not be empty';
    }else{
        $errors['user_address'] = '';
    }

    #trans_hash
    if(empty($data['trans_hash'])){
        array_push($error, 'll');
        $errors['trans_hash'] = 'Can not be empty';
    }else{
        $errors['trans_hash'] = '';
    }
    
    $genErrors = array($errors, $error);
    return $genErrors;
}

function careerVal($career){
    $errors = $error = array();

    #title
    if(empty($career['title'])){
        array_push($error, 'll');
        $errors['title'] = 'Cannot be left empty';
    }else{
        $errors['title'] = '';
    }

    #subTitle
    if(empty($career['subTitle'])){
        array_push($error, 'll');
        $errors['subTitle'] = 'Cannot be left empty';
    }else{
        $errors['subTitle'] = '';
    }

    #description
    if(empty($career['description'])){
        array_push($error, 'll');
        $errors['description'] = 'Cannot be left empty';
    }else{
        $errors['description'] = '';
    }
    
    $genErrors = array($errors, $error);
    return $genErrors;
}

function personVal($person){
    $errors = $error = array();

    #fullName
    if(empty($person['fullName'])){
        array_push($error, 'll');
        $errors['fullName'] = 'Cannot be left empty';
    }else{
        $errors['fullName'] = '';
    }

    #subTitle
    if(empty($person['subTitle'])){
        array_push($error, 'll');
        $errors['subTitle'] = 'Cannot be left empty';
    }else{
        $errors['subTitle'] = '';
    }

    #car_id
    if(empty($person['car_id'])){
        array_push($error, 'll');
        $errors['car_id'] = 'Cannot be left empty';
    }else{
        $errors['car_id'] = '';
    }
    
    #about
    if(empty($person['about'])){
        array_push($error, 'll');
        $errors['about'] = 'Cannot be left empty';
    }else{
        $errors['about'] = '';
    }
    
    $genErrors = array($errors, $error);
    return $genErrors;
}


function passVal($user){
    $errors = array();
    $error = array();
    $regexpassword = "/^[a-zA-Z\d]+$/";
    $lenght = strlen($user['password']);

    #password
    if (empty($user['password'])) {
        array_push($error, 'Password Required');
        $errors['pr'] = 'Password Required';
    }else{
        $errors['pr'] = '';
    }
    if (!empty($user['password']) && !preg_match($regexpassword, $user['password'])) {
        array_push($error, 'Password:Invalid characters');
        $errors['pri'] = 'Password:Invalid characters';
    }else{
        $errors['pri']  = '';
    }
    if ($lenght <= 8 || $lenght >= 16) {
       array_push($error, ucwords('Password Must contain 8 to 16 characters'));
       $errors['psl'] = "Password Must contain 8 to 16 characters";
    }else{
        $errors['psl'] = '';
    }

    #cpassword
    if (empty($user['cpassword'])) {
        array_push($error, 'Passwords do not match');
        $errors['cpse'] = 'Passwords do not match';
    }else{
        $errors['cpse'] = '';
    }
    if ($user['cpassword'] !== $user['password']) {
        array_push($error, 'Passwords do not match');
        $errors['cps'] = 'Passwords do not match';
    }else{
        $errors['cps'] = '';
    }

    $genErrors = array($errors, $error);
    return $genErrors;
}


?>