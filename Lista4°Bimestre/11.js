function evt_Calcular(){
    idade = document.getElementById("idade").value;
    
    dias = idade * 365;

    horas = dias * 24;

    minutos = horas * 60;

    segundos = minutos * 60;

    document.getElementById("dias").innerHTML = "Você já viveu " + dias + " Dias";
    document.getElementById("horas").innerHTML = horas + " horas";
    document.getElementById("minutos").innerHTML = minutos + " minutos";
    document.getElementById("segundos").innerHTML = "e " + segundos + " segundos";

}