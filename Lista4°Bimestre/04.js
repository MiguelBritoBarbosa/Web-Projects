function evt_GerarMedia(){
    var aluno = document.getElementById("aluno").value
    if (aluno == ""){
        var msg = document.getElementById("msg")
        return msg.innerHTML = "<span>Digite o nome do aluno!</span>"
    }
    else if(aluno.length < 3){
        var msg = document.getElementById("msg")
        return msg.innerHTML = "<span>Digite um nome válido!</span>"
    }


    var nota1 = Number(document.getElementById("nota1").value)
    var nota2 = Number(document.getElementById("nota2").value)
    var nota3 = Number(document.getElementById("nota3").value)
    var nota4 = Number(document.getElementById("nota4").value)
    
    if(nota1 == "" || nota2 == "" || nota3 == "" || nota4 == ""){
        var msg = document.getElementById("msg")
        return msg.innerHTML = "<span>Digite todas as notas!</span>"
    }
    
    MBF = (nota1 + nota2 + nota3 + nota4) / 4

    Alunos = document.getElementById("alunos")
    var opt = document.createElement("option")
    opt.value = aluno
    opt.text = aluno
    Alunos.options.add(opt)
    Alunos.style.visibility = "visible"
    
    Medias = document.getElementById("medias")
    var opt = document.createElement("option")
    opt.value = aluno
    opt.text = MBF
    Medias.options.add(opt)

    


    var msg = document.getElementById("msg")
    return msg.innerHTML = "<b>Aluno "+ aluno +" cadastrado!</b>"
}

function evt_MostrarNota(){

    var Alunos = document.getElementById("alunos")
    var index = Alunos.selectedIndex;

    var mediaAluno = document.getElementById("medias").options[index].text

    alert("Média Bimestral Final do aluno: "+mediaAluno)


}
