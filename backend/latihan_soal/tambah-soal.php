<?php
    require_once '../config.php';
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: logres.php");
    }
    $id = $_GET['id'];
    $mapel = $_GET['kategori'];
    $query = "SELECT * FROM kategori WHERE id_mapel = $mapel";
    $result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Latihan Soal</title>

    <link rel="stylesheet" href="tambah-soal.css" />

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
            <a class="menuLatihan" href=""></a>
            <a class="menuKumpulan" href=""></a>
        </div>
        <div class="btnAwal">
            <!-- Buat nama user --><a class="user" href="">Halo, <?php echo $_SESSION['username'] ?></a>
        </div>
    </nav>
  
    <div class="heading">
        <a href="draft_quiz.php?id=<?php echo $id ?>"><img src="../icon/back.svg" alt=""></a>
        <a href="draft_quiz.phpid=<?php echo $id ?>">Back</a>
    </div>

    <div class="main">
        <span>Tambah Soal</span>
        <form action="proses_soal.php" method="post">
            <table>
                <tr>
                    <td>Kesulitan</td>
                    <td>:</td>
                    <td>
                        <label for="kesulitan"></label>
                        <select class="kesulitan" name="kesulitan" id="kesulitan">
                            <option value="mudah">Mudah</option>
                            <option value="sulit">Sulit</option>
                        </select>
                    </td>
                </tr>

                <tr><td></td></tr>

                <tr>
                    <!-- MAPEL -->
                    <td>Kategori</td>
                    <td>:</td>
                    <td>
                        <label for="kategori"></label>
                        <select class="kategori" name="kategori" id="kategori">
                            <?php
                                while($row = mysqli_fetch_assoc($result)){
                                    echo "<option value=".$row['id']."";
                                    if($row['id'] == $id){
                                        echo " selected";
                                    }
                                    echo ">".$row['kategori']."</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr><td></td></tr>

                <tr>
                    <td>Pertanyaan</td>
                    <td>:</td>
                    <td>
                        <label for="pertanyaan"></label>
                        <textarea class="pertanyaan" name="pertanyaan" rows="4" placeholder="ketik pertanyaan..."></textarea>
                    </td>
                </tr>

                <tr><td></td></tr>

                <tr>
                    <!-- OPSI PILGAN -->
                    <td>Opsi</td>
                    <td>:</td>
                    <td>
                        <label for="opsi1"></label>
                        <input class="opsi" type="text" name="jawaban" placeholder="Masukkan jawaban disini"><br>

                        <label for="opsi2"></label>
                        <input class="opsi" type="text" name="opsi2" placeholder="Masukkan pilihan lain"><br>

                        <label for="opsi3"></label>
                        <input class="opsi" type="text" name="opsi3" placeholder="Masukkan pilihan lain"><br>

                        <label for="opsi4"></label>
                        <input class="opsi" type="text" name="opsi4" placeholder="Masukkan pilihan lain">
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value = <?php echo $id ?>>
                        <input type="hidden" name="mapel" value = <?php echo $mapel ?>>
                    </td>
                    <td></td>
                    <td>
                        <!-- CANCEL tambah soal -->
                        <label for="cancel"></label>
                        <input class="cancel" type="submit" name="cancel" value="Cancel">

                        <!-- SUBMIT tambah soal -->
                        <label for="submit"></label>
                        <input class="submit" type="submit" name="submit" value="Submit">
                </td>
                </tr>
            </table>
        </form>
    </div>

    <!-- FOOTER -->
    <footer>
        <p class="copyRight">&copy; 2023, SoalPedia</p>
    </footer>
</body>
</html>