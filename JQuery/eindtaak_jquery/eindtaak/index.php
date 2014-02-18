<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
        <meta name="Description" content="dit is de oefening voor de vdab opleidingsmodule jQuery. 'Sardine Airways' is een fictieve maatschappij. Indien u een  sardine bent, wend u tot een ander bedrijf" />
        <title>Sardine Airways: jQuery eindtaak</title>
        <!--CCS-->
        <link rel='stylesheet' type="text/css"  href="css/eindtaak.css"/>
        <link rel='stylesheet' type='text/css' href='css/jquery-ui-1.10.3.custom.min.css' />

        <!--JS-->
        <script src="js/jquery-1.10.1.js"></script>
        <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
        <!--<script src="js/tables/jquery.dataTables.min.js"></script> dataTable -->
        <script src="js/dist/jquery.validate.min.js"></script><!-- validator -->
        <script src="js/jquery.slides.min.js"></script><!-- slideshow -->
        <script src="js/airways.js"></script> <!-- eigen script -->
        <!--localisation files datepicker-->
        <script type='text/javascript' src='js/localization/jquery.ui.datepicker-nl-BE.js'></script>

    </head>
    <body>
        <div id="container">
            <div id="kop">
                <img id= "koptitel" src="images/sardineskop.png" alt="sardines airways"  /> </div>
            <div id="buik">
                <div id="links">&nbsp;</div>
                <div id="tester" style="display:none">tester element</div>
                <div id="midden">
                    <div id="prent">
                        <!--extra toegevoegd voor slideshow-->
                        <img src="images/sardines1.jpg"/>
                        <img src="images/sardines2.jpg"/>
                        <img src="images/sardines3.jpg"/>
                        <img src="images/sardines4.jpg"/>
                    </div>
                    <div id="inhoud">
                        <!--UL voor tabs, zelfgeschreven-->
                        <ul>
                            <li><a href='#vlucht'>Boek uw vlucht</a></li>
                            <li><a href='#checkin'>Online Check-in</a></li>
                            <li><a href='#hotel'>Hotel boeken</a></li>
                            <li><a href='#wagen'>Wagen reserveren</a></li>
                        </ul>
                        <!--einde UL voor tabs, zelfgeschreven-->
                        <div id="vlucht">
                            <h1>Vlucht boeken</h1>
                            <div class='foutBox' id='fouten'><h2>Fouten</h2><ul></ul></div>
                            <form name="frmVlucht" id ="frmVlucht" action="reflect_data.php" method="get">
                                <p>
                                    <label>Land van vertrek:</label>
                                    <select name="countries" id="countries">
                                    </select>
                                </p>
                                <p>
                                    <label>Luchthaven</label>
                                    <select name="airports" id="airports" >
                                    </select>
                                </p>
                                <p>
                                    <label>naar (luchthavencode)</label>
                                    <input type="text" name="destinationairport" id="destinationairport" />
                                </p>
                                <p>

                                    <label>heen (datum)</label>
                                    <input  class="datum" type="text" name="vertrekdatum" id="vertrekdatum" /><label class="inline" > retour<input type="checkbox" name="retour" id="retour" checked=true /></label>

                                </p>
                                <p id='terug'>
                                    <label>terug (datum)</label>
                                    <input class="datum" type="text" name="terugdatum" id="terugdatum" />
                                </p>
                                <p>
                                    <label>ticket type</label>
                                    goedkoopst
                                    <input type="radio" name="tickettype" id="ticketgoedkoop" value="goedkoop" />
                                    flexibel
                                    <input type="radio" name="tickettype" id="ticketflexibel" value="flexibel" />
                                </p>
                                <p>
                                    <label>aantal</label>
                                    volwassenen
                                    <select name="volwassenen" id="volwassenen" >
                                        <option value=0>0</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                    </select>
                                    kinderen
                                    <select name="kinderen" id="kinderen" >
                                        <option>0</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                    </select>
                                    babies
                                    <select name="babies" id="babies" >
                                        <option>0</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                    </select>
                                </p>
                                <p>
                                    <input type="submit" value="ga verder" />
                                </p>
                            </form>
                        </div>
                        <div id="checkin">
                            <h1>Online check-in</h1>
                            <p>Welkom op Sardine Airways online check-in systeem.</p>
                            <p>U kunt vanaf 15 dagen tot ten laatste 4 uur v&oacute;&oacute;r uw vlucht inchecken. Eenmaal ingecheckt kunt u ten allen tijde uw boarding paas (opnieuw) uitprinten tot 40 minuten  v&oacute;&oacute;r vertrektijd.</p>
                            <p>Om online in te checken:</p>
                            <ul>
                                <li>vul eerst uw reservatienummer in</li>
                                <li>vul het kredietkaartnummer in waarmee de boeking gebeurde</li>
                            </ul>
                            <form name="frmCheckin" id ="frmCheckin" action="reflect_data.php" method="get">
                                <p>                                   
                                    <label>boekingreferentie  <a href='#' id ="dialog_link_boekingref">Meer uitleg</a></label>
                                    <input type="text" name="boekingreferentie" id="boekingreferentie" />
                                    <!--Dialoog button-->
                                    <div id="dialog" title="Info boekingreferentie">
                                        <p>uw boekingsreferentie vindt u op uw electronisch ticket zoals hieronder aangegeven</p>
                                        <img id= "boekingref_vb" src="images/boeking.png" alt="boekingref voorbeeld"  />
                                    </div>
                                    
                                    <!--Dialoog button-->

                                </p>
                                <p>
                                    <label>kredietkaartnummer</label>
                                    <input type="text" name="kredietkaartnummer" id="kredietkaartnummer" />
                                </p>
                                <p>
                                    <label>familienaam</label>
                                    <input type="text" name="familienaam" id="familienaam" />
                                </p>
                                <p>
                                    <input type="submit" value="checkin" />
                                </p>
                            </form>
                        </div>
                        <div id="hotel">
                            <h1>Zoek een hotel</h1>
                            <form name="frmHotel" id ="frmHotel" action="reflect_data.php" method="get">
                                <p>
                                    <label>waar wil u logeren?</label>
                                    <input type="text" name="city" id="city" />
                                </p>
                                <p>
                                    <label>checkin datum</label>
                                    <input  class="datum" type="text" name="checkindatum" id="checkindatum" />
                                </p>
                                <p>
                                    <label>checkout datum</label>
                                    <input  class="datum" type="text" name="checkoutdatum" id="checkoutdatum" />
                                </p>
                                <p>
                                    <input type="submit" value="zoek hotels" />
                                </p>
                            </form>
                        </div>
                        <div id="wagen">
                            <h1>Wagen boeken</h1>
                            <form name="frmCar" id ="frmCar" action="reflect_data.php" method="get">
                                <p>
                                    <label>pick up locatie</label>
                                    <input type="text" name="pickuplocatie" id="pickuplocatie" />
                                </p>
                                <p>
                                    <label>pick up datum</label>
                                    <input  class="datum" type="text" name="pickupdatum" id="pickupdatum" />
                                </p>
                                <p>
                                    <label>drop off locatie</label>
                                    <input type="text" name="dropofflocatie" id="dropofflocatie" />
                                </p>
                                <p>
                                    <label>drop off datum</label>
                                    <input  class="datum" type="text" name="dropoffdatum" id="dropoffdatum" />
                                </p>
                                <p>
                                    <input type="submit" value="boek wagen" />
                                </p>
                            </form>
                        </div>
                    </div>
                    <!--einde inhoud-->
                </div>
                <!--einde midden-->
                <div id="rechts">&nbsp;</div>
            </div>
            <!--einde buik-->
            <div id="voet"> &copy; Sardine Airways | About | Contact </div>
        </div>
    </body>
</html>