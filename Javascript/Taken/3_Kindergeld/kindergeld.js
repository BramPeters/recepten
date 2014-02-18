
//
//
var versie = "versie 1.0";
window.onload = function() {
    var eKnop = document.querySelector('#deKnop');

    eKnop.onclick = evalueer;
    function evalueer() {
        /*evalueer of geslaagd of niet*/
        console.log('fn evalueer');
        //invulvelden
        var eKindAantal = document.getElementById('kinderen');
        var eMaandloon = document.getElementById('maandloon');
        //punten
        var nKindAantal = parseInt(eKindAantal.value);
        var nMaandloon = parseInt(eMaandloon.value);
        //evaluatie
        var resultaat = "";
        //test aantal kinderen
        
        if (nKindAantal == 0 || nMaandloon == 0){
                    window.alert("Gelieve correcte getallen in te vullen"); }
        
        if (nKindAantal < 3) {
            nKindloon = 25 * nKindAantal;
        } else {
            if (nKindAantal < 5) {
                nKindloon = ((25 * nKindAantal) + (12.5 * (nKindAantal - 2)));
            }
            else {
                nKindloon = ((25 * nKindAantal) + (12.5 * (nKindAantal - 2)) + (7.5 * (nKindAantal - 4)));
            }
        }

        if (nMaandloon <= 500) {
           resultaat = nKindloon *1.25; 
        }else{ 
            if (nMaandloon <= 2000){
                resultaat = nKindloon;
            }
            else{
              resultaat = nKindloon *.55;   
            }
        }
        if (resultaat < nKindAantal * 25){
            resultaat = nKindAantal * 25;
        }

        console.log(resultaat);
        //output naar div
        var eOutput = document.querySelector('#output');
        eOutput.innerHTML = resultaat + " "+nKindAantal +" "+nKindloon;
    }


}