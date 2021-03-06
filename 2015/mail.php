<?php

/**
 * Konfiguration
 *
 * Bitte passen Sie die folgenden Werte an, bevor Sie das Script benutzen!
 *
 * Das Skript bitte in UTF-8 abspeichern (ohne BOM).
 */

// An welche Adresse sollen die Mails gesendet werden?
$zieladresse = 'registration@si-se.ch';

// Welche Adresse soll als Absender angegeben werden?
// (Manche Hoster lassen diese Angabe vor dem Versenden der Mail ueberschreiben)
$absenderadresse = 'registration@si-se.ch';

// Welcher Absendername soll verwendet werden?
$absendername = 'SI-SE 2015';

// Welchen Betreff sollen die Mails erhalten?
$betreff = 'SI-SE 2015 Registration';

// Zu welcher Seite soll als "Danke-Seite" weitergeleitet werden?
// Wichtig: Sie muessen hier eine gueltige HTTP-Adresse angeben!
$urlDankeSeite = 'thankyou';

// Welche(s) Zeichen soll(en) zwischen dem Feldnamen und dem angegebenen Wert stehen?
$trenner = ": "; // Doppelpunkt + Tabulator

/**
 * Ende Konfiguration
 */

if ($_SERVER['REQUEST_METHOD'] === "POST") {


    if(!isset($_POST['Vorname']) ||
        !isset($_POST['Nachname']) ||
        !isset($_POST['Rechnungsadresse']) ||
        !isset($_POST['PLZ']) ||
        !isset($_POST['Ort']) ||
        !isset($_POST['E-Mail'])) {
        die("Ungueltiger Formularinhalt. E-Mail konnte nicht versendet werden.");
    }

	$header = array();
	$header[] = "From: ".mb_encode_mimeheader($absendername, "utf-8", "Q")." <".$absenderadresse.">";
	$header[] = "MIME-Version: 1.0";
	$header[] = "Content-type: text/plain; charset=utf-8";
	$header[] = "Content-transfer-encoding: 8bit";

    $mailtext = "";

    foreach ($_POST as $name => $wert) {
        if (is_array($wert)) {
		    foreach ($wert as $einzelwert) {
			    $mailtext .= $name.$trenner.$einzelwert."\n";
            }
        } else {
            $mailtext .= $name.$trenner.$wert."\n";
        }
    }

    mail(
    	$zieladresse,
    	mb_encode_mimeheader($betreff, "utf-8", "Q"),
    	$mailtext,
    	implode("\n", $header)
    ) or die("Die Mail konnte nicht versendet werden.");
    header("Location: $urlDankeSeite");
    exit;
}

?>