function evt_GerarGrafico(){
    eleitores = document.getElementById("eleitores").value;
    branco = document.getElementById("branco").value;
    nulos = document.getElementById("nulos").value;
    validos = document.getElementById("validos").value;

    if (eleitores == "" || branco == "" || nulos == "" || validos == "" ){
        return alert("Digite todas as informações!");
    }
    else{

        branco = (branco * 100) / eleitores
        nulos = (nulos * 100) / eleitores
        validos = (validos * 100) / eleitores

        var data = [
        { label: "Em Branco",  data: branco, color: "#ff0000"},
        { label: "Nulos",  data: nulos, color: "#00ff00"},
        { label: "Válidos",  data: validos, color: "#0000ff"},
        ];

        $(document).ready(function () {
                $.plot($("#placeholder"), data, {
                series: {
                    pie: {
                        show: true
                    }
                },
                legend: {
                    labelBoxBorderColor: "none"
                }
            });
        });
    } 
}