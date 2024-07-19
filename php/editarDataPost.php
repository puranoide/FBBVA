<?php
session_start();
include 'conection.php';
if (mysqli_connect_errno()) {
    echo "Error de conexión a MySQL: " . mysqli_connect_error();
    exit();
}

    $id=$_POST["id"];
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

    //DATOS QUE NUNCA IRAN VACIOS
    $NombreCompletoPost=$_POST["nombre"];
    $pautaTotalConvertida=floatval($pautaTotal);


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

    echo '<br>';
    echo 'id:'.$id;
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
    echo "Nombre Completo del post Autogenerado///".$NombreCompletoPost;
    echo '<br>';
    $sql = "UPDATE post SET namePost='$NombreCompletoPost',alcanceAds='$alcancetotal',alcanceInorganic='$alcanceInorganico',interaccionesAds='$interaccionesTotales',interaccionesInorganic='$interaccionesInorganico',clicsAds='$clicksTotales',clicsInorganic='$clicksInorganicos',seguidoresNuevosAds='$seguidoresTotales',seguidoresNuevosInorganic='$seguidoresInorganicos',pautaAds='$pautaTotalConvertida',impresionesAds='$impresionesTotales',alcanceOrg='$AlcanceOrg',interaccionesOrg='$interaccionesOrg',clicsOrg='$clicksOrg',seguidoresNuevosOrg='$seguidoresNuevosOrg',kpiFrecuenciaAds='$resultadoFormateadoKpiFrecuendiasAdsTostring',kpiengagementRateOrg='$KpiEngagementRateOrgFormattostring',kpiCtrAds='$kpiCtrAdsFormattostring',kpiCtrOrg='$kpiCtrOrgFormattostring',kpiCpmAds='$kpiCpmAdsFormattostring' WHERE idPost='$id'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        $idUser=$_SESSION['id_usuario'];
        $fechaDeinicio= date('Y-m-d H:i:s');
       // $idP = $conexion->insert_id; // Obtener el ID del nuevo post insertado

        $sqlmonLogin="INSERT INTO monitorieo(idEmpleado,actionMonitoreada,fechadeaccion) values ('$idUser','actualizo el post con id:$id ','$fechaDeinicio')";
        mysqli_query($conexion,$sqlmonLogin);
        echo'
        <script>
            alert("Post Actualizado con exito")
            window.location="../index.php";
        </script>
    ';
    
    mysqli_close($conexion);
    exit();
    
    } else {
        echo'
        <script>
            alert("No se pudo actualizar el Post")
            window.location="../index.php";
        </script>
    ';
    
    mysqli_close($conexion);
        exit();
        }
?>