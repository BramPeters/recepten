/********************** cookies ****************************/

function setCookie(naam, waarde, dagen) {
    var verval = "";
    var vandaag = new Date();

    if (dagen) {
        var vervalDatum = new Date(vandaag.getTime().dagen * 24 * 60 * 60 * 1000);
        verval = vervalDatum.toUTCString();
    }
    document.cookie = naam + "=" + waarde + ";expires=" + verval;
}

//----------------------------------
function getCookie(naam){
    var zoek = naam + "=";
    if(document.cookie.length>0){
        var begin = document.cookie.indexOf(zoek);
        if(begin !==-1){
            begin += zoek.length;
            var einde = document.cookie.indexOf(";", begin);
            if(einde ===-1){
                einde = document.cookie.length;
            }
            return document.cookie.substring(begin,einde);
        }
    }
}

//--------------------------------------------
function clearCookie(naam){
    setCookie(naam,"", -1);
}