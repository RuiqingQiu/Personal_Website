<?php

class user{
    private $id;               //User id
    private $fields;           //Other record fields
    
    public function __construct(){
        $this->id = null;
        $this->fields = array(
'zh_name'=>'', 'gender'=>'','grade'=>'', 'type'=>'', 'drive_age'=>'0', 'mobile'=>'0', 'email'=>'', 'password'=>'0', 'credit'=>'0');
    }
//$zh_name=$_POST['zh_name'];
//$gender=$_POST['gender'];
//$grade=$_POST['grade'];
//$type=$_POST['type'];
//$drive_age=$_POST['drive_age'];
//$mobile=$_POST['mobile'];
//$email=$_POST['email'];
//$password=$_POST['password'];
//$credit=$_POST['credit'];
    public function __get($field){                  //get value
        if($field=='id') return $this->id;
        else return $this->fields[$field];
    }
    
    public function __set($field,$value){           //set value
        if (array_key_exists($field,$this->fields)) $this->fields[$field]=$value;
    }
    public static function namechk($name) {
        if ($name) return 1;
        else return 0;
    } 
    public static function classchk($class){
        if (strlen($class) && strlen($class)<=9) return 1;
        else return 0;
    }
    public static function emailchk($email){
            if(preg_match('^[0-9a-z][a-z0-9\\._-]{1,}@[a-z0-9-]{1,}[a-z0-9]\\.[a-z\\.]{1,}[a-z]+^',$email)==0) return 0;
            else return 1;
    }
    public static function mobilechk($mobile){
            if(preg_match('^1(3|5|8)\d{9}^',$phone)) return 1;
            else return 0;
    }
    public static function levelchk($level){
            if($level) return 1;
            else return 0;
    }
    public static function messagechk($message) {
        if (preg_match("/^[\x{4e00}-\x{9fa5}\w]{0,150}$/u",$message)) return 1;
        else return 0;
    }

    public static function getbyid($user_id){
        $user = new user;
        $query = sprintf('select name,sex,mail,password,manager from user where id = %d',$user_id);
        mysql_query("set names 'gbk'");
        $result = mysql_query($query,$GLOBALS['DB']);
        if (mysql_num_rows($result)){
            $row = mysql_fetch_assoc($result);
            $user->id = $user_id;
            $user->name = $row['name'];
            $user->sex = $row['sex'];
            $user->email = $row['mail'];
            $user->password = $row['password'];
            $user->manager = $row['manager'];
        }
        mysql_free_result($result);
        return $user;
    }
    
     public static function getbyname($username){
        $user = new user;
        $query = sprintf('select id,sex,mail,password,manager from user where name = "%s"',mysql_real_escape_string($username,$GLOBALS['DB']));
        mysql_query("set names 'gbk'");
        $result = mysql_query($query,$GLOBALS['DB']);
        if (mysql_num_rows($result)){
            $row = mysql_fetch_assoc($result);
            $user->id = $row['id'];
            $user->name = $username;
            $user->sex = $row['sex'];
            $user->mail = $row['mail'];
            $user->password = $row['password'];
            $user->manager = $row['manager'];
        }
        mysql_free_result($result);
        return $user;
     }
     
     public function save(){
        if ($this->id){
            $query = sprintf('update user set name = "%s",sex = %d,mail = "%s",password = "%s",manager = %d where id = %d',
            mysql_real_escape_string($this->name,$GLOBALS['DB']),
            mysql_real_escape_string($this->sex,$GLOBALS['DB']),
            mysql_real_escape_string($this->mail,$GLOBALS['DB']),
            mysql_real_escape_string($this->password,$GLOBALS['DB']),
            mysql_real_escape_string($this->manager,$GLOBALS['DB']),
            $this->id
            );
            mysql_query("set names 'gbk'");
            return mysql_query($query,$GLOBALS['DB']);
        }
        else{
            $query = sprintf('insert into user (name,sex,mail,password,manager) values ("%s",%d,"%s","%s",%d)',
            mysql_real_escape_string($this->name,$GLOBALS['DB']),
            mysql_real_escape_string($this->sex,$GLOBALS['DB']),
            mysql_real_escape_string($this->mail,$GLOBALS['DB']),
            mysql_real_escape_string($this->password,$GLOBALS['DB']),
            mysql_real_escape_string($this->manager,$GLOBALS['DB'])
            );
            mysql_query("set names 'gbk'");
            if (mysql_query($query,$GLOBALS['DB'])){
                $this->id = mysql_insert_id($GLOBALS['DB']);
                return true;
            }
            else return false;
        }
     }   
}

?>
