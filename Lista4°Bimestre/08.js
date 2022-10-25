tipoConta = ""
function evt_Somar(){
    var input = document.getElementById("numero")
    numero = Number(input.value)
    tipoConta = "Somar"

    input.placeholder = "Digite o segundo número"
    input.value = ""

}
function evt_Subtrair(){
    var input = document.getElementById("numero")
    numero = Number(input.value)
    tipoConta = "Subtrair"

    input.placeholder = "Digite o segundo número"
    input.value = ""

}
function evt_Multiplicar(){
    var input = document.getElementById("numero")
    numero = Number(input.value)
    tipoConta = "Multiplicar"

    input.placeholder = "Digite o segundo número"
    input.value = ""

}
function evt_Dividir(){
    var input = document.getElementById("numero")
    numero = Number(input.value)
    tipoConta = "Dividir"

    input.placeholder = "Digite o segundo número"
    input.value = ""

}

function evt_Resultado(numero, TipoConta){
    numero2 = Number(document.getElementById("numero").value)

    if(TipoConta == "Somar"){
        resultado = numero + numero2;
    }
    else if(TipoConta == "Subtrair"){
        resultado = numero - numero2
    }
    else if(TipoConta == "Multiplicar"){
        resultado = numero * numero2
    }
    else if(TipoConta == "Dividir"){
        resultado = numero / numero2
    }
    else{
        return alert("Selecione uma operação!")
    }

    alert(resultado)
    numero = ""
    numero2 = ""
    TipoConta = ""
    document.getElementById("numero").placeholder = "Digite o primeiro número"
    document.getElementById("numero").value = ""
}