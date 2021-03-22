function hitung() {
    var totalDB     =   0;
    var DB_nom      =   document.getElementsByClassName("db");
    var valuesDB    =   [];
    for(var i = 0; i < DB_nom.length; ++i) {
        var dbt     =   DB_nom[i].value;
        if (dbt === '') {
            var angka_db    =   0;
        } else {
            var angka_db    =   dbt.replace(/,/g, '');
        }
        valuesDB.push(parseFloat(angka_db));
    }
    totalDB         =   (Math.round(valuesDB.reduce(function(previousDB, currentDB, index, array){
                            return previousDB + currentDB;
                        }) * 100) / 100).toFixed(2);

    // Calculate Credit
    var totalCR     =   0;
    var CR_nom      =   document.getElementsByClassName("cr");
    var valuesCR    =   [];
    for(var i = 0; i < CR_nom.length; ++i) {
        var kdt     =   CR_nom[i].value;
        if (kdt === '') {
            var angka_cr    =   0;
        } else {
            var angka_cr    =   kdt.replace(/,/g, '');
        }
        valuesCR.push(parseFloat(angka_cr));
    }
    totalCR         =   (Math.round(valuesCR.reduce(function(previousCR, currentCR, index, array){
                            return previousCR + currentCR;
                        }) * 100) / 100).toFixed(2);

    var result      =   parseFloat(totalDB) - parseFloat(totalCR);
    var submit      =   document.getElementById('btnPost');
    var butt        =   document.getElementById('btnSubmit');
    var alert       =   document.getElementById('info-alert');
    var info        =   document.getElementById('info-balance');

    document.getElementById('data_DB').innerHTML = accounting.formatMoney(totalDB, '');
    document.getElementById('data_CR').innerHTML = accounting.formatMoney(totalCR, '');

    if (result == 0) {
        submit.style = '';
        if ((parseFloat(totalDB) > 0) || (parseFloat(totalCR) > 0)) {
            info.innerHTML  = "BALANCE";
            alert.style     = "background-color:#157347;color:#fff";
            butt.hidden     = false;
            butt.disabled   = false;
        } else {
            info.innerHTML  = "TIDAK ADA TRANSAKSI";
            alert.style     = "";
            butt.hidden     = true;
            butt.disabled   = true;
        }
    } else {
        info.innerHTML  = "NOT BALANCE";
        alert.style     = "background-color:#bb2d3b;color:#fff";
        submit.style    = 'display:none';
        butt.hidden     = true;
        butt.disabled   = true;
    }
}
