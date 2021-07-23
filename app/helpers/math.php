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









?>