<?php
class Reportes_viaticos_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


    function obtenerListaviatico($data)
    {
        $this->db->where("nr_empleado",$data['nr']);
        $this->db->where("estado","revision");
        $this->db->or_where("estado","incompleto");
        $viaticos = $this->db->get('vyp_mision_oficial');
        return $viaticos;
    }
    function obtenerListaviaticoPagado($data){
      $this->db->where("nr_empleado",$data['nr']);
      $this->db->where("estado","pagado");
      $this->db->where("fecha_mision >=",date("Y-m-d",strtotime($data['fmin'])));
      $this->db->where("fecha_mision <=",date("Y-m-d",strtotime($data['fmax'])));
      $viaticos = $this->db->get('vyp_mision_oficial');
      return $viaticos;
    }
    function obtenerDetalle($data){
      $this->db->where("id_mision_oficial",$data["id_mision_oficial"]);
      $this->db->order_by("orden", "asc");
      $viaticos = $this->db->get('vyp_empresas_visitadas');
      return $viaticos;
    }
    function obtenerEmpleadoViatico()
    {
        $viaticos = $this->db->get('vyp_mision_oficial');
        return $viaticos;
    }
    function obtenerNREmpleadoViatico($data)
    {
        $this->db->where("nr",$data["nr"]);
        $this->db->limit(1);
        $viaticos = $this->db->get('sir_empleado');
        return $viaticos;
    }
}
?>
