function ActualizarForm(){
    //variables extraidas de la seleleccion del dom AddPostView var seleccionFundacion=document.getElementById("seleccionFundacion").value
    var seleccionFundacionFiltro = document.getElementById("seleccionFundacionFiltro").value;
    var seleccionObjetivoFiltro = document.getElementById("seleccionObjetivoFiltro").value;
    var dateCampaniadesdeFiltro = document.getElementById("dateCampaniadesdeFiltro").value;
    var dateCampaniahastaFiltro = document.getElementById("dateCampaniahastaFiltro").value;
    var seleccionnameFiltro=document.getElementById("seleccionnameFiltro").value;
    var formularioFiltro = document.getElementById("formularioFiltro");
    var seleccionFiltro=document.getElementById("seleccionFiltro").value;


        formularioFiltro.innerHTML =`
    <p> los filtros a buscar son:${seleccionFiltro} ${seleccionFundacionFiltro} desde:${dateCampaniadesdeFiltro}  hasta:${dateCampaniahastaFiltro} - ${seleccionObjetivoFiltro}-${seleccionnameFiltro}</p>

    

        <input value="${seleccionFundacionFiltro}" type="text" name="FundacionFiltro" hidden >
        <input value="${seleccionFiltro}" type="text" name="RedFiltrada" hidden >
        <input value="${dateCampaniadesdeFiltro}" type="date" name="FechaDesde" hidden >
        <input value="${dateCampaniahastaFiltro}" type="date" name="FechaHasta" hidden >
        <input value="${seleccionObjetivoFiltro}" type="text" name="ObjetivoFiltro" hidden >
        <input value="${seleccionnameFiltro}" type="text" name="NameFiltro" hidden >
        <button type="submit" class="btn btn-success">Filtrar</button>
    
    

    `; // Limpiar el formulario

}