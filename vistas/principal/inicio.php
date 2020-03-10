<?php
if (!ControlSesion :: sesionIniciada())
    Redireccion :: redirigir(SERVIDOR);

include_once 'plantillas/usuarioExiste.inc.php';
include_once 'plantillas/header.inc.php';
include_once 'plantillas/menu-principal.inc.php';
?>
        <script>
            window.onload = function() {
                document.getElementById("inicio").style.boxShadow="inset 0px -2px 0px 0px #222222";
                $(".chb").change(function() {
                    $(".chb").not(this).prop('checked', false);
                });
            }

            $(window).resize(function() {
                var field = $(document.activeElement);
                if (field.is('.hasDatepicker')) {
                    field.blur();
                    field.datepicker('hide');
                }
            });

            $('#t3').focus(function() {
                $(this).datepicker('show');
            })
        </script>
        <main>
            <div class="principal">
                <div class="presentacion general" id="pagInicio">
                    <div class="banner">
                        <!-- Código removido -->
                    </div>
                </div>
                <script>
                    $.datepicker.regional['es'] = {
                    closeText: 'Cerrar',
                    prevText: '< Ant',
                    nextText: 'Sig >',
                    currentText: 'Hoy',
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
                    dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sáb'],
                    weekHeader: 'Sm',
                    dateFormat: 'dd/mm/yy',
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: '',
                    };
                    $.datepicker.setDefaults($.datepicker.regional['es']);
                    $n = 0;
                    $fecha1 = '';
                    var f1 = new Date();
                    var f2 = new Date();
                    $fecha2 = '';
                    $('#t3').datepicker({
                        onSelect: function(){
                            $(this).change();
                            if ($n == 0) {
                                $fecha1 = $(this).val();
                                var partes1 = $fecha1.split("/");
                                f1 = new Date(partes1[2], partes1[1] - 1, partes1[0]);
                                $fecha2 = '';
                                $n++;
                                $(this).data('datepicker').inline = true;
                            } else {
                                $fecha2 = $(this).val();
                                var partes2 = $fecha2.split("/");
                                f2 = new Date(partes2[2], partes2[1] - 1, partes2[0]);
                                if (f1 <= f2) {
                                    $(this).val($fecha1 + " - " + $fecha2);
                                    $(this).data('datepicker').inline = false;
                                }
                                $n = 0;
                            }
                        },
                        onClose: function() {
                            $(this).data('datepicker').inline = false;
                            $n = 0;
                        },
                        beforeShow : function(input,inst){
                            var offset = $(input).offset();
                            var height = $(input).height();
                            window.setTimeout(function () {
                                $(inst.dpDiv).css({ top: (offset.top + height) + 'px', left:offset.left + 'px' })
                            }, 1);
                        }
                    })

                    $('#t3').change(function() {
                        $('#cruz').css('display', 'block');
                    })

                    $('#cruz').click(function () {
                        $('#t3').val('');
                        $('#cruz').css('display', 'none');
                    });

                    // Validaciones

                    function val(e){
                        key = e.keyCode || e.which;
                        tecla = String.fromCharCode(key).toLowerCase();
                        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
                        especiales = "8-37-39-46";

                        tecla_especial = false
                        for(var i in especiales){
                            if(key == especiales[i]){
                                tecla_especial = true;
                                break;
                            }
                        }

                        if(letras.indexOf(tecla)==-1 && !tecla_especial){
                            return false;
                        }
                    }
                </script>
                <div class="contenido">
                    <!-- Código removido -->
                </div>
            </div>
        </main>
        <?php
        include_once 'plantillas/footer.inc.php';
        ?>
    </body>
</html>