//JS doc
//script voor homepage
var ikoontjes = {
    header:"ui-icon-circle-arrow-e",
            activeHeader: "ui-icon-circle-arrow-s"
};

$(function(){
    $('#keuzes').accordion({
        active:1,
        icons: ikoontjes,
        heightStyle:"content",
        collapsible:true,
        animate:"easeOutBounce"
    });
});//endof doc ready