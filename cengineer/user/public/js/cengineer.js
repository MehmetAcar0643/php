function clock() {

    var saat_gir = new Date();
    var dakika_gir = new Date();
    var saniye_gir = new Date();

    document.getElementById("saat_gir").innerHTML = saat_gir.getHours();
    document.getElementById("dakika_gir").innerHTML = dakika_gir.getMinutes();
    document.getElementById("saniye_gir").innerHTML = saniye_gir.getSeconds();

}

var interval = setInterval(clock, 100);


function date() {

    var yil_gir = new Date();
    var gun_gir = new Date();
    var ay_gir = new Date();

    document.getElementById("yil_gir").innerHTML = yil_gir.getFullYear();
    document.getElementById('ay_gir').innerHTML = ay_gir.getMonth();
    document.getElementById('gun_gir').innerHTML = gun_gir.getDate();

    ///////////////////////////////////////////////////////////////////////////////////////////////
    var ay_yaz = new Date();
    var gun_yaz = new Date();
    var yıl_yaz = new Date();


    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    document.getElementById("ay_yaz").innerHTML = months[ay_yaz.getMonth()];
    var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    document.getElementById("gun_yaz").innerHTML = days[gun_yaz.getDay()];
    document.getElementById("yıl_yaz").innerHTML = yıl_yaz.getFullYear();

}

var date_al = setInterval(date, 100);