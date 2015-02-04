<?php
try{
    $dbh = new PDO ( "mysql:host=mysql.miraiserver.com;charset=utf8; dbname=u661551261_wan", "u661551261_wan", "u661551261" );
    $sql = "DELETE FROM `u661551261_wan`.`owner` WHERE `owner`.`owner_id` = ".$_GET['id'].";";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    if($stmt){
        print("変更成功");
        print("<br>\n");
        header("Location: Owner_Search.html");
    }else{
        print("変更失敗");
        print("<br>\n");
        header("Location: Owner_Search.html");
    }
}catch (PDOException $e){
    print('Connection failed:'.$e->getMessage());
}
?>
