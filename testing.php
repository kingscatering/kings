
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <?php include_once'dbcall.php'; ?>
    <?php 
       session_start();
        $query = "SELECT contact_number FROM accounts WHERE id=1";
        $param = ["contact_number"];
        $row = $_dbCall->getResult($query, $param);
        $number = $row[0];
        echo $number;
    ?>
    <form action="texting.php" method="POST">
        <input type="hidden" name="number" value="<?php echo $number;?>"/>
        <input type="hidden" name="messageType" value="<?php echo "cancel";?>"/>
        <button class="btn btn-default" type="submit" name="submit"> Submit </button>
    </form>
    
</body>
</html> 