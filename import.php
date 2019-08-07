<?php
/**
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * Date: 2019/8/6
 * Time: 18:27
 */

/**
 *数组去空值
 */
function del($var)
{
    return (trim($var));
}


$allQ = getAllQ('source/总题库文件(v171031).txt');
$aQNum = getAQNum('source/A_试卷涉及题号(v170717).txt');
$bQNum = getAQNum('source/B_试卷涉及题号(v170717).txt');
$cQNum = getAQNum('source/C_试卷涉及题号(v170717).txt');

/**
 *获取所有题库
 */
function getAllQ($allqfile)
{
    $file = @fopen($allqfile, 'r');
    $content = array();
    if (!$file) {
        return 'file open fail';
    } else {
        $i = 0;
        while (!feof($file)) {
            $str = trim(mb_convert_encoding(fgets($file), "UTF-8", "GB2312,GBK,ASCII,ANSI,UTF-8"));
            if (strpos($str, '[I]') !== false) {
                $content[$i]['I'] = substr($str, 3);
                $num = $i;
                $i++;
            } elseif (strpos($str, '[Q]') !== false) {
                $content[$num]['Q'] = substr($str, 3);
            } elseif (strpos($str, '[A]') !== false) {
                $content[$num]['A'] = substr($str, 3);
            } elseif (strpos($str, '[B]') !== false) {
                $content[$num]['B'] = substr($str, 3);
            } elseif (strpos($str, '[C]') !== false) {
                $content[$num]['C'] = substr($str, 3);
            } elseif (strpos($str, '[D]') !== false) {
                $content[$num]['D'] = substr($str, 3);
            } elseif (strpos($str, '[P]') !== false) {
                $content[$num]['P'] = substr($str, 3);
            } elseif (strpos($str, '[X]') !== false) {
                $content[$num]['X'] = substr($str, 3);
            }
        }
        fclose($file);
        //数		去空
    }
    return $content;
}


/**
 *获取所有A类题库序号
 */
function getAQNum($aqfile)
{
    $file = @fopen($aqfile, 'r');
    $content = array();
    if (!$file) {
        return 'file open fail';
    } else {
        $str = mb_convert_encoding(fgets($file), "UTF-8", "GB2312,GBK,ASCII,ANSI,UTF-8");
        $content = explode("， ", $str);

        fclose($file);
    }
    return array_filter($content, "del");
}

/**
 *获取所有B类题库序号
 */
function getBQNum($bqfile)
{
    $file = @fopen($bqfile, 'r');
    $content = array();
    if (!$file) {
        return 'file open fail';
    } else {
        $str = mb_convert_encoding(fgets($file), "UTF-8", "GB2312,GBK,ASCII,ANSI,UTF-8");
        $content = explode("， ", $str);

        fclose($file);
    }
    return array_filter($content, "del");
}

/**
 *获取所有C类题库序号
 */
function getCQNum($cqfile)
{
    $file = @fopen($cqfile, 'r');
    $content = array();
    if (!$file) {
        return 'file open fail';
    } else {
        $str = mb_convert_encoding(fgets($file), "UTF-8", "GB2312,GBK,ASCII,ANSI,UTF-8");
        $content = explode("， ", $str);

        fclose($file);
    }
    return array_filter($content, "del");
}

/**
 * 获取所有A类题库
 */
function getAQ()
{
    global $allQ, $aQNum;
    $aQ = array();

    $y = 0;
    for ($i = 0; $i < count($allQ); $i++) {
        if (in_array($allQ[$i]['I'], $aQNum)) {
            $aQ[$y] = $allQ[$i];
            $y++;
        }
    }
    return $aQ;
}


/**
 * 获取所有B类题库
 */
function getBQ()
{
    global $allQ, $bQNum;
    $bQ = array();
    $y = 0;
    for ($i = 0; $i < count($allQ); $i++) {
        if (in_array($allQ[$i]['I'], $bQNum)) {
            $bQ[$y] = $allQ[$i];
            $y++;
        }
    }
    return $bQ;
}

/**
 * 获取所有C类题库
 */
function getCQ()
{
    global $allQ, $cQNum;
    $cQ = array();
    $y = 0;
    for ($i = 0; $i < count($allQ); $i++) {
        if (in_array($allQ[$i]['I'], $cQNum)) {
            $cQ[$y] = $allQ[$i];
            $y++;
        }
    }
    return $cQ;
}

//print_r(getAQ());

//print_r(getAllQ('source/总题库文件(v171031).txt'));
//print_r(getAQ('source/A_试卷涉及题号(v170717).txt'));


?>