<?php


$error = [];
if(empty($_POST['visitors_id'])){
  $error['visitors_id'] = "No visitor Id";
}
if(empty($_POST['hash_id'])){
  $error['hash_id'] = "No Hash Id";
}
if(empty($_POST['post_id'])){
$error['post_id'] = "No post Id";
}
if(empty($error)){
  $user = userFullInfo($conn, $_POST['hash_id']);
  $point = 0;
  echo 'i have not started';
  $stmt = $conn->prepare("SELECT * FROM visitors WHERE visitors_id=:vid AND sharer_id =:shid AND post_id =:pid");
  $data = [
    ":vid"=>$_POST['visitors_id'],
    ":shid"=>$_POST['hash_id'],
    ":pid"=>$_POST['post_id']
  ];
  $stmt->execute($data);
  if($stmt->rowCount() !=0){
    $point = 0;
      echo 'got here it is greater than zero';
      die("over");
  }else{
      $point = $user['rate'];
  echo 'got here it is zero';
  $user = $conn->prepare("UPDATE user SET points=points+:ptt WHERE hash_id=:hid");
  $bind = [
  ":hid"=>$_POST['hash_id'],
  ":ptt"=>$point
  ];
  $user->execute($bind);
  $done = $conn->prepare("INSERT INTO visitors VALUES(NULL,:vi,:pi,:si)");
  $bindvalue = [
  ":vi"=>$_POST['visitors_id'],
  ":si"=>$_POST['hash_id'],
  ":pi"=>$_POST['post_id']
  ];
  $done->execute($bindvalue);
  }


}else{
  foreach($error as $err){
    echo $err;
  }
}




 ?>
