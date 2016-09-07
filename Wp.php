<?php
/**
 *
 */
class Wp
{
  private $db;
  function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;dbname=wp', "root", "");
  }

  public function get_data_kriteria(){
    $stmt = $this->db->prepare("SELECT*FROM kriteria ORDER BY id_kriteria");
    $stmt->execute();
		return $this->fetch($stmt);
  }

  public function get_data_alternative(){
    $stmt = $this->db->prepare("SELECT*FROM warung ORDER BY id_warung");
    $stmt->execute();
		return $this->fetch($stmt);
  }

  public function get_data_nilai_id($id){
    $stmt = $this->db->prepare("SELECT*FROM nilai WHERE id_warung='$id' ORDER BY id_kriteria");
    $stmt->execute();
		return $this->fetch($stmt);
  }

  public function fetch($query){
    while ($fetch = $query->fetch(PDO::FETCH_ASSOC)) {
      $data[]= $fetch;
    }
    return $data;
  }

  public function get_data_warung(){
    $stmt = $this->db->prepare("SELECT*FROM warung ORDER BY id_warung");
    $stmt->execute();
		return $this->fetch($stmt);
  }

  public function total_s($bobot_baru){
    $data_warung_array=array();
    $total_s=0;
    $s=1;
      $warung = $this->get_data_warung();
      foreach ($warung as $data_warung) {
     $data_warung_arrays['nama_warung']=$data_warung['nama_warung'];

    $index_bobot=0;
    $index_nilai=0;
    $nilai_s=0;
    $data_nilai_id = $this->get_data_nilai_id($data_warung['id_warung']);
      foreach ($data_nilai_id as $data_nilai) {

       $data_warung_arrays['nilai'] = $data_nilai['nilai'];
       $data_warung_arrays['bobot'] = $bobot_baru[$index_bobot++];
       $pangkat=pow($data_nilai['nilai'],$bobot_baru[$index_nilai++]);
       $data_warung_arrays['pangkat'] = $pangkat;

           if ($nilai_s!=0) {
             $nilai_s=$nilai_s*$pangkat;
           }else{
             $nilai_s=$pangkat;
           }
         }
         array_push($data_warung_array,$data_warung_arrays);

      $total_s=$total_s+$nilai_s;
      }

      return $total_s;
  }



}

 ?>
