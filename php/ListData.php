<?php

include_once('conection.php');

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
socialnet sn ON p.idSocialNet = sn.idSocialNet order by p.datePostCreated;";
echo '<div class="conteiner-todosPost">';
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
    echo '
    <form action="editarview.php" method="POST">
    <div class="post-container">
    <input class="idinput" type="number"  name="idPost" value="'.$row["idPost"].'" readonly hidden>
    <p>ID: ' . $row["idPost"] . '</p>
    <p>Fecha : ' . $row["datePostCreated"] . '</p>
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
    <button class="btn btn-info">editar</button>
    </div>
    </form>
    ';
    
}
}

echo '</div>';
$conexion->close();


?>