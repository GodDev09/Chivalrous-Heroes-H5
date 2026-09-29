<?php
function SafeSql($value) { //过滤sql语句
    return htmlspecialchars(str_replace('\\', '', $value), ENT_QUOTES, "UTF-8", false);
}
function SafeRequest($key, $mode, $type = 0) { //过滤post和get传递的参数
    $magic = get_magic_quotes_gpc();
    switch ($mode) {
        case 'post':
            $value = isset($_POST[$key]) ? $magic ? trim($_POST[$key]) : addslashes(trim($_POST[$key])) : NULL;
        break;
        case 'get':
            $value = isset($_GET[$key]) ? $magic ? trim($_GET[$key]) : addslashes(trim($_GET[$key])) : NULL;
        break;
    }
    return $type ? $value : htmlspecialchars(str_replace('\\' . '\\', '', $value), ENT_QUOTES, "UTF-8", false);
}
function getMillisecond() {
    list($t1, $t2) = explode(' ', microtime());
    return (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
}
function poststr($str) {
    if (isset($_POST[$str])) {
        return $_POST[$str];
    }
}
function REQUEST($str) {
    if (isset($_REQUEST[$str])) {
        return $_REQUEST[$str];
    }
    die("您提交的参数非法！");
}
function getip() {
    if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $ip = $_SERVER['REMOTE_ADDR'];
    } elseif (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
        $ip = getenv('HTTP_CLIENT_IP');
    } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $ip = getenv('REMOTE_ADDR');
    }
    preg_match("/[\d\.]{7,15}/", isset($ip) ? $ip : NULL, $match);
    return isset($match[0]) ? $match[0] : 'unknown';
}
?>