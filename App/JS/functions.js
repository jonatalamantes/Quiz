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

function hiddenElement(id, status, type)
{
    if (status === "true")
    {
        $("#" + id).css("display", "none");
    }
    else
    {
        if (type === undefined)
        {
            $("#" + id).css("display", "block");
        }
        else
        {
            $("#" + id).css("display", type);
        }        
    }
}

function href(url)
{
    window.location.href = url;
}

