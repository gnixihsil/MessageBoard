 <?php
 class db_Mysql
 {
  
  var $dbServer;
  var $dbDatabase; 
  var $dbbase;
  var $dbUser;
  var $dbPwd;
  var $dbLink;
  var $result;// 执行query命令的指针
  var $num_rows;// 返回的条目数
  var $insert_id;// 传回最后一次使用 INSERT 指令的 ID
  var $affected_rows;// 传回query命令所影响的列数目

function dbconnect()
{
   $this->dbLink=@mysql_connect($this->dbServer,$this->dbUser,$this->dbPwd);
   echo $this->dbLink;
   echo "<br />";
   if(!$this->dbLink) $this->dbhalt("不能连接数据库!");
   if($this->dbbase=="") $this->dbbase=$this->dbDatabase;
   echo $this->dbbase;
   $db_sel=@mysql_select_db($this->dbbase,$this->dbLink);
   // if(!@mysql_select_db($this->dbbase,$this->dbLink))
   echo "<br />";
   print($db_sel);
   echo $db_sel;
   if(!$db_sel)
   $this->dbhalt("数据库不可用!");
   mysql_query("SET NAMES 'gbk'");
} 

function execute($sql)
{
   $this->result=mysql_query($sql);
   return $this->result;
}

function fetch_array($result)
{
	return mysql_fetch_array($result);
}

function get_rows($sql)
{
	return mysql_num_rows(mysql_query($sql));
}

function num_rows($result)
{
	return mysql_num_rows($result);
}

function data_seek($result,$rowNumber)
{
	return mysql_data_seek($result,$rowNumber);
}
	
function dbhalt($errmsg)
{
   $msg="database is wrong!";
   $msg=$errmsg;
   echo"$msg";
   die();
}

function delete($sql){
   $result=$this->execute($sql,$dbbase);
   $this->affected_rows=mysql_affected_rows($this->dbLink);
   $this->free_result($result);
   return $this->affected_rows;
}
  
function insert($sql){
$result=$this->execute($sql,$dbbase);
$this->insert_id=mysql_insert_id($this->dbLink);
$this->free_result($result);
 return $this->insert_id;
}
  
function update($sql)
{
   $result=$this->execute($sql,$dbbase);
   $this->affected_rows=mysql_affected_rows($this->dbLink);
   $this->free_result($result);
    return $this->affected_rows;
}

function get_num($result)
{
   $num=@mysql_numrows($result);
   return $num;
}
 
function free_result($result)
{
   @mysql_free_result($result);
}

function dbclose()
{
   mysql_close($this->dbLink);
}

}// end class
?>

