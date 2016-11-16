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
            sortType = document.getElementById('sortType').selectedIndex;;
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
            sortType = document.getElementById('sortType').selectedIndex;;
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
}



