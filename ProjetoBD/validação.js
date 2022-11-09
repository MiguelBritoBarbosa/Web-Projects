const form = document.getElementById("form");
const campos = document.querySelectorAll(".required");
const spans = document.querySelectorAll(".validação");
const EmailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

form.addEventListener("submit", (event)=>{
    event.preventDefault();
    ValidarNome();
    ValidarIdade();
    ValidarCelular();
    ValidarEmail();
    ValidarCPF();
    ValidarSscore();
    ValidarSalario();
    ValidarCheck();
    if (ValidarNome() && ValidarIdade() && ValidarCelular && ValidarEmail && ValidarCPF && ValidarSscore && ValidarSalario() && ValidarCheck()){
        form.submit();        
    }  
});


function Testecpf(cpf){
    cpf = cpf.replace(/\D/g, '');
    if(cpf.toString().length != 11 || /^(\d)\1{10}$/.test(cpf)) return false;
    var result = true;
    [9,10].forEach(function(j){
        var soma = 0, r;
        cpf.split(/(?=)/).splice(0,j).forEach(function(e, i){
            soma += parseInt(e) * ((j+2)-(i+1));
        });
        r = soma % 11;
        r = (r <2)?0:11-r;
        if(r != cpf.substring(j, j+1)) result = false;
    });
    return result;
}


function InputErro(indice){
    campos[indice].style.border = "2px solid #e63636";
    spans[indice].style.display = "block";
}

function InputValido(indice){
    campos[indice].style.border = "2px solid #90ee90";
    spans[indice].style.display = "none";
}

function ValidarNome(){
    if (campos[0].value.length < 3){
        InputErro(0);
        return false;
    }
    else{
        InputValido(0);
        return true;
    }
}

function ValidarIdade(){
    if (Number(campos[1].value) < 16 || Number(campos[1].value) > 100){
        InputErro(1);
        return false;
    }
    else{
        InputValido(1);
        return true;
    }
}

function ValidarCelular(){
    if (campos[2].value.length != 15){
        InputErro(2);
        return false;
    }
    else{
        InputValido(2);
        return true;
    }
}


function ValidarEmail(){
    if (!EmailRegex.test(campos[3].value)){
        InputErro(3);
        return false;
    }
    else{
        InputValido(3);

        return true;
    }
}

function ValidarCPF(){
    if (!Testecpf(campos[4].value)){
        InputErro(4);
        return false;
    }
    else{
        InputValido(4);
        return true;
    }
}

function ValidarSscore(){
    if (Number(campos[5].value) < 500 || Number(campos[5].value) > 1000){
        InputErro(5);
        return false;
    }
    else{
        InputValido(5);
        return true;
    }
}

function ValidarSalario(){
    var salario = campos[6].value;
    salario = salario.replace("R$ ", "").replace(".", "").replace(",", ".");
    if (Number(salario) < 100){
        InputErro(6);
        return false;
    }
    else{
        InputValido(6);
        return true;
    }
}

function ValidarCheck(){
    if (!campos[7].checked){
        InputErro(7);
        return false;
    }
    else{
        InputValido(7);
        return true;
    }
}