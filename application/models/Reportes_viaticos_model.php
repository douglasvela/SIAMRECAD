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

SELECT m.*,
(SELECT sum(viatico) FROM vyp_empresa_viatico WHERE id_mision=m.id_mision_oficial) as viaticos,
(SELECT sum(pasaje) FROM vyp_empresa_viatico WHERE id_mision=m.id_mision_oficial) as pasajes,
(SELECT sum(alojamiento) FROM vyp_empresa_viatico WHERE id_mision=m.id_mision_oficial) as alojamiento,
(SELECT nombre_vyp_actividades FROM vyp_actividades WHERE id_vyp_actividades=m.id_actividad_realizada) as nombre_actividad,
(SELECT nombre_estado FROM vyp_estado_solicitud WHERE id_estado_solicitud=m.estado) as nombre_estado
FROM vyp_mision_oficial as m WHERE m.nr_empleado IN (SELECT nr FROM sir_empleado)
*/



/* ALGO ASI

SELECT i.id_oficina_departamental as id_depto, o.id_departamento, depto.departamento, round(SUM(s.viatico),2) AS viatico, round(SUM(s.pasaje),2) AS pasaje, round(SUM(s.alojamiento),2) AS alojamiento, round((SUM(s.viatico)+SUM(s.pasaje)+SUM(s.alojamiento)),2) as total FROM (SELECT ev.viatico, ev.pasaje, ev.alojamiento, m.nr_empleado, m.fecha_solicitud FROM vyp_mision_oficial AS m JOIN vyp_empresa_viatico AS ev ON ev.id_mision = m.id_mision_oficial UNION SELECT 0, p.monto_pasaje, 0, p.nr, p.fecha_solicitud FROM vyp_pasajes AS p) AS s JOIN vyp_informacion_empleado AS i ON s.nr_empleado = i.nr JOIN vyp_oficinas AS o ON o.id_oficina = i.id_oficina_departamental JOIN org_departamento as depto ON depto.id_departamento=o.id_departamento WHERE year(s.fecha_solicitud)='2017' GROUP BY i.id_oficina_departamental ORDER BY SUM(s.viatico) DESC

SELECT month(s.fecha_solicitud) as mes,ROUND(sum(s.pasaje),2) as pasajes,sum(s.viatico) as viaticos, sum(s.alojamiento) as alojamientos, ROUND(sum(s.viatico)+sum(s.pasaje)+sum(s.alojamiento),2) as total FROM (SELECT ev.viatico, ev.pasaje, ev.alojamiento, m.nr_empleado, m.fecha_solicitud FROM vyp_mision_oficial AS m JOIN vyp_empresa_viatico AS ev ON ev.id_mision = m.id_mision_oficial UNION SELECT 0, p.monto_pasaje, 0, p.nr, p.fecha_solicitud FROM vyp_pasajes AS p) AS s WHERE year(s.fecha_solicitud)='2017' and month(s.fecha_solicitud) IN ('1','2','3','4','5','6','7','8','9','10','11','12') GROUP by month(s.fecha_solicitud)

////////////////////////////////////////////////////////
old
SELECT i.id_oficina_departamental as id_depto, o.id_departamento, depto.departamento ,m.id_mision_oficial,SUM(ev.viatico) AS viatico, SUM(ev.pasaje) AS pasaje, SUM(ev.alojamiento) AS alojamiento, (SUM(ev.viatico)+SUM(ev.pasaje)+SUM(ev.alojamiento)) as total FROM vyp_mision_oficial AS m JOIN vyp_informacion_empleado AS i ON m.nr_empleado = i.nr JOIN vyp_oficinas AS o ON o.id_oficina = i.id_oficina_departamental JOIN vyp_empresa_viatico AS ev ON ev.id_mision = m.id_mision_oficial JOIN org_departamento as depto ON depto.id_departamento=o.id_departamento WHERE year(m.fecha_solicitud)='$data' GROUP BY i.id_oficina_departamental ORDER BY SUM(ev.viatico) DESC

SELECT month(mo.fecha_solicitud) as mes,sum(ev.pasaje) as pasajes,sum(ev.viatico) as viaticos, sum(ev.alojamiento) as alojamientos, sum(ev.viatico)+sum(ev.pasaje)+sum(ev.alojamiento) as total FROM vyp_mision_oficial as mo INNER JOIN vyp_empresa_viatico as ev ON ev.id_mision=mo.id_mision_oficial WHERE year(mo.fecha_solicitud)='$anio' and month(mo.fecha_solicitud) IN ('1','2','3','4','5','6','7','8','9','10','11','12') GROUP by month(mo.fecha_solicitud)
*/
    function obtenerViaticoAnualxDepto($data){
      
        $viaticos = $this->db->query("SELECT i.id_oficina_departamental as id_depto, o.id_departamento, depto.departamento, round(SUM(s.viatico),2) AS viatico, round(SUM(s.pasaje),2) AS pasaje, round(SUM(s.alojamiento),2) AS alojamiento, round((SUM(s.viatico)+SUM(s.pasaje)+SUM(s.alojamiento)),2) as total FROM (SELECT ev.viatico, ev.pasaje, ev.alojamiento, m.nr_empleado, m.fecha_solicitud,m.estado FROM vyp_mision_oficial AS m JOIN vyp_empresa_viatico AS ev ON ev.id_mision = m.id_mision_oficial UNION SELECT 0, p.monto_pasaje, 0, p.nr, p.fecha_solicitud,p.estado FROM vyp_pasajes AS p) AS s JOIN vyp_informacion_empleado AS i ON s.nr_empleado = i.nr JOIN vyp_oficinas AS o ON o.id_oficina = i.id_oficina_departamental JOIN org_departamento as depto ON depto.id_departamento=o.id_departamento WHERE year(s.fecha_solicitud)='$data' AND s.estado='8' GROUP BY i.id_oficina_departamental ORDER BY SUM(s.viatico) DESC");
        return $viaticos;
    }
    function obtenerViaticoAnual($data)
    {
      $anios = implode(",", $data);//de array a cadena
        $viaticos = $this->db->query("SELECT year(s.fecha_solicitud) as anio,sum(s.viatico) as viatico,sum(s.pasaje) as pasaje,sum(s.alojamiento) as alojamiento, (sum(s.viatico) + sum(s.pasaje) + sum(s.alojamiento)) as total_anio FROM (SELECT ev.viatico, ev.pasaje, ev.alojamiento, m.nr_empleado, m.fecha_solicitud,m.estado FROM vyp_mision_oficial AS m JOIN vyp_empresa_viatico AS ev ON ev.id_mision = m.id_mision_oficial UNION SELECT 0, p.monto_pasaje, 0, p.nr, p.fecha_solicitud,p.estado FROM vyp_pasajes AS p) AS s WHERE YEAR(s.fecha_solicitud) IN ($anios) AND s.estado='8'  group by year(s.fecha_solicitud) order by year(s.fecha_solicitud) desc");
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
                $viaticos1= $this->db->query("SELECT s.nr_empleado, u.nombre_completo, round(SUM(s.pasaje),2) AS pasajes, round(SUM(s.viatico),2) AS viaticos, round(sum(s.alojamiento),2) as alojamientos,round((SUM(s.pasaje) + SUM(s.viatico) + sum(s.alojamiento)),2) AS total FROM (SELECT ev.viatico, ev.pasaje, ev.alojamiento, m.nr_empleado, m.fecha_solicitud,m.id_mision_oficial,m.estado FROM vyp_mision_oficial AS m JOIN vyp_empresa_viatico AS ev ON ev.id_mision = m.id_mision_oficial UNION SELECT 0, p.monto_pasaje, 0, p.nr, p.fecha_solicitud,p.id_solicitud_pasaje,p.estado FROM vyp_pasajes AS p) AS s INNER JOIN org_usuario as u   WHERE YEAR(s.fecha_solicitud) = '$anio' AND s.nr_empleado=u.nr AND s.estado='8' AND u.id_seccion IN (SELECT DISTINCT s4.id_seccion FROM org_seccion as s1 LEFT JOIN org_seccion as s2 ON (s1.id_seccion=s2.depende or s1.id_seccion=s2.id_seccion) LEFT JOIN org_seccion as s3 ON (s2.id_seccion=s3.depende or s2.id_seccion=s3.id_seccion) LEFT JOIN org_seccion as s4 ON (s3.id_seccion=s4.depende or s3.id_seccion=s4.id_seccion) WHERE s1.depende = '$dir')  GROUP BY s.nr_empleado, u.nombre_completo ORDER BY total DESC");
              }else{
                $viaticos1= $this->db->query("SELECT s.nr_empleado, u.nombre_completo, round(SUM(s.pasaje),2) AS pasajes, round(SUM(s.viatico),2) AS viaticos, round(sum(s.alojamiento),2) as alojamientos,round((SUM(s.pasaje) + SUM(s.viatico) + sum(s.alojamiento)),2) AS total FROM (SELECT ev.viatico, ev.pasaje, ev.alojamiento, m.nr_empleado, m.fecha_solicitud,m.id_mision_oficial,m.estado FROM vyp_mision_oficial AS m JOIN vyp_empresa_viatico AS ev ON ev.id_mision = m.id_mision_oficial UNION SELECT 0, p.monto_pasaje, 0, p.nr, p.fecha_solicitud,p.id_solicitud_pasaje,p.estado FROM vyp_pasajes AS p) AS s INNER JOIN org_usuario as u   WHERE YEAR(s.fecha_solicitud) = '$anio' AND s.estado='8' AND s.nr_empleado=u.nr AND u.id_seccion = '$dir'  GROUP BY s.nr_empleado, u.nombre_completo ORDER BY total DESC");
              }

            }else{
              $viaticos1= $this->db->query("SELECT s.nr_empleado, u.nombre_completo, round(SUM(s.pasaje),2) AS pasajes, round(SUM(s.viatico),2) AS viaticos, round(sum(s.alojamiento),2) as alojamientos,round((SUM(s.pasaje) + SUM(s.viatico) + sum(s.alojamiento)),2) AS total FROM (SELECT ev.viatico, ev.pasaje, ev.alojamiento, m.nr_empleado, m.fecha_solicitud,m.id_mision_oficial,m.estado FROM vyp_mision_oficial AS m JOIN vyp_empresa_viatico AS ev ON ev.id_mision = m.id_mision_oficial UNION SELECT 0, p.monto_pasaje, 0, p.nr, p.fecha_solicitud,p.id_solicitud_pasaje,p.estado FROM vyp_pasajes AS p) AS s INNER JOIN org_usuario as u   WHERE YEAR(s.fecha_solicitud) = '$anio' AND s.nr_empleado=u.nr AND u.id_seccion = '$dir' AND s.estado='8'  GROUP BY s.nr_empleado, u.nombre_completo ORDER BY total DESC");
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
        $viaticos= $this->db->query("SELECT month(s.fecha_solicitud) as mes,ROUND(sum(s.pasaje),2) as pasajes,sum(s.viatico) as viaticos, sum(s.alojamiento) as alojamientos, ROUND(sum(s.viatico)+sum(s.pasaje)+sum(s.alojamiento),2) as total FROM (SELECT ev.viatico, ev.pasaje, ev.alojamiento, m.nr_empleado, m.fecha_solicitud,m.estado FROM vyp_mision_oficial AS m JOIN vyp_empresa_viatico AS ev ON ev.id_mision = m.id_mision_oficial UNION SELECT 0, p.monto_pasaje, 0, p.nr, p.fecha_solicitud,p.estado FROM vyp_pasajes AS p) AS s WHERE year(s.fecha_solicitud)='$anio' AND s.estado='8' and month(s.fecha_solicitud) IN ('1','2','3','4','5','6','7','8','9','10','11','12') GROUP by month(s.fecha_solicitud)");
        return $viaticos;
      }else{
        $viaticos= $this->db->query("SELECT month(s.fecha_solicitud) as mes,ROUND(sum(s.pasaje),2) as pasajes,sum(s.viatico) as viaticos, sum(s.alojamiento) as alojamientos, ROUND(sum(s.viatico)+sum(s.pasaje)+sum(s.alojamiento),2) as total FROM (SELECT ev.viatico, ev.pasaje, ev.alojamiento, m.nr_empleado, m.fecha_solicitud,m.estado FROM vyp_mision_oficial AS m JOIN vyp_empresa_viatico AS ev ON ev.id_mision = m.id_mision_oficial UNION SELECT 0, p.monto_pasaje, 0, p.nr, p.fecha_solicitud,p.estado FROM vyp_pasajes AS p) AS s WHERE year(s.fecha_solicitud)='$anio' AND s.estado='8' and month(s.fecha_solicitud) IN ('$primer_mes','$segundo_mes','$tercer_mes','$cuarto_mes','$quinto_mes','$sexto_mes') GROUP by month(s.fecha_solicitud)");
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
     
        $viaticos= $this->db->query("SELECT s.id_seccion,s.nombre_seccion,ROUND(sum(s.viatico),2) as viatico,ROUND(sum(s.pasaje),2) as pasaje,ROUND(sum(s.alojamiento),2) as alojamiento,ROUND((sum(s.viatico)+sum(s.pasaje)+sum(s.alojamiento)),2) as total FROM VISTA_VIATICOS as s WHERE s.id_seccion IN (SELECT id_seccion FROM org_seccion) AND year(s.fecha_solicitud)='$anio' AND s.estado='8' GROUP BY s.id_seccion ORDER BY s.viatico desc");
        return $viaticos;
    } 
    function buscar_oficina($data){
       $id_seccion=$data['seccion'];
        $seccion= $this->db->query("select nombre_seccion from org_seccion where id_seccion='$id_seccion'");
        return $seccion;
    }
    function viaticos_por_genero($data){
       $anio=$data['anio'];
        $viaticos= $this->db->query("SELECT i.id_genero,g.genero, round(SUM(s.viatico),2) AS viatico, round(SUM(s.pasaje),2) AS pasaje, round(SUM(s.alojamiento),2) AS alojamiento, round((SUM(s.viatico)+SUM(s.pasaje)+SUM(s.alojamiento)),2) as total FROM ( SELECT m.nr_empleado,m.nombre_completo, ev.viatico, ev.pasaje, ev.alojamiento, m.fecha_solicitud,m.id_mision_oficial,ev.id_empresa_viatico,m.estado FROM vyp_mision_oficial AS m JOIN vyp_empresa_viatico AS ev ON ev.id_mision = m.id_mision_oficial UNION SELECT p.nr,0, 0, p.monto_pasaje, 0, p.fecha_solicitud,p.id_solicitud_pasaje,(rand()),p.estado FROM vyp_pasajes AS p) as s JOIN sir_empleado AS i ON s.nr_empleado = i.nr JOIN org_genero as g ON g.id_genero=i.id_genero WHERE s.estado='8' year(s.fecha_solicitud)='$anio' GROUP BY i.id_genero ORDER BY SUM(s.viatico) DESC");
        return $viaticos;
    }
    function viaticos_por_mes($data,$primer_mes,$segundo_mes,$tercer_mes,$cuarto_mes,$quinto_mes,$sexto_mes){
       $anios = implode(",", $data);
       if($primer_mes=='0' && $segundo_mes=='0' && $tercer_mes=='0' && $cuarto_mes=='0' && $quinto_mes=='0' && $sexto_mes=='0'){
        $viaticos= $this->db->query("SELECT year(s.fecha) as anio,month(s.fecha) as mes,round(sum(s.viatico),2) as viatico,round(sum(s.pasaje),2) as pasaje,round(sum(s.alojamiento),2) as alojamiento, round((sum(s.viatico) + sum(s.pasaje) + sum(s.alojamiento)),2) as total_anio FROM ( SELECT m.nr_empleado,m.nombre_completo, ev.viatico, ev.pasaje, ev.alojamiento, m.fecha_solicitud,m.id_mision_oficial,ev.id_empresa_viatico,ev.fecha,m.estado FROM vyp_mision_oficial AS m JOIN vyp_empresa_viatico AS ev ON ev.id_mision = m.id_mision_oficial UNION SELECT p.nr,0, 0, p.monto_pasaje, 0, p.fecha_solicitud,p.id_solicitud_pasaje,(rand()),p.fecha_solicitud,p.estado FROM vyp_pasajes AS p ) as s WHERE month(s.fecha) IN (01,02,03,04,05,06,07,08,09,10,11,12) and YEAR(s.fecha) IN ($anios) AND s.estado='8' group by month(s.fecha),year(s.fecha) order by month(s.fecha) desc,year(s.fecha) desc");
        }else{
          $viaticos= $this->db->query("SELECT year(s.fecha) as anio,month(s.fecha) as mes,round(sum(s.viatico),2) as viatico,round(sum(s.pasaje),2) as pasaje,round(sum(s.alojamiento),2) as alojamiento, round((sum(s.viatico) + sum(s.pasaje) + sum(s.alojamiento)),2) as total_anio FROM ( SELECT m.nr_empleado,m.nombre_completo, ev.viatico, ev.pasaje, ev.alojamiento, m.fecha_solicitud,m.id_mision_oficial,ev.id_empresa_viatico,ev.fecha,m.estado FROM vyp_mision_oficial AS m JOIN vyp_empresa_viatico AS ev ON ev.id_mision = m.id_mision_oficial UNION SELECT p.nr,0, 0, p.monto_pasaje, 0, p.fecha_solicitud,p.id_solicitud_pasaje,(rand()),p.fecha_solicitud,p.estado FROM vyp_pasajes AS p ) as s WHERE month(s.fecha) IN ('$primer_mes','$segundo_mes','$tercer_mes','$cuarto_mes','$quinto_mes','$sexto_mes') and YEAR(s.fecha) IN ($anios) AND s.estado='8' group by month(s.fecha),year(s.fecha) order by month(s.fecha) desc,year(s.fecha) desc");
        }
        return $viaticos;
    }

    /*
      
      SELECT s.id_actividad_realizada,act.nombre_vyp_actividades as actividad,year(s.fecha_solicitud) as anio ,month(s.fecha_solicitud) as mes,round(sum(s.viatico),2) as viatico,round(sum(s.pasaje),2) as pasaje,round(sum(s.alojamiento),2) as alojamiento,round((sum(s.viatico)+sum(s.pasaje)+sum(s.alojamiento)),2) as total  
FROM (
SELECT m.nr_empleado,m.nombre_completo, ev.viatico, ev.pasaje, ev.alojamiento, m.fecha_solicitud,m.id_mision_oficial,ev.id_empresa_viatico,ev.fecha,m.id_actividad_realizada FROM vyp_mision_oficial AS m JOIN vyp_empresa_viatico AS ev ON ev.id_mision = m.id_mision_oficial UNION SELECT p.nr,0, 0, p.monto_pasaje, 0, p.fecha_solicitud,p.id_solicitud_pasaje,(rand()),p.fecha_solicitud,0 FROM vyp_pasajes AS p 
) as s
JOIN vyp_actividades as act ON s.id_actividad_realizada=act.id_vyp_actividades 
WHERE year(s.fecha_solicitud) IN ($anios) AND month(s.fecha_solicitud) IN (01,02,03,01,02,03,04,05,06,07,08,09,10,11,12) AND s.id_actividad_realizada IN (SELECT id_actividad_realizada FROM vyp_actividades) 
GROUP BY s.id_actividad_realizada,year(s.fecha_solicitud) ORDER BY month(s.fecha_solicitud) asc
    */
    function viaticos_por_actividad($data,$primer_mes,$segundo_mes,$tercer_mes,$cuarto_mes,$quinto_mes,$sexto_mes,$id_vyp_actividades){
       $anios = implode(",", $data);
       if($primer_mes=='0' && $segundo_mes=='0' && $tercer_mes=='0' && $cuarto_mes=='0' && $quinto_mes=='0' && $sexto_mes=='0'){
          if($id_vyp_actividades=="todo"){
            $viaticos= $this->db->query("SELECT m.id_actividad_realizada,act.nombre_vyp_actividades as actividad,year(m.fecha_solicitud) as anio ,month(m.fecha_solicitud) as mes,sum(v.viatico) as viatico,sum(v.pasaje) as pasaje,sum(v.alojamiento) as alojamiento,(sum(v.viatico)+sum(v.pasaje)+sum(v.alojamiento)) as total  FROM vyp_mision_oficial as m JOIN vyp_empresa_viatico as v ON v.id_mision=m.id_mision_oficial JOIN vyp_actividades as act ON m.id_actividad_realizada=act.id_vyp_actividades WHERE year(m.fecha_solicitud) IN ($anios) AND month(m.fecha_solicitud) IN (01,02,03,01,02,03,04,05,06,07,08,09,10,11,12) AND m.id_actividad_realizada IN (SELECT id_actividad_realizada FROM vyp_actividades) GROUP BY m.id_actividad_realizada,year(m.fecha_solicitud) AND m.estado='8' ORDER BY month(m.fecha_solicitud) asc");
          }else{
            $viaticos= $this->db->query("SELECT m.id_actividad_realizada,act.nombre_vyp_actividades as actividad,year(m.fecha_solicitud) as anio ,month(m.fecha_solicitud) as mes,sum(v.viatico) as viatico,sum(v.pasaje) as pasaje,sum(v.alojamiento) as alojamiento,(sum(v.viatico)+sum(v.pasaje)+sum(v.alojamiento)) as total  FROM vyp_mision_oficial as m JOIN vyp_empresa_viatico as v ON v.id_mision=m.id_mision_oficial JOIN vyp_actividades as act ON m.id_actividad_realizada=act.id_vyp_actividades WHERE year(m.fecha_solicitud) IN ($anios) AND month(m.fecha_solicitud) IN (01,02,03,01,02,03,04,05,06,07,08,09,10,11,12) AND m.id_actividad_realizada IN ('$id_vyp_actividades') AND m.estado='8' GROUP BY m.id_actividad_realizada,year(m.fecha_solicitud) ORDER BY  month(m.fecha_solicitud) asc");
          }
        }else{
          if($id_vyp_actividades=="todo"){
          $viaticos= $this->db->query("SELECT m.id_actividad_realizada,act.nombre_vyp_actividades as actividad,year(m.fecha_solicitud) as anio ,month(m.fecha_solicitud) as mes,sum(v.viatico) as viatico,sum(v.pasaje) as pasaje,sum(v.alojamiento) as alojamiento,(sum(v.viatico)+sum(v.pasaje)+sum(v.alojamiento)) as total  FROM vyp_mision_oficial as m JOIN vyp_empresa_viatico as v ON v.id_mision=m.id_mision_oficial JOIN vyp_actividades as act ON m.id_actividad_realizada=act.id_vyp_actividades WHERE year(m.fecha_solicitud) IN ($anios) AND month(m.fecha_solicitud) IN ('$primer_mes','$segundo_mes','$tercer_mes','$cuarto_mes','$quinto_mes','$sexto_mes') AND m.id_actividad_realizada IN (SELECT id_actividad_realizada FROM vyp_actividades) AND m.estado='8' GROUP BY m.id_actividad_realizada,year(m.fecha_solicitud) ORDER BY month(m.fecha_solicitud)asc");
          }else{
             $viaticos= $this->db->query("SELECT m.id_actividad_realizada,act.nombre_vyp_actividades as actividad,year(m.fecha_solicitud) as anio ,month(m.fecha_solicitud) as mes,sum(v.viatico) as viatico,sum(v.pasaje) as pasaje,sum(v.alojamiento) as alojamiento,(sum(v.viatico)+sum(v.pasaje)+sum(v.alojamiento)) as total  FROM vyp_mision_oficial as m JOIN vyp_empresa_viatico as v ON v.id_mision=m.id_mision_oficial JOIN vyp_actividades as act ON m.id_actividad_realizada=act.id_vyp_actividades WHERE year(m.fecha_solicitud) IN ($anios) AND month(m.fecha_solicitud) IN ('$primer_mes','$segundo_mes','$tercer_mes','$cuarto_mes','$quinto_mes','$sexto_mes') AND m.id_actividad_realizada IN ('$id_vyp_actividades') AND m.estado='8' GROUP BY m.id_actividad_realizada,year(m.fecha_solicitud) ORDER BY month(m.fecha_solicitud) asc");
          }
        }
        return $viaticos;
    }
    function misiones_empleados($data){
      if($data['nr']=="todos"){
          $viaticos= $this->db->query("SELECT s.* from (SELECT m.id_mision_oficial,m.nr_empleado,m.nombre_completo,(SELECT s.nombre_seccion  FROM sir_empleado as i JOIN sir_empleado_informacion_laboral as il ON i.id_empleado=il.id_empleado JOIN org_seccion as s ON s.id_seccion=il.id_seccion WHERE i.nr=m.nr_empleado ORDER BY il.id_empleado_informacion_laboral ASC LIMIT 1) as seccion,(SELECT c.funcional  FROM sir_empleado as i JOIN sir_empleado_informacion_laboral as il ON i.id_empleado=il.id_empleado JOIN sir_cargo_funcional as c ON c.id_cargo_funcional=il.id_cargo_funcional  WHERE i.nr=m.nr_empleado ORDER BY il.id_empleado_informacion_laboral ASC LIMIT 1) as cargo,m.fecha_mision_inicio,m.fecha_mision_fin,m.fecha_solicitud as fecha_solicitud,(SELECT nombre_vyp_actividades FROM vyp_actividades WHERE id_vyp_actividades=m.id_actividad_realizada) as nombre_actividad,(SELECT sum(viatico) FROM vyp_empresa_viatico WHERE id_mision=m.id_mision_oficial) as viaticos,(SELECT sum(pasaje) FROM vyp_empresa_viatico WHERE id_mision=m.id_mision_oficial) as pasajes,(SELECT sum(alojamiento) FROM vyp_empresa_viatico WHERE id_mision=m.id_mision_oficial) as alojamientos,(SELECT sum(viatico)+sum(pasaje)+sum(alojamiento) FROM vyp_empresa_viatico WHERE id_mision=m.id_mision_oficial) as total,(SELECT nombre_estado FROM vyp_estado_solicitud WHERE id_estado_solicitud=m.estado) as nombre_estado,m.fecha_pago FROM vyp_mision_oficial as m
UNION 
SELECT p.id_mision_pasajes as id_mision_oficial,p.nr as nr_empleado,(SELECT concat(primer_nombre,' ',segundo_nombre,' ',primer_apellido,' ',segundo_apellido) FROM sir_empleado WHERE nr=p.nr) as nombre_completo,(SELECT s.nombre_seccion  FROM sir_empleado as i JOIN sir_empleado_informacion_laboral as il ON i.id_empleado=il.id_empleado JOIN org_seccion as s ON s.id_seccion=il.id_seccion WHERE i.nr=p.nr ORDER BY il.id_empleado_informacion_laboral ASC LIMIT 1) as seccion,(SELECT c.funcional  FROM sir_empleado as i JOIN sir_empleado_informacion_laboral as il ON i.id_empleado=il.id_empleado JOIN sir_cargo_funcional as c ON c.id_cargo_funcional=il.id_cargo_funcional  WHERE i.nr=p.nr ORDER BY il.id_empleado_informacion_laboral ASC LIMIT 1) as cargo,'000-00-00' as fecha_mision_inicio,'000-00-00' as fecha_mision_fin,p.fecha_solicitud_pasaje as fecha_solicitud,('PASAJE')  as nombre_actividad,('0') as viaticos, (SELECT sum(monto_pasaje) FROM vyp_pasajes WHERE month(fecha_mision)=p.mes_pasaje and year(fecha_mision)=p.anio_pasaje AND nr=p.nr) as pasajes,('0') as alojamientos,(SELECT sum(monto_pasaje) FROM vyp_pasajes WHERE month(fecha_mision)=p.mes_pasaje and year(fecha_mision)=p.anio_pasaje AND nr=p.nr) as total,(SELECT nombre_estado FROM vyp_estado_solicitud WHERE id_estado_solicitud=p.estado) as nombre_estado,('000-00-00') as fecha_pago FROM vyp_mision_pasajes as p) as s ORDER BY s.fecha_solicitud ASC");
          }else{
             $viaticos= $this->db->query("SELECT m.*,(SELECT sum(viatico) FROM vyp_empresa_viatico WHERE id_mision=m.id_mision_oficial) as viaticos,(SELECT sum(pasaje) FROM vyp_empresa_viatico WHERE id_mision=m.id_mision_oficial) as pasajes,(SELECT sum(alojamiento) FROM vyp_empresa_viatico WHERE id_mision=m.id_mision_oficial) as alojamientos,(SELECT sum(viatico)+sum(pasaje)+sum(alojamiento) FROM vyp_empresa_viatico WHERE id_mision=m.id_mision_oficial) as total,(SELECT nombre_vyp_actividades FROM vyp_actividades WHERE id_vyp_actividades=m.id_actividad_realizada) as nombre_actividad,(SELECT nombre_estado FROM vyp_estado_solicitud WHERE id_estado_solicitud=m.estado) as nombre_estado,(SELECT s.nombre_seccion  FROM sir_empleado as i JOIN sir_empleado_informacion_laboral as il ON i.id_empleado=il.id_empleado JOIN org_seccion as s ON s.id_seccion=il.id_seccion WHERE i.nr=m.nr_empleado ORDER BY il.id_empleado_informacion_laboral ASC LIMIT 1) as seccion,(SELECT c.funcional  FROM sir_empleado as i JOIN sir_empleado_informacion_laboral as il ON i.id_empleado=il.id_empleado JOIN sir_cargo_funcional as c ON c.id_cargo_funcional=il.id_cargo_funcional  WHERE i.nr=m.nr_empleado ORDER BY il.id_empleado_informacion_laboral ASC LIMIT 1) as cargo FROM vyp_mision_oficial as m WHERE m.nr_empleado IN ('".$data['nr']."') ORDER BY m.fecha_solicitud ASC");
          }
        return $viaticos;
    }
}
/* 

SELECT m.id_actividad_realizada,m.detalle_actividad,year(m.fecha_solicitud) as anio ,month(m.fecha_solicitud) as mes,sum(v.viatico) as viatico,sum(v.pasaje) as pasaje,sum(v.alojamiento) as alojamiento,(sum(v.viatico)+sum(v.pasaje)+sum(v.alojamiento)) as total  FROM vyp_mision_oficial as m
JOIN vyp_empresa_viatico as v ON v.id_mision=m.id_mision_oficial
WHERE year(m.fecha_solicitud) IN (2016,2017) AND month(m.fecha_solicitud) IN (01,02,03) AND m.id_actividad_realizada IN (SELECT id_actividad_realizada FROM vyp_actividades)
GROUP BY m.id_actividad_realizada,year(m.fecha_solicitud)
ORDER BY  m.id_actividad_realizada DESC

SELECT year(fecha) as anio,month(fecha) as mes,sum(`viatico`) as viatico,sum(pasaje) as pasaje,sum(alojamiento) as alojamiento, (sum(`viatico`) + sum(pasaje) + sum(alojamiento)) as total_anio FROM `vyp_empresa_viatico` WHERE month(fecha) IN (01,02,03,04,05,06,07,08,09,10,11,12) and YEAR(fecha) IN (2017,2016)  group by month(fecha),year(`fecha`) order by month(fecha) desc


SELECT u.id_seccion,s.nombre_seccion,v.id_genero,g.genero, SUM(v.viatico) as viatico,SUM(v.pasaje) AS pasaje, SUM(v.alojamiento) AS alojamiento, (SUM(v.viatico)+SUM(v.pasaje)+SUM(v.alojamiento)) as total  
from vista_viaticos as v
JOIN org_genero as g ON g.id_genero=v.id_genero
JOIN org_usuario as u ON u.nr=v.nr
JOIN org_seccion as s ON s.id_seccion=v.id_seccion
WHERE year(v.fecha_solicitud)='2017'  AND u.id_seccion IN (SELECT id_seccion FROM org_seccion)
GROUP BY v.id_genero ,u.id_seccion
ORDER by SUM(v.viatico) DESC



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
