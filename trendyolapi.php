<?php
function json_encode_tr($string)
{
    return json_encode($string, JSON_UNESCAPED_UNICODE);
}
$url = "https://auth.trendyol.com/login";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "application-id: 1",
   "Content-Type: application/json",
   "culture: tr-TR",
   "storefront-id: 1",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = '{"email":"USERNAME","password":"PASSWORD"}';

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
$encodedTr = json_encode_tr($resp);
$decodedTr = json_decode($encodedTr);
if(strpos($decodedTr,'hatalı')){
    echo "E-posta veya Şifre hatalı ";
}else if(strpos($decodedTr,'accessToken')){
    echo "Giriş Başarılı";
}
?>