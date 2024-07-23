function actualizarFormulario() {
    //variables extraidas de la seleleccion del dom AddPostView
    var seleccionFundacion=document.getElementById("seleccionFundacion").value
    var seleccion = document.getElementById("seleccion").value;
    var seleccionObjetivo = document.getElementById("seleccionObjetivo").value;
    var dateCampania = document.getElementById("dateCampania").value;
    var NameingresadoPost=document.getElementById("NombreEscritoCampania").value;
    var formulario = document.getElementById("formulario");
    
    //variables compuestas
    var NombrePostCompleto=dateCampania+"-"+seleccion+"-"+seleccionObjetivo+"-"+NameingresadoPost
    // Formularios dependiendo de la red social
    var formularioFacebookvs2=`
 <p class="tituloForm">formulario Facebook-fundacion ${seleccionFundacion} </p>
    <p class="nombrePost">El nombre de la publicacion sera la siguiente: ${NombrePostCompleto}</p>
    <div class="divscontainer">
        <div>
            <h1> 1. Anuncios</h1>
            <input type="number" name="alcanceInorganico" placeholder="Alcance ADS">
            <input type="number" name="interacionesInorganico" placeholder="Interacciones ADS">
            <input type="number" name="clicksInorganico" placeholder="Clicks ADS">
            <input type="number" name="seguidoresInorganicos" placeholder="Seguidores ADS">
            <input type="number" name="impresionesTotales" placeholder="Impresiones ADS">
            <input type="text" name="PautaTotal" placeholder="Pautas ADS">
            
        </div>
        <div>
            <h1> 2. Publicacion</h1>
            <input type="text" value="facebook" readonly name="formType" hidden>
            <input type="text" value="${seleccionFundacion}" readonly name="Fundation" hidden>
            <input type="text" value="${seleccionObjetivo}" readonly name="Goal" hidden>
            <input type="text" value="${seleccion}" readonly name="RS" hidden>
            <input type="text" value="${NombrePostCompleto}" readonly name="nombrePostCompleto" hidden>
            <input type="date" value="${dateCampania}" readonly name="datepost" hidden>
            <input type="number" name="AlcanceTotal" placeholder="Alcance POST">
            <input type="number" name="interacionestotal" placeholder="Interacciones POST">
            <input type="number" name="clicksTotales" placeholder="Clicks POST">
            <input type="number" name="SeguidoresTotales" placeholder="Seguidores POST">
        </div>
    </div>
    <button type="submit" class="btn btn-success">enviar</button>
    `;
    var formulariointagramvs2=`
    <h3>formulario Instagram-fundacion ${seleccionFundacion} </h3>
    <p>El nombre de la publicacion sera la siguiente: ${NombrePostCompleto}</p>
    <input type="text" value="instagram" readonly name="formType" hidden>
    <input type="text" value="${seleccionFundacion}" readonly name="Fundation" hidden >
    <input type="text" value="${seleccionObjetivo}" readonly name="Goal" hidden >
    <input type="text" value="${seleccion}" readonly name="RS" hidden >
    <input type="text" value="${NombrePostCompleto}" readonly name="nombrePostCompleto" hidden>
    <input type="date" value="${dateCampania}" readonly name="datepost" hidden>

    <div class="divscontainer">
        <div>
        <h1> 1. Anuncios</h1> 
        <input type="number" name="alcanceInorganico" placeholder="Alcance ADS">
        <input type="number" name="interacionesInorganico" placeholder="Interacciones ADS">
        <input type="number" name="seguidoresInorganicos" placeholder="Seguidores ADS">
        <input type="number" name="impresionesTotales" placeholder=" impresiones ADS ">
        <input type="text"  name="PautaTotal" placeholder="Pautas ADS">
        
        </div>
        <div>
        <h1> 2. Publicacion</h1>
        <input type="number" name="AlcanceTotal" placeholder="Alcance POST">
    
        <input type="number" name="interacionestotal" placeholder="Interacciones POST">
    
        <input type="number" name="SeguidoresTotales" placeholder="Seguidores POST">
    
   
        </div>
    </div>
    <button type="submit" class="btn btn-success">enviar</button>
    `;
   
    // Lógica para actualizar el formulario según la selección, el objetivo y la fecha de la campaña
    formulario.innerHTML = ""; // Limpiar el formulario

    if (seleccion === "FB") {
        // Mostrar campos específicos para Facebook
        formulario.innerHTML = formularioFacebookvs2;
    } else if (seleccion === "IG") {
        // Mostrar campos específicos para Instagram
        formulario.innerHTML = formulariointagramvs2;
    } else if (seleccion === "TW") {
        // Mostrar campos específicos para Twitter
        formulario.innerHTML = formularioTwitter;
    } else {
        // En caso de no cumplir ninguna condición, mostrar un mensaje genérico
        formulario.innerHTML = "<p>Por favor, selecciona una red social</p>";
    }
}


    // Obtener la fecha de hoy en formato YYYY-MM-DD
    var today = new Date().toISOString().split('T')[0];
    // Establecer el atributo max del input tipo date
    document.getElementById('dateCampania').setAttribute('max', today);
