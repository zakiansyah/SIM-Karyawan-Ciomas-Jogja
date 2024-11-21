<?php
$id_provinsi_terpilih = $_POST['id_kecamatan'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.binderbyte.com/wilayah/kelurahan?api_key=d9c4a1cc88cfd3ab49398e355f14b18e80edb2bc68a7355cbba9ce2307389e8f&id_kecamatan='.$id_provinsi_terpilih,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    'key:d9c4a1cc88cfd3ab49398e355f14b18e80edb2bc68a7355cbba9ce2307389e8f'
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $array_response = json_decode($response,TRUE);
  $datakelurahan = $array_response["value"];

 
  echo "<option value=''>Pilih kelurahan/Kota</option>";

  foreach($datakelurahan as $key => $tiap_kelurahan)
  {
      echo "<option value='".$tiap_kelurahan["name"]."'
      id_kelurahan='".$tiap_kelurahan["id"]."'>";
      echo $tiap_kelurahan["name"];
      echo "</option>";

      // echo "<option value='".$tiap_kecamatan["province_id"]."' id_provinsi='".$tiap_kabupaten["province_id"]."'>";
      // echo $tiap_provinsi["province"];
      // echo "</option>";
  }
}
?>