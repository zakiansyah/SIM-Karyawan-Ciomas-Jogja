<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.binderbyte.com/wilayah/provinsi?api_key=d9c4a1cc88cfd3ab49398e355f14b18e80edb2bc68a7355cbba9ce2307389e8f',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'key: d9c4a1cc88cfd3ab49398e355f14b18e80edb2bc68a7355cbba9ce2307389e8f'
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $array_response = json_decode($response, TRUE);
  
  // Sesuaikan dengan struktur JSON yang baru
  $dataprovinsi = $array_response['value'];

  echo "<option value=''>Pilih Provinsi</option>";

  // Iterasi melalui array provinsi
  foreach($dataprovinsi as $tiap_provinsi) {
    echo "<option value='" . $tiap_provinsi['name'] . "' id_provinsi='" . $tiap_provinsi['id'] . "'>";
    echo $tiap_provinsi['name'];
    echo "</option>";
  }
}
?>