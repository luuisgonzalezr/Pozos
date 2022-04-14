$(document).ready(function(){
    $('#pozos').val("-SELECCIONE-").change();
    $('#btn-mediciones').prop('disabled', true);
    obtenerPozos();
    detectarCambio();
    //Llenar la lista de los id de pozos al cargar la pagina 
    obtenerIdsPozos();

    //Poner como fecha maxima de la medicion el dia actual 
   fechaActual();

   //Mostrar las mediciones del pozo 
   mostrarMediciones();
})

function fechaActual(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
    dd = '0' + dd;
    }

    if (mm < 10) {
    mm = '0' + mm;
    } 
        
    today = yyyy + '-' + mm + '-' + dd;
    $('#fecha-medicion').prop("max", today);
}

$('#btn-agregar').click(function(){
    $.ajax({
        type: 'POST',
        url: 'agregar-pozo.php',
        success: function(response){
            console.log(response);
            alert('Pozo agregado con exito con el id: ' + response);
            obtenerPozos();
            obtenerIdsPozos();
        }
    })
})

function obtenerPozos(){
    $.ajax({
        url: 'obtener-pozos.php',
        type: 'POST',
        success: function(response){
            $('#cant-pozos').text('Actualmente hay ' + response + ' pozos registrados.');
        }
    })
}

function obtenerIdsPozos(){
    $.ajax({
        url: 'obtener-todos-pozos.php',
        type: 'POST',
        success: function(response){
            if(!response === false){
                console.log(response);
                let pozos = JSON.parse(response);
                let template = '';
                pozos.forEach(pozo => {
                    $('#pozos').append(`<option value="${pozo.id}">Pozo ${pozo.id}</option>`)
                })
                
            }
            
        }
    })
}

//Detectar cuando cambie el pozo seleccionado en el drop down menu
function detectarCambio() {
$('#pozos').on('change', function (e) {
    if(!$('#pozos').val() != "-SELECCIONE-"){
        $('#btn-mediciones').prop('disabled', false);
      }
        
        
    });
}


//Ir a la seccion de mediciones
$('#btn-mediciones').click(function(){
    var id = $("#pozos option:selected").val();
    document.location.href = `mediciones.php?id=${id}`;
})

$('#btn-grafica').click(function(){
    var pozo = $('#pozo-medicion').val();
    document.location.href = `medicion-grafica.php?pozo=${pozo}`;
})


//Mostrar form de medicion
$('#btn-agregar-medicion').click(function(){
    $('#div-medicion').removeClass('invisible');
})

$('#btn-cancelar-medicion').click(function(){
    $('#div-medicion').addClass('invisible');
    $('#form-medicion')[0].reset();
})

//Cargar medicion
$('#form-medicion').submit(function(e){
    const datos = {
        pozo: $('#pozo-medicion').val(),
        hora: $('#hora-medicion').val(),
        fecha: $('#fecha-medicion').val(),
        medicion: $('#valor-medicion').val()
    }

    
    $.ajax({
        type: 'POST',
        url: 'guardar-medicion.php',
        data: datos,
        success: function(response){
            $('#div-medicion').addClass('invisible');
            $('#form-medicion')[0].reset();
            mostrarMediciones();
        }
    })
    e.preventDefault();
})


//Mostrar las mediciones en la tabla
function mostrarMediciones(){
    var pozo = $('#pozo-medicion').val();
    $.ajax({
        type: 'get',
        url: 'obtener-mediciones.php',
        data: {'pozo':pozo},
        success: function(response){console.log(response);
            if((!response === false) && (response != null)){
                let mediciones = JSON.parse(response);
                let template ='';
                mediciones.forEach(medicion => {
                  template += `
                    <tr>
                      <td>${medicion.fecha}</td>          
                      <td>${medicion.hora}</td> 
                      <td>${medicion.medicion}</td>
                    </tr>
                  `;
                });
                $('#mediciones').html(template);
              }else{
                $('#mediciones').empty();
              }
        }
    })
}