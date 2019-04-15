<?php
/**
 * Database functions with Postgres Commands
 * 
 */
Class pgdb {
    // Create connection
    protected $conn;

    Public function __construct($con){
        $this->conn = $con;
    }

    function FetchQuery($query){
        $arrayresult = [];
        if($queryresult = pg_query($this->conn, $query)){
            while ($row = pg_fetch_assoc($queryresult)){
                $arrayresult[] = $row;
            }
            return $arrayresult;
        }else{
            //find the error and return it
            echo"</br></br></br>";
            die(pg_last_error($this->conn) ."</br>".$query);
        }
    }

    function UpdateQuery($query){
        date_default_timezone_set('America/New_York');
        $date = date('Y-m-d H:i:s');
        $query = str_replace(' SET ', " SET dateLastMaint = '". $date . "' , " , $query);
        //return boolean value
        if(pg_query($this->conn, $query)) {
            return 'Update Worked';
        } else {
            //Find the error and return it
            echo"</br></br></br>";
            die(pg_last_error($this->conn) ."</br>".$query);
        }
    }

    function DeleteQuery($query){
        if(pg_query($this->conn, $query)) {
            return 'Delete Worked';
        } else {
            //Find the error and return it
            echo"</br></br></br>";
            die(pg_last_error($this->conn) ."</br>".$query);
        }
    }

    function InsertQuery($query){
        if(pg_query($this->conn, $query)) {
            return pg_last_oid($this->conn);
        } else {
            //Find the error and return it
            echo"</br></br></br>";
            die(pg_last_error($this->conn) ."</br>".$query);
        }
    }

    function CreateTableQuery($query){
        //return table name or false
       $queryresult = pg_query($conn, $query);
    }

    function AlterTableQuery(){
        //Return True of False
    }

    function CountFollowers($relid){
        
    }

    function runScriptFile($file){
        $script = file_get_contents($file);
        $statements = parseScript($script);
        foreach($statements as $statement) {
            if(!pg_query($this->conn, $statement)){
                die(pg_last_error($this->conn) ."</br>".$statement);
            }   
        }
        return true;
    }
}

function parseScript($script) {

    $result = array();
    $delimiter = ';';
    while(strlen($script) && preg_match('/((DELIMITER)[ ]+([^\n\r])|[' . $delimiter . ']|$)/is', $script, $matches, PREG_OFFSET_CAPTURE)) {
      if (count($matches) > 2) {
        $delimiter = $matches[3][0];
        $script = substr($script, $matches[3][1] + 1);
      } else {
        if (strlen($statement = trim(substr($script, 0, $matches[0][1])))) {
          $result[] = $statement;
        }
        $script = substr($script, $matches[0][1] + 1);
      }
    }
  
    return $result;
  
  }

?>