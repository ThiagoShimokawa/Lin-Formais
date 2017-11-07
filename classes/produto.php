<?php


class Produto
{
    //public $Id;
    public $nome;
    public $preco;

    public function __construct(/*$Id=null,*/ $nome=null, $preco=null)
    {
        //$this->Id = $Id;
        $this->nome = $nome;
        $this->preco = $preco;    }
}
