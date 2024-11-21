<?php
$id_provinsi_terpilih = $_POST['id_provinsi'] ?? null;

if (!$id_provinsi_terpilih) {
    echo "<option value=''>Provinsi tidak dipilih</option>";
    exit();
}

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.binderbyte.com/wilayah/kabupaten?api_key=d9c4a1cc88cfd3ab49398e355f14b18e80edb2bc68a7355cbba9ce2307389e8f&id_provinsi=' . $id_provinsi_terpilih,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'key: d9c4a1cc88cfd3ab49398e355f14b18e80edb2bc68a7355cbba9ce2307389e8f',
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "<option value=''>cURL Error: " . htmlspecialchars($err) . "</option>";
    exit();
}

$array_response = json_decode($response, TRUE);

// Cek apakah respons berhasil
if (isset($array_response['code']) && $array_response['code'] === "200") {
    $datakabupaten = $array_response['value'];

    echo "<option value=''>Pilih Kabupaten/Kota</option>";

    foreach ($datakabupaten as $tiap_kabupaten) {
        echo "<option value='" . htmlspecialchars($tiap_kabupaten['id']) . "' id_kabupaten='" . htmlspecialchars($tiap_kabupaten['id']) . "'>";
        echo htmlspecialchars($tiap_kabupaten['name']);
        echo "</option>";
    }
} else {
    // Respons gagal
    echo "<option value=''>Error: Gagal mengambil data kabupaten</option>";
}
?>