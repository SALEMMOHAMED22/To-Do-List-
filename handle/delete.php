<?php
require_once '../inc/connection.php';
require_once '../App.php';

if($request->check($request->get('id'))){
    $id = $request->get('id');

    $runQuery = $conn->prepare("select * from tasks where id=:id");
    $runQuery->bindParam(':id',$id);
    $runQuery->execute();

    if($runQuery->rowCount() == 1){

        $runQuery = $conn->prepare("delete from tasks where id=:id");
        $runQuery->bindParam(":id" , $id);
        
        $result = $runQuery->execute();
        if($result){
            $session->set("success" ,  "task deleted successfully");
            $request->redirect("../index.php");


        }else{
            $session->set("errors",["error while deletig"]);
            $request->redirect("../index.php");
            
        }

    }else{
        $session->set("errors" , ["task not found"]);
        $request->redirect("../index.php");
    }

}else{
    $request->redirect("../index.php");
}