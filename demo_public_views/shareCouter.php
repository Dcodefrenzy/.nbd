<?php


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

  echo 'got here it is zero';

$user = $conn->prepare("UPDATE user SET points=points+1 WHERE hash_id=:hid");
$bind = [
  ":hid"=>$_POST['hash_id']
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




 ?>