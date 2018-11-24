<?php
/**
 * 保存图片
 */
class Tools
{
    public static $config_host = [];

    // 渲染显示
    public static function saveImage($imgPath,$img)
    {
        //$img为传入字符串
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);

        if(@file_exists($imgPath)){
            @unlink($imgPath);
        }@clearstatcache();
        $fp=fopen($imgPath,'w');
        fwrite($fp,$data);
        fclose($fp);
    }

    /**
     * Generates an UUID
     *
     * @author     Anis uddin Ahmad
     * @param      string  an optional prefix
     * @return     string  the formatted uuid
     */
    public static function uuid($prefix = '')
    {
        $chars = md5(uniqid(mt_rand(), true));
        $uuid  = substr($chars,0,8) . '-';
        $uuid .= substr($chars,8,4) . '-';
        $uuid .= substr($chars,12,4) . '-';
        $uuid .= substr($chars,16,4) . '-';
        $uuid .= substr($chars,20,12);
        return $prefix . $uuid;
    }

    public static function imageHost()
    {
        if(count(Tools::$config_host) == 0)
            Tools::$config_host = require(APP_PATH . 'config/config_host.php');
        return Tools::urlProtocol().Tools::$config_host['img_host'];
    }

    public static function urlProtocol()
    {
        $protocol = empty($_SERVER['HTTP_X_CLIENT_PROTO']) ? 'http://' : $_SERVER['HTTP_X_CLIENT_PROTO'] . '://';
        return $protocol;
    }

}