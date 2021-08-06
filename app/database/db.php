<?php 
require('connect.php');

function executeQurey($sql, $data) {
global $conn;

    $stmt = $conn->prepare($sql);
    $value = array_values($data);
    $type = str_repeat('s', count($value));
    $stmt->bind_param($type, ...$value);
    $stmt->execute();
    return $stmt;
}

function selectAll($table, $conditions = []) {
    global $conn;

    $sql = "SELECT * FROM $table ";

    if (empty($conditions)) {
        $sql =  $sql . " ORDER BY created_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }   
    else {
        $i = 0;
        foreach ($conditions as $key=>$value)
        {
            if ($i === 0) {
                $sql = $sql . " WHERE $key=?";
            } else {
                $sql = $sql . " AND $key=?"; 
            }
            $i++;
        }
    }
    $sql =  $sql . " ORDER BY created_at DESC";
    $stmt = executeQurey($sql, $conditions);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function selectAllLimits($table, $conditions = [], $start, $rpp) {
    global $conn;

    $sql = "SELECT * FROM $table ";

    if (empty($conditions)) {
        $sql =  $sql . " ORDER BY created_at DESC LIMIT $start, $rpp";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }   
    else {
        $i = 0;
        foreach ($conditions as $key=>$value)
        {
            if ($i === 0) {
                $sql = $sql . " WHERE $key=?";
            } else {
                $sql = $sql . " AND $key=?"; 
            }
            $i++;
        }
    }
    $sql =  $sql . " ORDER BY created_at DESC LIMIT $start, $rpp";
    $stmt = executeQurey($sql, $conditions);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function selectOne($table, $conditions) {
    global $conn;
    
    $sql = "SELECT * FROM $table";

        $i = 0;
        foreach ($conditions as $key=>$value)
        {
        if ($i === 0) {
            $sql = $sql . " WHERE $key=?";
        } else {
            $sql = $sql . " AND $key=?";
        }
        $i++;
    }
    $sql = $sql . " LIMIT 1";
    $stmt = executeQurey($sql, $conditions);
    $records = $stmt->get_result()->fetch_assoc();
    return $records;
    
}

function create($table, $data) {
    global $conn;

    $sql = "INSERT INTO $table SET ";
    $i = 0;
    foreach ($data as $key=>$value)
        {
        if ($i === 0) {
            $sql = $sql . "$key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;   
    }
    $stmt = executeQurey($sql, $data);
    $id = $stmt->insert_id;
    return $id;
}

function update($table, $id, $data) {
    global $conn;

    $sql = "UPDATE $table SET ";
    $i = 0;
    foreach ($data as $key=>$value)
        {
        if ($i === 0) {
            $sql = $sql . "$key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;   
    }
    $sql = $sql . " WHERE id=?";
    $data['id'] = $id;
    $stmt = executeQurey($sql, $data);
    $id = $stmt->insert_id;
    return $id;
}

function delete($table, $id) {
    global $conn;

    $sql = "DELETE FROM $table WHERE id=?";
    
    $stmt = executeQurey($sql, ['id' => $id]);
    return $stmt->affected_rows;
}

function sum($table, $column, $conditions = []){
    global $conn;

    $sql = "SELECT SUM($column) FROM $table as total";
    if (empty($conditions)){
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = mysqli_fetch_assoc($stmt);
        return $result;
    }else{
        $i = 0;
        foreach ($conditions as $key=>$value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key=?";
            } else {
                $sql = $sql . " AND $key=?";
            }
            $i++;
        }
    }
    $stmt = executeQurey($sql, $conditions);
    $result = $stmt->get_result()->fetch_assoc();
    return $result;
}

function avg($table, $column, $conditions = []){
    global $conn;

    $sql = "SELECT AVG($column) as amount FROM $table";
    if (empty($conditions)){
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }else{
        $i = 0;
        foreach ($conditions as $key=>$value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key=?";
            } else {
                $sql = $sql . " AND $key=?";
            }
            $i++;
        }
    }
    $stmt = executeQurey($sql, $conditions);
    $result = $stmt->get_result()->fetch_assoc();
    return $result;
}


function getPublishedpostpage($s, $rpp) {
    global $conn;

    $sql = "SELECT p.*, u.username FROM post AS p JOIN user AS u ON p.user_id=u.id WHERE p.published=? ORDER BY p.id DESC LIMIT $s, $rpp";

    $stmt = executeQurey($sql, ['published' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}
function getPublishedpost() {
    global $conn;

    $sql = "SELECT p.*, u.username FROM post AS p JOIN user AS u ON p.user_id=u.id WHERE p.published=?";

    $stmt = executeQurey($sql, ['published' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getPublishedpostAll() {
    global $conn;

    $sql = "SELECT p.*, u.username FROM post AS p JOIN user AS u ON p.user_id=u.id WHERE p.published<? ORDER BY p.id DESC";

    $stmt = executeQurey($sql, ['published' => 2]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}
function getPublishedpostAllLimts($s, $rpp) {
    global $conn;

    $sql = "SELECT p.*, u.username FROM post AS p JOIN user AS u ON p.user_id=u.id WHERE p.published<? ORDER BY p.id DESC LIMIT $s, $rpp";

    $stmt = executeQurey($sql, ['published' => 2]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getPOstByIdLimts($s, $rpp, $topic_id) {
    global $conn;

    $sql = "SELECT p.*, u.username FROM post AS p JOIN user AS u ON p.user_id=u.id WHERE p.published=? AND topic_id=? ORDER BY p.id DESC LIMIT $s, $rpp";

    $stmt = executeQurey($sql, ['published' => 1, 'topic_id' => $topic_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getPOstById($topic_id) {
    global $conn;

    $sql = "SELECT p.*, u.username FROM post AS p JOIN user AS u ON p.user_id=u.id WHERE p.published=? AND topic_id=?";

    $stmt = executeQurey($sql, ['published' => 1, 'topic_id' => $topic_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function search($term) {
    global $conn;

    $match = '%' . $term . '%';
    $sql = "SELECT p.*, u.username FROM post AS p JOIN user AS u 
            ON p.user_id=u.id WHERE p.published=?
            AND p.title LIKE ? OR p.body LIKE ?";

    $stmt = executeQurey($sql, ['published' => 1, 'title' => $match, 'body' => $match]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}
function searchLimts($term, $s, $rpp) {
    global $conn;

    $match = '%' . $term . '%';
    $sql = "SELECT p.*, u.username FROM post AS p JOIN user AS u 
            ON p.user_id=u.id WHERE p.published=?
            AND p.title LIKE ? OR p.body LIKE ? ORDER BY p.id DESC LIMIT $s, $rpp";

    $stmt = executeQurey($sql, ['published' => 1, 'title' => $match, 'body' => $match]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
    return $records;
}


if(isset($_SESSION['id'])){
    $xUser = selectOne('users', ['id' => $_SESSION['id']]);
}

?>