function evt_Calcular(){
    salario = Number(document.getElementById("salario").value);
    reajuste = (document.getElementById("reajuste").value / 100) * salario;
    
    if(salario == "" || reajuste == ""){
        return alert("Digite todas as informações!");
    }
    else{
        SalarioReajustado = salario + reajuste;
        div = document.getElementById("SalarioReajustado");
        div.innerHTML = "Seu salário reajustado é " + SalarioReajustado;
    }
}