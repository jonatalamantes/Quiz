$( document ).ready(function() {
    getAutocompletados();
});

function login()
{
    codigo = $("#txtUser").val();
    correcto = true;

    if (codigo == undefined || codigo == "")
    {
        $("#txtloginu").css("color", "red");
        correcto = false;
    }

    if (correcto)
    {
        $.ajax({
            method: "POST",
            url: "JS/scriptsAjax/login.php",
            data: 
            { 
                codigo: codigo
            }
        })
        .done(function( msg) 
        {
            if (msg.indexOf("OK") >= 0)
            {
                if (msg.indexOf("OKAdmin") >= 0)
                {
                    window.location.href = "menu_admin.php";     
                }
                else if (msg.indexOf("OKNormal") >= 0)
                {
                    window.location.href = "menu_normal.php";     
                }

                
            }
            else 
            {
                $("#txtloginu").css("color", "red");
                alert("Alumno no encontrado");                 
            }
        })
        .fail(function() 
        {
            alert("Hubo problemas con el servidor");
        });
    }
}

function getAutocompletados()
{
    page = String(window.location);

    if (page.indexOf("agregar_alumno_curso.php") >= 0)
    {
        $('#txtAlumno').autocomplete({
            minLength: 2,
            source: 'JS/scriptsAjax/getAutocompletadoAlumno.php',
            focus: function( event, ui ) {
                $( '#idAlumno' ).html('0');    
                return false;
            },
            select: function( event, ui ) {
                $( '#txtAlumno' ).val( ui.item.label );
                $( '#idAlumno' ).html( ui.item.id );                     
                $( '#labelAlumno' ).css('color','black');                     
                return false;
            }
        });

        $('#txtCurso').autocomplete({
            minLength: 2,
            source: 'JS/scriptsAjax/getAutocompletadoCurso.php',
            focus: function( event, ui ) {
                $( '#idCurso' ).html('0');    
                return false;
            },
            select: function( event, ui ) {
                $( '#txtCurso' ).val( ui.item.label );
                $( '#idCurso' ).html( ui.item.id );  
                $( '#labelCurso' ).css('color','black');
                return false;
            }
        });
    }

    if (page.indexOf("agregar_cuestionario_curso.php") >= 0)
    {
        $('#txtCuestionario').autocomplete({
            minLength: 2,
            source: 'JS/scriptsAjax/getAutocompletadoCuestionario.php',
            focus: function( event, ui ) {
                $( '#idCuestionario' ).html('0');    
                return false;
            },
            select: function( event, ui ) {
                $( '#txtCuestionario' ).val( ui.item.label );
                $( '#idCuestionario' ).html( ui.item.id );                     
                $( '#labelCuestionario' ).css('color','black');                     
                return false;
            }
        });

        $('#txtCurso').autocomplete({
            minLength: 2,
            source: 'JS/scriptsAjax/getAutocompletadoCurso.php',
            focus: function( event, ui ) {
                $( '#idCurso' ).html('0');    
                return false;
            },
            select: function( event, ui ) {
                $( '#txtCurso' ).val( ui.item.label );
                $( '#idCurso' ).html( ui.item.id );  
                $( '#labelCurso' ).css('color','black');
                return false;
            }
        });
    }
}

function normalData(page)
{
    if (page === 'alumno_insertar.php')
    {
        $('#labelCodigo').css('color', 'black');
        $('#labelNombre').css('color', 'black');
        $('#labelApellidoPaterno').css('color', 'black');
        $('#labelApellidoMaterno').css('color', 'black');
        $('#labelTipo').css('color', 'black');
    }
    else if (page === 'curso_insertar.php')
    {
        $('#labelNombre').css('color', 'black');
        $('#labelCiclo').css('color', 'black');
    }
    else if (page === 'cuestionario_insertar.php')
    {
        $('#labelNombre').css('color', 'black');
    }
}

function validateData(page, status)
{
    if (page === 'alumno_insertar.php')
    {
        correct = true;

        idAlumno           = $("#idAlumno").html();
        txtCodigo          = $("#txtCodigo").val();
        txtNombres         = $("#txtNombres").val();
        txtApellidoPaterno = $("#txtApellidoPaterno").val();
        txtApellidoMaterno = $("#txtApellidoMaterno").val();
        selectTipo         = $("#selectTipo").val();

        if (txtCodigo === undefined || txtCodigo === '0' || txtCodigo === "")
        {
            $('#labelCodigo').css('color', 'blue');
            correct = false;
        }

        if (txtNombres === undefined || txtNombres === "")
        {
            $('#labelNombre').css('color', 'blue');
            correct = false;
        }

        if (txtApellidoPaterno === undefined || txtApellidoPaterno === "")
        {
            $('#labelApellidoPaterno').css('color', 'blue');
            correct = false;
        }

        if (txtApellidoMaterno === undefined || txtApellidoMaterno === "")
        {
            $('#labelApellidoMaterno').css('color', 'blue');
            correct = false;
        }

        if (correct)
        {
            $.ajax
            ({
                data: {
                        'idAlumno'           : idAlumno           ,
                        'txtCodigo'          : txtCodigo          ,
                        'txtNombres'         : txtNombres         ,
                        'txtApellidoPaterno' : txtApellidoPaterno ,
                        'txtApellidoMaterno' : txtApellidoMaterno ,
                        'selectTipo'         : selectTipo         ,
                        'status'             : status           
                      },

                type: "POST",
                url: 'JS/scriptsAjax/updateAlumno.php',
            })
            .done(function( data, textStatus, jqXHR ) 
            {
                if (data.indexOf("OK") !== -1)
                {
                    alert("Guardado Exitoso");
                    window.location.href = "alumno_menu.php";
                }
                else //OK
                {
                    alert("Error en los datos proporcionados");   
                }
            })
            .fail(function( jqXHR, textStatus, errorThrown ) 
            {
                alert("Error al procesar los datos");
            });
        }
    }
    else if (page === 'curso_insertar.php')
    {
        correct = true;

        idCurso   = $("#idCurso").html();
        txtNombre = $("#txtNombre").val();
        txtCiclo  = $("#txtCiclo").val();

        if (txtNombre === undefined || txtNombre === "")
        {
            $('#labelNombre').css('color', 'blue');
            correct = false;
        }

        if (txtCiclo === undefined || txtCiclo === "")
        {
            $('#labelCiclo').css('color', 'blue');
            correct = false;
        }

        if (correct)
        {
            $.ajax
            ({
                data: {
                        'idCurso'   : idCurso   ,
                        'txtNombre' : txtNombre ,
                        'txtCiclo'  : txtCiclo  ,
                        'status'    : status           
                      },

                type: "POST",
                url: 'JS/scriptsAjax/updateCurso.php',
            })
            .done(function( data, textStatus, jqXHR ) 
            {
                if (data.indexOf("OK") !== -1)
                {
                    alert("Guardado Exitoso");
                    window.location.href = "curso_menu.php";
                }
                else //OK
                {
                    alert("Error en los datos proporcionados");   
                }
            })
            .fail(function( jqXHR, textStatus, errorThrown ) 
            {
                alert("Error al procesar los datos");
            });
        }
    }
    else if (page == "agregar_alumno_curso.php")
    {
        correct = true;

        idAlumno = $("#idAlumno").html();
        idCurso  = $("#idCurso").html();

        if (idAlumno === undefined || idAlumno === "" || idAlumno == "0")
        {
            $('#labelAlumno').css('color', 'blue');
            correct = false;
        }

        if (idCurso === undefined || idCurso === "" || idCurso == "0")
        {
            $('#labelCurso').css('color', 'blue');
            correct = false;
        }

        if (correct)
        {
            $.ajax
            ({
                data: {
                        'idCurso'   : idCurso   ,
                        'idAlumno'  : idAlumno
                      },

                type: "POST",
                url: 'JS/scriptsAjax/insertRelacionAlumnoCurso.php',
            })
            .done(function( data, textStatus, jqXHR ) 
            {
                if (data.indexOf("OK") !== -1)
                {
                    alert("Guardado Exitoso");
                    window.location.href = status;
                }
                else //OK
                {
                    alert("Error en los datos proporcionados");   
                }
            })
            .fail(function( jqXHR, textStatus, errorThrown ) 
            {
                alert("Error al procesar los datos");
            });
        }
    }     
    else if (page == "agregar_cuestionario_curso.php")
    {
        correct = true;

        idCuestionario = $("#idCuestionario").html();
        idCurso  = $("#idCurso").html();

        if (idCuestionario === undefined || idCuestionario === "" || idCuestionario == "0")
        {
            $('#labelCuestionario').css('color', 'blue');
            correct = false;
        }

        if (idCurso === undefined || idCurso === "" || idCurso == "0")
        {
            $('#labelCurso').css('color', 'blue');
            correct = false;
        }

        if (correct)
        {
            $.ajax
            ({
                data: {
                        'idCurso'   : idCurso   ,
                        'idCuestionario'  : idCuestionario
                      },

                type: "POST",
                url: 'JS/scriptsAjax/insertRelacionCuestionarioCurso.php',
            })
            .done(function( data, textStatus, jqXHR ) 
            {
                if (data.indexOf("OK") !== -1)
                {
                    alert("Guardado Exitoso");
                    window.location.href = status;
                }
                else //OK
                {
                    alert("Error en los datos proporcionados");   
                }
            })
            .fail(function( jqXHR, textStatus, errorThrown ) 
            {
                alert("Error al procesar los datos");
            });
        }
    }     
    else if (page == "cuestionario_insertar.php")
    {
        nombreQuiz = $("#txtNombre").val();
        correct = true;

        if (nombreQuiz == undefined || nombreQuiz == "")
        {
            $("#labelNombre").css("color", "blue");
            correct = false;
        }

        if (correct)
        {
            estructuraLimpia = generarEstructuraLimpia();

            if (estructuraLimpia.length == 0)
            {
                alerta("Favor de Agregar Preguntas");
                correct = false;
            }

            if (correct)
            {
                arregloPreguntasFallidas = [];
                
                for (i = 0; i < estructuraLimpia.length; i++)
                {
                    if (estructuraLimpia[i]["respuesta"] != -1)
                    {
                        if (estructuraLimpia[i]["opciones"].length <= 1)
                        {
                            arregloPreguntasFallidas.push({pregunta:i, razon:"faltan opciones"});
                        }
                        else
                        {
                            arregloDistintos = [];

                            tieneRespuesta = false;

                            for (j = 0; j < estructuraLimpia[i]["opciones"].length; j++)
                            {
                                descripcion = estructuraLimpia[i]["opciones"][j]["descripcion"];
                                if (estructuraLimpia[i]["opciones"][j]["respuesta"])
                                {
                                    tieneRespuesta = true;
                                }

                                if (arregloDistintos.indexOf(descripcion) == -1)
                                {
                                    arregloDistintos.push(descripcion);
                                }
                                else
                                {
                                    arregloPreguntasFallidas.push({pregunta:i, razon:descripcion});
                                }
                            }

                            if (!tieneRespuesta)
                            {
                                arregloPreguntasFallidas.push({pregunta:i, razon:"no respuesta"});
                            }
                        }
                    }
                    else
                    {
                        arregloPreguntasFallidas.push({pregunta:i, razon:"no respuesta"});
                    }
                }

                //console.log(arregloPreguntasFallidas);

                if (arregloPreguntasFallidas.length == 0)
                {
                    //Script de Ajax
                    $.ajax
                    ({
                        data: {data:estructuraLimpia, nombreCuestionario:nombreQuiz},
                        type: "POST",
                        url: 'JS/scriptsAjax/insertarCuestionario.php',
                    })
                    .done(function( data, textStatus, jqXHR ) 
                    {
                        if (data.indexOf("OK") !== -1)
                        {
                            alert("Guardado Exitoso");
                            window.location.href = status;
                        }
                        else //OK
                        {
                            alert("Error en los datos proporcionados");   
                        }
                    })
                    .fail(function( jqXHR, textStatus, errorThrown ) 
                    {
                        alert("Error al procesar los datos");
                    });
                }
                else
                {
                    alertaVar = "Ha habido preguntas Incorrectas<br>";

                    for (i = 0; i < arregloPreguntasFallidas.length; i++)
                    {
                        if (arregloPreguntasFallidas[i]["razon"] == "no respuesta")
                        {
                            alertaVar += "La pregunta " + (i+1) + ": no tiene respuesta";
                        }
                        else if (arregloPreguntasFallidas[i]["razon"] == "faltan opciones")
                        {
                            alertaVar += "La pregunta " + (i+1) + ": debe de tener por lo menos dos opciones";
                        }
                        else 
                        {
                            alertaVar += "La pregunta " + (i+1) + ": Se repite la opcion '" + arregloPreguntasFallidas[i]["razon"] + "'";
                        }

                        alertaVar += "<br>";
                    }

                    alerta(alertaVar);
                }
            }
        }
    }  
    else if (page == "contestar.php")
    {
        if (respuesta.length == 0)
        {
            alerta("Favor de Insertar por lo menos una respuesta");
        }
        else
        {
            msg = ("Una vez apretado este botón se habrá terminado el Quiz. ¿Desea continuar?");

            $("#dialogoError").html(msg);

            $("#dialogoError").dialog({
                resizable: false,
                height: "auto",
                width: 400,
                modal: true,
                buttons: {
                    "Continuar": function() {
                        $("#dialogoError").dialog( "close" );
                        $("#btn-guardar").attr("disabled", true);
                        nombreQuiz = $("#txtNombre").val();

                        $.ajax
                        ({
                            data: {data:respuesta, nombreCuestionario:nombreQuiz},
                            type: "POST",
                            url: 'JS/scriptsAjax/insertarRespuestas.php',
                        })
                        .done(function( data, textStatus, jqXHR ) 
                        {
                            if (data.indexOf("OK") !== -1)
                            {
                                $("#btn-guardar").attr("disabled", false);
                                alerta("Guardado Exitoso");
                                window.location.href = status;
                            }
                            else //OK
                            {
                                $("#btn-guardar").attr("disabled", false);
                                alerta("Error en los datos proporcionados");   
                            }
                        })
                        .fail(function( jqXHR, textStatus, errorThrown ) 
                        {
                            $("#btn-guardar").attr("disabled", false);
                            alerta("Error al procesar los datos");
                        });
                    },
                    "Regresar al Cuestionario": function() {
                        $("#dialogoError").dialog( "close" );
                    }
                }
            });
        }
    } 
}

function deleteObject(objectName, id)
{
    correct = confirm("¿Esta seguro que desea eliminar el registro No." + id + "?");
    
    if (objectName === 'alumno')
    {
        if (correct)
        {
            //Get the data for insert in the database
            var datosEnv  = 'JS/scriptsAjax/deleteAlumno.php?id=' + id;

            var ajax = new XMLHttpRequest();

            //Revision del objeto funcionando
            ajax.onreadystatechange = function() 
            {
                if (ajax.readyState == 4 && ajax.status == 200) 
                {
                    if (ajax.responseText.indexOf("OK") !== -1)
                    {
                        alert("Guardado Exitoso");
                        window.location.reload();
                    }
                    else //OK
                    {
                        alert("Error Eliminando los datos");
                    }
                }
            }

            //Envio de datos al servidor
            ajax.open("GET",datosEnv,true);
            ajax.send();
        }
    }
    else if (objectName === 'curso')
    {
        if (correct)
        {
            //Get the data for insert in the database
            var datosEnv  = 'JS/scriptsAjax/deleteCurso.php?id=' + id;

            var ajax = new XMLHttpRequest();

            //Revision del objeto funcionando
            ajax.onreadystatechange = function() 
            {
                if (ajax.readyState == 4 && ajax.status == 200) 
                {
                    if (ajax.responseText.indexOf("OK") !== -1)
                    {
                        alert("Guardado Exitoso");
                        window.location.reload();
                    }
                    else //OK
                    {
                        alert("Error Eliminando los datos");
                    }
                }
            }

            //Envio de datos al servidor
            ajax.open("GET",datosEnv,true);
            ajax.send();
        }
    }
}


function deleteRelacionAlumnoCurso(idAlumno, idCurso)
{
    if (idAlumno == undefined || idAlumno == "" || idAlumno == "0" ||
        idCurso  == undefined || idCurso  == "" || idCurso  == "0")
    {
        alert("No hay nada para eliminar");
    }
    else
    {
        correct = confirm("¿Esta seguro que desea eliminar esta relacion entre el alumno y el curso?");

        if (correct)
        {
            //Get the data for insert in the database
            var datosEnv  = 'JS/scriptsAjax/deleteRelacionAlumnoCurso.php?idAlumno=' + idAlumno + "&idCurso=" + idCurso;

            var ajax = new XMLHttpRequest();

            //Revision del objeto funcionando
            ajax.onreadystatechange = function() 
            {
                if (ajax.readyState == 4 && ajax.status == 200) 
                {
                    if (ajax.responseText.indexOf("OK") !== -1)
                    {
                        alert("Guardado Exitoso");
                        window.location.reload();
                    }
                    else //OK
                    {
                        alert("Error Eliminando los datos");
                    }
                }
            }

            //Envio de datos al servidor
            ajax.open("GET",datosEnv,true);
            ajax.send();
        }
    }
}

function deleteRelacionCuestionarioCurso(idCuestionario, idCurso)
{
    if (idCuestionario == undefined || idCuestionario == "" || idCuestionario == "0" ||
        idCurso  == undefined || idCurso  == "" || idCurso  == "0")
    {
        alert("No hay nada para eliminar");
    }
    else
    {
        correct = confirm("¿Esta seguro que desea eliminar esta relacion entre el alumno y el curso?");

        if (correct)
        {
            //Get the data for insert in the database
            var datosEnv  = 'JS/scriptsAjax/deleteRelacionCuestionarioCurso.php?idCuestionario=' + idCuestionario + "&idCurso=" + idCurso;

            var ajax = new XMLHttpRequest();

            //Revision del objeto funcionando
            ajax.onreadystatechange = function() 
            {
                if (ajax.readyState == 4 && ajax.status == 200) 
                {
                    if (ajax.responseText.indexOf("OK") !== -1)
                    {
                        alert("Guardado Exitoso");
                        window.location.reload();
                    }
                    else //OK
                    {
                        alert("Error Eliminando los datos");
                    }
                }
            }

            //Envio de datos al servidor
            ajax.open("GET",datosEnv,true);
            ajax.send();
        }
    }
}