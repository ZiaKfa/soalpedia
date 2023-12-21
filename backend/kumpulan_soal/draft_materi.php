<?php
  require_once "../config.php";
  session_start();
  if(!isset($_SESSION['login'])){
    header("Location: ../logres.php");
  }
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM kategori WHERE id_mapel = $id";
    $kategori = mysqli_query($mysqli, $query);
  } else {
    $query = "SELECT * FROM kategori";
    $kategori = mysqli_query($mysqli, $query);
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Draft Soal Quiz</title>

    <link rel="stylesheet" href="draftMateri.css" />

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
  </head>
  
  <body>
    <nav class="header">
      <div class="logo1">
        <img class="logoAwal" src="../gambar/logo2.svg" alt="SoalPedia" />
      </div>
      <div class="menuAwal">
        <!-- Menu Latihan dan Kumpulan -->
        <a class="menuLatihan" href="../latihan_soal/draft_quiz.html">Latihan Soal</a>
        <a class="menuKumpulan" href="draft_materi.php?id=<?php echo $id ?>">Kumpulan Soal</a>
      </div>
      <div class="btnAwal">
        <!-- Buat nama user --><a class="btnMasuk" href="">Halo, <?php echo $_SESSION['username'] ?></a>
        <!-- Tombol Logout --><a class="btnDaftar" href="../logout.php">Keluar</a>
      </div>
    </nav>

    <div class="heading">
      <a href="../mapel/mapel.php"><img src="../icon/back.svg" alt=""></a>
      <a href="../mapel/mapel.php">Back</a>
    </div>

    <center>
      <div class="main">
        <!-- Nama Mapel -->
          <div class="namaMapel">
            <?php if(isset($_GET['id'])) : ?>
              <?php
                $id = $_GET['id'];
                $query = "SELECT * FROM mapel WHERE id = $id";
                $result = mysqli_query($mysqli, $query);
                $row = mysqli_fetch_assoc($result);
              ?>
              <p><?php echo $row['pelajaran'] ?></p>
            <?php else : ?>
              <p>Semua Materi</p>
            <?php endif ?>
          </div>
  
        <!-- Dropdown Pilih Kelas buat User Guru,Admin,Siswa,Editor -->
        <div class="dropdown">
          <button>Pilih Kelas</button>
          <div class="dropdown-content">
            <a href="#">Kelas 12</a>
            <a href="#">Kelas 11</a>
            <a href="#">Kelas 10</a>
          </div>
        </div>
  
        <!-- Menu Tambah Soal hanya bisa buat User Guru dan Admin -->
        <?php if ($_SESSION['role'] == 'guru' || $_SESSION['role'] == 'admin') : ?>
        <div class="tambahSoal">
          <a class="add" href=""><img src="../icon/add.svg" alt=""></a>
          <a class="tambah" href="">Tambah Soal</a>
        </div>
        <?php endif ?>
  
        <!-- Searching -->
          <div class="search">
              <label for="search"></label>
              <input type="text" name="search" placeholder="Cari...">
          </div>
      </div>
      </center>
      <?php 
        while($row = mysqli_fetch_assoc($kategori)){
          echo "<div class='draft'>";
          echo "<div class='draftMapel'>";
          echo "<div class='listMapel'>";
          echo "<img src='../gambar/materi.svg' alt=''>";
          echo "<a class='mapel-1' href='download_materi.php?id=".$row['id']."'>".$row['kategori']."</a>";
          echo "</div>";
          if ($_SESSION['role'] == 'guru' || $_SESSION['role'] == 'admin' || $_SESSION['role'] == 'editor'){
            echo "<div class='icon'>";
            echo "<a class='edit' href=''><img src='../icon/edit.svg' alt=''></a>";
            echo "<a class='trash' href=''><img src='../icon/trash.svg' alt=''></a>";
            echo "</div>";
          }
          echo "</div>";
          echo "</div>";
        }
      ?>
    <!-- <div class="draft">
        <div class="draftMapel">
            List Materi
            <div class="listMapel">
              <img src="../gambar/materi.svg" alt="">
              <a class="mapel-1" href="download_materi.html">Kumpulan Soal UTS Semester 1</a>
            </div>

            Tombol
            <div class="icon">
              Tombol Edit dan Hapus buat User Guru,Admin
              <a class="edit" href=""><img src="../icon/edit.svg" alt=""></a>
              <a class="trash" href=""><img src="../icon/trash.svg" alt=""></a>
            </div>
        </div>
    </div> -->

    <!-- FOOTER -->
    <footer>
        <p class="copyRight">&copy; 2023, SoalPedia</p>
    </footer>
  </body>
</html>