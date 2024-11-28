const headers = new Headers();
headers.append('Content-Type', 'application/json');
headers.append('Accept', 'application/json');
headers.append('Authorization', 'Basic ' + btoa(username + ":" + password));
headers.append('Origin', 'http://localhost:3000');

// Fetch data provinsi
fetch("https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json")
    .then(response => response.json())
    .then(data => {
        console.log(data.length);
        for (let i = 0; i < data.length; i++) {
            document.getElementById('provinsi').innerHTML += "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
        }
    });

// Event listener untuk fetch data kabupaten
const xEvent1 = document.getElementById('provinsi');
xEvent1.addEventListener("change", regency);

function regency() {
    const province = xEvent1.value;
    fetch("https://emsifa.github.io/api-wilayah-indonesia/api/regencies/" + province + ".json")
        .then(response => response.json())
        .then(data => {
            console.log(data.length);
            document.getElementById('kabupaten').innerHTML = ""; // Hapus opsi sebelumnya
            for (let i = 0; i < data.length; i++) {
                document.getElementById('kabupaten').innerHTML += "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
            }
        });
}
