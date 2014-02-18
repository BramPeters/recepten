
//
//
var versie = "versie 3.0";
window.onload = function() {
    //functie 
    
// document.write(navigator.appName);
// document.write("<P>");
// document.write(navigator.appVersion);
    
    var eOutput = document.getElementById('output');
    var aFeatures = [[document.images,'documents.images'], [document.layers,'documents.layers'], [document.all,'documents.all'],[document.getElementById,'documents.getElementById'], [document.querySelector,'documents.querySelector'], [document.styleSheets,'documents.styleSheets'], [document.createElement,'documents.createElement']];
    var sLijst = "";
    sLijst += "<ul>";


//eOutput.innerHTML += "<span class='tag'" + " id='term_" + arrTags[i][0] + "'" + ">" + arrTags[i][0] + "</span>";
  //                  var eTag = document.querySelector('#term_' + arrTags[i][0]);
    //                eTag.style.position = "absolute";



    for (var i = 0; i < aFeatures.length; i++) {
       // var eTag="";
        if (aFeatures[i][0]!==undefined) {
            sLijst += "<li"+" id='term_" + i +"'>" +aFeatures[i][1] + ": wel" + "</li>";
           // eTag = document.querySelector('#term_' + i);
            
            console.log(aFeatures[i] + ": wel");
        } else {
            sLijst += "<li"+" id='term_" + i +"'>" +aFeatures[i][1] + ": niet" + "</li>";
            eTag = document.querySelector('#term_' + i);
           // 
            console.log(aFeatures[i] + ": niet");
        }
    }
    sLijst += "</ul>";


   eOutput.innerHTML = sLijst;
   
   for (var i = 0; i < aFeatures.length; i++) {
       if (aFeatures[i][0]) {
           eTag = document.getElementById('term_' + i);
            eTag.style.color = "green";
           } else {
               eTag = document.getElementById('term_' + i);
            eTag.style.color = "red";
           }
       }
   
};


