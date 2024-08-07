// Funktion zum Anzeigen des Fehler-Popup
function showErrorPopup(message) {
    // Popup-Element erstellen
    var popup = document.createElement("div");
    popup.className = "error-popup";
    popup.innerHTML = "<p>" + message + "</p>";

    // Popup dem Body hinzufügen
    document.body.appendChild(popup);

    // Nach einigen Sekunden Popup entfernen
    setTimeout(function() {
        document.body.removeChild(popup);
    }, 3000); // Popup nach 3 Sekunden entfernen
}
