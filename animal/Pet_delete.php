<?php
try{
    $dbh = new PDO ( "mysql:host=mysql.miraiserver.com;charset=utf8; dbname=u661551261_wan", "u661551261_wan", "u661551261" );
    $sql = "DELETE FROM `u661551261_wan`.`animal` WHERE `animal`.`animal_id` = ".$_GET['id'].";";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    if($stmt){
        print("ペット情報削除成功");
        print("<br>\n");
        header("Location: newpet.php");
    }else{
        print("ペット情報削除失敗");
        print("<br>\n");
        header("Location: newpet.php");
    }
}catch (PDOException $e){
    print('Connection failed:'.$e->getMessage());
}
?>
