<?php

echo '{"page":1,"total":12,"rows":[{"id":1,"cell":{"employeeID":1,"name":"Tony","primary_language":"english","favorite_color":"green","favorite_pet":"hamster"}},{"id":2,"cell":{"employeeID":2,"name":"Mary","primary_language":"spanish","favorite_color":"red","favorite_pet":"groundhog"}},{"id":3,"cell":{"employeeID":3,"name":"Seth","primary_language":"french","favorite_color":"silver","favorite_pet":"snake"}},{"id":5,"cell":{"employeeID":5,"name":"Mark","primary_language":"php","favorite_color":"Tan","favorite_pet":"Dog"}},{"id":7,"cell":{"employeeID":7,"name":"Sandra","primary_language":"mandarin","favorite_color":"blue","favorite_pet":"cat"}},{"id":8,"cell":{"employeeID":8,"name":"Sandra","primary_language":"mandarin","favorite_color":"blue","favorite_pet":"cat"}},{"id":9,"cell":{"employeeID":9,"name":"Sandra","primary_language":"mandarin","favorite_color":"blue","favorite_pet":"cat"}},{"id":10,"cell":{"employeeID":10,"name":"Sandra","primary_language":"mandarin","favorite_color":"blue","favorite_pet":"cat"}},{"id":11,"cell":{"employeeID":11,"name":"Sandra","primary_language":"mandarin","favorite_color":"blue","favorite_pet":"cat"}},{"id":12,"cell":{"employeeID":12,"name":"Sandra","primary_language":"mandarin","favorite_color":"blue","favorite_pet":"cat"}},{"id":"","cell":{"employeeID":"","name":"","primary_language":"","favorite_color":"","favorite_pet":""}},{"id":"null","cell":{"employeeID":"null","name":"null","primary_language":"null","favorite_color":"null","favorite_pet":"null"}}]}';
exit;


    session_start();

    $page = isset($_POST['page']) ? $_POST['page'] : 1;
    $rp = isset($_POST['rp']) ? $_POST['rp'] : 10;
    $sortname = isset($_POST['sortname']) ? $_POST['sortname'] : 'name';
    $sortorder = isset($_POST['sortorder']) ? $_POST['sortorder'] : 'desc';
    $query = isset($_POST['query']) ? $_POST['query'] : false;
    $qtype = isset($_POST['qtype']) ? $_POST['qtype'] : false;


    if(isset($_GET['Add'])){ // this is for adding records

        $rows = $_SESSION['Example4'];
        $rows[$_GET['EmpID']] = 
        array(
            'name'=>$_GET['Name']
            , 'favorite_color'=>$_GET['FavoriteColor']
            , 'favorite_pet'=>$_GET['FavoritePet']
            , 'primary_language'=>$_GET['PrimaryLanguage']
        );
        $_SESSION['Example4'] = $rows;

    }
    elseif(isset($_GET['Edit'])){ // this is for Editing records
        $rows = $_SESSION['Example4'];
        
        unset($rows[trim($_GET['OrgEmpID'])]);  // just delete the original entry and add.
        
        $rows[$_GET['EmpID']] = 
        array(
            'name'=>$_GET['Name']
            , 'favorite_color'=>$_GET['FavoriteColor']
            , 'favorite_pet'=>$_GET['FavoritePet']
            , 'primary_language'=>$_GET['PrimaryLanguage']
        );
        $_SESSION['Example4'] = $rows;
    }
    elseif(isset($_GET['Delete'])){ // this is for removing records
        $rows = $_SESSION['Example4'];
        unset($rows[trim($_GET['Delete'])]);  // to remove the \n
        $_SESSION['Example4'] = $rows;
    }
    else{

        if(isset($_SESSION['Example4'])){ // get session if there is one
            $rows = $_SESSION['Example4'];
        }
        else{ // create session with some data if there isn't
            $rows[1] = array('name'=>'Tony',   'favorite_color'=>'green',  'favorite_pet'=>'hamster',   'primary_language'=>'english');
            $rows[2] = array('name'=>'Mary',   'favorite_color'=>'red',    'favorite_pet'=>'groundhog', 'primary_language'=>'spanish');
            $rows[3] = array('name'=>'Seth',   'favorite_color'=>'silver', 'favorite_pet'=>'snake',     'primary_language'=>'french');
            $rows[4] = array('name'=>'Sandra', 'favorite_color'=>'blue',   'favorite_pet'=>'cat',       'primary_language'=>'mandarin');
            $_SESSION['Example4'] = $rows;
        }



        header("Content-type: application/json");
        $jsonData = array('page'=>$page,'total'=>0,'rows'=>array());
        foreach($rows AS $rowNum => $row){
            //If cell's elements have named keys, they must match column names
            //Only cell's with named keys and matching columns are order independent.
            $entry = array('id' => $rowNum,
                'cell'=>array(
                    'employeeID'       => $rowNum,
                    'name'             => $row['name'],
                    'primary_language' => $row['primary_language'],
                    'favorite_color'   => $row['favorite_color'],
                    'favorite_pet'     => $row['favorite_pet']
                )
            );
            $jsonData['rows'][] = $entry;
        }
        $jsonData['total'] = count($rows);
        echo json_encode($jsonData);

}