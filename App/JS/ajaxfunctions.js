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