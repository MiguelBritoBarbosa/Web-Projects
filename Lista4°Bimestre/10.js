function evt_CalcularArea(){
    altura = document.getElementById("altura").value;
    base = document.getElementById("base").value;

    if (altura == "" || base == ""){
        return alert("Digite todas as infromações");
    }
    else{
        area = base * altura;
        div = document.getElementById("resultado");
        div.innerHTML = "A área do retângulo é " + area + "m²"
    }
}