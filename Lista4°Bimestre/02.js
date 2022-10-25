function evt_addAluno(){
    var aluno = document.getElementById("aluno").value;
    console.log(aluno);
    var opt = document.createElement("option");
    opt.text = aluno;
    opt.value = aluno;
    document.getElementById("alunos").options.add(opt);

}