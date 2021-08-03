<?php 


function upload($destination, $fileType, $fileName){
    $ierror = $ierrors = array();
    //check if the file filed is filled
    if (!empty($_FILES[$fileName]['name'])) {
        $image_name = time() . '_' . $_FILES[$fileName]['name'];
        $destination = ROOT_PATH . $destination . $image_name;
        $imageFileType = strtolower(pathinfo($destination, PATHINFO_EXTENSION));
        //check is its a valid file format
        $typeAlert = 0;
        foreach($fileType as $type => $value){
            // Allow certain file formats
            if($imageFileType != $value) {
                $typeAlert += 0;
            }else{
                $typeAlert += 1;
            }
        }
        //if yes
        if($typeAlert){
            //begin upload
            $result = move_uploaded_file($_FILES[$fileName]['tmp_name'], $destination);
            //check if upload is true
            if ($result) {
                $_POST[$fileName] = $image_name;
                $ierrors['failed'] = '';
            } else {
                array_push($ierror, 'Failed To Upload File');
                $ierrors['failed'] = 'Failed To Upload ' . $_FILES[$fileName]['name'];
            }
            $ierrors['empty'] = '';
            $ierrors['type'] = '';
        }else{
            //compile ierror message
            $x = 0;
            $tpyee = '';
            foreach($fileType as $type => $value){
                if ($x === 0) {
                    $tpyee = $type + 1;
                    $tpyee .= ') ' . $value;
                }else{
                    $tpyee .= ', '; $tpyee .= $type + 1;
                    $tpyee .= ') ' . $value;
                }
                $x++;
            }
            array_push($ierror, 'Xfile');
            $ierrors['type'] = 'Only ' . $tpyee . ' is allowed.';
            $ierrors['empty'] = '';
            $ierrors['failed'] = '';
        }
        
    }else{
        //array_push($ierror, 'File Required');
        $ierrors['empty'] = 'File Required';
        $ierrors['failed'] = '';
        $ierrors['type'] = '';\
        array_push($ierror, 'Xfile');
    }
    $gen = array($ierror, $ierrors);
    return $gen;
}

function updateFile($destination, $fileType, $FileName){
    $ierror = $ierrors = array();
    //check if the file filed is filled
    if (!empty($_FILES[$fileName]['name'])) {
        $image_name = time() . '_' . $_FILES[$fileName]['name'];
        $destination = ROOT_PATH . $destination . $image_name;
        $imageFileType = strtolower(pathinfo($destination, PATHINFO_EXTENSION));
        //check is its a valid file format
        $typeAlert = 0;
        foreach($fileType as $type => $value){
            // Allow certain file formats
            if($imageFileType != $value) {
                $typeAlert += 0;
            }else{
                $typeAlert += 1;
            }
        }
        //if yes
        if($typeAlert){
            //begin upload
            $result = move_uploaded_file($_FILES[$fileName]['tmp_name'], $destination);
            //check if upload is true
            if ($result) {
                $_POST[$fileName] = $image_name;
                $ierrors['failed'] = '';
            } else {
                array_push($ierror, 'Failed To Upload File');
                $ierrors['failed'] = 'Failed To Upload ' . $_FILES[$fileName]['name'];
            }
            $ierrors['empty'] = '';
            $ierrors['type'] = '';
        }else{
            //compile ierror message
            $x = 0;
            $tpyee = '';
            foreach($fileType as $type => $value){
                if ($x === 0) {
                    $tpyee = $type + 1;
                    $tpyee .= ') ' . $value;
                }else{
                    $tpyee .= ', '; $tpyee .= $type + 1;
                    $tpyee .= ') ' . $value;
                }
                $x++;
            }
            array_push($ierror, 'Xfile');
            $ierrors['type'] = 'Only ' . $tpyee . ' is allowed.';
            $ierrors['empty'] = '';
            $ierrors['failed'] = '';
        }
        
    }else{
        array_push($ierror, 'File Required');
        $ierrors['empty'] = 'File Required';
        $ierrors['failed'] = '';
        $ierrors['type'] = '';
    }
    $gen = array($ierror, $ierrors);
    return $gen;
}


?>