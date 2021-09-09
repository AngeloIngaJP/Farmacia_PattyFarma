$(buscar_datos());

function buscar_datos(consulta) {
        $.ajax({
                        url: '../pagesuser/procesos/procesosearchmed.php',
                        type: 'POST',
                        dataType: 'html',
                        data: {
                                consulta: consulta
                        },
                })
                .done(function (res) {
                        $("#respuesta").html(res);
                })
                .fail(function () {
                        console.log("error");
                })
                .always(function () {
                        console.log("complete")
                });
}

$(document).on('keyup', '#caja_busqueda', function () {
        let valor = $(this).val();
        if (valor != "") {
                buscar_datos(valor);
        } else{
                buscar_datos();
        }
});


function Clear(){
        document.getElementById('caja_busqueda').value='';
        buscar_datos();
}
