//JS code voor de intro pagina van taalkeuze
  var cookie = getCookie('taal');
       
            
window.onload = function() {
     
    switch (cookie) {
            case 'nl':
                window.location = 'nederlands.html';
            break;
                
            case 'fr':
                window.location = 'francais.html';
            break;
                
            case 'en':
                window.location = 'english.html';
            break;        
        }
        
    //autoForward(null);    
    
    var aKeuzes = document.getElementsByClassName('keuze');
    
    for (var i = 0; i < aKeuzes.length; i++) {
        var eKeuze = aKeuzes[i];
        eKeuze.onclick = autoForward;       
    }
};    
  
  function test(e){
      
      console.log(this.nodeName);
  }
  
  
//*******************REDIRECT************* 
function autoForward(event) {
//    if (event === null) {
//        //check cookie
//         
//        }
//    } else {
        // Check link   
        var link = event.currentTarget;
        console.log("this:",this.nodeName)
        switch (link.id) {
            
            case 'nl':
                setCookie('taal', 'nl', 100);
                window.location = "nederlands.html";
            break;
                
            case 'fr':
                setCookie('taal', 'fr', 100);
                window.location = "francais.html";
            break;
                
            case 'en':
                setCookie('taal', 'en', 100);
                window.location = "english.html";
            break;
        }
  }
