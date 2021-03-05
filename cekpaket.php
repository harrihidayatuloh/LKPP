<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cek Resi LKPP">
    <meta name="author" content="Harri Hidayatuloh">
    <meta name="keywords" content="cek resi">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- My CSS -->
    <link rel="stylesheet" href="css/style.css">

    <link rel="icon" href="img/PaketKu.png" type="image/gif" sizes="16x16">

    <title>Cek Paket LKPP</title>
  </head>
  <body>
   <div class="container mt-5" id="main">
        <div class="shadow p-3 bg-white rounded"><h3>CEK PAKET</h3>
        <div class="row">
		<br>
            <div class="col-md-4">
            	<input type="text" class="form-control" placeholder="Input Resi Anda ..." id="search-input" autofocus>
            </div>
				<button class="btn btn-primary" name="cek" type="submit" id="search-button">Cari</button>
            </div>
            <div>
       		<input type="radio" id="contactChoice1" name="contact" value="JNE">
    			<label for="contactChoice1">JNE</label>
			<input type="radio" id="contactChoice2" name="contact" value="TIKI">
    			<label for="contactChoice2">TIKI</label>
			<input type="radio" id="contactChoice2" name="contact" value="POS">
    			<label for="contactChoice2">POS</label>
			<input type="radio" id="contactChoice2" name="contact" value="AnterAja">
    			<label for="contactChoice2">AnterAja</label>
			<input type="radio" id="contactChoice2" name="contact" value="SiCepat">
    			<label for="contactChoice2">SiCepat</label>
			<input type="radio" id="contactChoice2" name="contact" value="Ninja">
    			<label for="contactChoice2">Ninja</label>
			<input type="radio" id="contactChoice2" name="contact" value="JNT">
    			<label for="contactChoice2">JNT</label>
         	</div>
        </div>  
        </div>
        <div class="row mt-4">
            <div class="col-md-10 info">
                
            </div>
        </div>
    </div>
	<div class="col-lg-8">
    <?php  
     if (isset($_POST['cek'])) 
     {
      $resi = isset($_POST['resi'])?$_POST['resi']:"";
      $jasa = isset($_POST['jasa'])?$_POST['jasa']:"";

      $konten = file_get_contents("http://ibacor.com/api/cek-resi?pengirim=".$jasa."&resi=".$resi."");

      $result = json_decode($konten, true);

      //ambil data

      //date

      if ($result['status'] == "success") 
      {
       $detail = $result['data']['detail'];
       $riwayat = $result['data']['riwayat'];

      ?>
      <div class="panel panel-info">
       <div class="panel-heading">Hasil Pencarian Nomor Resi Anda</div>
       <div class="panel-body">
        <legend>Detail </legend>
        <table class="table table-striped">
         <tr>
          <td width="170"><label for="" class="control-label">Nomor Resi</label> </td>
          <td width="10">:</td>
          <td><?php echo $detail['no_resi'] ?></td>
         </tr>
			
		<?php if ($jasa != "pos"): ?>
          <tr>
           <td width="50"><label for="" class="control-label">Tanggal Pengiriman</label></td>
           <td width="10">:</td>
           <td>
           <?php if ($jasa == "jne"): ?>
           <?php echo $detail['tanggal'] ?>
           <?php else: ?>
           <?php echo $detail['tanggal'] ?> 
           <?php endif ?>
           </td>
          </tr>
         <?php endif ?>
 
         <legend>Asal & Tujuan</legend>
        	<table class="table table-bordered">
         <thead>
          <tr>
           <th>Pengirim</th>
           <th>Penerima</th>
          </tr>
         </thead>
         <tbody>
          <tr>
           <td>
            <?php if ($jasa == "jne" || $jasa == "pos"): ?>
             Nama :  <?php echo $detail['asal']['nama'] ?><br>
             Dari : <?php echo $detail['asal']['alamat'] ?>
            <?php else: ?>
             Dari : <?php echo $detail['asal']['alamat'] ?>
            <?php endif ?><br>
           </td>
           <td>
            <?php if ($jasa == "jne" || $jasa == "pos"): ?>
             Nama :  <?php echo $detail['tujuan']['nama'] ?><br>
             Dari : <?php echo $detail['tujuan']['alamat'] ?>
            <?php else: ?>
             Dari : <?php echo $detail['tujuan']['alamat'] ?>
            <?php endif ?><br>
           </td>
          </tr>
         </tbody>
        </table>
			
        <legend>Detail Pengiminan</legend>
        <table class="table table-bordered">
         <thead>
          <tr>
           <th>Tanggal/Waktu</th>
           <th>Deskripsi</th>
          </tr>
         </thead>
         <tbody>
          <?php  
           for ($i=0; $i < count($riwayat) ; $i++) 
           { 
            ?>
            <tr>
             <td>
              <?php  
               if ($jasa == "JNE") 
               {
                echo $riwayat[$i]['taggal']." ".$riwayat[$i]['waktu'];
               }
               else
               {
                echo $riwayat[$i]['taggal'];
               }
              ?>
             </td>
			<td>
              <?php  
               if ($jasa == "TIKI") 
               {
                echo $riwayat[$i]['taggal']." ".$riwayat[$i]['waktu'];
               }
               else
               {
                echo $riwayat[$i]['taggal'];
               }
              ?>
             </td>
			<td>
              <?php  
               if ($jasa == "POS") 
               {
                echo $riwayat[$i]['taggal']." ".$riwayat[$i]['waktu'];
               }
               else
               {
                echo $riwayat[$i]['taggal'];
               }
              ?>
             </td>
			<td>
              <?php  
               if ($jasa == "SiCepat") 
               {
                echo $riwayat[$i]['taggal']." ".$riwayat[$i]['waktu'];
               }
               else
               {
                echo $riwayat[$i]['AnterAja'];
               }
              ?>
             </td>
			<td>
              <?php  
               if ($jasa == "Ninja") 
               {
                echo $riwayat[$i]['taggal']." ".$riwayat[$i]['waktu'];
               }
               else
               {
                echo $riwayat[$i]['taggal'];
               }
              ?>
             </td>
             <td><?php echo $riwayat[$i]['lokasi'] ?></td>
             <td>
              <?php if ($jasa == "JNT"): ?>
               <?php echo $riwayat[$i]['keterangan'] ?>
              <?php else: ?>
               <?php echo $riwayat[$i]['status'] ?>
              <?php endif ?>
             </td>
             <td>
              <?php if ($jasa == "tiki" || $jasa == "pos"): ?>
               <?php echo $riwayat[$i]['keterangan'] ?>
              <?php else: ?>
               <?php echo ""; ?>
              <?php endif ?>
             </td>
            </tr>
            <?php
           }
          ?>
         </tbody>
        </table>
       </div>
      </div>
      <?php
      } else
      {
       echo '<div class="alert alert-danger">Data tidak ditemukan. Pastikan Nomor Resi dan Jasa Pengiriman benar.</div>';
      }
     }
    ?>
   </div>
  </div>  
  </body>
</html>