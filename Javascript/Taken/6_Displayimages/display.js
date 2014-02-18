window.onload = function() {
//

 var aoTekst = [
/*nederlands*/            {show: 'Alle schermen tonen' ,hide: 'Alle schermen verbergen',taal: 'Toon Engels'    },
/*engels*/                {show: 'Show all screenshots',hide: 'Hide all screenshots'   ,taal: 'Switch to dutch'}

            ];

//
    var eTest = document.querySelector('#taalknop');
    var sTaal = 'nl';
    var sCheck= "show";
    var sToon = 'Alle schermen tonen';
    var sShow = 'Show all screenshots';
    var sVerb = 'Alle schermen verbergen';
    var sHide = 'Hide all screenshots';
    var sNl   = 'Toon Engels';
    var sEng  = 'Switch to dutch';
    //
   // var eLink = document.querySelectorAll('dd');

    //hoofdknop; algemeent tonen/verbergen
    var eKnop = document.querySelector('#hoofdknop');
    eKnop.addEventListener('click', function toggleDisplay(){
        //eKnop.innerHTML = "Alle schermen tonen";
        var eSshots = document.getElementsByClassName('screenshot');
        for (i = 0; i < eSshots.length; i++) {
            if (eSshots[i].style.display === null || sCheck==='hide') {
                eSshots[i].style.display = 'block';
                if(sTaal === "nl"){
                    //eKnop.innerHTML = sVerb;
                    eKnop.innerHTML = aoTekst[0]['hide'];
                }else{
                    //eKnop.innerHTML = sHide;
                    eKnop.innerHTML = aoTekst[1]['hide'];
                }             
            } else {
                
                eSshots[i].style.display = 'none';
                if(sTaal === "nl"){
                    //eKnop.innerHTML = sToon;
                    eKnop.innerHTML = aoTekst[0]['show'];
                }else{
                    //eKnop.innerHTML = sShow;
                    eKnop.innerHTML = aoTekst[1]['show'];
                }
            }

            // eLink[i].addEventListener('mouseover', function(i) {
            //     eSshot[i].style.display = 'block';
//            });
        }
        if(sCheck==='show'){ sCheck = 'hide';}else{sCheck = 'show';}        ;
    });

    //taalknop
    //var

    eTest.addEventListener('click', function toggleTaal(){
        //eTest.innerHTML = "Toon Engels";
        //eKnop.innerHTML = "Alle schermen verbergen";
        if (sTaal === 'nl') {
            //eTest.innerHTML = sEng;
            eTest.innerHTML = aoTekst[1]['taal'];
            sTaal = 'Eng';

            if ( eKnop.innerHTML === aoTekst[0]['hide']) {
                //eKnop.innerHTML = sHide;
                    eKnop.innerHTML = aoTekst[1]['hide'];
            } else {
                //eKnop.innerHTML = sShow;
                    eKnop.innerHTML = aoTekst[1]['show'];
            }


        } else {
            //eTest.innerHTML = sNl;
            eTest.innerHTML = aoTekst[0]['taal'];
            sTaal = 'nl';
            if (eKnop.innerHTML === aoTekst[1]['hide']) {
                //eKnop.innerHTML = sVerb;
                    eKnop.innerHTML = aoTekst[0]['hide'];
            } else {
                //eKnop.innerHTML = sToon;
                    eKnop.innerHTML = aoTekst[0]['show'];
            }

        }
    });

    //endof taalknop
//

                screenlinks = document.getElementsByClassName('hover');
                var index = 0;
                for (; index < screenlinks.length; index++) {
                    addHandlerNative(index, screenlinks[index]);
                }

                function addHandlerNative(index, element) {
                    element.addEventListener('click', function(){
                    //element.onclick = function() {
                      //  element.onclick = function() {
                        screenshots = document.getElementsByClassName('screenshot');
                        if(screenshots[index].style.display === null || screenshots[index].style.display === 'none'){
                            screenshots[index].style.display = 'block';}
                        else{
                            
                            screenshots[index].style.display = 'none';}
                        
                    });
                }
            };


