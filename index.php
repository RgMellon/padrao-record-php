<?php
    require 'autoload.php';
    
    $p = new Produto();
    
    $p->nome = 'Renan';
    $p->idade =  33;
    
    echo $p->save();

    $c = new Categoria();

    $c->nome = 'Mocinga';
    $c->id = 222;
    echo '<br>';
    echo $c->save();