<?php
/**
 * Database Functions with MYSQL commands
 */
Class mydb {
    // Create connection
    protected $conn;

    Public function __construct($con){
        $this->conn = $con;
    }

    function FetchQuery($query){
        $arrayresult = [];
        if($queryresult = mysqli_query($this->conn, $query)){
            while ($row = mysqli_fetch_assoc($queryresult)){
                $arrayresult[] = $row;
            }
            return $arrayresult;
        }else{
            //find the error and return it
            echo"</br></br></br>";
            die(mysqli_error($this->conn) ."</br>".$query);
        }
    }

    function UpdateQuery($query){
        date_default_timezone_set('America/New_York');
        $date = date('Y-m-d H:i:s');
        $query = str_replace(' SET ', " SET dateLastMaint = '". $date . "' , " , $query);
        //return boolean value
        if(mysqli_query($this->conn, $query)) {
            return 'Update Worked';
        } else {
            //Find the error and return it
            echo"</br></br></br>";
            die(mysqli_error($this->conn) ."</br>".$query);
        }
    }

    function DeleteQuery($query){
        if(mysqli_query($this->conn, $query)) {
            return 'Delete Worked';
        } else {
            //Find the error and return it
            echo"</br></br></br>";
            die(mysqli_error($this->conn) ."</br>".$query);
        }
    }

    function InsertQuery($query){
        if(mysqli_query($this->conn, $query)) {
            return mysqli_insert_id($this->conn);
        } else {
            //Find the error and return it
            echo"</br></br></br>";
            die(mysqli_error($this->conn) ."</br>".$query);
        }
    }

    function CreateTableQuery($query){
        //return table name or false
       $queryresult = mysqli_query($conn, $query);
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
            if(!mysqli_query($this->conn, $statement)){
                die(mysqli_error($this->conn) ."</br>".$statement);
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