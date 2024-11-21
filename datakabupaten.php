<?php
$id_provinsi_terpilih = $_POST['id_provinsi'] ?? null;

if (!$id_provinsi_terpilih) {
    echo "<option value=''>Provinsi tidak dipilih</option>";
    exit();
}

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.rajaongkir.com/starter/city?province=' . $id_provinsi_terpilih,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'key: a57a1ac3fa364e3d6383d2ae79f2ffde',
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

// Cek apakah status respons berhasil
if (isset($array_response['rajaongkir']['status']['code'])) {
    $status_code = $array_response['rajaongkir']['status']['code'];
    $status_description = $array_response['rajaongkir']['status']['description'];

    if ($status_code === 200) {
        // Respons berhasil, tampilkan data kabupaten/kota
        $datakabupaten = $array_response['rajaongkir']['results'];

        echo "<option value=''>Pilih Kabupaten/Kota</option>";

        if (is_array($datakabupaten)) {
            foreach ($datakabupaten as $tiap_kabupaten) {
                echo "<option value='" . htmlspecialchars($tiap_kabupaten['city_id']) . "'>";
                echo htmlspecialchars($tiap_kabupaten['city_name']);
                echo "</option>";
            }
        } else {
            // Jika hanya ada satu kabupaten
            echo "<option value='" . htmlspecialchars($datakabupaten['city_id']) . "'>";
            echo htmlspecialchars($datakabupaten['city_name']);
            echo "</option>";
        }
    } else {
        // Respons gagal dengan deskripsi status
        echo "<option value=''>Error: " . htmlspecialchars($status_description) . "</option>";
    }
} else {
    echo "<option value=''>Format respons tidak valid</option>";
}
?>
