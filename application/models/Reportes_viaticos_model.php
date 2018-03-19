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
    function obtenerViaticoAnualxDepto($data){
      
        $viaticos = $this->db->query("SELECT i.id_oficina_departamental as id_depto, o.id_departamento, depto.departamento ,m.id_mision_oficial,SUM(ev.viatico) AS viatico, SUM(ev.pasaje) AS pasaje, SUM(ev.alojamiento) AS alojamiento, (SUM(ev.viatico)+SUM(ev.pasaje)+SUM(ev.alojamiento)) as total FROM vyp_mision_oficial AS m JOIN vyp_informacion_empleado AS i ON m.nr_empleado = i.nr JOIN vyp_oficinas AS o ON o.id_oficina = i.id_oficina_departamental JOIN vyp_empresa_viatico AS ev ON ev.id_mision = m.id_mision_oficial JOIN org_departamento as depto ON depto.id_departamento=o.id_departamento WHERE year(m.fecha_solicitud)='$data' GROUP BY i.id_oficina_departamental ORDER BY SUM(ev.viatico) DESC");
        return $viaticos;
    }
    function obtenerViaticoAnual($data)
    {
      $anios = implode(",", $data);//de array a cadena
        $viaticos = $this->db->query("SELECT year(fecha) as anio,sum(`viatico`) as viatico,sum(pasaje) as pasaje,sum(alojamiento) as alojamiento, (sum(`viatico`) + sum(pasaje) + sum(alojamiento)) as total_anio FROM `vyp_empresa_viatico` WHERE YEAR(fecha) IN ($anios)  group by year(`fecha`) order by year(fecha) desc");
        return $viaticos;
    }
    function obtenerListaviatico_pendiente($data)
    {
        $nr = $data['nr'];
        $viaticos = $this->db->query("SELECT * FROM `vyp_mision_oficial` WHERE `nr_empleado`='$nr' and ( `estado` between '0' and '6')");
        return $viaticos;
    }
    function obtenerDetalleActividad($data)
    {
        $id_detalle_actividad = $data;
        $detalle_actividad = $this->db->query("SELECT * FROM `vyp_actividades` WHERE `id_vyp_actividades`='$id_detalle_actividad'");
        return $detalle_actividad;
    }
    function obtenerDetalleEstado($data)
    {
        $id_estado = $data;
        $detalle_actividad = $this->db->query("SELECT * FROM `vyp_estado_solicitud` WHERE `id_estado_solicitud`='$id_estado'");
        return $detalle_actividad;
    }
    function obtenerTotalMontos($data)
    {
        $id_mision_oficial = $data;
        $detalle = $this->db->query("SELECT sum(`viatico`) as viatico,sum(`pasaje`) as pasaje,sum(`alojamiento`) as alojamiento FROM `vyp_empresa_viatico` WHERE `id_mision`='$id_mision_oficial'");
        return $detalle;
    }
    function obtenerListaviaticoPagado($data){
      $this->db->where("nr_empleado",$data['nr']);
      $this->db->where("estado","8");
      $this->db->where("fecha_solicitud >=",date("Y-m-d",strtotime($data['fmin'])));
      $this->db->where("fecha_solicitud <=",date("Y-m-d",strtotime($data['fmax'])));
      $viaticos = $this->db->get('vyp_mision_oficial');
      return $viaticos;
    }
    function obtenerDetalle($data){
      $this->db->where("id_mision_oficial",$data["id_mision_oficial"]);
      $this->db->order_by("id_empresas_visitadas", "asc");
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
        $recursividad = $data['recursividad'];

            $prueba = $this->db->query("SELECT DISTINCT s4.id_seccion FROM org_seccion as s1 LEFT JOIN org_seccion as s2 ON (s1.id_seccion=s2.depende or s1.id_seccion=s2.id_seccion) LEFT JOIN org_seccion as s3 ON (s2.id_seccion=s3.depende or s2.id_seccion=s3.id_seccion) LEFT JOIN org_seccion as s4 ON (s3.id_seccion=s4.depende or s3.id_seccion=s4.id_seccion) WHERE s1.depende = '$dir'");

            if($prueba->num_rows()>0){
              if($recursividad=="si"){
                $viaticos1= $this->db->query("SELECT mo.nr_empleado, mo.nombre_completo, SUM(em.pasaje) AS pasajes, SUM(em.viatico) AS viaticos, sum(em.alojamiento) as alojamientos,(SUM(em.pasaje) + SUM(em.viatico) + sum(em.alojamiento)) AS total FROM vyp_mision_oficial AS mo INNER JOIN vyp_empresa_viatico AS em INNER JOIN org_usuario as u   WHERE mo.id_mision_oficial = em.id_mision AND YEAR(mo.fecha_solicitud) = '$anio' AND mo.nr_empleado=u.nr AND u.id_seccion IN (SELECT DISTINCT s4.id_seccion FROM org_seccion as s1 LEFT JOIN org_seccion as s2 ON (s1.id_seccion=s2.depende or s1.id_seccion=s2.id_seccion) LEFT JOIN org_seccion as s3 ON (s2.id_seccion=s3.depende or s2.id_seccion=s3.id_seccion) LEFT JOIN org_seccion as s4 ON (s3.id_seccion=s4.depende or s3.id_seccion=s4.id_seccion) WHERE s1.depende = '$dir')  GROUP BY mo.nr_empleado, mo.nombre_completo ORDER BY total DESC");
              }else{
                $viaticos1= $this->db->query("SELECT mo.nr_empleado, mo.nombre_completo, SUM(em.pasaje) AS pasajes, SUM(em.viatico) AS viaticos, sum(em.alojamiento) as alojamientos,(SUM(em.pasaje) + SUM(em.viatico) + sum(em.alojamiento)) AS total FROM vyp_mision_oficial AS mo INNER JOIN vyp_empresa_viatico AS em INNER JOIN org_usuario as u   WHERE mo.id_mision_oficial = em.id_mision AND YEAR(mo.fecha_solicitud) = '$anio' AND mo.nr_empleado=u.nr AND u.id_seccion = '$dir'  GROUP BY mo.nr_empleado, mo.nombre_completo ORDER BY total DESC");
              }

            }else{
              $viaticos1= $this->db->query("SELECT mo.nr_empleado, mo.nombre_completo, SUM(em.pasaje) AS pasajes, SUM(em.viatico) AS viaticos, sum(em.alojamiento) as alojamientos,(SUM(em.pasaje) + SUM(em.viatico) + sum(em.alojamiento)) AS total FROM vyp_mision_oficial AS mo INNER JOIN vyp_empresa_viatico AS em INNER JOIN org_usuario as u   WHERE mo.id_mision_oficial = em.id_mision AND YEAR(mo.fecha_solicitud) = '$anio' AND mo.nr_empleado=u.nr AND u.id_seccion = '$dir'  GROUP BY mo.nr_empleado, mo.nombre_completo ORDER BY total DESC");
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
      $primer_mes = $data['primer_mes'];
      $segundo_mes = $data['segundo_mes'];
      $tercer_mes = $data['tercer_mes'];
      $cuarto_mes = $data['cuarto_mes'];
      $quinto_mes = $data['quinto_mes'];
      $sexto_mes = $data['sexto_mes'];
      if($primer_mes=='0' && $segundo_mes=='0' && $tercer_mes=='0' && $cuarto_mes=='0' && $quinto_mes=='0' && $sexto_mes=='0'){
        $viaticos= $this->db->query("SELECT month(mo.fecha_solicitud) as mes,sum(ev.pasaje) as pasajes,sum(ev.viatico) as viaticos, sum(ev.alojamiento) as alojamientos, sum(ev.viatico)+sum(ev.pasaje)+sum(ev.alojamiento) as total FROM vyp_mision_oficial as mo INNER JOIN vyp_empresa_viatico as ev ON ev.id_mision=mo.id_mision_oficial WHERE year(mo.fecha_solicitud)='$anio' and month(mo.fecha_solicitud) IN ('1','2','3','4','5','6','7','8','9','10','11','12') GROUP by month(mo.fecha_solicitud)");
        return $viaticos;
      }else{
        $viaticos= $this->db->query("SELECT month(mo.fecha_solicitud) as mes,sum(ev.pasaje) as pasajes,sum(ev.viatico) as viaticos, sum(ev.alojamiento) as alojamientos, sum(ev.viatico)+sum(ev.pasaje)+sum(ev.alojamiento) as total FROM vyp_mision_oficial as mo INNER JOIN vyp_empresa_viatico as ev ON ev.id_mision=mo.id_mision_oficial WHERE year(mo.fecha_solicitud)='$anio' and month(mo.fecha_solicitud) IN ('$primer_mes','$segundo_mes','$tercer_mes','$cuarto_mes','$quinto_mes','$sexto_mes') GROUP by month(mo.fecha_solicitud)");
        return $viaticos;
      }
    }
    function obtenerViaticosPorCargo($data){

      $anio=$data['anio'];
      $cargo=$data['cargo'];
     
      if($cargo=='todo'){
        $viaticos= $this->db->query("SELECT id_cargo_funcional,funcional,nombre_seccion,sum(viatico) as viatico,sum(pasaje) as pasaje,sum(alojamiento) as alojamiento FROM VISTA_VIATICOS  WHERE id_cargo_funcional IN (SELECT id_cargo_funcional FROM sir_cargo_funcional) AND year(fecha_solicitud)='$anio' GROUP BY id_seccion ORDER BY pasaje desc");
        return $viaticos;
      }else{
        $viaticos= $this->db->query("SELECT id_cargo_funcional,funcional,nombre_seccion,sum(viatico) as viatico,sum(pasaje) as pasaje,sum(alojamiento) as alojamiento FROM VISTA_VIATICOS  WHERE id_cargo_funcional IN ('$cargo') AND year(fecha_solicitud)='$anio' GROUP BY id_seccion ORDER BY pasaje desc");
        return $viaticos;
      }


    }
    function buscar_cargo_funcional($data){
       $idcargo=$data['cargo'];
      $cargos= $this->db->query("select funcional from sir_cargo_funcional where id_cargo_funcional='$idcargo'");
        return $cargos;
    }
    function obtenerViaticosPorOficina($data){

      $anio=$data['anio'];
     
        $viaticos= $this->db->query("SELECT id_seccion,nombre_seccion,sum(viatico) as viatico,sum(pasaje) as pasaje,sum(alojamiento) as alojamiento,(sum(viatico)+sum(pasaje)+sum(alojamiento)) as total FROM VISTA_VIATICOS  WHERE id_seccion IN (SELECT id_seccion FROM org_seccion) AND year(fecha_solicitud)='$anio' GROUP BY id_seccion ORDER BY viatico desc");
        return $viaticos;
    }
    function buscar_oficina($data){
       $id_seccion=$data['seccion'];
        $seccion= $this->db->query("select nombre_seccion from org_seccion where id_seccion='$id_seccion'");
        return $seccion;
    }
}
/*
CONSULTA MOTORISTAS
SELECT  empleado.id_empleado,CONCAT(empleado.primer_nombre,' ',empleado.segundo_nombre) as nombre,empleado.nr,info.id_cargo_funcional,info.id_seccion,seccion.nombre_seccion,mision.nr_empleado,mision.id_mision_oficial,(viatico.viatico),viatico.id_empresa_viatico
FROM sir_empleado as empleado 
INNER JOIN sir_empleado_informacion_laboral as info ON empleado.id_empleado=info.id_empleado
INNER JOIN org_seccion as seccion ON seccion.id_seccion = info.id_seccion
INNER JOIN vyp_mision_oficial as mision ON mision.nr_empleado=empleado.nr
INNER JOIN vyp_empresa_viatico as viatico ON mision.id_mision_oficial=viatico.id_mision
WHERE info.id_cargo_funcional = 291
GROUP BY viatico.id_empresa_viatico 



SELECT mision.nr_empleado,mision.id_mision_oficial,sum(viatico.viatico),empleado.nr,empleado.id_empleado,CONCAT(empleado.primer_nombre,' ',empleado.segundo_nombre) as nombre FROM vyp_mision_oficial as mision INNER JOIN vyp_empresa_viatico as viatico ON viatico.id_mision=mision.id_mision_oficial INNER JOIN sir_empleado as empleado ON empleado.nr=mision.nr_empleado

jose.pleitez
rolando.carrillo


SELECT info.id_empleado,info.id_cargo_funcional,info.id_seccion,empleado.nr,CONCAT(empleado.primer_nombre,' ',empleado.segundo_nombre) as nombre,mision.id_mision_oficial,(viatico.viatico), seccion.nombre_seccion,viatico.id_empresa_viatico FROM sir_empleado_informacion_laboral as info
INNER JOIN sir_empleado as empleado ON empleado.id_empleado=info.id_empleado
INNER JOIN vyp_mision_oficial as mision ON empleado.nr = mision.nr_empleado
INNER JOIN vyp_empresa_viatico as viatico ON viatico.id_mision=mision.id_mision_oficial
INNER JOIN org_seccion as seccion ON seccion.id_seccion=info.id_seccion
WHERE info.id_cargo_funcional = 291
GROUP BY viatico.id_empresa_viatico 
/*ORDER BY info.fecha_inicio DESC limit 1
*/
?>
