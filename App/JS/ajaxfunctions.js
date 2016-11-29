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