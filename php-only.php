PHP

<?php

// Variabel
$host = "host";
$user = "username";
$pass = "password";
$db = "nama_database";

// Koneksi ke database MySQL
$mysqli = new mysqli($host, $user, $pass, $db);

// Respon setelah koneksi ke database
if ($mysqli -> connect_errno) {echo "Failed to connect to MySQL: " . $mysqli -> connect_error; exit();}

// Fungsi perhitungan nilai akhir
function NilaiAkhir(int $a, int $b) {
  if (($a>=75)&&($b>=75)) {
    $sum = $a + $b;
    $avg = $sum / 2;
    return round($avg);
  } elseif (($a>=75)||($b>=75)) {
    if ($a>=75) {
      return $avg = $a;
    } elseif ($b>=75) {
      return $avg = $b;
    }
  } elseif ($a && $b < 75) {
    if ($a < $b) {
      return $avg = $a;
    } else {
      return $avg = $b;
    }
  }
}

// Fungsi keterangan nilai akhir
function Keterangan(int $a, int $b) {
  if (($a>=75)&&($b>=75)) {
    return "Sangat Baik (SB)";
  } elseif (($a>=75)||($b>=75)) {
    return "Baik (B)";
  } elseif (($a<75)&&($b<75)) {
    return "Kurang (K)";
  }
}

// Menyeleksi semua kolom pada tabel rapot 
$select = "SELECT * FROM rapot";

// Membentuk query pada tag $select
$result = $mysqli->query($select);

if ($result->num_rows > 0) {
  echo "<table>";
  echo "<tr><th>ID</th><th>Nama</th><th>Matematika</th><th>Fisika</th><th>Nilai Akhir</th><th>Keterangan</th></tr>";

  // Mengeksekusi tabel secara berulang menggunakan array
  while($row = $result->fetch_assoc()) {

    // Eksekusi fungsi nilai akhir dan keterangan
    $NilaiAkhir = NilaiAkhir($row["mtk"], $row["fis"]);
    $Keterangan = Keterangan($row["mtk"], $row["fis"]);

    echo "<tr><th scope='row'>".$row["id"]."</th><td scope='row'>".$row["nama"]."</td><td scope='row'>".$row["mtk"]."</td><td scope='row'>".$row["fis"]."</td><td scope='row'>".$NilaiAkhir."</td><td scope='row'>".$Keterangan."</td></tr>";
  } echo "</table>";

} else {
  echo "<script>alert('TABEL MASIH KOSONG');</script>";
} $mysqli->close(); // Menutup database

?>