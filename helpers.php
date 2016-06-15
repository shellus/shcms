<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2016-05-23
 * Time: 14:56
 */


if (! function_exists('self_user_id_field')) {
    /**
     * Generate a CSRF token form field.
     *
     * @return \Illuminate\Support\HtmlString
     */
    function self_user_id_field()
    {
        return new \Illuminate\Support\HtmlString('<input type="hidden" name="user_id" value="' . Auth::user()->id . '">');
    }
}
/**
 * @param $url
 * @param string $method
 * @param array $data
 * @param array $headers
 * @return \anlutro\cURL\Request
 */
function curl($url, $method = 'GET', $data = [], $headers = [])
{
    $request = (new \anlutro\cURL\cURL) -> newRequest($method, $url, $data);
    foreach ($headers as $key => $value){
        $request -> setHeader($key, $value);
    }
    return $request;
}


function rc42 ($pwd, $data)//$pwd密钥 $data需加密字符串
{
    $key[] ="";
    $box[] ="";
    $cipher = "";
    $pwd_length = strlen($pwd);
    $data_length = strlen($data);

    for ($i = 0; $i < 256; $i++)
    {
        $key[$i] = ord($pwd[$i % $pwd_length]);
        $box[$i] = $i;
    }

    for ($j = $i = 0; $i < 256; $i++)
    {
        $j = ($j + $box[$i] + $key[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }

    for ($a = $j = $i = 0; $i < $data_length; $i++)
    {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;

        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;

        $k = $box[(($box[$a] + $box[$j]) % 256)];
        $cipher .= chr(ord($data[$i]) ^ $k);
    }

    return $cipher;
}
function rc4($key, $data)
{
    // Store the vectors "S" has calculated
    static $SC;
    // Function to swaps values of the vector "S"
    $swap = create_function('&$v1, &$v2', '
        $v1 = $v1 ^ $v2;
        $v2 = $v1 ^ $v2;
        $v1 = $v1 ^ $v2;
    ');
    $ikey = crc32($key);
    if (!isset($SC[$ikey])) {
        // Make the vector "S", basead in the key
        $S    = range(0, 255);
        $j    = 0;
        $n    = strlen($key);
        for ($i = 0; $i < 255; $i++) {
            $char  = ord($key{$i % $n});
            $j     = ($j + $S[$i] + $char) % 256;
            $swap($S[$i], $S[$j]);
        }
        $SC[$ikey] = $S;
    } else {
        $S = $SC[$ikey];
    }
    // Crypt/decrypt the data
    $n    = strlen($data);
    $data = str_split($data, 1);
    $i    = $j = 0;
    for ($m = 0; $m < $n; $m++) {
        $i        = ($i + 1) % 256;
        $j        = ($j + $S[$i]) % 256;
        $swap($S[$i], $S[$j]);
        $char     = ord($data[$m]);
        $char     = $S[($S[$i] + $S[$j]) % 256] ^ $char;
        $data[$m] = chr($char);
    }
    return implode('', $data);
}