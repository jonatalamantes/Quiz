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
}

function validateData(page, status)
{
    if (page === 'alumno_insertar.php')
    {
        correct = true;

        idAlumno           = $("#idAlumno").html();
        txtCodigo          = $("#txtCodigo").val();
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
}
