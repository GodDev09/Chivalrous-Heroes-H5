<?php
include_once dirname(__FILE__).'/config.php';
$newdbip = DBIP;
$newdbuser = DBUSER;
$newdbpwd = DBPWD;
$newdbname = DBNAME;
class db_mysql {
    protected $link_id;
    function __construct($newdbip, $newdbuser, $newdbpwd, $newdbname, $charset = "utf8") {
        if (!($this->link_id = @mysql_connect($newdbip, $newdbuser, $newdbpwd))) {
            die($this->mysql_error());
        }
        if (!@mysql_select_db($newdbname, $this->link_id)) {
            die($this->mysql_error());
        }
        mysql_set_charset($charset, $this->link_id);
        mysql_query("SET NAMES $charset", $this->link_id);
    }
    public function escape_field($field) {
        return mysql_real_escape_string($field); //转义sql语句
        
    }
    public function fetch_row($res) {
        return mysql_fetch_row($res); //从结果集中取得一行作为数字数组。
        
    }
    public function fetch_array($query, $result_type = MYSQL_ASSOC) {
        return mysql_fetch_array($query, $result_type); //函数从结果集中取得一行作为关联数组，或数字数组，或二者兼有。返回根据从结果集取得的行生成的数组，如果没有更多行则返回 false。
        
    }
    public function query($sql) { //执行sql
        return mysql_query($sql, $this->link_id);
    }
    public function num_rows($query) { //统计结果条数
        $row = $this->fetch_array($query);
        return $row['count(*)'];
    }
    public function insert_id() { //mysql_insert_id() 函数返回上一步 INSERT 操作产生的 ID。如果上一查询没有产生 AUTO_INCREMENT 的 ID，则 mysql_insert_id() 返回 0。
        return mysql_insert_id($this->link_id);
    }
    public function getone($sql, $limited = false) { //获取最后一条记录或者第一条记录
        if ($limited == true) {
            $sql = trim("$sql LIMIT 1");
        }
        $res = $this->query($sql);
        if ($res !== false) {
            $row = $this->fetch_row($res);
            return $row[0];
        } else {
            return false;
        }
    }
    public function getrow($sql) { //mysql_fetch_assoc() 函数从结果集中取得一行作为关联数组。返回根据从结果集取得的行生成的关联数组，如果没有更多行，则返回 false。
        $res = $this->query($sql);
        if ($res !== false) {
            return mysql_fetch_assoc($res);
        } else {
            return false;
        }
    }
    public function getall($sql) { //获取全部记录，并生成关联数组
        $res = $this->query($sql);
        if ($res !== false) {
            $arr = array();
            while ($row = mysql_fetch_assoc($res)) {
                $arr[] = $row;
            }
            return $arr;
        } else {
            return false;
        }
    }
    public function mysql_error() { //mysql错误信息
        return mysql_error();
    }
    public function mysql_version() { //mysql版本
        return mysql_get_server_info();
    }
}
class db_pdo {
    protected $pdo;
    function __construct($newdbip, $newdbuser, $newdbpwd, $newdbname, $charset = "utf8") {
        try {
            $this->pdo = new PDO("mysql:host=$newdbip;dbname=$newdbname;charset=$charset", $newdbuser, $newdbpwd);
            $this->pdo->exec("SET NAMES $charset");
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }
    public function escape_field($field) { //sql转义
        return str_replace(array("\n", "\r"), array('\\n', '\\r'), $field);
    }
    public function fetch_row($res) {
        return $res->fetch(PDO::FETCH_NUM); //把一条记录遍历到索引型数组中
        
    }
    public function fetch_array($query) { //把一条记录遍历到关联数组中
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function query($sql) { //执行sql
        if (preg_match('/^(select|SHOW FULL COLUMNS FROM|SHOW TABLES FROM|SHOW CREATE TABLE)/i', $sql)) {
            return $this->pdo->query($sql);
        } else {
            return $this->pdo->exec($sql);
        }
    }
    public function num_rows($query) { //把一条记录遍历到混合型数组中，返回第一条记录
        $row = $query->fetch(PDO::FETCH_BOTH);
        return $row[0];
    }
    public function insert_id() { //如果没有为参数 name 指定序列名称，PDO::lastInsertId() 则返回一个表示最后插入数据库那一行的行ID的字符串。
        return $this->pdo->lastInsertId();
    }
    public function getone($sql, $limited = false) { //获取最后一条记录或者第一条记录
        if ($limited == true) {
            $sql = trim("$sql LIMIT 1");
        }
        $res = $this->query($sql);
        if ($res !== false) {
            $row = $this->fetch_row($res);
            return $row[0];
        } else {
            return false;
        }
    }
    public function getrow($sql) { //函数从结果集中取得一行作为关联数组。返回根据从结果集取得的行生成的关联数组，如果没有更多行，则返回 false。
        $res = $this->query($sql);
        if ($res !== false) {
            return $this->fetch_array($res);
        } else {
            return false;
        }
    }
    public function getall($sql) { //获取全部记录，并生成关联数组
        $res = $this->query($sql);
        if ($res !== false) {
            $arr = array();
            while ($row = $this->fetch_array($res)) {
                $arr[] = $row;
            }
            return $arr;
        } else {
            return false;
        }
    }
    public function mysql_error() { //mysql错误信息
        $info = $this->pdo->errorInfo();
        return $info[2];
    }
    public function mysql_version() { //mysql版本
        return $this->pdo->getAttribute(constant('PDO::ATTR_SERVER_VERSION'));
    }
}
$db = extension_loaded('pdo_mysql') ? new db_pdo($newdbip, $newdbuser, $newdbpwd, $newdbname) : new db_mysql($newdbip, $newdbuser, $newdbpwd, $newdbname);
?>