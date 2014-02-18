//
//
var versie = "versie 2.0";
window.onload = function() {
    var eKop = document.querySelector('h1');
    eKop.innerHTML = eKop.innerHTML + versie;

    var eImg = document.getElementById('plaatshouder');
    //
    //var eSidebar = document.querySelector('aside');
    //var eLinks = eSidebar.getElementsByTagName('a');
    eLink = document.querySelectorAll('aside a');
    console.log('sidebarLinks %s', eLink.length);

    for (var i = 0; i < eLink.length; i++) {
        eLink[i].addEventListener('click', function(e) {
            e.preventDefault();
            toonFoto(this /*,eImg*/);
        });
        eLink[i].addEventListener('mouseover', function(e) {
            toonFoto(this, eImg);

        });
    }
};
function toonFoto(eLink, eImg) {
    eImg.src = eLink.href;
    var sInfo = eLink.getAttribute('title');
    var eInfo = document.getElementById('info');

    
    if (eInfo) {
        //einfo bestaat reeds
        eInfo.innerHTML = sInfo;
    }
    else {
        var sInfo = eLink.getAttribute('title');
        var eInfo = document.createElement('p');
        eInfo.id = "info";
        eInfo.innerHTML = sInfo;
        eImg.parentNode.insertBefore(eInfo, eImg.parentNode.firstChild);
    }
}