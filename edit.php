<?php
require_once 'inc/header.php';
require_once 'inc/connection.php';
require_once 'App.php';

?>

<?php

if($request->get("id")){
    $id = $request->get('id');
    $runQuery = $conn->prepare("select * from tasks where id = :id");
    $runQuery->bindParam(":id" , $id);
    $runQuery->execute();
    if($runQuery->rowCount()== 1){
        $task = $runQuery->fetch(pdo::FETCH_ASSOC);
    }else{
        $session->set("errors" , ["task not found"]);
        $request->redirect("index.php");

    }
}else{
    $request->redirect("index.php");
}

require_once 'inc/errors.php';

?>

<body class="container w-50 mt-5">
    <form action="handle/edit.php?id=<?php echo $id ?>" method="post">
            <textarea type="text" class="form-control"  name="title" id="" placeholder="enter your note here"><?php echo $task['title']?></textarea>
            <div class="text-center">
                <button type="submit" name="submit" class="form-control text-white bg-info mt-3 " >Update</button>
            </div>  
    </form>
</body>
</html>