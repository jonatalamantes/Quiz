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

function agregarPregunta()
{
    //console.log($("#txtAgregarPregunta").val());
    //console.log("hola");

    if ($("#txtAgregarPregunta").val() != undefined && $("#txtAgregarPregunta").val() !== "")
    {
        pos = pregunta.length;
        //console.log("hola");
        //console.log(pos);
        arrayOpciones = {opcion1:{descripcion:"", activo:true}, opcion2:{descripcion:"", activo:true}};
        //console.log(arrayOpciones);
        objPregunta = {pos:pos, nombrePregunta:$("#txtAgregarPregunta").val(), opciones:arrayOpciones};
        //console.log(objPregunta);
        pregunta.push(objPregunta);
        //console.log(pregunta);
        elem = objPregunta;
        //console.log(elem);

        cad = "#pregunta"+elem["pos"];
        //console.log(cad);

        contenidoNuevo  = "<div class='well'>";
        contenidoNuevo += "<label>"+elem["nombrePregunta"]+"</label>";

        contenidoNuevo += "<table class='table table-condensed cf' style='background-color: transparent'><tbody>";

        contenidoNuevo += "<tr><td>";
        contenidoNuevo += "<button class='form-control btn btn-warning' style='padding-button: 15px'>";
        contenidoNuevo += "<img src='icons/deleteLight.png' height='15px' style='margin-top:-5px; margin-right:5px'>Eliminar Pregunta";
        contenidoNuevo += "<img src='icons/deleteLight.png' height='15px' style='margin-top:-5px; margin-left:5px'>";
        contenidoNuevo += "</button>";
        contenidoNuevo += "</td></tr>";

        contenidoNuevo += "<tr><td>";
        contenidoNuevo += "<div class='input-group'>";
        contenidoNuevo += "<div class='input-group-btn'>";
        contenidoNuevo += "<button class='btn btn-default' style='margin-top: 0px; margin-left: 3px' onclick='marcarRespuesta("+elem["pos"]+",0)'>";
        contenidoNuevo += "<img src='' id='img"+elem["pos"]+"-0' height='15px'>";
        contenidoNuevo += "</button>";
        contenidoNuevo += "</div>";
        contenidoNuevo += "<input type='text' id='"+elem["pos"]+"' class='form-control' onkeyup='inputUpper('"+elem["pos"]+"')'>";
        contenidoNuevo += "<div class='input-group-btn'>";
        contenidoNuevo += "<button class='btn btn-default btn-warning' style='margin-top: 0px; margin-left: 3px' onclick='eliminarOpcion("+elem["pos"]+",0)'>";
        contenidoNuevo += "<img src='icons/deleteLight.png' id='img"+elem["pos"]+"-0' height='15px'>";
        contenidoNuevo += "</button>";
        contenidoNuevo += "</div>";
        contenidoNuevo += "</div>";
        contenidoNuevo += "</td></tr>";

        contenidoNuevo += "<tr><td>";
        contenidoNuevo += "<div class='input-group'>";
        contenidoNuevo += "<div class='input-group-btn'>";
        contenidoNuevo += "<button class='btn btn-default' style='margin-top: 0px; margin-left: 3px' onclick='marcarRespuesta("+elem["pos"]+",0)'>";
        contenidoNuevo += "<img src='' id='img"+elem["pos"]+"-0' height='15px'>";
        contenidoNuevo += "</button>";   
        contenidoNuevo += "</div>";
        contenidoNuevo += "<input type='text' id='"+elem["pos"]+"' class='form-control' onkeyup='inputUpper('"+elem["pos"]+"')'>";
        contenidoNuevo += "<div class='input-group-btn'>";        
        contenidoNuevo += "<button class='btn btn-default btn-warning' style='margin-top: 0px; margin-left: 3px' onclick='eliminarOpcion("+elem["pos"]+",1)'>";
        contenidoNuevo += "<img src='icons/deleteLight.png' id='img"+elem["pos"]+"-1' height='15px'>";
        contenidoNuevo += "</button>";
        contenidoNuevo += "</div>";
        contenidoNuevo += "</div>";
        contenidoNuevo += "</td></tr>";

        contenidoNuevo += "<tr><td>";
        contenidoNuevo += "<button class='form-control btn btn-warning' style='padding-button: 15px'>";
        contenidoNuevo += "<img src='icons/plusLight.png' height='20px' style='margin-top:-5px; margin-right:5px'>Agregar Opcion";
        contenidoNuevo += "<img src='icons/plusLight.png' height='20px' style='margin-top:-5px; margin-left:5px'>";
        contenidoNuevo += "</button>";
        contenidoNuevo += "</td></tr>";

        contenidoNuevo += "</tbody></table>";
        contenidoNuevo += "</div>";

        contenidoNuevo += "</div>";
        contenidoNuevo += "<div id='pregunta"+(elem["pos"]+1)+"'>";

        $(cad).html(contenidoNuevo);
        $("#txtAgregarPregunta").val("");
    }
}

