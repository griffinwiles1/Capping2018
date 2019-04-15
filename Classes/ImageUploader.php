<?php
    class FileUploader{
        protected $db; //Sets the Database -- Allows for queries in this class

        protected $type;//Sets the Type of the File -- Will Determine where the file is placed

        protected $userid;//Id of the user uploading the image

        Public function __construct($db,$type,$userid){
            $this->db = $db;
            $this->type = $type;
            $this->userid = $userid;
        }
        /**
         * The Upload Function
         * 
         */
        function uploadFile ($file) {
            $result["error"] = 0;
            $result["str"] = '';
            $error = $this->checkError($file['error']);
            if(!$error){
                $result["error"] = 1;
                $result["str"] = "Image Upload Failed";
                return $result;
            }
            $filename = $file['name'];
            $filetmp = $file['tmp_name'];
            $ext = $this->checkExtension($file);
            if($ext){
                $this->checkFile($file);//Make sure the file is safe
                $name = $this->setName($filename, $ext);//Set a random name to the file
                $path = $this->setPath($name);//Create the path for the file to be place -- The folder
                $this->doUpload($filetmp, $path, $name);
                $result["str"] = $name;
            }
            return $result;
        }

        function checkError($check){
            if($check == 1){
                return false;
            }else{
                return true;
            }
        }

        /**
         * Function that checks if the extension is acceptable
         * 
         */
        function checkExtension($file){
            $name = $file['name'];
            $ext = end((explode(".", $name))); # extra () to prevent notice
            echo "Extension -- " . $ext;
            $validexts = ['gif', 'jpg', 'png', 'GIF'];
            foreach($validexts as $i){
                if($ext == $i){
                    return $ext;
                }
            }
            return false;
        }

        /**
         * Function that checks for XSS
         * 
         */
        function checkFile($file){
            return true;
        }

        /**
         * Function that randomly creates a name for the file
         * 
         */
        function setName($file, $ext){
            $newname = $this->generateRandomString();
            $name = $newname .''.$ext;
            // echo $name;
            return $name;
        }

        /**
         * Function that sets the path for the file to be placed
         * 
         */
        function setPath($name){
            $dir = getRoot()."images/Users/".$this->userid."/".$this->type."/";
            $path = $dir."".$name;
            // echo $path;
            return $path;
        }

        /**
         * Function that uploads the file to the directory and the database
         * 
         */
        function doUpload($file, $path, $name){
            $didupload = move_uploaded_file($file,$path);
            if($this->type == 'Banner'){
                $var = 'bPicture';
                $this->doQuery($var, $name);
            }
            if($this->type == 'Profile'){
                $var = 'pPicture';
                $this->doQuery($var, $name);
            }
        }

        /**
         * Uploads the file name to the database
         * 
         */
        function doQuery($var, $name){
            $query = "UPDATE USERS
                     SET $var = '$name'
                     WHERE userid = $this->userid";
            echo $query .'</br>';
            $result = $this->db->updateQuery($query);
            echo $result;
        }

        /**
         * Creates a random string
         * 
         * Code Credit -> Stephen Watkins @ Stack Overflow
         * link -> https://stackoverflow.com/questions/4356289/php-random-string-generator
         * 
         */
        function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            // $this->checkUnique($randomString);
            return $randomString;
        }
    }
?>