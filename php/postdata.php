<?php



function LogicaFormFacebook(){
    session_start();
    include 'conection.php';
    //datos que si pueden ir vacios,como se hacen divisiones con estas mismas tenemos que crear condiciones en las cuales estas no den como resultado error osea 0/0 por ejemplo
    $alcancetotal=!empty($_POST['AlcanceTotal']) ? $_POST['AlcanceTotal']:0;
    $alcanceInorganico=!empty($_POST["alcanceInorganico"]) ? $_POST["alcanceInorganico"]:0;
    $interaccionesTotales=!empty($_POST["interacionestotal"]) ? $_POST["interacionestotal"]:0;
    $interaccionesInorganico=!empty($_POST["interacionesInorganico"]) ? $_POST["interacionesInorganico"] :0;
    $clicksTotales=!empty($_POST["clicksTotales"])?$_POST["clicksTotales"]:0;
    $clicksInorganicos=!empty($_POST["clicksInorganico"])?$_POST["clicksInorganico"]:0;
    $seguidoresTotales=!empty($_POST["SeguidoresTotales"])?$_POST["SeguidoresTotales"]:0;
    $seguidoresInorganicos=!empty($_POST["seguidoresInorganicos"])?$_POST["seguidoresInorganicos"]:0;
    $pautaTotal=isset($_POST["PautaTotal"])?$_POST["PautaTotal"]:0;
    $impresionesTotales=!empty($_POST["impresionesTotales"])?$_POST["impresionesTotales"]:0;

    //DATOS QUE NUNCA IRAN VACIOS
    $seleccionRedSocial=$_POST["RS"];
    $seleccionFundacion=$_POST["Fundation"];
    $seleccionobjetivo=$_POST["Goal"];
    $NombreCompletoPost=$_POST["nombrePostCompleto"];
    $datecampania=$_POST["datepost"];

    $pautaTotalConvertida=floatval($pautaTotal);

    if($seleccionFundacion=="FBBVA"){
        $seleccionFundacion=1;
    };

    if($seleccionobjetivo=="PPL"){
        $seleccionobjetivo=1;
    }elseif ($seleccionobjetivo=="PPA") {
        $seleccionobjetivo=2;
    };

    //Variables Organicas que se forman de los datos totales e inorganicos
    //manejo la logica por si llegan vacias las variables
    if($alcancetotal>0 && $alcancetotal>$alcanceInorganico){
        $AlcanceOrg=$alcancetotal-$alcanceInorganico;
    
    }else{
        $AlcanceOrg=0;
    };

    echo 'Alcance Org:'.$AlcanceOrg;
    echo '<br>';
    if($interaccionesTotales>0){
        
        $interaccionesOrg=$interaccionesTotales-$interaccionesInorganico;

    }else{
        $interaccionesOrg=0;
    }

    echo 'Interacciones Org:'.$interaccionesOrg;
    echo '<br>';

    if($clicksTotales>0){
        $clicksOrg=$clicksTotales-$clicksInorganicos;
    
    }else{
        $clicksOrg=0;
    }

    echo 'Clicks Org:'.$clicksOrg;
    echo '<br>';

    if($seguidoresTotales>0){
        $seguidoresNuevosOrg=$seguidoresTotales-$seguidoresInorganicos;

    }else{
        $seguidoresNuevosOrg=0;
    }

    echo 'Seguidores Org:'.$seguidoresNuevosOrg;
    echo '<br>';

    //Variables KPIS que se forman de los datos ingresados

    //KPI FrecuenciaAds
    //logica en caso la division se de entre 0
    if($alcanceInorganico>0){
        $kpiFrecuenciasAds=$impresionesTotales/$alcanceInorganico*100;
        $resultadoRedondeado=round($kpiFrecuenciasAds,2);
        $resultadoFormateadoKpiFrecuendiasAds = number_format($resultadoRedondeado, 2, '.', '');
        $resultadoFormateadoKpiFrecuendiasAdsTostring=$resultadoFormateadoKpiFrecuendiasAds."%";
    }else{
        $resultadoFormateadoKpiFrecuendiasAdsTostring="0%";
    }
    echo "kpi frecuenciaAds///" .$resultadoFormateadoKpiFrecuendiasAdsTostring;
    echo '<br>';

    //KPI engagement rate Ads
    if($alcanceInorganico>0){
        $KpiEngagementRateAds=round($interaccionesInorganico/$alcanceInorganico*100,2);
        $KpiEngagementRateAdsFormat=number_format($KpiEngagementRateAds,2,'.','');
        $KpiEngagementRateAdsFormattostring=$KpiEngagementRateAdsFormat."%";
    }else{
        $KpiEngagementRateAdsFormattostring="0%";
    }

    echo "Kpi EngagementRateAds///".$KpiEngagementRateAdsFormattostring;

    //Kpi engagement rate Organico
    echo '<br>';
    if($AlcanceOrg>0){
        $KpiEngagementRateOrg=round($interaccionesOrg/$AlcanceOrg*100,2);
    $KpiEngagementRateOrgFormat=number_format($KpiEngagementRateOrg,2,'.','');
    $KpiEngagementRateOrgFormattostring=$KpiEngagementRateOrgFormat."%";
    }else{
        $KpiEngagementRateOrgFormattostring="0%";
    }

    echo "Kpi engagement rate Organico///".$KpiEngagementRateOrgFormattostring;

    //Kpi CTR ADS
    if($impresionesTotales>0){
        $kpiCtrAds=round($clicksInorganicos/$impresionesTotales*100,2);
        $kpiCtrAdsFormat=number_format($kpiCtrAds,2,'.','');
        $kpiCtrAdsFormattostring=$kpiCtrAdsFormat."%";
    }else{
        $kpiCtrAdsFormattostring="0%";
    }
    echo '<br>';

    echo "Kpi CTR ADS///".$kpiCtrAdsFormattostring."%";


    //Kpi CTR ORG
    echo '<br>';

    if($AlcanceOrg>0){
        $kpiCtrOrg=round($clicksOrg/$AlcanceOrg*100,2);
        $kpiCtrOrgFormat=number_format($kpiCtrOrg,2,'.','');
        $kpiCtrOrgFormattostring=$kpiCtrOrgFormat."%";
    }else{
        $kpiCtrOrgFormattostring="0%";
    }

    echo "Kpi CTR ORG///".$kpiCtrOrgFormattostring."%";

    //kPI CPM ADS
    echo '<br>';
    if($impresionesTotales>0){
        $KpiCpmAds=round($pautaTotalConvertida/$impresionesTotales*1000,2);
        $kpiCpmAdsFormat=number_format($KpiCpmAds,2,'.','');
        $kpiCpmAdsFormattostring="S/.".$kpiCpmAdsFormat;
    }else{
        $kpiCpmAdsFormattostring="S/.0.00";
    }

    echo "Kpi kPI CPM ADS".$kpiCpmAdsFormattostring;

    //datos obtenidos del formulario

    echo '<br>';
    echo '<br>';
    echo '<br>';

    echo "alcance Total///".$alcancetotal;
    echo '<br>';
    echo "Alcance Inorganico///".$alcanceInorganico;
    echo '<br>';
    echo "Inteacciones totales///".$interaccionesTotales;
    echo '<br>';
    echo "Interaciones Inorganicas///".$interaccionesInorganico;
    echo '<br>';
    echo "Clicks Totales///".$clicksTotales;
    echo '<br>';
    echo "Clicks Inorganicos///".$clicksInorganicos;
    echo '<br>';
    echo "Seguidores Totales///".$seguidoresTotales;
    echo '<br>';
    echo "Seguidores Inorganicos///".$seguidoresInorganicos;
    echo '<br>';
    echo "Pauta total///S/.".$pautaTotalConvertida;
    echo '<br>';
    echo "Impresiones Totales///".$impresionesTotales;
    echo '<br>';
    echo "RedSocialId///".$seleccionRedSocial;
    echo '<br>';
    echo "Fundacion Seleccionada///".$seleccionFundacion;
    echo '<br>';
    echo "Seleccion Objetivo///".$seleccionobjetivo;
    echo '<br>';
    echo "Nombre Completo del post Autogenerado///".$NombreCompletoPost;
    echo '<br>';
    echo "Fecha de la camapania///".$datecampania;

    $query = "INSERT INTO post(datePostCreated, namePost,idGoal, idFundation, IdsocialNet,alcanceAds,alcanceInorganic,alcanceOrg,interaccionesAds,interaccionesInorganic,interaccionesOrg,clicsAds,clicsInorganic,clicsOrg,seguidoresNuevosAds,seguidoresNuevosInorganic,seguidoresNuevosOrg,PautaAds,impresionesAds,kpiFrecuenciaAds,kpiengagementRateAds,kpiengagementRateOrg,kpiCtrAds,kpiCtrOrg,kpiCpmAds) 
            VALUES('$datecampania', '$NombreCompletoPost','$seleccionobjetivo','$seleccionFundacion',1,'$alcancetotal','$alcanceInorganico','$AlcanceOrg','$interaccionesTotales','$interaccionesInorganico','$interaccionesOrg','$clicksTotales','$clicksInorganicos','$clicksOrg','$seguidoresTotales','$seguidoresInorganicos','$seguidoresNuevosOrg','$pautaTotalConvertida','$impresionesTotales','$resultadoFormateadoKpiFrecuendiasAdsTostring','$KpiEngagementRateAdsFormattostring','$KpiEngagementRateOrgFormattostring','$kpiCtrAdsFormattostring','$kpiCtrOrgFormattostring','$kpiCpmAdsFormattostring')";

    $ejecutar=mysqli_query($conexion,$query);

    if($ejecutar){
        $idUser=$_SESSION['id_usuario'];
        $fechaDeinicio= date('Y-m-d H:i:s');
        $idP = $conexion->insert_id; // Obtener el ID del nuevo post insertado

        $sqlmonLogin="INSERT INTO monitorieo(idEmpleado,actionMonitoreada,fechadeaccion) values ('$idUser','agrego un nuevo post con id:$idP ','$fechaDeinicio')";
        mysqli_query($conexion,$sqlmonLogin);
        echo '
            <script>
                alert("post registrado correctamente");
                window.location="../index.php";
            </script>
        ';
    } else {
        echo '
        
            <script>
            
                alert("post no almacenado, inténtelo de nuevo");
                window.location="../index.php";
            </script>
        ';
    }
    $conexion->close();
}

function LogicaFromInstagram(){
    session_start();
    include 'conection.php';
    echo "logica para form de instagram";
    $alcancetotal=!empty($_POST["AlcanceTotal"])?$_POST["AlcanceTotal"]:0;
    $alcanceInorganico=!empty($_POST["alcanceInorganico"])?$_POST["alcanceInorganico"]:0;
    $interaccionesTotales=!empty($_POST["interacionestotal"])?$_POST["interacionestotal"]:0;
    $interaccionesInorganico=!empty($_POST["interacionesInorganico"])?$_POST["interacionesInorganico"]:0;
    $seguidoresTotales=!empty($_POST["SeguidoresTotales"])?$_POST["SeguidoresTotales"]:0;
    $seguidoresInorganicos=!empty($_POST["seguidoresInorganicos"])?$_POST["seguidoresInorganicos"]:0;
    $pautaTotal=isset($_POST["PautaTotal"])?$_POST["PautaTotal"]:0;
    $impresionesTotales=!empty($_POST["impresionesTotales"])?$_POST["impresionesTotales"]:0;

    //nunca vacios
    $seleccionRedSocial=$_POST["RS"];
    $seleccionFundacion=$_POST["Fundation"];
    $seleccionobjetivo=$_POST["Goal"];
    $NombreCompletoPost=$_POST["nombrePostCompleto"];
    $datecampania=$_POST["datepost"];
    $pautaTotalConvertida=floatval($pautaTotal);


    if($seleccionFundacion=="FBBVA"){
        $seleccionFundacion=1;
    };

    if($seleccionobjetivo=="PPL"){
        $seleccionobjetivo=1;
    }elseif ($seleccionobjetivo=="PPA") {
        $seleccionobjetivo=2;
    };

    if($alcancetotal>0 && $alcancetotal>$alcanceInorganico){
        $AlcanceOrg=$alcancetotal-$alcanceInorganico;
    
    }else{
        $AlcanceOrg=0;
    };

    echo 'Alcance Org:'.$AlcanceOrg;
    echo '<br>';
    if($interaccionesTotales>0){
        
        $interaccionesOrg=$interaccionesTotales-$interaccionesInorganico;

    }else{
        $interaccionesOrg=0;
    }

    echo 'Interacciones Org:'.$interaccionesOrg;
    echo '<br>';

    
    if($seguidoresTotales>0){
        $seguidoresNuevosOrg=$seguidoresTotales-$seguidoresInorganicos;

    }else{
        $seguidoresNuevosOrg=0;
    }

    echo 'Seguidores Org:'.$seguidoresNuevosOrg;
    echo '<br>';

    //Variables KPIS que se forman de los datos ingresados

    //KPI FrecuenciaAds
    //logica en caso la division se de entre 0
    //Variables KPIS que se forman de los datos ingresados

    //KPI FrecuenciaAds
    //logica en caso la division se de entre 0
    if($alcanceInorganico>0){
        $kpiFrecuenciasAds=$impresionesTotales/$alcanceInorganico*100;
        $resultadoRedondeado=round($kpiFrecuenciasAds,2);
        $resultadoFormateadoKpiFrecuendiasAds = number_format($resultadoRedondeado, 2, '.', '');
        $resultadoFormateadoKpiFrecuendiasAdsTostring=$resultadoFormateadoKpiFrecuendiasAds."%";
    }else{
        $resultadoFormateadoKpiFrecuendiasAdsTostring="0%";
    }
    echo "kpi frecuenciaAds///" .$resultadoFormateadoKpiFrecuendiasAdsTostring;
    echo '<br>';

    //KPI engagement rate Ads
    if($alcanceInorganico>0){
        $KpiEngagementRateAds=round($interaccionesInorganico/$alcanceInorganico*100,2);
        $KpiEngagementRateAdsFormat=number_format($KpiEngagementRateAds,2,'.','');
        $KpiEngagementRateAdsFormattostring=$KpiEngagementRateAdsFormat."%";
    }else{
        $KpiEngagementRateAdsFormattostring="0%";
    }

    echo "Kpi EngagementRateAds///".$KpiEngagementRateAdsFormattostring;

    //Kpi engagement rate Organico
    echo '<br>';
    if($AlcanceOrg>0){
        $KpiEngagementRateOrg=round($interaccionesOrg/$AlcanceOrg*100,2);
    $KpiEngagementRateOrgFormat=number_format($KpiEngagementRateOrg,2,'.','');
    $KpiEngagementRateOrgFormattostring=$KpiEngagementRateOrgFormat."%";
    }else{
        $KpiEngagementRateOrgFormattostring="0%";
    }

    echo "Kpi engagement rate Organico///".$KpiEngagementRateOrgFormattostring;



    //kPI CPM ADS
    echo '<br>';
    if($impresionesTotales>0){
        $KpiCpmAds=round($pautaTotalConvertida/$impresionesTotales*1000,2);
        $kpiCpmAdsFormat=number_format($KpiCpmAds,2,'.','');
        $kpiCpmAdsFormattostring="S/.".$kpiCpmAdsFormat;
    }else{
        $kpiCpmAdsFormattostring="S/.0.00";
    }

    echo "Kpi kPI CPM ADS".$kpiCpmAdsFormattostring;

    //datos obtenidos del formulario

    echo '<br>';
    echo '<br>';
    echo '<br>';

    echo "alcance Total///".$alcancetotal;
    echo '<br>';
    echo "Alcance Inorganico///".$alcanceInorganico;
    echo '<br>';
    echo "Inteacciones totales///".$interaccionesTotales;
    echo '<br>';
    echo "Interaciones Inorganicas///".$interaccionesInorganico;
    echo '<br>';

    echo '<br>';
    echo "Seguidores Totales///".$seguidoresTotales;
    echo '<br>';
    echo "Seguidores Inorganicos///".$seguidoresInorganicos;
    echo '<br>';
    echo "Pauta total///S/.".$pautaTotalConvertida;
    echo '<br>';
    echo "Impresiones Totales///".$impresionesTotales;
    echo '<br>';
    echo "RedSocialId///".$seleccionRedSocial;
    echo '<br>';
    echo "Fundacion Seleccionada///".$seleccionFundacion;
    echo '<br>';
    echo "Seleccion Objetivo///".$seleccionobjetivo;
    echo '<br>';
    echo "Nombre Completo del post Autogenerado///".$NombreCompletoPost;
    echo '<br>';
    echo "Fecha de la camapania///".$datecampania;

    
    $query = "INSERT INTO post(datePostCreated, namePost,idGoal, idFundation, IdsocialNet,alcanceAds,alcanceInorganic,alcanceOrg,interaccionesAds,interaccionesInorganic,interaccionesOrg,seguidoresNuevosAds,seguidoresNuevosInorganic,seguidoresNuevosOrg,PautaAds,impresionesAds,kpiFrecuenciaAds,kpiengagementRateAds,kpiengagementRateOrg,kpiCpmAds) 
    VALUES('$datecampania', '$NombreCompletoPost','$seleccionobjetivo','$seleccionFundacion',2,'$alcancetotal','$alcanceInorganico','$AlcanceOrg','$interaccionesTotales','$interaccionesInorganico','$interaccionesOrg','$seguidoresTotales','$seguidoresInorganicos','$seguidoresNuevosOrg','$pautaTotalConvertida','$impresionesTotales','$resultadoFormateadoKpiFrecuendiasAdsTostring','$KpiEngagementRateAdsFormattostring','$KpiEngagementRateOrgFormattostring','$kpiCpmAdsFormattostring')";

    $ejecutar=mysqli_query($conexion,$query);

    if($ejecutar){
        $idUser=$_SESSION['id_usuario'];
        $fechaDeinicio= date('Y-m-d H:i:s');
        $idP = $conexion->insert_id; // Obtener el ID del nuevo post insertado

        $sqlmonLogin="INSERT INTO monitorieo(idEmpleado,actionMonitoreada,fechadeaccion) values ('$idUser','agrego un nuevo post con id:$idP ','$fechaDeinicio')";
        mysqli_query($conexion,$sqlmonLogin);
    echo '
    <script>
    alert("post registrado correctamente");
    window.location="../index.php";
    </script>
    ';
    } else {
    echo '

    <script>

    alert("post no almacenado, inténtelo de nuevo");
    window.location="../index.php";
    </script>
    ';
    };

    $conexion->close();

}

$tipoform=$_POST["formType"];
//variables puestas por el usuario mediante el formulario
if($tipoform=="facebook"){
    LogicaFormFacebook();
};

if($tipoform=="instagram"){
    LogicaFromInstagram();
};
?>