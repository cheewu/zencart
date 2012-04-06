<?php
/**
 * functions_chn.php
 * Simplified Chinese character conversion
 *
 * @package functions
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: functions_chn.php 00001 2006-09-03 20:00:00 jack $
 */

/*中文处理工具函数
--- 空格 ---
string GBspace(string) --------- 每个中文字之间加空格
string GBunspace(string) ------- 每个中文字之间的空格清除
string clear_space(string) ------- 用来清除多余的空格

--- 转换 ---
string GBcase(string,offset) --- 将字符串内的中英文字转换大小写
offset : "upper" - 字符串全转为大写 (strtoupper)
 "lower" - 字符串全转为小写 (strtolower)
 "ucwords" - 将字符串每个字第一个字母改大写 (ucwords)
 "ucfirst" - 将字符串第一个字母改大写 (ucfirst)
string GBrev(string) ----------- 颠倒字符串

--- 文字检查 ---
int GB_check(string) ----------- 检查字符串内是否有 GB 字，有会返回 true，
 否则会返回false
int GB_all(string) ------------- 检查字符串内所有字是否有 GB 字，是会返回 true，
 否则会返回false
int GB_non(string) ------------- 检查字符串内所有字并不是 GB 字，是会返回 true，
 否则会返回false
int GBlen(string) -------------- 返回字符串长度（中文字只计一字母）

--- 查找、取代、提取 ---
int/array GBpos(haystack,needle,[offset]) ---- 查找字符串 (strpos)
offset : 留空 - 查找第一个出现的位置
 int- 由该位置搜索出现的第一个位置
 "r"- 查找最后一次出现的位置 (strrpos)
 "a"- 将所有查找到的字储存为数组(返回 array)

string GB_replace(needle,str,haystack) -- 查找与取代字符串 (str_replace)
string GB_replace_i(needle,str_f,str_b,haystack) -- 不检查大小写查找与取代字符串
 needle - 查找字母
 str - 取代字母 ( str_f - 该字母前, str_b 该字母后)
 haystack - 字符串

string GBsubstr(string,start,[length]) -- 从string提取出由开始到结尾或长度
length的字符串。
中文字只计一字母，可使用正负数。
string GBstrnear(string,length) -- 从 string提取最接近 length的字符串。
 length 中 中文字计2个字母。

--- 注意 ---
如使用由 Form 返回的字符串前，请先替字符串经过 stripslashes() 处理，除去多余的 \ 。

用法：在原 PHP 代码内加上：
include ("GB.inc");
即可使用以上工具函数。
*/

function GBlen($string) {
$l = strlen($string);
$ptr = 0;
$a = 0;
while ($a < $l) {
$ch = substr($string,$a,1);
$ch2 = substr($string,$a+1,1);
if (ord($ch) >= HexDec("0x81") && ord($ch2) >= HexDec("0x40")) {
$ptr++;
$a += 2;
} else {
$ptr++;
$a++;
} // END IF
} // END WHILE

return $ptr;
}

function GBsubstr($string,$start,$length) {
if (!is_int($length) && $length != "") {
return "错误：length 值错误（必须为数值）。<br>";
} elseif ($length == "0") {
return "";
} else {
$l = strlen($string);
$a = 0;
$ptr = 0;
$str_list = array();
$str_list2 = array();
while ($a < $l) {
$ch = substr($string,$a,1);
$ch2 = substr($string,$a+1,1);
if (ord($ch) >= HexDec("0x81") && ord($ch2) >= HexDec("0x40")) {
$str_list[$ptr] = $a;
$str_list2[$ptr] = $a+1;
$ptr++;
$a += 2;
} else {
$str_list[$ptr] = $a;
$str_list2[$ptr] = $a;
$ptr++;
$a++;
} // END IF
} // END WHILE

if ($start > $ptr || -$start > $ptr) {
return;
} elseif ($length == "") {
if ($start >= 0) { // (text,+)
return substr($string,$str_list[$start]);
} else { // (test,-)
return substr($string,$str_list[$ptr + $start]);
}
} else {

if ($length > 0) { // $length > 0


if ($start >= 0) {// (text,+,+)
if (($start + $length) >= count($str_list2)) {
return substr($string,$str_list[$start]);
} else { //(text,+,+)
$end = $str_list2[$start + ($length - 1)] - $str_list[$start] +1;
return substr($string,$str_list[$start],$end);
}

} else { // (text ,-,+)
$start = $ptr + $start;
if (($start + $length) >= count($str_list2)) {
return substr($string,$str_list[$start]);
} else {
$end = $str_list2[$start + ($length - 1)] - $str_list[$start] +1;
return substr($string,$str_list[$start],$end);
}
}

} else { // $length < 0
$end = strlen($string) - $str_list[$ptr+$length];
if ($start >= 0) {// (text,+,-) {
return substr($string,$str_list[$start],-$end);
} else { //(text,-,-)
$start = $ptr + $start;
return substr($string,$str_list[$start],-$end);
}

} // END OF LENGTH > / < 0

}
} // END IF
}

function GB_replace($needle,$string,$haystack) {
$l = strlen($haystack);
$l2 = strlen($needle);
$l3 = strlen($string);
$news = "";
$skip = 0;
$a = 0;
while ($a < $l) {
$ch = substr($haystack,$a,1);
$ch2 = substr($haystack,$a+1,1);
if (ord($ch) >= HexDec("0x81") && ord($ch2) >= HexDec("0x40")) {
if (substr($haystack,$a,$l2) == $needle) {
$news .= $string;
$a += $l2;
} else {
$news .= $ch.$ch2;
$a += 2;
}
} else {
if (substr($haystack,$a,$l2) == $needle) {
$news .= $string;
$a += $l2;
} else {
$news .= $ch;
$a++;
}
} // END IF
} // END WHILE
return $news;
}

function GB_replace_i($needle,$str_f,$str_b,$haystack) {

$l = strlen($haystack);
$l2 = strlen($needle);
$l3 = strlen($string);
$news = "";
$skip = 0;
$a = 0;
while ($a < $l) {
$ch = substr($haystack,$a,1);
$ch2 = substr($haystack,$a+1,1);
if (ord($ch) >= HexDec("0x81") && ord($ch2) >= HexDec("0x40")) {
if (GBcase(substr($haystack,$a,$l2),"lower") == GBcase($needle,"lower")) {
$news .= $str_f . substr($haystack,$a,$l2) . $str_b;
$a += $l2;
} else {
$news .= $ch.$ch2;
$a += 2;
}
} else {
if (GBcase(substr($haystack,$a,$l2),"lower") == GBcase($needle,"lower")) {
$news .= $str_f . substr($haystack,$a,$l2) . $str_b;
$a += $l2;
} else {
$news .= $ch;
$a++;
}
} // END IF
} // END WHILE
return $news;
}



function GBpos($haystack,$needle,$offset) {
if (!is_int($offset)) {
$offset = strtolower($offset);
if ($offset != "" && $offset != "r" && $offset != "a") {
return "错误：offset 值错误。<br>";
}
}
$l = strlen($haystack);
$l2 = strlen($needle);
$found = false;
$w = 0; // WORD
$a = 0; // START

if ($offset == "" || $offset == "r") {
$atleast = 0;
$value = false;
} elseif ($offset == "a") {
$value = array();
$atleast = 0;
} else {
$value = false;
$atleast = $offset;
}
while ($a < $l) {
$ch = substr($haystack,$a,1);
$ch2 = substr($haystack,$a+1,1);
if (ord($ch) >= HexDec("0x81") && ord($ch2) >= HexDec("0x40") && $skip == 0) {
if (substr($haystack,$a,$l2) == $needle) {
if ($offset == "r") {
$found = true;
$value = $w;
} elseif ($offset == "a") {
$found = true;
$value[] = $w;
} elseif (!$value) {
if ($w >= $atleast) {
$found = true;
$value = $w;
}
}
}
$a += 2;
} else {
if (substr($haystack,$a,$l2) == $needle) {
if ($offset == "r") {
$found = true;
$value = $w;
} elseif ($offset == "a") {
$found = true;
$value[] = $w;
} elseif (!$value) {
if ($w >= $atleast) {
$found = true;
$value = $w;
}
}
}
$a++;
}
$w++;
} // END OF WHILE
if ($found) {
return $value;
} else {
return $false;
}
//} // END OF WHILE

}

function GBrev($text) {
$news = "";
$l = strlen($text);
$GB = 0;
$a = 0;
while ($a < $l) {
$ch = substr($text,$a,1);
$ch2 = substr($text,$a+1,1);
if (ord($ch) >= HexDec("0x81") && ord($ch2) >= HexDec("0x40") && $skip == 0) {
$a += 2;
$news = $ch . $ch2 . $news;
} else {
$news = $ch . $news;
$a++;
}
}
return $news;
}

function GB_check($text) {
$l = strlen($text);
$a = 0;
while ($a < $l) {
$ch = substr($text,$a,1);
$ch2 = substr($text,$a+1,1);
if (ord($ch) >= HexDec("0x81") && ord($ch2) >= HexDec("0x40")) {
return true;
} else {
return false;
}
}
}

function GB_all ($text) {
$l = strlen($text);
$all = 1;
$a = 0;
while ($a < $l) {
$ch = substr($text,$a,1);
$ch2 = substr($text,$a+1,1);
if (ord($ch) >= HexDec("0x81") && ord($ch2) >= HexDec("0x40")) {
$a += 2;
} else {
$a++;
$all = 0;
}
}
if ($all == 1) {
return true;
} else {
return false;
}
}

function GB_non ($text) {
$l = strlen($text);
$all = 1;
$a = 0;
while ($a < $l) {
$ch = substr($text,$a,1);
$ch2 = substr($text,$a+1,1);
if (ord($ch) >= HexDec("0x81") && ord($ch2) >= HexDec("0x40")) {
$a += 2;
$all = 0;
} else {
$a++;
}
}
if ($all == 1) {
return true;
} else {
return false;
}
}


function GBcase ($text,$case) {
$case = strtolower($case);
if ($case != "upper" && $case != "lower" && $case != "ucwords" && $case != "ucfirst") {
return "函数用法错误。 $case";
} else {
$ucfirst = 0;
$ucwords = 0;
$news = "";
$l = strlen($text);
$GB = 0;
$english = 0;

$a = 0;
while ($a < $l) {

$ch = substr($text,$a,1);
if ($GB == 0 && ord($ch) >= HexDec("0x81")) {

$GB = 1;
$english = 0;
$news .= $ch;
$ucwords = 0;

} elseif ($GB == 1 && ord($ch) >= HexDec("0x40") && $english == 0) {
$news .= "$ch";
$ucwords = 0;
$GB = 0;

} else {
if ($case == "upper") {
$news .= strtoupper($ch);
} elseif ($case == "lower") {
$news .= strtolower($ch);
} elseif ($case == "ucwords") {
if ($ucwords == 0) {
$news .= strtoupper($ch);
} else {
$news .= strtolower($ch);
}
$ucwords = 1;
} elseif ($case == "ucfirst") {
if ($ucfirst == 0) {
$news .= strtoupper($ch);
$ucfirst = 1;
} else {
$news .= strtolower($ch);
$ucfirst = 1;
}
} else {
$news .= $ch;
}
if ($ch == " " || $ch == "\n") {
$ucwords = 0;
}
$english = 1;
$GB = 0;

}

$a++;

} // END OF while
return $news;
} // end else
}



function GBspace ($text) {

$news = "";
$l = strlen($text);
$GB = 0;
$english = 0;

$a = 0;
while ($a < $l) {


$ch = substr($text,$a,1);
$ch2 = substr($text,$a+1,1);
if (!($ch == " " && $ch2 == " ")) {
if ($GB == 0) {
if (ord($ch) >= HexDec("0x81")) {

if ($english == 1) {
if ((substr($text,$a-1,1) == " ") || (substr($text,$a-1,1) == "\n")) {
$news .= "$ch";
} else {
$news .= " $ch";
}
$english = 0;
$GB = 1;
} else {
$GB = 1;
$english = 0;
$news .= $ch;
}
} else {
$english = 1;
$GB = 0;
$news .= $ch;
}

} else {
if (ord($ch) >= HexDec("0x40")) {
if ($english == 0) {
if ((substr($text,$a+1,1) == " ")|| (substr($text,$a+1,1) == "\n")) {
$news .= "$ch";
} else {
$news .= "$ch ";
}
} else {
$news .= " $ch";
}
} else {
$english = 1;
$news .= "$ch";
}
$GB = 0;
}
}
$a++;
} // END OF while

// Chk 1 & last is space

$l = strlen($news);
if (substr($news,0,1) == " ") {
$news = substr($news,1);
}
$l = strlen($news);
if (substr($news,$l-1,1) == " ") {
$news = substr($news,0,$l-1);
}
return $news;
}

function GBunspace($text) {
$news = "";
$l = strlen($text);
$a = 0;
$last_space = 1;
while ($a < $l) {

$ch = substr($text,$a,1);
$ch2 = substr($text,$a+1,1);
$ch3 = substr($text,$a+2,1);
if (($a + 1) == $l ) {
$last_space = 1;
}
if ($ch == " ") {
if ($last_space == 0) {
if (ord($ch2) >= HexDec("0x81") && ord($ch3) >= HexDec("0x40")) {
if ($chi == 0) {
$news .= " ";
$last_space = 1;
}
$chi=1;


} elseif ($ch2 != " ") {
$news .= " ";
$chi = 0;
$last_space = 1;
}
}
} else {
if (ord($ch) >= HexDec("0x81") && ord($ch2) >= HexDec("0x40")) {
$chi = 1;
$a++;
$news .= $ch . $ch2;
$last_space = 0;

} else {
$chi = 0;
$news .= $ch;
$last_space = 0;
}

}
$a++;
}
// Chk 1 & last is space

$l = strlen($news);
if (substr($news,0,1) == " ") {
$news = substr($news,1);
}
$l = strlen($news);
if (substr($news,$l-1,1) == " ") {
$news = substr($news,0,$l-1);
}
return $news;



} // END OF Function

function GBstrnear($text,$length) {

$tex_len = strlen($text);
$a = 0;
$w = "";
while ($a < $tex_len) {
$ch = substr($text,$a,1);
$ch2 = substr($text,$a+1,1);
if (GB_all($ch.$ch2)) {
$w .= $ch.$ch2;
$a=$a+2;
} else {
$w .= $ch;
$a++;
}
if ($a == $length || $a == ($length - 1)) {
$a = $tex_len;
}
}
return $w;
} // END OF FUNCTION

function clear_space($text) {
$t = "";
for ($a=0;$a<strlen($text);$a++) {
$ch = substr($text,$a,1);
$ch2 = substr($text,$a+1,1);
if ($ch == " " && $ch2 == " ") {
} else {
$t .= $ch;
}
}
return $t;
}
?>