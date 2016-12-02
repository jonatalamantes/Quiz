var pregunta = [];

function normalInputs(page)
{
    if (page == "login.php")
    {
        $("#txtloginu").css("color", "white");
    }
}

function loginMitad()
{
    var ventana_ancho = $(window).width();
    var ventana_alto = $(window).height();

    var div_ancho = $("#contenedor").width();
    var div_alto  = $("#contenedor").height();

    var nueva_posicion_x = (ventana_ancho - div_ancho)/2;
    $("#contenedor").css("margin-left", nueva_posicion_x);

    if (ventana_alto > div_alto)
    {
        var nueva_posicion_y = (ventana_alto - div_alto)/2;
        $("#contenedor").css("margin-top", nueva_posicion_y);
    }
}

function loadSort(page, id)
{
    if (page == 'alumno_menu.php')
    {
        var sortType = 0;
        var target   = window.location.href;
        var key      = "";

        if (document.getElementById('sortType') !== null)
        {
            sortType = document.getElementById('sortType').selectedIndex;
        }

        if (sortType == 0)
        {
            key = "sort=id";
        }
        else if (sortType == 1)
        {
            key = "sort=nombres";
        }
        else if (sortType == 2)
        {
            key = "sort=apellidoPaterno";
        }

        if (target.indexOf('sort=') >= 0)
        {
            cad1 = target.substring(0, target.indexOf('sort='));
            cad3 = target.substring(target.indexOf('sort='));
            
            if (cad1.indexOf('&') < 0)
            {
                target = cad1 + key;
            }
            else
            {
                cad2 = cad3.substring(cad3.indexOf('&'));
                cad1 = cad1.substring(5);
                target = cad1 + key + cad2;
            }

        }
        else
        {
            if (target.indexOf('?') < 0)
            {
                target = target + "?" + key;
            }
            else
            {
                target = target + "&" + key;
            }
        }

        window.location.href = target;
    }
    else if (page == 'curso_menu.php')
    {
        var sortType = 0;
        var target   = window.location.href;
        var key      = "";

        if (document.getElementById('sortType') !== null)
        {
            sortType = document.getElementById('sortType').selectedIndex;
        }

        if (sortType == 0)
        {
            key = "sort=id";
        }
        else if (sortType == 1)
        {
            key = "sort=nombre";
        }
        else if (sortType == 2)
        {
            key = "sort=ciclo";
        }

        if (target.indexOf('sort=') >= 0)
        {
            cad1 = target.substring(0, target.indexOf('sort='));
            cad3 = target.substring(target.indexOf('sort='));
            
            if (cad1.indexOf('&') < 0)
            {
                target = cad1 + key;
            }
            else
            {
                cad2 = cad3.substring(cad3.indexOf('&'));
                cad1 = cad1.substring(5);
                target = cad1 + key + cad2;
            }

        }
        else
        {
            if (target.indexOf('?') < 0)
            {
                target = target + "?" + key;
            }
            else
            {
                target = target + "&" + key;
            }
        }

        window.location.href = target;
    }
    if (page == 'cuestionario_menu.php')
    {
        var sortType = 0;
        var target   = window.location.href;
        var key      = "";

        if (document.getElementById('sortType') !== null)
        {
            sortType = document.getElementById('sortType').selectedIndex;
        }

        if (sortType == 0)
        {
            key = "sort=id";
        }
        else if (sortType == 1)
        {
            key = "sort=nombre";
        }


        if (target.indexOf('sort=') >= 0)
        {
            cad1 = target.substring(0, target.indexOf('sort='));
            cad3 = target.substring(target.indexOf('sort='));
            
            if (cad1.indexOf('&') < 0)
            {
                target = cad1 + key;
            }
            else
            {
                cad2 = cad3.substring(cad3.indexOf('&'));
                cad1 = cad1.substring(5);
                target = cad1 + key + cad2;
            }

        }
        else
        {
            if (target.indexOf('?') < 0)
            {
                target = target + "?" + key;
            }
            else
            {
                target = target + "&" + key;
            }
        }

        window.location.href = target;
    }    
}

function simpleSearch(page)
{
    if (page == 'alumno_menu.php')
    {
        var sortType = 0;
        var keyword  = document.getElementById('inputSimple').value;
        var target   = "";

        if (document.getElementById('sortType') !== null)
        {
            sortType = document.getElementById('sortType').selectedIndex;
        }

        if (sortType == 0)
        {
            target = page + "?page=0&sort=id&keyword=" + keyword;
        }
        else if (sortType == 1)
        {
            target = page + "?page=0&sort=nombres&keyword=" + keyword;
        }
        else if (sortType == 2)
        {
            target = page + "?page=0&sort=apellidoPaterno&keyword=" + keyword;
        }

        window.location.href = target;
    }
    else if (page == 'curso_menu.php')
    {
        var sortType = 0;
        var keyword  = document.getElementById('inputSimple').value;
        var target   = "";

        if (document.getElementById('sortType') !== null)
        {
            sortType = document.getElementById('sortType').selectedIndex;
        }

        if (sortType == 0)
        {
            target = page + "?page=0&sort=id&keyword=" + keyword;
        }
        else if (sortType == 1)
        {
            target = page + "?page=0&sort=nombre&keyword=" + keyword;
        }
        else if (sortType == 2)
        {
            target = page + "?page=0&sort=ciclo&keyword=" + keyword;
        }

        window.location.href = target;
    }
    else if (page == 'cuestionario_menu.php')
    {
        var sortType = 0;
        var keyword  = document.getElementById('inputSimple').value;
        var target   = "";

        if (document.getElementById('sortType') !== null)
        {
            sortType = document.getElementById('sortType').selectedIndex;
        }

        if (sortType == 0)
        {
            target = page + "?page=0&sort=id&keyword=" + keyword;
        }
        else if (sortType == 1)
        {
            target = page + "?page=0&sort=nombre&keyword=" + keyword;
        }

        window.location.href = target;
    }
}

function advancedSearch(page)
{
    if (page == 'alumno_menu.php')
    {
        var selectTipo        = $("#selectTipo").val();
        var inputNames        = $("#inputNames").val();
        var inputLastname1    = $("#inputLastname1").val();
        var inputLastname2    = $("#inputLastname2").val();
        var inputCodigo       = $("#inputCodigo").val();
        var sortType          = "0";
        var target            = "";

        if (document.getElementById('sortType') !== null)
        {
            sortType = document.getElementById('sortType').selectedIndex;
        }

        if (sortType == 0)
        {
            target = page + "?page=0&sort=id";
        }
        else if (sortType == 1)
        {
            target = page + "?page=0&sort=nombres";
        }
        else if (sortType == 2)
        {
            target = page + "?page=0&sort=apellidoPaterno";
        }

        target = target +   "&kid="             +  
                            "&ktipo="           + selectTipo     +
                            "&kinputNames="     + inputNames     +
                            "&kinputLastname1=" + inputLastname1 +
                            "&kinputLastname2=" + inputLastname2 +
                            "&kinputCodigo="    + inputCodigo;

        window.location.href = target;
    }
    else if (page == 'curso_menu.php')
    {
        var inputNameC        = $("#inputNameC").val();
        var inputCiclo        = $("#inputCiclo").val();
        var sortType          = "0";
        var target            = "";

        if (document.getElementById('sortType') !== null)
        {
            sortType = document.getElementById('sortType').selectedIndex;
        }

        if (sortType == 0)
        {
            target = page + "?page=0&sort=id";
        }
        else if (sortType == 1)
        {
            target = page + "?page=0&sort=nombre";
        }
        else if (sortType == 2)
        {
            target = page + "?page=0&sort=ciclo";
        }

        target = target +   "&kid="     + 
                            "&knombre=" + inputNameC +
                            "&kciclo="  + inputCiclo;

        window.location.href = target;
    }
}

function eliminarPregunta(numeroPregunta)
{
    if (numeroPregunta !== undefined)
    {
        $("#pregunta" + numeroPregunta).css("display", "none");  
        pregunta[numeroPregunta]["activo"] = false;
    }
}

function eliminarOpcion(numeroPregunta, numeroOpcion)
{
    $("#filaOpcion"+numeroPregunta+"-"+numeroOpcion).css("display","none");
    pregunta[numeroPregunta]["opciones"][numeroOpcion]["activo"] = false;

    if (pregunta[numeroPregunta]["respuesta"] == numeroOpcion)
    {
        pregunta[numeroPregunta]["respuesta"] = -1;
    }
}

function actualizarOpcion(numeroPregunta, numeroOpcion)
{
    texto = $('#opcion'+numeroPregunta+"-"+numeroOpcion).val();
    pregunta[numeroPregunta]["opciones"][numeroOpcion]["descripcion"] = texto;   
}

function agregarOpcion(numeroPregunta)
{
    if (numeroPregunta !== undefined)
    {
        contenidoAntiguo = $("#tablaOpcionesPregunta" + numeroPregunta).html();

        numeroOpcion = pregunta[numeroPregunta]["opciones"].length;

        contenidoNuevo = "<tr id='filaOpcion"+numeroPregunta+"-"+numeroOpcion+"'><td>";
        contenidoNuevo += "<div class='input-group'>";
        contenidoNuevo += "<div class='input-group-btn'>";
        contenidoNuevo += "<button class='btn btn-default' style='margin-top: 0px; margin-left: 3px' onclick='marcarRespuesta("+numeroPregunta+","+numeroOpcion+")'>";
        contenidoNuevo += "<img src='' id='marca"+numeroPregunta+"-"+numeroOpcion+"' height='15px'>";
        contenidoNuevo += "</button>";   
        contenidoNuevo += "</div>";
        contenidoNuevo += "<input type='text' id='opcion"+numeroPregunta+"-"+numeroOpcion+"' class='form-control' onkeyup='inputUpper(\"opcion"+numeroPregunta+"-"+numeroOpcion+"\"); actualizarOpcion("+numeroPregunta+","+numeroOpcion+")'>";
        contenidoNuevo += "<div class='input-group-btn'>";        
        contenidoNuevo += "<button class='btn btn-default btn-warning' style='margin-top: 0px; margin-left: 3px' onclick='eliminarOpcion("+numeroPregunta+","+numeroOpcion+")'>";
        contenidoNuevo += "<img src='icons/deleteLight.png' height='15px'>";
        contenidoNuevo += "</button>";
        contenidoNuevo += "</div>";
        contenidoNuevo += "</div>";
        contenidoNuevo += "</td></tr>";

        posLast = contenidoAntiguo.indexOf("lastRow");

        if (posLast !== -1)
        {
            posLast = posLast - 11;
            contenido = contenidoAntiguo.substring(0,posLast) + contenidoNuevo + contenidoAntiguo.substring(posLast);

            $("#tablaOpcionesPregunta" + numeroPregunta).html(contenido);

            pregunta[numeroPregunta]["opciones"].push({numero: numeroOpcion, descripcion:"", activo:true});

            for (i = 0; i < pregunta[numeroPregunta]["opciones"].length; i++)
            {
                texto = pregunta[numeroPregunta]["opciones"][i]["descripcion"];   
                $('#opcion'+numeroPregunta+"-"+i).val(texto);
            }
        }
    }

    desmarcarRespuestas(numeroPregunta);
}

function marcarRespuesta(numeroPregunta, numeroOpcion)
{
    if (pregunta[numeroPregunta] !== undefined &&
        pregunta[numeroPregunta]["opciones"][numeroOpcion] !== undefined &&
        pregunta[numeroPregunta]["opciones"][numeroOpcion]["descripcion"] != "")
    {
        desmarcarRespuestas(numeroPregunta);
        $("#marca"+numeroPregunta+"-"+numeroOpcion).attr("src", "icons/check.png");
        pregunta[numeroPregunta]["opciones"][numeroOpcion]["respuesta"] = true;
    }
    else
    {
        alerta("Opcion Invalida, trate de agregar texto a la opcion");
    }
}

function desmarcarRespuestas(numeroPregunta)
{
    for (i = 0; i < pregunta[numeroPregunta]["opciones"].length; i++)
    {
        $("#marca"+numeroPregunta+"-"+i).attr("src", "icons/delete.png");
        pregunta[numeroPregunta]["opciones"][i]["respuesta"] = false;
    }
}

function alerta(msg)
{
    $("#dialogoError").html(msg);
    $("#dialogoError").dialog({modal: true});
}

function generarEstructuraLimpia()
{
    estructuraLimpia = [];

    contadorFilas = 0;
    for (i = 0; i < pregunta.length; i++)
    {
        if (pregunta[i]["activo"])
        {
            objPregunta = {pos: contadorFilas, 
                           nombrePregunta: pregunta[i]["nombrePregunta"], 
                           activo:true, opciones:[]};

            estructuraLimpia.push(objPregunta);

            contadorColumna = 0;
            posRespuesta = 0;
            for (j = 0; j < pregunta[i]["opciones"].length; j++)
            {
                if (pregunta[i]["opciones"][j]["activo"] && pregunta[i]["opciones"][j]["descripcion"] != "")
                {
                    objOpcion = {numero: contadorColumna, 
                                 descripcion:pregunta[i]["opciones"][j]["descripcion"], 
                                 activo:true,
                                 respuesta:pregunta[i]["opciones"][j]["respuesta"]};

                    estructuraLimpia[contadorFilas]["opciones"].push(objOpcion);

                    contadorColumna++;

                    if (pregunta[i]["respuesta"] <= j)
                    {
                        posRespuesta++;
                    }
                }
            }

            estructuraLimpia[contadorFilas]["respuesta"] = posRespuesta;
 
            contadorFilas++;
        }
    }

    //console.log(estructuraLimpia);

    return estructuraLimpia;
}

function agregarPregunta()
{
    if ($("#txtAgregarPregunta").val() != undefined && $("#txtAgregarPregunta").val() !== "")
    {
        pos = pregunta.length;
        //console.log("hola");
        //console.log(pos);
        arrayOpciones = [];
        //console.log(arrayOpciones);
        objPregunta = {pos:pos, nombrePregunta:$("#txtAgregarPregunta").val(), activo:true, opciones:arrayOpciones, respuesta:-1};
        //console.log(objPregunta);
        pregunta.push(objPregunta);
        //console.log(pregunta);
        elem = objPregunta;
        //console.log(elem);

        cad = "#pregunta"+elem["pos"];
        //console.log(cad);

        contenidoNuevo = "<div id='pregunta"+(elem["pos"])+"'>";
        contenidoNuevo += "<div class='well wellEspecial'>";
        contenidoNuevo += "<label>"+elem["nombrePregunta"]+"</label>";

        contenidoNuevo += "<table id='tablaOpcionesPregunta"+elem["pos"]+"' class='table table-condensed cf' style='background-color: transparent'><tbody>";

        contenidoNuevo += "<tr><td>";
        contenidoNuevo += "<button class='form-control btn btn-warning' style='padding-button: 15px' onclick='eliminarPregunta("+elem["pos"]+")'>";
        contenidoNuevo += "<img src='icons/deleteLight.png' height='15px' style='margin-top:-5px; margin-right:5px'>Eliminar Pregunta";
        contenidoNuevo += "<img src='icons/deleteLight.png' height='15px' style='margin-top:-5px; margin-left:5px'>";
        contenidoNuevo += "</button>";
        contenidoNuevo += "</td></tr>";

        contenidoNuevo += "<tr class='lastRow'><td>";
        contenidoNuevo += "<button class='form-control btn btn-warning' style='padding-button: 15px' onclick='agregarOpcion("+elem["pos"]+")'>";
        contenidoNuevo += "<img src='icons/plusLight.png' height='20px' style='margin-top:-5px; margin-right:5px'>Agregar Opcion";
        contenidoNuevo += "<img src='icons/plusLight.png' height='20px' style='margin-top:-5px; margin-left:5px'>";
        contenidoNuevo += "</button>";
        contenidoNuevo += "</td></tr>";

        contenidoNuevo += "</tbody></table>";
        contenidoNuevo += "</div>";

        contenidoNuevo += "</div></div>";
        contenidoNuevo = $("#preguntas").html() + contenidoNuevo;

        $("#preguntas").html(contenidoNuevo);
        $("#txtAgregarPregunta").val("");

        agregarOpcion(elem["pos"]);
        agregarOpcion(elem["pos"]);

        for (i = 0; i < pregunta.length; i++)
        {
            for (j = 0; j < pregunta[i]["opciones"].length; j++)
            {
                texto = pregunta[i]["opciones"][j]["descripcion"];   
                $('#opcion'+i+"-"+j).val(texto);
            }
        }

    }
}

