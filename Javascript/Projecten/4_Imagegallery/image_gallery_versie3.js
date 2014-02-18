//
//
var versie = "versie 3.0";
window.onload = function() {
    var eNoScript = document.getElementById('noscript');
    eNoScript.style.display="none";
    
//array geladen?
    if (typeof aModernArt == "undefined") {
        throw new Error("array aModernArt niet gevonden");
    }
    else {


        var eKop = document.querySelector('h1');
        eKop.innerHTML = eKop.innerHTML + versie;

        var eImg = document.getElementById('plaatshouder');
        //
        //var eSidebar = document.querySelector('aside');
        //var eLinks = eSidebar.getElementsByTagName('a');
        eLink = document.querySelectorAll('aside a');
        console.log('sidebarLinks %s', eLink.length);

        var eKeuzelijst = maakKeuzelijst(aModernArt);
        var eSidebar = document.querySelector('aside');
        eSidebar.appendChild(eKeuzelijst);
        eKeuzelijst.addEventListener("change", function(e){
            var waarde = this.value;
            console.log(waarde);
            if(waarde!="" && waarde !=null){
                toonFoto(waarde,eImg);
            }
        });
    }
    ;
    function maakKeuzelijst(a){
        var nArt = a.length;
        var eSelect = document.createElement('select');
        eSelect.id = "keuzelijst";
        var eOption = document.createElement('option');
        eOption.innerHTML = "maak een keuze";
        eOption.setAttribute("value", "");
        eSelect.appendChild(eOption);
        for(var i=0; i<nArt;i++){
            var eOption = document.createElement('option');
            eOption.innerHTML = a[i][2];
            eOption.value = i;
            eSelect.appendChild(eOption);
        }
        return eSelect;
    }
    
    function toonFoto(nIndex, eImg) {
        aArt = aModernArt[nIndex];
        sPad = aArt[0];
        sInfo = aArt[1];
        sNaam = aArt[2];
        
        eImg.src = "art/"+sPad;
        var eInfo = document.getElementById('info');
        

        if (eInfo) {
            //einfo bestaat reeds
            eInfo.innerHTML = sInfo;
        }
        else {
            var eInfo = document.createElement('p');
            eInfo.id = "info";
            eInfo.innerHTML = sInfo;
            eImg.parentNode.insertBefore(eInfo, eImg.parentNode.firstChild);
        }
    }
};