
/* ------ ARRAYS -------------------------*/
//Groenten
var aoGroenten = [
    {naam: "aardappelen", prijs: 0.95, eenheid: "kg"},
    {naam: "avocado", prijs: 2.69, eenheid: "stuk"},
    {naam: "bloemkool", prijs: 1.93, eenheid: "stuk"},
    {naam: "broccoli", prijs: 1.29, eenheid: "stuk"},
    {naam: "champignons", prijs: 0.89, eenheid: "250g"},
    {naam: "chinese kool", prijs: 1.59, eenheid: "stuk"},
    {naam: "groene kool", prijs: 1.69, eenheid: "stuk"},
    {naam: "knolselder", prijs: 1.29, eenheid: "stuk"},
    {naam: "komkommer", prijs: 2.49, eenheid: "stuk"},
    {naam: "kropsla", prijs: 1.69, eenheid: "stuk"},
    {naam: "paprika", prijs: 0.89, eenheid: "net"},
    {naam: "prei", prijs: 2.99, eenheid: "bundel"},
    {naam: "prinsessenbonen", prijs: 1, eenheid: "250g"},
    {naam: "rapen", prijs: 0.99, eenheid: "bundel"},
    {naam: "kropsla", prijs: 1.69, eenheid: "stuk"},
    {naam: "rode kool", prijs: 1.39, eenheid: "stuk"},
    {naam: "sla iceberg", prijs: 1.49, eenheid: "stuk"},
    {naam: "spinazie vers", prijs: 1.89, eenheid: "300g"},
    {naam: "sjalot", prijs: 0.99, eenheid: "500g"},
    {naam: "spruiten", prijs: 1.86, eenheid: "kg"},
    {naam: "trostomaat", prijs: 2.99, eenheid: "500g"},
    {naam: "ui", prijs: 0.89, eenheid: "kg"},
    {naam: "witloof 1ste keus", prijs: 1.49, eenheid: "700g"},
    {naam: "wortelen", prijs: 2.59, eenheid: "kg"},
    {naam: "courgetten", prijs: 1.5, eenheid: "stuk"}
];

//Winkels  

var aoWinkels = [
    {naam: "de fruitmand", adres: "steenstraat 34", post: 8000, gemeente: "Brugge", tel: "050342218", manager: "Francine Lapoule"},
    {naam: "Jos & Anneke", adres: "visserijstraat 1", post: 8400, gemeente: "Oostende", tel: "059463689", manager: "Jos Leman"},
    {naam: "groene vingers", adres: "hoogstraat 108", post: 9000, gemeente: "Gent", tel: "091342218"},
    {naam: "de buurtwinkel", adres: "die laene 22", post: 2000, gemeente: "Antwerpen", tel: "0230342218", manager: "Bert Simoens"}
];

var aoGroentenMandje = [];

//========ENDOF ARRAYS==================================

window.onload = function() {            //WINDOW.ONLOAD~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    console.log('lets get rolling');
    /* ------ KEUZELIJST OPVULLEN -------------------------*/
    //Groenten keuzelijst

    var eGroente = document.getElementById('groente');

    for (var i = 0; i < aoGroenten.length; i++) {
        var oGroente = aoGroenten[i];
        var eOption = document.createElement('option');
        var sValue = document.createTextNode(oGroente.naam + " \(" + oGroente.prijs + " €\/" + oGroente.eenheid + "\)");
        eOption.appendChild(sValue);
        eGroente.appendChild(eOption);
    }

    //Winkels keuzelijst
    var eWinkel = document.getElementById('winkel');
    for (var i = 0; i < aoWinkels.length; i++) {
        var oWinkel = aoWinkels[i];
        var eOption = document.createElement('option');
        var sValue = document.createTextNode(oWinkel.naam);

        //title
        var att = document.createAttribute("title");
        att.value = oWinkel.adres + ", " + oWinkel.post + " " + oWinkel.gemeente;

        eOption.setAttributeNode(att);
        eOption.appendChild(sValue);
        eWinkel.appendChild(eOption);

    }



//========ENDOF KEUZELIJST OPVULLEN==================================

    var efrmBestel = document.frmBestel;
    var eKnopToevoegen = document.getElementById('toevoegen');

    //event handler voor knop toevoegen
    eKnopToevoegen.addEventListener('click', function() {
        berekenen(efrmBestel);
    });
    //event handler voor knop toevoegen               

    //formulier submit
    function berekenen(frm) {
        var eMandje = document.getElementById('winkelmandje');
        console.log(frm);
        var bValid = valideer(frm);
        console.log('formulier ' + frm.name + ' valideert ' + bValid);
        if (bValid === true) {

            var valueKeuze = frm.elements[1].value;
            var aKeuze = valueKeuze.split("(");
            var groente = aKeuze[0]; //Naam van de groente afsplitsen
            var aKeuze2 = aKeuze[1].split(" ");
            var prijs = aKeuze2[0]; //Prijs van de groente afsplitsen
            var aantal = frm.elements[2].value; //aantal uit het form halen
            var subTotaal = parseFloat(prijs * aantal).toFixed(2);
            console.log(groente + " - " + prijs + " - " + aantal);

            var leeg = document.getElementById('leeg');
            var totaal = document.getElementById('totaal');
            leeg.style.display = 'none'; //div voor leeg winkelmandje verbergen

            //Aanmaak groente in winkelmandje

            //check if exists
            if (aoGroentenMandje.length > 0) {

                //

                for (var i = 0; i < aoGroentenMandje.length; i++) {
                    var oGroenteInMandje = aoGroentenMandje[i];
                    console.log(aoGroentenMandje[i]);
                    if (oGroenteInMandje.naam === groente) {
                        //GroenteInMandje.aantal = GroenteInMandje.aantal + aantal;
                        //GroenteInMandje.subTotaal = GroenteInMandje.subTotaal+subTotaal;
                        console.log(oGroenteInMandje.naam + " - " + groente);
                        console.log(oGroenteInMandje.aantal + " - " + aantal);
                        console.log(oGroenteInMandje.subTotaal + " - " + subTotaal);

                    }
                    else {

                        var GroenteInMandje = new Object();
                        GroenteInMandje.naam = groente;
                        GroenteInMandje.aantal = aantal;
                        GroenteInMandje.eenheidsprijs = prijs;
                        GroenteInMandje.subTotaal = subTotaal;
                        aoGroentenMandje.push(GroenteInMandje);
                    }
                    //console.log(oGroenteInMandje.naam+" - " + GroenteInMandje.subTotaal);
                }
            } else {
                var GroenteInMandje = new Object();
                GroenteInMandje.naam = groente;
                GroenteInMandje.aantal = aantal;
                GroenteInMandje.eenheidsprijs = prijs;
                GroenteInMandje.subTotaal = subTotaal;
                aoGroentenMandje.push(GroenteInMandje);
            }
//                var div = document.createElement('div');
//
//                div.innerHTML = "<div class='cel cellinks' id='" + groente + "'>" + "<span class='naam' id='" + groente + "naam'>" + groente + " </span><span class= 'aantal'id='" + groente + "aantal'> " + aantal + "</span><span class='eenheidsprijs'id='" + groente + "eenheidsprijs'>" + prijs + "</span></div><div class='cel celrechts subTotaal'id='" + groente + "subTotaal'>" + subTotaal + "</div>";
//                div.setAttribute('class', 'item'); // and make sure myclass has some styles in css
//                eMandje.insertBefore(div, leeg);
//
//
//
//            //Totaal aanpassen
//            var eTotaal = document.getElementById('totNum');
//            //console.log(eTotaal.innerHTML);
//            eTotaal.innerHTML = (parseFloat(eTotaal.innerHTML) + parseFloat(subTotaal)).toFixed(2);



            //Form resetten na afloop zodat men niet per ongeluk dubbelklikt
            //frm.reset();


            //Tekenen van het winkelmandje

            for (var i = 0; i < aoGroentenMandje.length; i++) {

                var oGroenteInMandje = aoGroentenMandje[i];
                var div = document.createElement('div');
                div.innerHTML = "<div class='cel cellinks' id='" + oGroenteInMandje.naam + "'>" + "<span class='naam'>" + oGroenteInMandje.naam + " </span><span class= 'aantal'> " + oGroenteInMandje.aantal + "</span><span class='eenheidsprijs'>" + oGroenteInMandje.eenheidsprijs + "</span></div><div class='cel celrechts subTotaal'>" + oGroenteInMandje.subTotaal + "</div>";
                div.setAttribute('class', 'item'); // and make sure myclass has some styles in css




                eMandje.insertBefore(div, totaal);
                //document.getElementById("myList").replaceChild(newnode,oldnode);
                //Totaal aanpassen
                var eTotaal = document.getElementById('totNum');
                eTotaal.innerHTML = (parseFloat(eTotaal.innerHTML) + parseFloat(oGroenteInMandje.subTotaal)).toFixed(2);

            }

        }
        ;
    }
    ;



}
;//END OF WINDOW.ONLOAD
function valideer(frm) {
    var bValid = true;

    //loop
    for (var i = 0; i < frm.elements.length; i++) {
        //verwijder vorige foutboodschappen
        hideErrors(frm.elements[i]);
        //validate
        var bVeld = valideerVeld(frm.elements[i]);
        console.log(" het element %s met naam %s valideert %s", frm.elements[i].nodeName, frm.elements[i].name, bVeld);
        if (bVeld === false) {
            bValid = false;
        }
    }

    return bValid;
}

/* ------ VALIDATIE -------------------------*/
var oFouten = {
    required: {
        msg: "verplicht veld",
        test: function(elem) {
            return elem.value !== "";
        }
    },
    number: {
        msg: "getal verwacht groter dan 0",
        test: function(elem) {
            //aantal test enkel de inhoud als getal als er een inhoud is
            if (elem.value !== "") {
                return !isNaN(elem.value) && elem.value > 0;
            } else {
                return true;
            }
        }
    }
};
function valideerVeld(elem) {
    //valideer 1 veld volgens zijn class

    var aFoutBoodschappen = [];

    for (var fout in oFouten) {
        /////////////////////////////////////////CHECKME----------------------------------------------------------------
        var re = new RegExp(("(^|\\s)") + fout + "(\\s|$)"); //regex
        //fouten class aanwezig
        if (re.test(elem.className)) {
            var bTest = oFouten[fout].test(elem);
            console.log("het element %s met name %s wordt gevalideerd door %s: %s", elem.nodeName, elem.name, fout, bTest);
            if (bTest === false) {
                aFoutBoodschappen.push(oFouten[fout].msg);
            }
        }
    }
    if (aFoutBoodschappen.length > 0) {
        showErrors(elem, aFoutBoodschappen);
    }
    return !(aFoutBoodschappen.length > 0);

}

function showErrors(elem, aErrors) {
    //toont alle fouten voor 1 element
    var eBroertje = elem.nextSibling;

    //verberg vorige errors
    hideErrors(elem);

    if (eBroertje !== null || !(eBroertje.nodeName === "UL" && eBroertje.className === "fouten")) {
        eBroertje = document.createElement('ul');
        eBroertje.className = "fouten";
        elem.parentNode.insertBefore(eBroertje, elem.nextSibling);
    }
    //plaats alle foutberichten erin
    for (var i = 0; i < aErrors.length; i++) {
        var eLi = document.createElement('li');
        eLi.innerHTML = aErrors[i];
        eBroertje.appendChild(eLi);
    }
}

function hideErrors(elem) {
    //verbergt alle foutboodschappen
    var eBroertje = elem.nextSibling;
    if (eBroertje && eBroertje.nodeName === 'UL' && eBroertje.className === "fouten") {
        elem.parentNode.removeChild(eBroertje);
    }
}

//========ENDOF VALIDATIE==================================



