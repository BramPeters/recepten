$(function() {
    // enkele pagina omzetten in tabs
    $('#inhoud').tabs({
        active: 0 //focus op de eerste tab
    });

    //
    $("#frmVlucht").submit(function(e) {
        //e.preventDefault();
    });

    //slideshow #prent
    $("#prent").slidesjs({
        width: 600,
        height: 100,
        effect: {slide: {speed: 20000}},
        play: {auto: true}

    });



    //retour aanvinken
    $('#retour').checked = true;


    //datepicker toevoegen aan de datumkeuzevelden
    $.datepicker.setDefaults($.datepicker.regional["nl-BE"]);
    $("#vertrekdatum").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: '-0:+01', //max 1 jaar in de toekomst reserveren
        minDate: 0, //niet toelaten dat men reserveert voor een reeds gepasseerde datum
        changeMonth: true,
        changeYear: true,
        onSelect: function(selected) {
            $("#terugdatum").datepicker("option", "minDate", selected);    //niet toelaten dat men vroeger terugkeert dan men vertrekt
        }

    });
    $("#terugdatum").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: '-0:+01',
        changeMonth: true,
        changeYear: true
    });
    $("#checkindatum").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: '-0:+01',
        minDate: 0,
        changeMonth: true,
        changeYear: true,
        onSelect: function(selected) {
            $("#checkoutdatum").datepicker("option", "minDate", selected);    //niet toelaten dat men vroeger terugkeert dan men vertrekt
        }
    });
    $("#checkoutdatum").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: '-0:+01',
        changeMonth: true,
        changeYear: true
    });
    $("#pickupdatum").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: '-0:+01',
        minDate: 0,
        changeMonth: true,
        changeYear: true,
        onSelect: function(selected) {
            $("#dropoffdatum").datepicker("option", "minDate", selected);    //niet toelaten dat men vroeger terugkeert dan men vertrekt
        }
    });
    $("#dropoffdatum").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: '-0:+01',
        changeMonth: true,
        changeYear: true
    });
    //*********************VALIDATORS ********************************* 
    $.validator.addMethod("volwassenCheck", function(value, element) {
        return value.match(/^[1-9]+$/i);
    });
        $.validator.addMethod("airportCheck", function(value, element) {
        return value.match(/^[a-z]+$/i);;
    });
    var $foutBoksen=$('div.foutBox');
    //validate vlucht
    $("#frmVlucht").validate({
        rules: {
            countries: "required",
            airports: {required:true,airportCheck:true},
            destinationairport: "required",
            vertrekdatum: {
                required: true,
                dateISO: true
            },
            terugdatum: {
                required: "#retour:checked" //terugdatum is verplicht wanneer retourdatum is aangevinkt
            },
            tickettype: "required",
            volwassenen: {volwassenCheck: true}
        },
        messages: {
            countries: "Land van vertrek is verplicht",
            airports: "Luchthaven is verplicht",
            destinationairport: "Luchthaven bestemming is verplicht",
            vertrekdatum: {
                required: "Heendatum is verplicht",
                dateISO: "de datum moet het juiste formaat hebben (DD-MM-YYYY"
            },
            terugdatum: "Terugdatum is verplicht bij retourvlucht",
            tickettype: "Kies uw type ticket",
            volwassenen: {volwassenCheck: "Er moet minstens 1 volwassene meegaan"}
        },
                        errorContainer:$foutBoksen,
                errorLabelContainer:$("ul",$foutBoksen),
                wrapper:"li",
        submitHandlers: function(form) {
            form.submit();
        }
    });//end of validator

    $.validator.addMethod("boekingCheck", function(value, element) {
        return value.match(/^[a-z0-9]+$/i);
    });

    //alle dialoogvenster instellingen
    $("#dialog").dialog({
        width: 600,
        modal: true,
        autoOpen: false,
        buttons: {
            "Ok": function() {
                $(this).dialog("close");
            }
        },
        show: {
            effect: "blind",
            duration: 100
        },
        hide: {
            effect: "blind",
            duration: 100
        }
    });
    //dialoogbutton
    $("#dialog_link_boekingref")
            .button({icons: {secondary: "ui-icon-help"}})
            .click(function(e) {
        e.preventDefault();
        $('#dialog').dialog('open');
    });

//validate checkin
    $("#frmCheckin").validate({
        rules: {
            boekingreferentie: {
                minlength: 6,
                maxlength: 6,
                required: true,
                boekingCheck: true
            },
            kredietkaartnummer: {creditcard: true, required: true},
            familienaam: "required"
        },
        messages: {
            boekingreferentie: "Boekingreferentienummer is verplicht",
            kredietkaartnummer: "kaartnummer is verplicht en moet correct geschreven worden",
            familienaam: "familienaam is verplicht"
        },
        submitHandlers: function(form) {
            form.submit();
        }
    });//end of validator
    //validate Hotel
    $("#frmHotel").validate({
        rules: {
            city: "required",
            checkindatum: {required: true, dateISO: true},
            checkoutdatum: {required: true, dateISO: true}
        },
        messages: {
            city: "Stad voor overnachting is verplicht",
            checkindatum: {
                required: "check in datum is verplicht",
                dateISO: "de datum moet het juiste formaat hebben (DD-MM-YYYY"
            },
            checkoutdatum: {
                required: "check out datum is verplicht",
                dateISO: "de datum moet het juiste formaat hebben (DD-MM-YYYY"
            }
        },
        submitHandlers: function(form) {
            form.submit();
        }
    });//end of validator
    //validate auto
    $("#frmCar").validate({
        rules: {
            pickuplocatie: "required",
            pickupdatum: {
                required: true,
                dateISO: true
            },
            dropofflocatie: "required",
            dropoffdatum: {
                required: true,
                dateISO: true
            }
        },
        messages: {
            pickuplocatie: "Pick up locatie is verplicht",
            dropofflocatie: "drop off locatie is verplicht",
            pickupdatum: {
                required: "pick up datum is verplicht",
                dateISO: "de datum moet het juiste formaat hebben (DD-MM-YYYY"
            },
            dropoffdatum: {
                required: "drop off datum is verplicht",
                dateISO: "de datum moet het juiste formaat hebben (DD-MM-YYYY"
            }
        },
        submitHandlers: function(form) {
            form.submit();
        }
    });//end of validator



//**** JSON aanvullen dropdown lists ****************

//eerste dropdown lijst
    $.getJSON("php/ajax_json_countries.php", function(result) {
        $.each(result, function(item) { //voor elk item, maak een option met val code en inhoud naam
            $("#countries").append($("<option />").val(this.country_code).text(this.country_name));
        });

    });

//tweede dropdown lijst aan de hand van keuze eerste lijst
    $("#countries")
            .change(function() {
        $("#airports").empty();
        var waarde = $(this).val();
        //console.log(waarde+' gekozen');
        $.getJSON('php/ajax_json_airports.php',
                {country_code: waarde},
        function(jeeson) {
$("#airports").append($("<option />").text('kies een vliegveld'));
            $.each(jeeson, function(item) { //voor elk item, maak een option met val code en inhoud naam
                $("#airports").append($("<option />").val(this.airport_code).text(this.airport_name));
            });

        }
        );
    }).change();;
     $("#airports").change(function() {
         var waarde = $(this).val();
         $('#destinationairport').val(waarde);
     });

    /*ENDOF dropdownlists*/

//check if retour then return datum
    $('#retour').click(function(e) {
        if ($('#retour').is(':checked')) {
            $('#terug').show();

        } else {
            $('#terug').hide();
            $('#terugdatum').val('');           
        }
    });//endof retourdatum

});//end of doc.ready
