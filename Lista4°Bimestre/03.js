function evt_addAluno(){
    var Alunos = document.getElementById("alunos");
    var aluno = document.getElementById("aluno").value;
    validação = true;
    for (i = 0; i < Alunos.length; i++){
        if (aluno == Alunos[i].value){
            console.log(aluno);
            console.log(Alunos[i].value);
            validação = false;
            alert("aluno ja existe");
        }
    }
    if (validação == true){
        opt = document.createElement("option");
        console.log("teste 123")
        opt.text = aluno
        opt.value = aluno
        Alunos.options.add(opt)
    }
    else{
        console.log("teste fuck")
    }
}