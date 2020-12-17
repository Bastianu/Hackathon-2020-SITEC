<php?

$method = 'GET';
$url = 'https://services.nvd.nist.gov/rest/json/cves/1.0?cpeMatchString=cpe:2.3:*:ubuntu';

function CallAPI($method, $url)
{
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    echo $result;
}
?>