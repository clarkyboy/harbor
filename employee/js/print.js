function print() {    
    var divToPrint = document.getElementById('divToPrint');
    var popupWin = window.open('', '_blank', 'width=500, height=300');
    popupWin.document.open();
    popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
    popupWin.document.close();
}