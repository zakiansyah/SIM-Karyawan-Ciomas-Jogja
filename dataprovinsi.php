<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.rajaongkir.com/starter/province', // Hapus tanda kutip ganda ekstra
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'key: a57a1ac3fa364e3d6383d2ae79f2ffde'
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $array_response = json_decode($response, TRUE);
  // Sesuaikan dengan struktur JSON yang benar
  $dataprovinsi = $array_response['rajaongkir']['results'];

  echo "<option value=''>Pilih Provinsi</option>";

  // Jika mengambil satu provinsi
  if (isset($dataprovinsi['province_id'])) {
    echo "<option value='" . $dataprovinsi['province'] . "' id_provinsi='" . $dataprovinsi['province_id'] . "'>";
    echo $dataprovinsi['province'];
    echo "</option>";
  } 
  // Jika mengambil semua provinsi (akan berbentuk array)
  else if (is_array($dataprovinsi)) {
    foreach($dataprovinsi as $tiap_provinsi) {
      echo "<option value='" . $tiap_provinsi['province'] . "' id_provinsi='" . $tiap_provinsi['province_id'] . "'>";
      echo $tiap_provinsi['province'];
      echo "</option>";
    }
  }
}
?>