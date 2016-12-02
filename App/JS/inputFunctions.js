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

function nextPage(state, number)
{
    url = String(window.location);
    
    pageBegin = -1;

    for (var i = 0; i < url.length - 5; i++) 
    {
        if (url.substring(i, i+5) == 'page=')
        {
            pageBegin = i;
            break;
        }
    }

    if (pageBegin == -1) //page 0
    {
        if (state === 'true' || state === 'false')
        {
            if (url.indexOf('?') == -1)
            {
                url = url + "?page=1";
            }
            else
            {
                url = url + "&page=1";
            }
        }
        else
        {
            if (url.indexOf('?') == -1)
            {
                url = url + "?page=" + number;
            }
            else
            {
                url = url + "&page=" + number;
            }   
        }
    }
    else
    {
        pageEnd = -1;

        for (i = pageBegin; i < url.length; i++)
        {
            if (url[i] == '&')
            {
                pageEnd = i;
                break;
            }
        }

        if (pageEnd == -1)
        {
            pageEnd = url.length;
        }

        urlPrev = url.substring(pageBegin, pageEnd);

        if (state == 'true')
        {
            urlNext = "page=" + (parseInt(urlPrev.substring(5)) + 1);
        }
        else if (state == 'set')
        {
            urlNext = "page=" + number;
        }
        else
        {
            urlNext = "page=" + (parseInt(urlPrev.substring(5)) - 1);
        }

        url = url.replace(urlPrev, urlNext);
    }

    window.location.href = url;
}

function inputNumeric(id)
{
    obj =  document.getElementById(id);

    cad = obj.value;

    var letras = '01234567890+-';

    for (var i = 0; i < cad.length; i++) 
    {
        if (letras.indexOf(cad[i]) === -1)
        {
            cad = cad.substring(0, i) + cad.substring(i+1, i+2);
            i--;
        }
    }
    
    obj.value = cad;
}

function inputName(id)
{
    obj =  document.getElementById(id);
    cad = obj.value;

    var letrasM = 'ABCDEFGHIJKLMNOPQRSTUVWXYZÑÁÉÍÓÚŮ .';
    var letrasm = 'abcdefghijklmnopqrstuvwxyzñáéíóúů .';

    while (cad[0] == " ")
    {
        cad = cad.substring(1);
    }

    if (cad.length > 1) //put the upper at begin
    {
        if (letrasM.indexOf(cad[0]) == -1)
        {
            cad = cad.substring(0,1).toUpperCase() + cad.substring(1).toLowerCase();
        }
    }

    for (var i = cad.length -2; i >= 0; i--) //validate the space + upper
    {
        if (cad[i] == " ")
        {
            cad = cad.substring(0, i+1)+cad.substring(i+1, i+2).toUpperCase() + cad.substring(i+2);
        }
    }

    if (cad[cad.length-2] == " ") //begin of name
    {
        if (letrasM.indexOf(cad[cad.length-1]) == -1)
        {
            if (letrasm.indexOf(cad[cad.length-1]) == -1)
            {
                cad = cad.substring(0, cad.length - 1);
            }
            else
            {
                cad = cad.substring(0, cad.length-1) + cad[cad.length-1].toUpperCase();
            }
        }
    }
    else
    {
        if (letrasM.indexOf(cad[cad.length-1]) == -1)
        {
            if (letrasm.indexOf(cad[cad.length-1]) == -1) //middle letter
            {
                cad = cad.substring(0, cad.length - 1);
            }
        }
        else
        {
            cad = cad.substring(0, cad.length - 1) + cad.substring(cad.length-1).toLowerCase();        
        }
    }
    
    if (cad.length === 1)
    {
        cad = cad.toUpperCase();
    }

    obj.value = cad;
}

function inputCharacter(id)
{
    obj =  document.getElementById(id);

    cad = obj.value;

    var letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZÑÁÉÍÓÚŮ abcdefghijklmnopqrstuvwxyzñáéíóúů01234567890#$%&/.,!?¿*+-';

    if (letras.indexOf(cad[cad.length - 1]) == -1)
    {
        cad = cad.substring(0, cad.length - 1);
    }
    
    obj.value = cad;
}

function inputUpper(id)
{
    inputCharacter(id);

    obj =  document.getElementById(id);    
    obj.value = obj.value.toUpperCase();
}

function inputLower(id)
{
    inputCharacter(id);

    obj =  document.getElementById(id);    
    obj.value = obj.value.toLowerCase();
}