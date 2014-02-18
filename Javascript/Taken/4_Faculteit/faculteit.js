
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
        var eFaculteit = document.getElementById('getal');
        //punten
        var nFaculteit = parseInt(eFaculteit.value);
        //evaluatie
        var resultaat = "";
        //test aantal kinderen

        if (nFaculteit < 0 || isNaN(nFaculteit) || nFaculteit === "") {
            window.alert("Gelieve correcte getallen in te vullen");
        } else {
            resultaat = 1;
            if (nFaculteit === 0 || nFaculteit === 1) {

            } else {
                i = nFaculteit;
                while (i >= 1) {
                    resultaat = resultaat * i;
                    i--;

                }

            }

        }

        console.log(resultaat);
        //output naar div
        var eOutput = document.querySelector('#output');
        eOutput.innerHTML = nFaculteit + "! = " + resultaat;
    }


};