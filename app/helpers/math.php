<?php 

#percentage users to admins
function percentUsers($users, $admins, $return){
    $totalUsers = $users + $admins ;
    if($return === 'admin'){
        $usersper = $admins / $totalUsers;
        $usersper *= 100;
        return $usersper;
    }else{
        $usersper = $users / $totalUsers;
        $usersper *= 100;
        return $usersper;
    }
}

function timeDiff($date1, $date2){
    $date1 = date_create($date1); $date2 = date_create($date2);
    $diff = date_diff($date1, $date2);
    $time = '';
    if($diff->y > 0){$time .= $diff->y . ' years, ';}
    if($diff->m > 0){$time .= $diff->m . ' months, ';}
    if($diff->d > 0){$time .= $diff->d . ' days, ';}
    if($diff->h > 0){$time .= $diff->h . ' hours, ';}
    if($diff->i > 0){$time .= $diff->i . ' mins, ';}
    if($diff->s > 0){$time .= $diff->s . ' sec, ';}
    
    $newTime = str_split($time); array_pop($newTime); array_pop($newTime);
    $time = implode($newTime, '');
    return $time;
}









?>