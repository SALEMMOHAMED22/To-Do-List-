<?php
require_once '../inc/connection.php';
require_once '../App.php';

if($request->check($request->get('status')) && $request->check($request->get('id')))
{
// catch 
$id = $request->get('id');
$status = $request->get('status');
$runQuery = $conn->prepare("select * from tasks where id = :id");
$runQuery->bindParam(":id" , $id);

$runQuery->execute();
if($runQuery->rowCount()== 1){

    $runQuery = $conn->prepare("update tasks set `status`= :status where `id`=:id");
    $runQuery->bindParam(":status" , $status);
    $runQuery->bindParam(":id" , $id );
    $done = $runQuery->execute();
    if($done){
        $session->set("success" , "status updated successfully");
        $request->redirect("../index.php");
    }else{
        $session->set("errors" , [" errors while status updating"]);
        $request->redirect("../edit.php?id=$id");

    }


}else{

         $session->set("errors" , [" task not found"]);
         $request->redirect("../index.php");
}

}else{

    $request->redirect("../index.php");

}