window.onload = function() {
    var eKnop = document.getElementById('reset');
    eKnop.addEventListener('click', taalkeuzeVerwijderen);
};

/************* FUNCTIES **************/
function taalkeuzeVerwijderen() {
    clearCookie('taal');
    window.location = "intro.html";
};