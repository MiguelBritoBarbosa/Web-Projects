var Cadastro = Array(["nome", "sobrenome", "Naturalidade", "idade"], ["Miguel", "Brito Barbosa", "Joseense", "17"])
var div = document.getElementById("informações")

div.innerHTML =  "Informações: " +" "+ Cadastro[0][0] +" "+ Cadastro[0][1] +" "+ Cadastro[0][2] +" "+ Cadastro[0][3] +" "+ Cadastro[1][0] +" "+ Cadastro[1][1] +" "+ Cadastro[1][2] +" "+ Cadastro[1][3] 

function evt_Cadastrar(Cadastro){
    var lista = document.getElementById("lista")
    var opt = document.createElement("option")
    opt.text = Cadastro[1][0] + " " + Cadastro[1][1]
    opt.value = Cadastro[1][1]
    lista.add(opt)

    lista.style.visibility = "visible"
}