window.onload = function() {

    //   setCookie('taal', nTaal, 100);
    //                  window.history.go(0);

    var eOutput = document.getElementById('output');
    var sMsg = '';
    //test cookie
    if (getCookie('taal')) {
        //gekende klant
        //bericht
        sMsg += "Welkom beste bezoeker. ";
        sMsg += "Uw gekozen taal is " + nTaal;
        //knop
        var eKnop = maakKnop('Verwijder taalkeuze uit cookie');
        eKnop.addEventListener('click', taalkeuzeVerwijderen);
        nTaal = "Nederlands";
    }
    else {
        //eerste bezoek
        sMsg += "Welkom beste bezoeker. ";
        sMsg += "Kies uw taal door op een vlaggetje te klikken.";
        //setCookie('taal', nNieuwSaldo, 100);
        //knop
        // var eKnop = document.getElementById('taal');
        //eKnop.addEventListener('click', taalKiezen);
        nTaal = "Nederlands";
    }


    var dfBericht = document.createDocumentFragment();
    //var eNl = document.createElement('br');

    //vervolledig en voeg toe
    var tNode = document.createTextNode(sMsg);
    dfBericht.appendChild(tNode);
    // dfBericht.appendChild(eNl.cloneNode(false));
    //dfBericht.appendChild(eNl.cloneNode(false));
    //dfBericht.appendChild(eKnop);
    eOutput.appendChild(dfBericht);
};

//TAAL KIEZEN
function taalKiezen() {
    //console.log('rekening openen')
    if (nTaal !== "" && nTaal !== null) {
        //  localStorage.setItem('klantnaam', sNaam);
        //  localStorage.setItem('saldo',100);
        setCookie('taal', nTaal, 100);
        window.history.go(0);
    }
}

function taalkeuzeVerwijderen() {
    //console.log('rekening sluiten')
    localStorage.clear();
    //clearCookie('klantnaam');
    //clearCookie('saldo');
    window.history.go(0);
}

//***********************REDIRECT*****************************************
/*
var nTaal = ""; //cookie
switch (nTaal)
{
    case nl:
       window.location="nederlands.html";
        break;
    case fr:
        window.location="francais.html";
        break;
    case en:
        window.location="english.html";
        break;
    default:
        window.location="nederlands.html";
}
*/


//***********************COOKIES******************************************

function setCookie(naam, waarde, dagen) {
    var verval = "";
    var vandaag = Date.now();

    if (dagen) {
        var vervalDatum = new Date(vandaag.getTime().dagen * 24 * 60 * 60 * 1000);
        verval = vervalDatum.toUTCString();
    }
    document.cookie = naam + "=" + waarde + ";expires=" + verval;
}

//----------------------------------
function getCookie(naam) {
    var zoek = naam + "=";
    if (document.cookie.length > 0) {
        var begin = document.cookie.indexOf(zoek);
        if (begin !== -1) {
            begin += zoek.length;
            var einde = document.cookie.indexOf(";", begin);
            if (einde === -1) {
                einde = document.cookie.length;
            }
            return document.cookie.substring(begin, einde);
        }
    }
}

//--------------------------------------------
function clearCookie(naam) {
    setCookie(naam, "", -1);
}