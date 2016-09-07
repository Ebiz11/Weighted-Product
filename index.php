<?php
spl_autoload_register(function($class){
  require_once $class.'.php';
});

$wp = new Wp();
?>

<h2>Kriteria</h2>
 <table border="1" cellspacing="0">
   <tr>
     <th>Id Kriteria</th>
     <th>Nama Kriteria</th>
     <th>Bobot</th>
   </tr>

    <?php
    $kriteria = $wp->get_data_kriteria();
    foreach ($kriteria as $data_kriteria) {
    ?>
   <tr>
     <td>C<?php echo $data_kriteria['id_kriteria']; ?></td>
     <td><?php echo $data_kriteria['nama_kriteria']; ?></td>
     <td><?php echo $data_kriteria['bobot']; ?></td>
   </tr>
   <?php } ?>
 </table>

 <hr>

<!-- Tabel Alternative -->
 <h2>Alternative</h2>
 <table border="1" cellspacing="0" width="200" height="200">
   <tr>
     <th>Id Kriteria</th>
     <th>Nama Kriteria</th>
   </tr>

  <?php
  $warung = $wp->get_data_alternative();
  foreach ($warung as $data_warung) {
  ?>
   <tr>
     <td>R<?php echo $data_warung['id_warung']; ?></td>
     <td><?php echo $data_warung['nama_warung']; ?></td>
   </tr>
   <?php } ?>
 </table>
 <hr>

 <h2>Alternative Kriteria</h2>
 <table border="1" cellspacing="0">
   <tr>
     <?php
     $kriteria = $wp->get_data_kriteria();
     $jum=count($kriteria);
     ?>
     <th rowspan="2">Alternative</th>
     <th colspan="<?php echo $jum ?>">Kriteria</th>
   </tr>
   <tr>
     <?php
     foreach ($kriteria as $krit) {
       ?>
     <th>C<?php echo $krit['id_kriteria']; ?></th>
     <?php } ?>
   </tr>

    <?php
    $alternative = $wp->get_data_alternative();
    foreach ($alternative as $alternative_nilai) {
    ?>

    <tr>
      <th>R<?php echo $alternative_nilai['id_warung']; ?></th>
      <?php
      $alternative_nilai_id = $wp->get_data_nilai_id($alternative_nilai['id_warung']);
      foreach ($alternative_nilai_id as $data_nilai_id) {
      ?>
    <td><center><?php echo $data_nilai_id['nilai']; ?></center></td>
    <?php } ?>
    </tr>
    <?php }  ?>
 </table>
<hr>

<h2>Bobot</h2>
<table border="1" cellspacing="0">
  <tr>

  <?php
    $bobot_array=array();
    $total_bobot="";
    $kriteria = $wp->get_data_kriteria();
    foreach ($kriteria as $data_kriteria) {
    ?>

      <td>W<?php echo $data_kriteria['id_kriteria']; ?></td>
      <?php
        if ($data_kriteria['jenis']=="cost") {
          $bobot['bobot']=-$data_kriteria['bobot'];
        }else {
          $bobot['bobot']=$data_kriteria['bobot'];
        }
      $bobot['id_kriteria']=$data_kriteria['id_kriteria'];
      array_push($bobot_array,$bobot);
      $total_bobot=$total_bobot+$data_kriteria['bobot'];
      ?>
    <?php } ?>
  </tr>

    <?php
    $bobot_baru_array= array();
    foreach ($bobot_array as $bobot) {
      $perbaikan_bobot = number_format($bobot['bobot']/$total_bobot,2);
      $bobot_baru_array[] = $perbaikan_bobot;
    ?>
   <td>
     <?php echo $perbaikan_bobot; ?>
   </td>
   <?php } ?>
</table>

<hr>
                                                                      <!-- Tabel Pangkat -->
<h2>Perhitungan</h2>
<?php $peringkat=array(); ?>
<table border="1" cellspacing="0" width="1200" height="100">
  <tr>
    <th>Nama</th>
    <th>Nilai</th>
    <th>Bobot</th>
    <th>Pangkat</th>
    <th>S</th>
    <th>V</th>
  </tr>

  <?php
  $warung = $wp->get_data_warung();
  foreach ($warung as $data_warung) {
  ?>

  <tr>
    <td rowspan="7"><?php echo $data_warung['nama_warung']; ?></td>
  </tr>

  <?php
  $index_bobot=0;
  $index=0;
  $nilai_s=0;
  $data_nilai_id = $wp->get_data_nilai_id($data_warung['id_warung']);
  foreach ($data_nilai_id as $data_nilai) {
     ?>
     <tr>
       <td><?php echo $data_nilai['nilai']; ?></td>
       <td><?php echo $bobot_baru_array[$index_bobot++]; ?></td>
       <td>
         <?php
         $pangkat=pow($data_nilai['nilai'],$bobot_baru_array[$index++]);
         echo number_format($pangkat,2);

         if ($nilai_s!=0) {
           $nilai_s=$nilai_s*$pangkat;
         }else{
           $nilai_s=$pangkat;
         }
         ?>
       </td>
    <?php } ?>
    <td>
      <?php
        echo $nilai_s;
      ?>
    </td>
    <td>
      <?php
      $total_s=$wp->total_s($bobot_baru_array);
      echo $nilai_v=$nilai_s/$total_s;
      $peringkats['nilai']=$nilai_v;
      $peringkats['id_warung']=$data_warung['id_warung'];
      $peringkats['nama_warung']=$data_warung['nama_warung'];
      array_push($peringkat,$peringkats);
      ?>
    </td>
     <?php } ?>
   </tr>
</table>

<hr>
<h2>Peringkat</h2>
<table border="1" cellspacing="0">
  <tr>
    <th>Ranking</th>
    <th>Nama Warung</th>
    <th>Nilai</th>
  </tr>

  <?php
rsort($peringkat);
$no=1;
  foreach ($peringkat as $ranking) { ?>

  <tr>
    <td>
      <?php echo $no++ ?>
    </td>
    <td><?php echo $ranking['nama_warung']; ?></td>
    <td><?php echo $ranking['nilai']; ?></td>
  </tr>
  <?php } ?>
</table>

<hr>

<h1>ALTERNATIVE TERBAIK</h1>
<?php print_r(max($peringkat));
?>
<br><br><br><br>
