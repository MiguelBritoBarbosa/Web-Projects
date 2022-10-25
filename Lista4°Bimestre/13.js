function evt_multiplos(){
    div = document.getElementById("multiplos");
    num = 1
    for(i=7; i < 7000; i+=7){
        multiplo = i;
        div.innerHTML += "7 x "+ num + " = " + multiplo+"<br>";
        num++
    }
}