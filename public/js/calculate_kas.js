function hitung() {
    var total   =   0;
    var nom     =   document.getElementsByClassName("nominal");
    var besar   =   [];
    for(var i = 0; i < nom.length; ++i) {
        var nominal =   nom[i].value;
        if (nominal === '') {
            var angka   =   0;
        } else {
            var angka   =   nominal.replace(/,/g, '');
        }
        besar.push(parseFloat(angka));
    }
    total   =   (Math.round(besar.reduce(function(previous, current, index, array){
                    return previous + current;
                }) * 100) / 100).toFixed(2);

    document.getElementById('total').innerHTML = accounting.formatMoney(total, '');
}

function deleteRow(rowid) {
    $('.column-' + rowid).remove();
    var total   =   0;
    var nom     =   document.getElementsByClassName("nominal");
    var besar   =   [];
    for(var i = 0; i < nom.length; ++i) {
        var nominal =   nom[i].value;
        if (nominal === '') {
            var angka   =   0;
        } else {
            var angka   =   nominal.replace(/,/g, '');
        }
        besar.push(parseFloat(angka));
    }
    total   =   (Math.round(besar.reduce(function(previous, current, index, array){
                    return previous + current;
                }) * 100) / 100).toFixed(2);

    document.getElementById('total').innerHTML = accounting.formatMoney(total, '');
}
