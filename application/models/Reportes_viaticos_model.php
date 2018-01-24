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
    function obtenerViaticoMayoraMenor($data){
        $anio = $data['anio'];
        $dir = $data['dir'];

        $prueba = $this->db->query("SELECT DISTINCT s4.id_seccion FROM org_seccion as s1 LEFT JOIN org_seccion as s2 ON (s1.id_seccion=s2.depende or s1.id_seccion=s2.id_seccion) LEFT JOIN org_seccion as s3 ON (s2.id_seccion=s3.depende or s2.id_seccion=s3.id_seccion) LEFT JOIN org_seccion as s4 ON (s3.id_seccion=s4.depende or s3.id_seccion=s4.id_seccion) WHERE s1.depende = '$dir'");

        if($prueba->num_rows()>0){
          $viaticos1= $this->db->query("SELECT mo.nr_empleado, mo.nombre_completo, SUM(em.pasajes) AS pasajes, SUM(em.viaticos) AS viaticos,(SUM(em.pasajes) + SUM(em.viaticos)) AS total FROM vyp_mision_oficial AS mo INNER JOIN vyp_empresas_visitadas AS em INNER JOIN org_usuario as u   WHERE mo.id_mision_oficial = em.id_mision_oficial AND YEAR(mo.fecha_mision) = '$anio' AND mo.nr_empleado=u.nr AND u.id_seccion IN (SELECT DISTINCT s4.id_seccion FROM org_seccion as s1 LEFT JOIN org_seccion as s2 ON (s1.id_seccion=s2.depende or s1.id_seccion=s2.id_seccion) LEFT JOIN org_seccion as s3 ON (s2.id_seccion=s3.depende or s2.id_seccion=s3.id_seccion) LEFT JOIN org_seccion as s4 ON (s3.id_seccion=s4.depende or s3.id_seccion=s4.id_seccion) WHERE s1.depende = '$dir')  GROUP BY mo.nr_empleado ORDER BY total DESC");
        }else{
          $viaticos1= $this->db->query("SELECT mo.nr_empleado, mo.nombre_completo, SUM(em.pasajes) AS pasajes, SUM(em.viaticos) AS viaticos,(SUM(em.pasajes) + SUM(em.viaticos)) AS total FROM vyp_mision_oficial AS mo INNER JOIN vyp_empresas_visitadas AS em INNER JOIN org_usuario as u   WHERE mo.id_mision_oficial = em.id_mision_oficial AND YEAR(mo.fecha_mision) = '$anio' AND mo.nr_empleado=u.nr AND u.id_seccion = '$dir'  GROUP BY mo.nr_empleado ORDER BY total DESC");
        }
        return $viaticos1;
    }
    function obtenerNombreSeccion($data){
      $this->db->where("id_seccion",$data["dir"]);
      $seccion = $this->db->get('org_seccion');
      return $seccion;
    }
    function obtenerViaticosPorPeriodo($data){
      $anio=$data['anio'];

      $viaticos= $this->db->query("SELECT month(mo.fecha_mision) as mes,sum(ev.pasajes) as pasajes,sum(ev.viaticos) as viaticos,sum(ev.viaticos)+sum(ev.pasajes) as total FROM vyp_mision_oficial as mo INNER JOIN vyp_empresas_visitadas as ev ON ev.id_mision_oficial=mo.id_mision_oficial WHERE year(mo.fecha_mision)='$anio' and month(mo.fecha_mision) IN (1,2,3) GROUP by month(mo.fecha_mision)");
      return $viaticos;
    }
}
/*

CONSULTA TERMINADA
SELECT DISTINCT s4.id_seccion,s4.nombre_seccion,s4.depende FROM org_seccion as s1 LEFT JOIN org_seccion as s2 ON (s1.id_seccion=s2.depende or s1.id_seccion=s2.id_seccion) LEFT JOIN org_seccion as s3 ON (s2.id_seccion=s3.depende or s2.id_seccion=s3.id_seccion) LEFT JOIN org_seccion as s4 ON (s3.id_seccion=s4.depende or s3.id_seccion=s4.id_seccion) WHERE s1.depende='36'

consulta anidada
SELECT distinct t2.nombre_seccion AS DESCRIPCION, t2.id_seccion
  FROM org_seccion as t1
LEFT JOIN org_seccion AS t2 ON (t2.depende = t1.id_seccion OR t1.id_seccion = t2.id_seccion )
ORDER BY t1.depende ASC, t1.id_seccion ASC, t2.id_seccion ASC, t2.depende ASC

segunda consulta anidada
SELECT distinct t2.id_seccion ,t2.nombre_seccion FROM org_seccion as t1 LEFT JOIN org_seccion AS t2 ON (t2.depende = '34' OR t1.id_seccion = '34' ) ORDER BY t1.depende ASC, t1.id_seccion ASC, t2.id_seccion ASC, t2.depende ASC


consulta todas oficinas
SELECT mo.nr_empleado, mo.nombre_completo, SUM(em.pasajes) AS pasajes, SUM(em.viaticos) AS viaticos,(SUM(em.pasajes) + SUM(em.viaticos)) AS total,u.nombre_completo,u.id_seccion FROM vyp_mision_oficial AS mo INNER JOIN vyp_empresas_visitadas AS em INNER JOIN org_usuario as u   WHERE mo.id_mision_oficial = em.id_mision_oficial AND YEAR(mo.fecha_mision) = '2018' AND mo.nr_empleado=u.nr AND u.id_seccion  GROUP BY mo.nr_empleado ORDER BY total DESC

consulta ordenada
select s1.id_seccion,s2.id_seccion,s3.id_seccion,s4.id_seccion, s5.id_seccion from org_seccion s1 LEFT JOIN org_seccion as s2 ON s2.id_seccion=s1.depende LEFT JOIN org_seccion as s3 ON s3.id_seccion=s2.depende
LEFT JOIN org_seccion as s4 ON s4.id_seccion=s3.depende
LEFT JOIN org_seccion as s5 ON s5.id_seccion=s4.depende
ORDER BY `s5`.`id_seccion`  DESC,
 `s4`.`id_seccion`  DESC,
 `s3`.`id_seccion`  DESC,
 `s2`.`id_seccion`  DESC,
 `s1`.`id_seccion`  DESC


 consulta por peridodo
 SELECT month(mo.fecha_mision),sum(ev.pasajes),sum(ev.viaticos),sum(ev.viaticos)+sum(ev.pasajes) FROM vyp_mision_oficial as mo INNER JOIN vyp_empresas_visitadas as ev ON ev.id_mision_oficial=mo.id_mision_oficial WHERE year(mo.fecha_mision)='2018' and month(mo.fecha_mision) IN (1,2,3) GROUP by month(mo.fecha_mision)
*/
?>
