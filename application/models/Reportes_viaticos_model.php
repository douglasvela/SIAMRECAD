<?php
class Reportes_viaticos_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
/*
empleados con total de viaticos y pasajes
select sum(ev.viaticos),sum(ev.pasajes)
from vyp_empresas_visitadas as ev
where ev.id_mision_oficial IN (
SELECT mo.id_mision_oficial FROM vyp_mision_oficial AS mo WHERE mo.nr_empleado=2499)
*/

    function obtenerListaviatico($data)
    {
        $nr = $data['nr'];
        $viaticos = $this->db->query("SELECT * FROM `vyp_mision_oficial` WHERE `nr_empleado`='$nr' and ( `estado` = 'revision' or `estado` = 'incompleta'  or `estado` = 'sin procesar' )");
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
        $viaticos = $this->db->get('org_usuario');
        return $viaticos;
    }
}
?>
