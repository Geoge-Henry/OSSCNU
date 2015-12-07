<?PHP
class CRYPT{
private static $_key = "zxren.net"; // 密钥
//加密
static function encrypt($data)
{
$key = md5($_key);
$x = 0;
$len = strlen($data);
$l = strlen($key);
for ($i = 0; $i < $len; $i++)
{
if ($x == $l)
{
$x = 0;
}
$b .= $key[$x];
$x++;
}
for ($i = 0; $i < $len; $i++)
{
$s= $data[$i] ^ $b[$i];
$str.=$s;
}
return base64_encode($str);
}
//解密
static function decrypt($data)
{
$key = md5($_key);
$x = 0;
$data = base64_decode($data);
$len = strlen($data);
$l = strlen($key);
for ($i = 0; $i < $len; $i++)
{
if ($x == $l)
{
$x = 0;
}
$b .= substr($key, $x, 1);
$x++;
}
for ($i = 0; $i < $len; $i++)
{
$s=$data[$i]^$b[$i];
$str.=$s;
}
return $str;
}
}
