<?php $ruta_segmento = trim(obtener_segmentos(2)); ?>
</div>
    <style type="text/css">.container-fluid{ padding-bottom: 60px;  }</style>
   <script type="text/javascript">
        function mostrarAcercade(){
            $('#modal_acercade').modal('show');
        }
        $(document).ready(function() {
            $( '.page-wrapper .container-fluid' ).append( "<footer class='footer' style='cursor: pointer'> © 2019 UES-FMP   |   <a onClick='mostrarAcercade()'>Acerca de</a></footer>" );
            //$( '.page-wrapper .container-fluid' ).append( "<footer class='footer'> © 2019 UES-FMP </footer>" );
            <?php if($ruta_segmento != "/viaticos"){ ?>
            var ancho_barra = $( '.row.page-titles' ).width();
            var ancho_title = $( '.row.page-titles .align-self-center' ).width();
            var ancho = ancho_barra - ancho_title - 30; //menos 30 de padding
            $( '.row.page-titles' ).append( 
            "<div class='pull-right' style='width: "+ancho+"px;' align='right'>"+
                "<span class='round' style='cursor: pointer;' onclick='call_help(\"<?= str_replace("/", "_", $ruta_segmento) ?>\");'>"+
                    "<span class='mdi mdi-help'></span>"+
                "</span>"+
            "</div>" 
            );
            <?php } ?>
        });

        function call_help(ruta){
            if(ruta == 'informes_menu_reportes'){
                window.open("<?= base_url() ?>assets/help/REPORTES.pdf");
            }else{
                window.open("<?= base_url() ?>assets/help/"+ruta+'.pdf');
            }
        }
    </script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/viaticos_validation.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/sidebarmenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/waves.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script> jQuery(document).ready(function() { $(".select2").select2(); $('.selectpicker').selectpicker(); }); </script>
    <script src="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/moment-with-locales.min.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/plugins/toast-master/js/jquery.toast.js"></script>

<?php if($ruta_segmento == "configuraciones/informacion_empleado"){ ?>
    <script src="<?php echo base_url(); ?>assets/plugins/cropper/cropper.js"></script>
<?php } ?>

<?php if($ruta_segmento == "pagos/emergencias" || $ruta_segmento == "pasajes/pasaje"){ ?>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<?php } ?>

<?php if($ruta_segmento == "viaticos/solicitud_viatico" || $ruta_segmento == "viaticos/solicitud_admin"){ ?>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/dropify/dist/js/dropify.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/mask.js"></script>
<?php } ?>
 
<?php if($ruta_segmento == "informes/menu_reportes"){ ?>
    <!-- JS para reportes  -->
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/ion-rangeslider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/ion-rangeslider/js/ion-rangeSlider/ion.rangeSlider-init.js"></script>
<?php } ?>

</body>
<!-- Modal Acerca de -->
<div class="modal fade " id="modal_acercade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2" aria-hidden="true" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel2">Acerca de</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card-body" style="text-align: center">
                    <b>Sistema Informático de Viáticos y Pasajes.</b><br>
                    <img src="<?php echo base_url(); ?>assets/images/minerva.png" width="100px" height="130px"><br>
                    <div style="font-size:13px">Todos los derechos reservados 2019.<br>
                    Universidad de El Salvador.<br>
                    Facultad Multidisciplinaria Paracentral.</div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Modal Acerca de -->
</html>