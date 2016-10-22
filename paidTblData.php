<?php
/*
 * For more details
 * please check official documentation of DataTables  https://datatables.net/manual/server-side
 * Coded by charaf JRA
 * RefreshMyMind.com
 */

/* IF Query comes from DataTables do the following */
if (!empty($_POST) ) {

    /*
     * Database Configuration and Connection using mysqli
     */

    include_once "dbCall.php";

    /* Useful $_POST Variables coming from the plugin */
    $draw = $_POST["draw"];//counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables
    $orderByColumnIndex  = $_POST['order'][0]['column'];// index of the sorting column (0 index based - i.e. 0 is the first record)
    $orderBy = $_POST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
    $orderType = $_POST['order'][0]['dir']; // ASC or DESC
    $start  = $_POST["start"];//Paging first record indicator.
    $length = $_POST['length'];//Number of records that the table can display in the current draw
    /* END of POST variables */

    $query = "SELECT id, da"."te, event_type, package_type, time_start, amount FROM event_reservation WHERE status='paid'";
    $param = ["id", "date", "event_type", "package_type", "time_start","amount"];
    $resultTable = $_dbCall->getResultsArray($query, $param);     
    $recordsTotal = count($resultTable);

    /* SEARCH CASE : Filtered data */
    if(!empty($_POST['search']['value'])){

        /* WHERE Clause for searching */
        for($i=0 ; $i<count($_POST['columns'])-1;$i++){
            $column = $_POST['columns'][$i]['data'];//we get the name of each column using its index from POST request
            $where[]="$column like '%".$_POST['search']['value']."%'";
        }
        $where = "WHERE status='paid' AND (".implode(" OR " , $where).")";// id like '%searchValue%' or name like '%searchValue%' ....
        /* End WHERE */

        // $sql = sprintf("SELECT * FROM %s WHERE status='paid' ", "event_reservation");//Search query without limit clause (No pagination)
        $param = ["id", "date", "event_type", "package_type", "time_start", "amount"];
        $sql = sprintf("SELECT * FROM %s %s", "event_reservation" , $where);//Search query without limit clause (No pagination)

        $recordsFiltered = count($_dbCall->getResultsArray($sql, $param));//Count of search result

        /* SQL Query for search with limit and orderBy clauses*/
        $sql = sprintf("SELECT id, da"."te, event_type, package_type, time_start, amount  FROM %s %s ORDER BY %s %s limit %d , %d ", "event_reservation" , $where ,$orderBy, $orderType ,$start,$length  );
        $param = ["id", "date", "event_type", "package_type", "time_start", "amount"];
        $data = $_dbCall->getResultsArray($sql, $param);
        
        for($i = 0; $i < count($data); $i++) {
            $data[$i]["date"] = date('Y-m-d', strtotime($data[$i]["date"]));
            $data[$i]["time_start"] = date('H:i:s', strtotime($data[$i]["time_start"]));
        }
    }
    /* END SEARCH */
    else {
        $sql = sprintf("SELECT id, da"."te, event_type, package_type, time_start, amount FROM %s WHERE status='paid' ORDER BY %s %s limit %d , %d", "event_reservation" ,$orderBy,$orderType ,$start , $length);
        $param = ["id", "date", "event_type", "package_type", "time_start", "amount"];
        $data = $_dbCall->getResultsArray($sql, $param);

        for($i = 0; $i < count($data); $i++) {
            $data[$i]["date"] = date('Y-m-d', strtotime($data[$i]["date"]));
            $data[$i]["time_start"] = date('H:i:s', strtotime($data[$i]["time_start"]));
        }

        $recordsFiltered = $recordsTotal;
    }

    /* Response to client before JSON encoding */
    $response = array(
        "draw" => intval($draw),
        "recordsTotal" => $recordsTotal,
        "recordsFiltered" => $recordsFiltered,
        "data" => $data
    );
    echo json_encode($response);

} else {
    echo "NO POST Query from DataTable";
}
?>