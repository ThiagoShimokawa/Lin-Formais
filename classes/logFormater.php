<?php


class Log
{
    //public $Id;
    public $nome;
    public $acao;
    public $produto;

    public function __construct(/*$Id=null,*/ $nome=null, $acao=null, $produto=null)
    {
        //$this->Id = $Id;
        $this->nome = $nome;
        $this->acao = $acao;
        $this->produto = $produto;
    }
}
