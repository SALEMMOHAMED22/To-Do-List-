<?php

require_once '../inc/connection.php';
require_once '../App.php';

// check 
if($request->check($request->post("submit"))){
// catch 

$title = $request->filter($request->post("title"));

// validation (required , string )

$validation->endValidation("title" , $title , ["Required" , "Str"]);
$errors=  $validation->getError();
if(empty($errors)){
    $runQuery = $conn->prepare("insert into tasks(`title`) values(:title)");
    $runQuery->bindParam(":title" ,$title , pdo::PARAM_STR);
    $result =$runQuery->execute();
    if($result){
        $session->set("success" , "data inserted successfully");
        $request->redirect("../index.php");


    }else{
        $session->set("errors" , ["errors while inserting"]);
        $request->redirect("../index.php");

    }


}else{
    $session->set("errors" , $errors);
    $request->redirect("../index.php");

}


}else{
    $request->redirect("../index.php");

}



// insert msg 
//errors

