<?php
/**
 * 保存图片
 */
class SaveImage
{
    // 渲染显示
    public static function save($imgPath,$img)
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
}