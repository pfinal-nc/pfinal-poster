<?php
/**
 * Created by PhpStorm.
 * User: 南丞
 * Date: 2019/5/30
 * Time: 17:17
 *
 *
 *                      _ooOoo_
 *                     o8888888o
 *                     88" . "88
 *                     (| ^_^ |)
 *                     O\  =  /O
 *                  ____/`---'\____
 *                .'  \\|     |//  `.
 *               /  \\|||  :  |||//  \
 *              /  _||||| -:- |||||-  \
 *              |   | \\\  -  /// |   |
 *              | \_|  ''\---/''  |   |
 *              \  .-\__  `-`  ___/-. /
 *            ___`. .'  /--.--\  `. . ___
 *          ."" '<  `.___\_<|>_/___.'  >'"".
 *        | | :  `- \`.;`\ _ /`;.`/ - ` : | |
 *        \  \ `-.   \_ __\ /__ _/   .-` /  /
 *  ========`-.____`-.___\_____/___.-`____.-'========
 *                       `=---='
 *  ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
 *           佛祖保佑       永无BUG     永不修改
 *
 */

namespace App\Services;


class ImgTools
{
    protected $imgData;

    public function __construct($imgData)
    {
        $this->imgData = $imgData;
    }

    // 生成海报
    public function createSharePng($fileName = '')
    {
        //dd($this->imgData);
        //创建画布
        if ($this->imgData['generate_desc']['height'] > $this->imgData['generate_desc']['width']) {
            $canvas_height = $this->imgData['bg_img']['bg_data'][1];
            $canvas_width = $this->imgData['bg_img']['bg_data'][0] + $this->imgData['generate_desc']['width'];
        } else {
            $canvas_width = $this->imgData['bg_img']['bg_data'][0];
            $canvas_height = $this->imgData['bg_img']['bg_data'][1] + $this->imgData['generate_desc']['height'];
        }
//        dd($canvas_height);
//        dd($canvas_width);
        $im = imagecreatetruecolor($canvas_width, $canvas_height);
        $color = imagecolorallocate($im, 255, 255, 255);
        imagefill($im, 0, 0, $color);
        $font_file = 'font/msyh.ttf';
        $font_color_2 = ImageColorAllocate($im, 28, 28, 28);
        $logoImg = @imagecreatefrompng($this->imgData['qrcode']['qrcode_path']);
        imagecopyresized($im, $logoImg, $canvas_width - 10, $canvas_height-10, 0, 0, $this->imgData['qrcode']['qrcode_width'], $this->imgData['qrcode']['qrcode_width'],$this->imgData['qrcode']['qrcode_width'],$this->imgData['qrcode']['qrcode_width']);
        $posterImg = $this->createImageFromFile($this->imgData['bg_img']['bg_path']);
        imagecopyresized($im,$posterImg,0,0,0,0,$this->imgData['bg_img']['bg_data'][0],$this->imgData['bg_img']['bg_data'][1],$this->imgData['bg_img']['bg_data'][0],$this->imgData['bg_img']['bg_data'][1]);

        // 标题
        $theTitle = $this->cn_row_substr($this->imgData['msg']['title'], 2, 18);
        imagettftext($im, 32, 0, 20, 1000, $font_color_2, $font_file, $this->to_entities($theTitle[1]));
        if ($fileName) {
            imagepng($im, $fileName);
        } else {
            Header("Content-Type: image/png");
            imagepng($im);
        }
        imagedestroy($im);
        imagedestroy($posterImg);
        return $fileName;
    }
    private function createImageFromFile($file) {
        if (preg_match('/http(s)?:\/\//', $file)) {
            $fileSuffix = $this->getNetworkImgType($file);
        } else {
            $fileSuffix = pathinfo($file, PATHINFO_EXTENSION);
        }

        if (!$fileSuffix) return false;

        switch ($fileSuffix) {
            case 'jpeg':
                $theImage = @imagecreatefromjpeg($file);
                break;
            case 'jpg':
                $theImage = @imagecreatefromjpeg($file);
                break;
            case 'png':
                $theImage = @imagecreatefrompng($file);
                break;
            case 'gif':
                $theImage = @imagecreatefromgif($file);
                break;
            default:
                $theImage = @imagecreatefromstring(file_get_contents($file));
                break;
        }
        return $theImage;
    }

    private function getNetworkImgType($url)
    {
        return file_get_contents($url);
    }
    /**
     * 分行连续截取字符串
     * @param $str  需要截取的字符串,UTF-8
     * @param int $row 截取的行数
     * @param int $number 每行截取的字数，中文长度
     * @param bool $suffix 最后行是否添加‘...’后缀
     * @return array    返回数组共$row个元素，下标1到$row
     */
    private function cn_row_substr($str, $row = 1, $number = 10, $suffix = true)
    {
        $result = array();
        for ($r = 1; $r <= $row; $r++) {
            $result[$r] = '';
        }

        $str = trim($str);
        if (!$str) return $result;

        $theStrlen = strlen($str);

        //每行实际字节长度
        $oneRowNum = $number * 3;
        for ($r = 1; $r <= $row; $r++) {
            if ($r == $row and $theStrlen > $r * $oneRowNum and $suffix) {
                $result[$r] = $this->mg_cn_substr($str, $oneRowNum - 6, ($r - 1) * $oneRowNum) . '...';
            } else {
                $result[$r] = $this->mg_cn_substr($str, $oneRowNum, ($r - 1) * $oneRowNum);
            }
            if ($theStrlen < $r * $oneRowNum) break;
        }

        return $result;
    }
    /**
     * 按字节截取utf-8字符串
     * 识别汉字全角符号，全角中文3个字节，半角英文1个字节
     * @param $str  需要切取的字符串
     * @param $len  截取长度[字节]
     * @param int $start 截取开始位置，默认0
     * @return string
     */
    function mg_cn_substr($str, $len, $start = 0)
    {
        $q_str = '';
        $q_strlen = ($start + $len) > strlen($str) ? strlen($str) : ($start + $len);

        //如果start不为起始位置，若起始位置为乱码就按照UTF-8编码获取新start
        if ($start and json_encode(substr($str, $start, 1)) === false) {
            for ($a = 0; $a < 3; $a++) {
                $new_start = $start + $a;
                $m_str = substr($str, $new_start, 3);
                if (json_encode($m_str) !== false) {
                    $start = $new_start;
                    break;
                }
            }
        }

        //切取内容
        for ($i = $start; $i < $q_strlen; $i++) {
            //ord()函数取得substr()的第一个字符的ASCII码，如果大于0xa0的话则是中文字符
            if (ord(substr($str, $i, 1)) > 0xa0) {
                $q_str .= substr($str, $i, 3);
                $i += 2;
            } else {
                $q_str .= substr($str, $i, 1);
            }
        }
        return $q_str;
    }
    function to_entities($string)
    {
        $len = strlen($string);
        $buf = "";
        for ($i = 0; $i < $len; $i++) {
            if (ord($string[$i]) <= 127) {
                $buf .= $string[$i];
            } else if (ord($string[$i]) < 192) {
                //unexpected 2nd, 3rd or 4th byte
                $buf .= "&#xfffd";
            } else if (ord($string[$i]) < 224) {
                //first byte of 2-byte seq
                $buf .= sprintf("&#%d;",
                    ((ord($string[$i + 0]) & 31) << 6) +
                    (ord($string[$i + 1]) & 63)
                );
                $i += 1;
            } else if (ord($string[$i]) < 240) {
                //first byte of 3-byte seq
                $buf .= sprintf("&#%d;",
                    ((ord($string[$i + 0]) & 15) << 12) +
                    ((ord($string[$i + 1]) & 63) << 6) +
                    (ord($string[$i + 2]) & 63)
                );
                $i += 2;
            } else {
                //first byte of 4-byte seq
                $buf .= sprintf("&#%d;",
                    ((ord($string[$i + 0]) & 7) << 18) +
                    ((ord($string[$i + 1]) & 63) << 12) +
                    ((ord($string[$i + 2]) & 63) << 6) +
                    (ord($string[$i + 3]) & 63)
                );
                $i += 3;
            }
        }
        return $buf;
    }
}