function evt_calc(){
    var numero = document.getElementById("numero").value;
    var div = document.getElementById("tabuada");

    for(x=1; x <= 10 ;x++){
        tabuada = numero * x;
        div.innerHTML +="<br>" +tabuada;
    }

}