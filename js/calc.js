var zn1 = 0
  , zn2 = 0
  , znr = 0
  , tmd = "sl"
  , samcal = document.getElementById("corpus_calc");
samcal.onclick = function(a) {
    a = window.event || a;
    a.target || (a.target = a.srcElement);
    a = a.target.id;
    "bt_0" == a ? dbCf("0") : "bt_1" == a ? dbCf("1") : "bt_2" == a ? dbCf("2") : "bt_3" == a ? dbCf("3") : "bt_4" == a ? dbCf("4") : "bt_5" == a ? dbCf("5") : "bt_6" == a ? dbCf("6") : "bt_7" == a ? dbCf("7") : "bt_8" == a ? dbCf("8") : "bt_9" == a ? dbCf("9") : "bt_zp" == a ? dbTch() : "bt_sb" == a ? sZn() : "bt_st" == a ? stSim() : "bt_pm" == a ? plMn() : "bt_kr" == a ? kvKr() : "bt_pl" == a ? mtDs("sl") : "bt_um" == a ? mtDs("um") : "bt_mi" == a ? mtDs("vc") : "bt_dl" == a ? mtDs("dl") : "bt_rv" == a && mtDs("rv")
}
;
function dbCf(a) {
    "rv" == tmd && sZn();
    zn1 += "";
    a += "";
    var b = -1 < zn1.indexOf(".") ? 11 : 10;
    zn1 = "0" == zn1 && "00" != a ? a : "0" == zn1 && "00" == a ? "0" : zn1 + a;
    zn1.length > b && (zn1 = zn1.substr(0, b));
    0 != 1 * zn1 && tekMat();
    document.getElementById("disp_out").value = zn1
}
function dbTch() {
    "rv" == tmd && sZn();
    zn1 += "";
    -1 == zn1.indexOf(".") && (zn1 += ".");
    document.getElementById("disp_out").value = zn1
}
function mtDs(a) {
    tmd = a;
    zn2 = znr + "";
    zn1 = "0";
    Infinity == zn2 || -Infinity == zn2 ? (alert("\u041d\u0430 \u043d\u043e\u043b\u044c \u0434\u0435\u043b\u0438\u0442\u044c \u043d\u0435\u043b\u044c\u0437\u044f !!!"),
    tekMat()) : document.getElementById("disp_out").value = zn2
}
function tekMat() {
    zn1 *= 1;
    zn2 *= 1;
    "sl" == tmd ? znr = zn2 + zn1 : "vc" == tmd ? znr = zn2 - zn1 : "um" == tmd ? znr = zn2 * zn1 : "dl" == tmd && (znr = zn2 / zn1);
    znr = +znr.toFixed(9)
}
function stSim() {
    "rv" == tmd ? (zn2 += "",
    zn1 = zn2.substr(0, zn2.length - 1),
    zn2 = "0",
    tmd = "sl") : (zn1 += "",
    zn1 = zn1.substr(0, zn1.length - 1));
    zn1 *= 1;
    if (0 == zn1.length || isNaN(zn1))
        zn1 = 0;
    tekMat();
    document.getElementById("disp_out").value = zn1
}
function plMn() {
    zn1 *= 1;
    zn2 *= 1;
    "rv" == tmd ? (zn1 = -1 * zn2,
    zn2 = "0",
    tmd = "sl") : zn1 *= -1;
    tekMat();
    document.getElementById("disp_out").value = zn1
}
function kvKr() {
    zn1 *= 1;
    zn2 *= 1;
    "rv" == tmd && 0 > zn2 ? alert("\u041a\u0432\u0430\u0434\u0440\u0430\u0442\u043d\u044b\u0439 \u043a\u043e\u0440\u0435\u043d\u044c \u0438\u0437 \u043e\u0442\u0440\u0438\u0446\u0430\u0442\u0435\u043b\u044c\u043d\u043e\u0433\u043e \u0447\u0438\u0441\u043b\u0430 \u0438\u0437\u0432\u043b\u0435\u043a\u0430\u0442\u044c \u043d\u0435\u043b\u044c\u0437\u044f !!!") : "rv" != tmd && 0 > zn1 ? alert("\u041a\u0432\u0430\u0434\u0440\u0430\u0442\u043d\u044b\u0439 \u043a\u043e\u0440\u0435\u043d\u044c \u0438\u0437 \u043e\u0442\u0440\u0438\u0446\u0430\u0442\u0435\u043b\u044c\u043d\u043e\u0433\u043e \u0447\u0438\u0441\u043b\u0430 \u0438\u0437\u0432\u043b\u0435\u043a\u0430\u0442\u044c \u043d\u0435\u043b\u044c\u0437\u044f !!!") : ("rv" == tmd ? (zn2 *= 1,
    zn1 = Math.sqrt(zn2),
    zn2 = "0",
    tmd = "sl") : (zn1 *= 1,
    zn1 = Math.sqrt(zn1)),
    zn1 = +zn1.toFixed(9),
    tekMat(),
    document.getElementById("disp_out").value = zn1)
}
function sZn() {
    znr = zn2 = zn1 = 0;
    tmd = "sl";
    document.getElementById("disp_out").value = 0
}
;