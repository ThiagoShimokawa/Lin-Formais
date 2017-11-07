<?php
require_once ("funcao.php");

$log = array();
lerArquivo($log);

$produtos = array();
lerProdutos($produtos);

$acoes = array();
lerAcoes($acoes);

$qtdVenda = $qtdDuvida = $qtdReclamar = $valorVenda = 0.00;

//print_r($log);
//print_r($produtos);
//print_r($acoes);

foreach ($log as $l){
	
    if( strcasecmp($l->acao, "comprar") == 0 ){
    	$valorVenda += getPreco($l->produto, $produtos);
    	$qtdVenda++;
    }

    else if( strcasecmp($l->acao, "saber") == 0 )
    	$qtdDuvida++;

    else if( strcasecmp($l->acao, "reclamar") == 0 )
    	$qtdReclamar++;
}

?>
<html>
    <head>
        <title>ER</title>    
        <link href="estilo.css" rel="stylesheet"> 

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	    <script type="text/javascript">
	      google.charts.load("current", {packages:["corechart"]});
	      google.charts.setOnLoadCallback(drawChart);
	      function drawChart() {
	        var data = google.visualization.arrayToDataTable([
	          ['Task', 'Hours per Day'],
	          ['Vendas',     <?=$qtdVenda?>],
	          ['Duvidas',      <?=$qtdDuvida?>],
	          ['Reclamações',  <?=$qtdReclamar?>]
	        ]);

	        var options = {
	          title: 'Estatisticas de ações',
	          pieHole: 0.4,
	        };

	        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
	        chart.draw(data, options);
	      }
	    </script>
    </head>

    <body>
    	<div id="principal">
    <div id="corpo">

    	<div id="donutchart" style="width: 600px; height: 400px;"></div>

    	<p>Valor total da venda: <?=$valorVenda?></p>
       <p>Quantidade de vendas: <?=$qtdVenda?></p>
       <p>Quantiade de duvidas: <?=$qtdDuvida?></p>
       <p>Quantiade de Reclamações: <?=$qtdReclamar?></p>
   </div></div>
	
	</body>
</html>