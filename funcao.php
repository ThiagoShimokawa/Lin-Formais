<?php
require_once ("classes/logFormater.php");
require_once ("classes/produto.php");

function lerArquivo (&$arr){
        //ABRE O ARQUIVO TXT
        $ponteiro = fopen ("arquivo/target.txt", "r");

        //LÊ O ARQUIVO ATÉ CHEGAR AO FIM
        while (!feof ($ponteiro)) {
                //LÊ UMA LINHA DO ARQUIVO
                $linha = fgets($ponteiro, 4096);
                $log = regex($linha);

                if($log != null)
                    array_push($arr, $log);
                $log = null;
        }

        //FECHA O PONTEIRO DO ARQUIVO
        fclose ($ponteiro);
}

function lerProdutos (&$arr){

        //ABRE O ARQUIVO CSV
        $ponteiro = fopen ("arquivo/bdProdutos.csv", "r");
 
        //LÊ O ARQUIVO ATÉ CHEGAR AO FIM
        while (!feof ($ponteiro)) {
            //LÊ UMA LINHA DO ARQUIVO
            $linha = fgets($ponteiro, 4096);
                
            if(strlen($linha) > 0){
                $temp = explode(";", $linha);
                $nome = $temp[0];
                $preco = (double)$temp[1];

                array_push($arr, new Produto($nome, $preco));
            }
        }

        //FECHA O PONTEIRO DO ARQUIVO
        fclose ($ponteiro);
}

function lerAcoes (&$arr){
        //ABRE O ARQUIVO TXT
        $ponteiro = fopen ("arquivo/bdAcoes.csv", "r");

        //LÊ O ARQUIVO ATÉ CHEGAR AO FIM
        while (!feof ($ponteiro)) {
                //LÊ UMA LINHA DO ARQUIVO
                $linha = fgets($ponteiro, 4096);
                
                if(strlen($linha) > 0){
                $temp = explode(";", $linha);
                $acao = $temp[0];
                
                $arr[] =  $acao;
                }
        }

        //FECHA O PONTEIRO DO ARQUIVO
        fclose ($ponteiro);
}

function regex($input_str){
    $pattern = "/[Oo]i,\s+eu\s+sou\s+[ao]\s+(\w+).\s+Gostaria\s+de\s+(\w+)\s+sobre\s+[ao]\s+(\w+).|[Ee]u\s+sou\s+o\s+(\w+)\s+e\s+queria\s+(\w+)\s+sobre\s+o\s+(\w+).|Sou\s+[ao]\s+(\w+)\s+e\s+queria\s+(\w+)\s+sobre\s+[ao]\s+(\w+)|(\w+)\s+(\w+)\s+(\w+)/";

    if(preg_match($pattern, $input_str, $matches_out)){

        //echo(count($matches_out));
        //print_r($matches_out);

        if(count($matches_out) == 4)
            return new Log($matches_out[1], $matches_out[2], $matches_out[3]);
        
        else if(count($matches_out) == 7)
            return new Log($matches_out[4], $matches_out[5], $matches_out[6]);
        
        else if(count($matches_out) == 10)
            return new Log($matches_out[7], $matches_out[8], $matches_out[9]);
        
        else if(count($matches_out) == 13)
            return new Log($matches_out[10], $matches_out[11], $matches_out[12]);
        
    }
}

function getPreco($produto, $arr){
    foreach ($arr as $p) {

        if( strcasecmp($p->nome, $produto) == 0)
            return (double)$p->preco;
    }
} 
