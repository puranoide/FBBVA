<?php
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include 'conection.php';

// Obtener los datos del reporte
$fechaDesde = isset($_POST["FechaDesde"]) ? $_POST["FechaDesde"] : '';
$fechaHasta = isset($_POST["FechaHasta"]) ? $_POST["FechaHasta"] : '';
$nombre = isset($_POST["NameFiltro"]) ? $_POST["NameFiltro"] : '';
$socialNet = isset($_POST["RedFiltrada"]) ? $_POST["RedFiltrada"] : '';
$objetivo = isset($_POST["ObjetivoFiltro"]) ? $_POST["ObjetivoFiltro"] : '';

$sqlreport = "SELECT SUM(p.alcanceAds) as totalAlcanceAds, SUM(p.alcanceInorganic) as TotalAlcanceMeta, SUM(p.alcanceOrg) as totalAlcanceOrg, SUM(p.clicsAds) AS totalClicsAds, SUM(p.clicsInorganic) AS clicsMetaTotal, SUM(p.clicsOrg) AS clicsOrgTotal, SUM(p.impresionesAds) as totalImpresionesAds, SUM(p.interaccionesAds) AS totalInteraccionesAds, SUM(p.interaccionesInorganic) AS totalInteraccionesMeta, SUM(p.interaccionesOrg) as totalInteraccionesOrg, SUM(p.pautaAds) as totalPautasAds, SUM(p.seguidoresNuevosAds) as totalSeguidoresNuevosAds, SUM(p.seguidoresNuevosInorganic) as TotalSeguidoresNuevosInorganic, SUM(p.seguidoresNuevosOrg) as TotalSeguidoresNuevosOrg, SUM(CAST(REPLACE(p.kpiFrecuenciaAds, '%', '') AS DECIMAL(10,2)))/ COUNT(kpiFrecuenciaAds) AS promedioKpiFrecuenciasAds, SUM(CAST(REPLACE(p.kpiengagementRateAds, '%', '') AS DECIMAL(10,2)))/COUNT(kpiengagementRateAds) AS promediokpiengagementRateAds, SUM(CAST(REPLACE(p.kpiengagementRateOrg, '%', '') AS DECIMAL(10,2)))/COUNT(kpiengagementRateOrg) AS promediokpiengagementRateOrg, SUM(CAST(REPLACE(p.kpiCtrAds, '%', '') AS DECIMAL(10,2)))/COUNT(kpiCtrAds) AS promediokpiCtrAds, SUM(CAST(REPLACE(p.kpiCtrOrg, '%', '') AS DECIMAL(10,2)))/COUNT(kpiCtrOrg) AS promediokpiCtrOrg, SUM(CAST(REPLACE(REPLACE(TRIM(kpiCpmAds), 'S/.', ''), ',', '') AS DECIMAL(10, 2)))/COUNT(kpiCpmAds) AS promediokpiCpmAds FROM post p JOIN socialnet sn ON p.idSocialNet = sn.idSocialNet WHERE (p.datePostCreated BETWEEN '$fechaDesde' and '$fechaHasta' OR '$fechaDesde' = '' AND '$fechaHasta' = '') AND (p.namePost='$nombre' OR '$nombre' IS NULL OR '$nombre'='') AND (sn.nameSocialNet = '$socialNet' OR '$socialNet' IS NULL OR '$socialNet' = '');";

$resulreport = $conexion->query($sqlreport);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Configurar encabezados
$headers = [
    'Alcance Meta', 'Alcance Ads', 'Alcance Orgánico', 
    'Clicks Meta', 'Clicks Ads', 'Clicks Orgánicos',
    'Interacciones Meta', 'Interacciones Ads', 'Interacciones Orgánicas',
    'Followers Meta', 'Followers Ads', 'Followers Orgánicos', 
    'Pautas Ads', 'Impresiones', 'KPI Frecuencia Ads', 
    'KPI Engagement Rate Ads', 'KPI Engagement Rate Org', 
    'KPI CTR Ads', 'KPI CTR Org', 'KPI CPM Ads'
];

$col = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($col . '1', $header);
    $col++;
}

$rowNum = 2;
if ($resulreport->num_rows > 0) {
    while ($row2 = $resulreport->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowNum, $row2["totalAlcanceAds"]);
        $sheet->setCellValue('B' . $rowNum, $row2["TotalAlcanceMeta"]);
        $sheet->setCellValue('C' . $rowNum, $row2["totalAlcanceOrg"]);
        $sheet->setCellValue('D' . $rowNum, $row2["totalClicsAds"]);
        $sheet->setCellValue('E' . $rowNum, $row2["clicsMetaTotal"]);
        $sheet->setCellValue('F' . $rowNum, $row2["clicsOrgTotal"]);
        $sheet->setCellValue('G' . $rowNum, $row2["totalInteraccionesAds"]);
        $sheet->setCellValue('H' . $rowNum, $row2["totalInteraccionesMeta"]);
        $sheet->setCellValue('I' . $rowNum, $row2["totalInteraccionesOrg"]);
        $sheet->setCellValue('J' . $rowNum, $row2["totalSeguidoresNuevosAds"]);
        $sheet->setCellValue('K' . $rowNum, $row2["TotalSeguidoresNuevosInorganic"]);
        $sheet->setCellValue('L' . $rowNum, $row2["TotalSeguidoresNuevosOrg"]);
        $sheet->setCellValue('M' . $rowNum, $row2["totalPautasAds"]);
        $sheet->setCellValue('N' . $rowNum, $row2["totalImpresionesAds"]);
        $sheet->setCellValue('O' . $rowNum, number_format($row2["promedioKpiFrecuenciasAds"], 2) . '%');
        $sheet->setCellValue('P' . $rowNum, number_format($row2["promediokpiengagementRateAds"], 2) . '%');
        $sheet->setCellValue('Q' . $rowNum, number_format($row2["promediokpiengagementRateOrg"], 2) . '%');
        $sheet->setCellValue('R' . $rowNum, number_format($row2["promediokpiCtrAds"], 2) . '%');
        $sheet->setCellValue('S' . $rowNum, number_format($row2["promediokpiCtrOrg"], 2) . '%');
        $sheet->setCellValue('T' . $rowNum, number_format($row2["promediokpiCpmAds"], 2) . '%');
        $rowNum++;
    }
} else {
    echo 'No hay resultados para ese parámetro de búsqueda.';
    exit;
}

// Nueva consulta para obtener métricas detalladas y ordenarlas
$valorIG=0;
$valorFB=0;
$sqlParametros="SELECT * FROM parametrosreportes ORDER BY `parametrosreportes`.`dateParametro` DESC LIMIT 1;";
$resulParametros = $conexion->query($sqlParametros);

if ($resulParametros->num_rows > 0){
    while ($rowparametroe = $resulParametros->fetch_assoc()){
        $valorIG=$rowparametroe['valorIg'];
        $valorFB=$rowparametroe['valorFb'];
    }
}
$sqldetalle = "SELECT 
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
    CASE 
        WHEN sn.nameSocialNet = 'facebook' THEN p.seguidoresNuevosAds * $valorFB
        WHEN sn.nameSocialNet = 'instagram' THEN p.seguidoresNuevosAds * $valorIG
        ELSE p.seguidoresNuevosAds 
    END AS seguidoresNuevosAds, 
    CASE 
        WHEN sn.nameSocialNet = 'facebook' THEN p.seguidoresNuevosInorganic * $valorFB 
        WHEN sn.nameSocialNet = 'instagram' THEN p.seguidoresNuevosInorganic * $valorIG
        ELSE p.seguidoresNuevosInorganic 
    END AS seguidoresNuevosInorganic, 
    CASE 
        WHEN sn.nameSocialNet = 'facebook' THEN p.seguidoresNuevosOrg * $valorFB 
        WHEN sn.nameSocialNet = 'instagram' THEN p.seguidoresNuevosOrg * $valorIG
        ELSE p.seguidoresNuevosOrg 
    END AS seguidoresNuevosOrg, 
    p.pautaAds, 
    p.impresionesAds, 
    p.kpiFrecuenciaAds, 
    p.kpiengagementRateAds, 
    p.kpiengagementRateOrg, 
    p.kpiCtrAds, 
    p.kpiCtrOrg, 
    p.kpiCpmAds
FROM post p
JOIN goals g ON p.idGoal = g.idGoal
JOIN fundation f ON p.idFundation = f.idFundation
JOIN socialnet sn ON p.idSocialNet = sn.idSocialNet
WHERE (sn.nameSocialNet = '$socialNet' OR '$socialNet' IS NULL OR '$socialNet' = '')
AND ((p.datePostCreated BETWEEN '$fechaDesde' AND '$fechaHasta') OR ('$fechaDesde' = '' AND '$fechaHasta' = ''))
AND (g.nameGoal = '$objetivo' OR '$objetivo' IS NULL OR '$objetivo' = '')
AND (p.namePost = '$nombre' OR '$nombre' IS NULL OR '$nombre' = '')
ORDER BY 
    CASE 
        WHEN sn.nameSocialNet = 'facebook' THEN (p.seguidoresNuevosAds * $valorFB + p.seguidoresNuevosInorganic * $valorFB + p.seguidoresNuevosOrg * $valorFB)
        WHEN sn.nameSocialNet = 'instagram' THEN (p.seguidoresNuevosAds * $valorIG + p.seguidoresNuevosInorganic *  $valorIG + p.seguidoresNuevosOrg *  $valorIG)
        ELSE (p.seguidoresNuevosAds + p.seguidoresNuevosInorganic + p.seguidoresNuevosOrg)
    END DESC;";

$resuldetalle = $conexion->query($sqldetalle);

if ($resuldetalle->num_rows > 0) {
    // Crear una nueva hoja
    $detailsSheet = $spreadsheet->createSheet();
    $detailsSheet->setTitle('Detalle Publicaciones');

    // Configurar encabezados para la nueva hoja
    $headersDetalle = [
        'ID Post', 'Fecha Creación', 'Objetivo', 'Fundación', 'Red Social', 'Nombre Post',
        'Alcance Ads', 'Alcance Inorgánico', 'Alcance Orgánico', 'Interacciones Ads', 
        'Interacciones Inorgánicas', 'Interacciones Orgánicas', 'Clics Ads', 'Clics Inorgánicos', 
        'Clics Orgánicos', 'Seguidores Nuevos Ads', 'Seguidores Nuevos Inorgánicos', 
        'Seguidores Nuevos Orgánicos', 'Pauta Ads', 'Impresiones Ads', 'KPI Frecuencia Ads', 
        'KPI Engagement Rate Ads', 'KPI Engagement Rate Org', 'KPI CTR Ads', 'KPI CTR Org', 'KPI CPM Ads'
    ];

    $col = 'A';
    foreach ($headersDetalle as $header) {
        $detailsSheet->setCellValue($col . '1', $header);
        $col++;
    }

    $rowNum = 2;
    while ($row = $resuldetalle->fetch_assoc()) {
        $detailsSheet->setCellValue('A' . $rowNum, $row["idPost"]);
        $detailsSheet->setCellValue('B' . $rowNum, $row["datePostCreated"]);
        $detailsSheet->setCellValue('C' . $rowNum, $row["nameGoal"]);
        $detailsSheet->setCellValue('D' . $rowNum, $row["nameFundation"]);
        $detailsSheet->setCellValue('E' . $rowNum, $row["nameSocialNet"]);
        $detailsSheet->setCellValue('F' . $rowNum, $row["namePost"]);
        $detailsSheet->setCellValue('G' . $rowNum, $row["alcanceAds"]);
        $detailsSheet->setCellValue('H' . $rowNum, $row["alcanceInorganic"]);
        $detailsSheet->setCellValue('I' . $rowNum, $row["alcanceOrg"]);
        $detailsSheet->setCellValue('J' . $rowNum, $row["interaccionesAds"]);
        $detailsSheet->setCellValue('K' . $rowNum, $row["interaccionesInorganic"]);
        $detailsSheet->setCellValue('L' . $rowNum, $row["interaccionesOrg"]);
        $detailsSheet->setCellValue('M' . $rowNum, $row["clicsAds"]);
        $detailsSheet->setCellValue('N' . $rowNum, $row["clicsInorganic"]);
        $detailsSheet->setCellValue('O' . $rowNum, $row["clicsOrg"]);
        $detailsSheet->setCellValue('P' . $rowNum, $row["seguidoresNuevosAds"]);
        $detailsSheet->setCellValue('Q' . $rowNum, $row["seguidoresNuevosInorganic"]);
        $detailsSheet->setCellValue('R' . $rowNum, $row["seguidoresNuevosOrg"]);
        $detailsSheet->setCellValue('S' . $rowNum, $row["pautaAds"]);
        $detailsSheet->setCellValue('T' . $rowNum, $row["impresionesAds"]);
        $detailsSheet->setCellValue('U' . $rowNum, $row["kpiFrecuenciaAds"]);
        $detailsSheet->setCellValue('V' . $rowNum, $row["kpiengagementRateAds"]);
        $detailsSheet->setCellValue('W' . $rowNum, $row["kpiengagementRateOrg"]);
        $detailsSheet->setCellValue('X' . $rowNum, $row["kpiCtrAds"]);
        $detailsSheet->setCellValue('Y' . $rowNum, $row["kpiCtrOrg"]);
        $detailsSheet->setCellValue('Z' . $rowNum, $row["kpiCpmAds"]);
        $rowNum++;
    }
}

$writer = new Xlsx($spreadsheet);
$fileName = 'reporte_' . date('Y-m-d_H-i-s') . '.xlsx';
$filePath = 'reportes/' . $fileName;

$writer->save($filePath);

// Forzar la descarga del archivo
header('Content-Description: File Transfer');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filePath));
readfile($filePath);
exit;
?>
