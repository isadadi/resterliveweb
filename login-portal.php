<?php

  include("../config.php");

  $username = $_POST['username'];

  if(strlen($username) == 9)
  {
    //fopen("cookie.txt", "w+");

    $curl = curl_init();
    $url["login"] = "https://portal.usu.ac.id/login/proses_login.php";
    $url["khs"] = "https://portal.usu.ac.id/informasi_hasil_studi/tampil.php";
    $cookie = "cookie.txt";

    $data = [
      'username' => $username,
      'password' => $_POST['password']
    ];

    $data = http_build_query($data);

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, $url["login"] );
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_COOKIEJAR, realpath($cookie));

    $html = curl_exec($curl);
    $pattern = '/<div.+?id="member-info">.+<h3>([\S\s]+)<\/h3>.+<h4>([\d]+)<\/h4>.+<h4>([\S\s]+)<\/h4>.+/s';
    preg_match($pattern, $html, $login);

    if(empty($login))
    {
      header("location:../index.php?error=login_gagal");
      die;
    }

    curl_setopt($curl, CURLOPT_URL, $url['khs']);
    $html = curl_exec($curl);

    preg_match_all('/\<option.+?\"(.+)\".+?\<\/option\>/', $html, $semester);
    $data = http_build_query(['semester' => $semester[1][count($semester[1]) - 2]]);

    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    $html = curl_exec($curl);

    preg_match_all('/\<td.+width="10%".?(.+)?<\/td>/', $html, $matkul);
    preg_match_all('/\<td.+width="22%".?(.+)?<\/td>/', $html, $kom);

    if(session_status() == PHP_SESSION_NONE)
      session_start();
    $_SESSION['username']=$login[2];
    $password = $_POST['password'];
    $pass = md5($password);
    $_SESSION['pass']=$pass;

    $sqlmhs = mysqli_query($connect, "select nama, nim, password, jurusan from mahasiswa where nim='$login[2]'");
  	$hslmhs = mysqli_num_rows($sqlmhs);

    if ($hslmhs==0)
    {
      $query = mysqli_query($connect, "INSERT INTO mahasiswa values ('$login[2]', \"$pass\", '$login[1]', '$login[3]', '')");

      for($i = 0; $i < count($matkul[1]); $i++)
      {
        $kode_matkul = $matkul[1][$i];
        $kelas = $kom[1][$i];
        $query1 = mysqli_query($connect, "INSERT INTO krs values ('$login[2]', '$kode_matkul', '$kelas')");
      }
    }

    else
    {
      $query = mysqli_query($connect, "UPDATE mahasiswa SET nama = '$login[1]' WHERE nim = '$login[2]'");
      $query1 = mysqli_query($connect, "DELETE FROM krs WHERE nim = '$login[2]'");

      for($i = 0; $i < count($matkul[1]); $i++)
      {
        $kode_matkul = $matkul[1][$i];
        $kelas = $kom[1][$i];
        $query2 = mysqli_query($connect, "INSERT INTO krs values ('$login[2]', '$kode_matkul', '$kelas')");
      }
    }

  }


  else
  {
    /*//fopen("cookie.txt", "w+");

    $curl = curl_init();
    $url["login"] = "https://portal.usu.ac.id/login/proses_login.php";
    $url["info_matkul"] = "https://portal.usu.ac.id/matakuliah_diampu/tampil.php";
    $cookie = "cookie.txt";

    $data = [
      'username' => $username,
      'password' => $_POST['password']
    ];

    $data = http_build_query($data);

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, $url["login"] );
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_COOKIEJAR, realpath($cookie));

    $html = curl_exec($curl);
    $pattern = '/<div.+?id="member-info">.+<h3>([\S\s]+)<\/h3>.+<h4>([\d]+)<\/h4>.+<h4>([\S\s]+)<\/h4>.+/s';
    preg_match($pattern, $html, $login);

    if(empty($login))
    {
      header("location:../index.php?error=login_gagal");
      die;
    }

    curl_setopt($curl, CURLOPT_URL, $url['info_matkul']);
    $html = curl_exec($curl);

    preg_match_all('/\<td.+width="56%".?(.+)?\-.+<\/td>/', $html, $matkul);
    preg_match_all('/\<td.+width="15%".+".?(.+)?<\/a><\/td>/', $html, $kom);

    if(session_status() == PHP_SESSION_NONE)
      session_start();
    $_SESSION['username']=$login[2];
    $password = $_POST['password'];
    $pass = md5($password);
    $_SESSION['pass']=$pass;

    $query = mysqli_query($connect, "INSERT INTO dosen values ('$login[2]', \"$pass\", '$login[1]', '$login[3]')");

    for($i = 0; $i < count($matkul[1]); $i++)
    {
      $kode_matkul = $matkul[1][$i];
      $kelas = $kom[1][$i];
      $query1 = mysqli_query($connect, "INSERT INTO info_matkul values ('$login[2]', '$kode_matkul', '$kelas')");
    }*/

    if(session_status() == PHP_SESSION_NONE)
      session_start();
    $_SESSION['username']=$username;
    $password = $_POST['password'];
    $pass = md5($password);
    $_SESSION['pass']=$pass;
  }

  header("location:login.php");
?>
