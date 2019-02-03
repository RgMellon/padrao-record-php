## Padrão Active Record php 

##### O que é
 Active record é um padrão de projeto, ele é uma otima saída para reutilização
 de codigo ao que se refere a ações no banco de dados, como insert, update e 
 delete
 exemplo : 
 não seria legal se pudessemos fazer assim :
```php
    $u = new User();
    $u->nome = 'Moises';
    $u->email =  'moises@mail.com';
    $u->pass = 'secret';

    $u->save();
 ```
e apenas com isso toda a complexidade de salvar no banco de dados
seria escrita apenas uma vez, e todos que extendesse da classe Record
ganharia essas habilidades ...
##### Motivação de uso
