<?php
require_once '../inc/connection.php';
require_once '../App.php';


// check 
if($request->check($request->post('submit')) && $request->check($request->get('id')))
{
// catch 
$id = $request->get('id');
$title = $request->filter($request->post('title')) ;
// validation 
$validation->endValidation('title' , $title , ["Required" , "Str"]);
$errors = $validation->getError();
if(empty($errors)){
    // true -> select one -> founded -> update 
    $runQuery = $conn->prepare("select * from tasks where id = :id");
    $runQuery->bindParam(":id" , $id);
    $runQuery->execute();
    if($runQuery->rowCount()== 1){
       $runQuery =  $conn->prepare("update tasks set `title`= :title  where id = :id");
        $runQuery->bindParam(":title" , $title , pdo::PARAM_STR );
        $runQuery->bindParam(":id" , $id , pdo::PARAM_INT);
        if( $runQuery->execute()){

            $session->set("success" , " task updated successfully ");
            $request->redirect("../index.php");


        }else{
            $session->set("errors" , [" error while updating"]);
            $request->redirect("../edite.php?id=$id");
        }



    }else{
        $session->set("errors" , [" task not found"]);
        $request->redirect("../index.php");

    } 



    
}else{
    // false -> msg errors 
    $session->set("errors" , $errors);
    $request->redirect("../edit.php?id=$id");
    

}



}else{

    $request->redirect("../index.php");

}


