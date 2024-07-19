<?php
        include 'conection.php';
        $nombreFundacion=isset($_POST["FundacionFiltro"])?$_POST["FundacionFiltro"]:'';
        $socialNet=isset($_POST["RedFiltrada"])?$_POST["RedFiltrada"]:'';
        $fechaDesde=isset($_POST["FechaDesde"])?$_POST["FechaDesde"]:'';
        $fechaHasta=isset($_POST["FechaHasta"])?$_POST["FechaHasta"]:'';
        $objetivo=isset($_POST["ObjetivoFiltro"])?$_POST["ObjetivoFiltro"]:'';
        $nombre=isset($_POST["NameFiltro"])?$_POST["NameFiltro"]:'';


        $sql = "SELECT 
            p.idPost,
            p.datePostCreated,
            g.nameGoal,
            f.nameFundation,
            sn.nameSocialNet,
            p.namePost,
            p.alcanceAds,
            p.alcanceInorganic,
            p.alcanceOrg,
            p.interaccionesAds,
            p.interaccionesInorganic,
            p.interaccionesOrg,
            p.clicsAds,
            p.clicsInorganic,
            p.clicsOrg,
            p.seguidoresNuevosAds,
            p.seguidoresNuevosInorganic,
            p.seguidoresNuevosOrg,
            p.pautaAds,
            p.impresionesAds,
            p.kpiFrecuenciaAds,
            p.kpiengagementRateAds,
            p.kpiengagementRateOrg,
            p.kpiCtrAds,
            p.kpiCtrOrg,
            p.kpiCpmAds
        FROM 
            post p
        JOIN 
            goals g ON p.idGoal = g.idGoal
        JOIN 
            fundation f ON p.idFundation = f.idFundation
        JOIN 
            socialnet sn ON p.idSocialNet = sn.idSocialNet
        WHERE 
        (sn.nameSocialNet = '$socialNet' OR '$socialNet' IS NULL OR '$socialNet' = '')
        AND((p.datePostCreated BETWEEN '$fechaDesde' AND '$fechaHasta') OR ('$fechaDesde' = '' AND '$fechaHasta' = ''))
        AND(g.nameGoal='$objetivo' OR '$objetivo' IS NULL OR '$objetivo'='')
        AND (p.namePost='$nombre' OR '$nombre' IS NULL OR '$nombre'='')
        ;";
        
        $sqlreport="SELECT SUM(p.alcanceAds) as totalAlcanceAds,SUM(p.alcanceInorganic) as TotalAlcanceMeta,SUM(p.alcanceOrg) as totalAlcanceOrg,SUM(p.clicsAds) AS totalClicsAds,SUM(p.clicsInorganic) AS clicsMetaTotal,SUM(p.clicsOrg) AS clicsOrgTotal,SUM(p.impresionesAds) as totalImpresionesAds,SUM(p.impresionesAds) AS totalImpresionesAds,SUM(p.interaccionesAds) AS totalInteraccionesAds,SUM(p.interaccionesInorganic) totalInteraccionesMeta,SUM(p.interaccionesOrg) as totalInteraccionesOrg,SUM(p.pautaAds) as totalPautasAds,SUM(p.seguidoresNuevosAds) as totalSeguidoresNuevosAds,SUM(p.seguidoresNuevosInorganic) as TotalSeguidoresNuevosInorganic,SUM(p.seguidoresNuevosOrg) as  TotalSeguidoresNuevosOrg,SUM(CAST(REPLACE(p.kpiFrecuenciaAds, '%', '') AS DECIMAL(10,2)))/ COUNT(kpiFrecuenciaAds) AS promedioKpiFrecuenciasAds,SUM(CAST(REPLACE(p.kpiengagementRateAds, '%', '') AS DECIMAL(10,2)))/COUNT(kpiengagementRateAds) AS promediokpiengagementRateAds,SUM(CAST(REPLACE(p.kpiengagementRateOrg, '%', '') AS DECIMAL(10,2)))/COUNT(kpiengagementRateOrg) AS promediokpiengagementRateOrg,SUM(CAST(REPLACE(p.kpiCtrAds, '%', '') AS DECIMAL(10,2)))/COUNT(kpiCtrAds) AS promediokpiCtrAds,SUM(CAST(REPLACE(p.kpiCtrOrg, '%', '') AS DECIMAL(10,2)))/COUNT(kpiCtrOrg) AS promediokpiCtrOrg,SUM(CAST(REPLACE(REPLACE(TRIM(kpiCpmAds), 'S/.', ''), ',', '') AS DECIMAL(10, 2)))/COUNT(kpiCpmAds) AS promediokpiCpmAds FROM post p JOIN 
            socialnet sn ON p.idSocialNet = sn.idSocialNet WHERE p.datePostCreated BETWEEN '$fechaDesde' and '$fechaHasta' or '$fechaDesde' = '' AND '$fechaHasta' = '' and p.namePost='$nombre' or '$nombre' is null or '$nombre'='' and sn.nameSocialNet = '$socialNet' OR '$socialNet' IS NULL OR '$socialNet' = '';"; 
       //echo $sql;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles.css">
    <title>Data-filtrada</title>
</head>
<body>

<form action="generate_excel.php" method="POST">
        <input type="hidden" name="FechaDesde" value="<?php echo $fechaDesde; ?>">
        <input type="hidden" name="FechaHasta" value="<?php echo $fechaHasta; ?>">
        <input type="hidden" name="NameFiltro" value="<?php echo $nombre; ?>">
        <input type="hidden" name="RedFiltrada" value="<?php echo $socialNet; ?>">
        <button type="submit">Descargar Reporte en Excel</button>
    </form>
    <?php

        $resulreport=$conexion->query($sqlreport);
        if($resulreport->num_rows > 0){
            while($row2=$resulreport->fetch_assoc()){
                echo '
                    <table class="tablereport">
                    <caption>tabla totales</caption>
                        <thead>
                        <tr>
                            <th>Alcance Meta</th>
                            <th>Alcance Ads</th>
                            <th>Alcance Organico</th>

                            <th>clicks Meta</th>
                            <th>clicks Ads</th>
                            <th>clicks Organico</th>

                            <th>interacciones Meta</th>
                            <th>interracciones Ads</th>
                            <th>interacciones Organico</th>

                            <th>Followers Meta</th>
                            <th>Followers Ads</th>
                            <th>Followers Organico</th>
                            <th>Pautas Ads</th>
                            <th>Impresiones</th>
                            <th>KPI Frecuencia Ads</th>
                            <th>KPI Engagement Rate Ads</th>
                            <th>KPI Engagement Rate Org</th>
                            <th>KPI CTR Ads</th>
                            <th>KPI CTR Org</th>
                            <th>KPI CPM Ads</th>
                        </tr>
                        </thead>
                        <tr>
                            <td>'.$row2["totalAlcanceAds"].'</td>
                            <td>'.$row2["TotalAlcanceMeta"].'</td>
                            <td>'.$row2["totalAlcanceOrg"].'</td>

                            <td>'.$row2["totalClicsAds"].'</td>
                            <td>'.$row2["clicsMetaTotal"].'</td>
                            <td>'.$row2["clicsOrgTotal"].'</td>

                            <td>'.$row2["totalInteraccionesAds"].'</td>
                            <td>'.$row2["totalInteraccionesMeta"].'</td>
                            <td>'.$row2["totalInteraccionesOrg"].'</td>

                            <td>'.$row2["totalSeguidoresNuevosAds"].'</td>
                            <td>'.$row2["TotalSeguidoresNuevosInorganic"].'</td>
                            <td>'.$row2["TotalSeguidoresNuevosOrg"].'</td>
                            <td>'.$row2["totalPautasAds"].'</td>
                            <td>'.$row2["totalImpresionesAds"].'</td>
                           <td>'.number_format($row2["promedioKpiFrecuenciasAds"], 2).'%</td>
                            <td>'.number_format($row2["promediokpiengagementRateAds"], 2).'%</td>
                            <td>'.number_format($row2["promediokpiengagementRateOrg"], 2).'%</td>
                            <td>'.number_format($row2["promediokpiCtrAds"], 2).'%</td>
                            <td>'.number_format($row2["promediokpiCtrOrg"], 2).'%</td>
                            <td>'.number_format($row2["promediokpiCpmAds"], 2).'%</td>
                        <tr>
                    </table>
                    
                
                ';
            }
        }else{
            echo 'no hay resultados para ese parametro de busqueda';
        }


    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '
            <div class="conteiner-todosPost">
            <form action="editarview.php" method="POST">
            <div class="post-container">
            <input class="idinput" type="number"  name="idPost" value="'.$row["idPost"].'" readonly>
            <p>ID: ' . $row["idPost"] . '</p>
            <p>Fecha: ' . $row["datePostCreated"] . '</p>
            <p>Objetivo: ' . $row["nameGoal"] . '</p>
            <p>Cuenta: ' . $row["nameFundation"] . '</p>
            <p>Red Social: ' . $row["nameSocialNet"] . '</p>
            <p>Post: ' . $row["namePost"] . '</p>
            <p>Alcance meta: ' . $row["alcanceAds"] . '</p>
            <p>Alcance Ads: ' . $row["alcanceInorganic"] . '</p>
            <p>Alcance Orgánico: ' . $row["alcanceOrg"] . '</p>
            <p>Interacciones meta: ' . $row["interaccionesAds"] . '</p>
            <p>Interacciones Ads: ' . $row["interaccionesInorganic"] . '</p>
            <p>Interacciones Orgánicas: ' . $row["interaccionesOrg"] . '</p>
            <p>Clics meta: ' . $row["clicsAds"] . '</p>
            <p>Clics Ads: ' . $row["clicsInorganic"] . '</p>
            <p>Clics Orgánicos: ' . $row["clicsOrg"] . '</p>
            <p>Followers Meta: ' . $row["seguidoresNuevosAds"] . '</p>
            <p>Followers Ads: ' . $row["seguidoresNuevosInorganic"] . '</p>
            <p>Followers Orgánicos: ' . $row["seguidoresNuevosOrg"] . '</p>
            <p>Pauta Ads: ' . $row["pautaAds"] . '</p>
            <p>Impresiones Ads: ' . $row["impresionesAds"] . '</p>
            <p>KPI Frecuencia Ads: ' . $row["kpiFrecuenciaAds"] . '</p>
            <p>KPI Engagement Rate Ads: ' . $row["kpiengagementRateAds"] . '</p>
            <p>KPI Engagement Rate Org: ' . $row["kpiengagementRateOrg"] . '</p>
            <p>KPI CTR Ads: ' . $row["kpiCtrAds"] . '</p>
            <p>KPI CTR Org: ' . $row["kpiCtrOrg"] . '</p>
            <p>KPI CPM Ads: ' . $row["kpiCpmAds"] . '</p>
                <button>editar</button>
            </div>
            </form>
            </div>
            ';
            
        }
       
    } else{
        echo 'no hay resultados para ese parametro de busqueda';
    }

   

  
    
    $conexion->close();
    ?>
</body>
</html>