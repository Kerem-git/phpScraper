<?php
function get_content(){
$url = 'https://www.hepsiburada.com/';
$proxyUrl = 'https://public.freeproxyapi.com/api/Proxy/Mini';
$response = file_get_contents($proxyUrl);
$decoded_json = json_decode($response, false);



$proxyauth = 'user:pass';
$proxy = strval($decoded_json-> host);
$proxyPort = strval($decoded_json->port);
print_r($proxy.':'.$proxyPort);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//proxy suport
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYPORT, $proxyPort);
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
curl_setopt($ch, CURLOPT_PROXYTYPE, 'HTTP');
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
//https
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML,like Gecko) Chrome/27.0.1453.94 Safari/537.36");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 100);

$output = curl_exec($ch);   

if(curl_exec($ch) === false)
{
    echo 'Curl error: ' . curl_error($ch);
    get_content();
}
else
{
    echo 'Operation completed without any errors';
}

echo $output;

curl_close($ch);
};
get_content();
?>
