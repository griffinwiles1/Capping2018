<?php
header('location:../index.php');
    class Table{

        protected $db;//Sets the Database -- Allows for queries in this class

        protected $table;//The current table being used

        protected $values;//The values in the database

        protected $fields;

        Public function __construct($db){
            $this->db = $db;
        }
        
        function setTable($table){
            $this->table = $table;
        }

        function getValues(){
            $query = "SELECT * FROM $this->table";
            $result = $this->db->fetchQuery($query);
            $this->values = $result;
        }

        function getFields(){
            $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME = '$this->table' AND TABLE_SCHEMA = 'psndata'";
            $result = $this->db->fetchQuery($query);
            $this->fields = $result;
        }

        function displayTable($table){
            $this->setTable($table);
            echo "<div class='table-header'>";
            echo $this->table;
            echo "</div>";
            echo "<div class='database-table'>";
            $this->showFields();
            echo "</div>";
        }

        function showFields(){
            $this->getFields();
            // print_ary($this->values);
                foreach($this->fields as $i){
                    echo "<div class='database-columns'>";
                    echo "<div class='database-table-fields'>";
                    echo $i['COLUMN_NAME'];
                    echo "</div>";
                    $this->showValues($i['COLUMN_NAME']);
                    echo "</div>";
                }
        }

        function showValues($key){
            $this->getValues();
            // print_ary($this->values);
            foreach($this->values as $i){
                echo "<div class='database-table-values'>";
                $result = isset($i[$key]) ? $i[$key] : 'NULL';
                echo $result;
                echo "</div>";
            }
        }
    }
?>