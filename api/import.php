<?php
/**
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-08-06 18:27:00
 */


/**
 *数组去空值
 * @param $var
 * @return string
 */
function del($var)
{
    return (trim($var));
}

$allQ = getAllQ($_SERVER['DOCUMENT_ROOT'] . '/source/总题库文件(v171031).txt');
$aQNum = getAQNum($_SERVER['DOCUMENT_ROOT'] . '/source/A_试卷涉及题号(v170717).txt');
$bQNum = getAQNum($_SERVER['DOCUMENT_ROOT'] . '/source/B_试卷涉及题号(v170717).txt');
$cQNum = getAQNum($_SERVER['DOCUMENT_ROOT'] . '/source/C_试卷涉及题号(v170717).txt');

/**
 *获取所有题库
 * @param $allqfile
 * @return array
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
    }
    return $content;
}


/**
 *获取所有A类题库序号
 * @param $aqfile
 * @return array|string
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
 * @param $bqfile
 * @return array|string
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
 * @param $cqfile
 * @return array|string
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
function getAQ($shuff)
{
    global $allQ, $aQNum;
    $aQ = array();
    $y = 0;
    for ($i = 0; $i < count($allQ); $i++) {
        if (in_array($allQ[$i]['I'], $aQNum)) {
            $aQ[$y] = $allQ[$i];
            $aQ[$y]["index"] = $y;
            $answer = array(
                array("k" => "A", "v" => $allQ[$i]["A"]),
                array("k" => "B", "v" => $allQ[$i]["B"]),
                array("k" => "C", "v" => $allQ[$i]["C"]),
                array("k" => "D", "v" => $allQ[$i]["D"]),
            );
            if ($shuff) {
                shuffle($answer);
            }
            $aQ[$y]["answer"] = $answer;
            $y++;
        }
    }
    return $aQ;
}

/**
 * 分页获取题库
 * @param $pageSize
 * @param $page
 * @return array
 */
function getQSP($qs, $pageSize, $page)
{
    $count = count($qs);//总条数
    $countpage = ceil($count / $pageSize); #总页面数
    $start = ($page - 1) * $pageSize;//偏移量，当前页-1乘以每页显示条数
    if ($page < $countpage) {
        $qsP = array_slice($qs, $start, $pageSize);
    } else {
        $qsP = array_slice($qs, $start);
    }
    return $qsP;
}


/**
 * 获取所有B类题库
 */
function getBQ($shuff)
{
    global $allQ, $bQNum;
    $bQ = array();
    $y = 0;
    for ($i = 0; $i < count($allQ); $i++) {
        if (in_array($allQ[$i]['I'], $bQNum)) {
            $bQ[$y] = $allQ[$i];
            $bQ[$y]["index"] = $y;
            $answer = array(
                array("k" => "A", "v" => $allQ[$i]["A"]),
                array("k" => "B", "v" => $allQ[$i]["B"]),
                array("k" => "C", "v" => $allQ[$i]["C"]),
                array("k" => "D", "v" => $allQ[$i]["D"]),
            );
            if ($shuff) {
                shuffle($answer);
            }
            $bQ[$y]["answer"] = $answer;
            $y++;
        }
    }
    return $bQ;
}

/**
 * 获取所有C类题库
 */
function getCQ($shuff)
{
    global $allQ, $cQNum;
    $cQ = array();
    $y = 0;
    for ($i = 0; $i < count($allQ); $i++) {
        if (in_array($allQ[$i]['I'], $cQNum)) {
            $cQ[$y] = $allQ[$i];
            $cQ[$y]["index"] = $y;
            $answer = array(
                array("k" => "A", "v" => $allQ[$i]["A"]),
                array("k" => "B", "v" => $allQ[$i]["B"]),
                array("k" => "C", "v" => $allQ[$i]["C"]),
                array("k" => "D", "v" => $allQ[$i]["D"]),
            );
            if ($shuff) {
                shuffle($answer);
            }
            $cQ[$y]["answer"] = $answer;
            $y++;
        }
    }
    return $cQ;
}

/**
 * 随机获取试题
 */
function getExam($type)
{
    $q = array();
    switch ($type) {
        case "A":
            $q = getAQ(true);
            $QSR = array_rand($q, 30);
            break;
        case "B":
            $q = getBQ(true);
            $QSR = array_rand($q, 50);
            break;
        case "C":
            $q = getCQ(true);
            $QSR = array_rand($q, 80);
            break;
    }

    shuffle($QSR);
    return $QSR;
}

//print_r(getAQ());

//print_r(getAllQ('source/总题库文件(v171031).txt'));
//print_r(getAQ('source/A_试卷涉及题号(v170717).txt'));


?>