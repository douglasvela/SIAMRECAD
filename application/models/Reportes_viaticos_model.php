<?php
class Reportes_viaticos_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


    function obtenerListaviatico()
    {
        $viaticos = $this->db->get('vyp_mision_oficial');
        return $viaticos;
    }
    function obtenerDetalle($data){
      $this->db->where("id_mision_oficial",$data["id_mision_oficial"]);
      $this->db->order_by("orden", "asc");
      $viaticos = $this->db->get('vyp_empresas_visitadas');
      return $viaticos;
    }
}
?>
