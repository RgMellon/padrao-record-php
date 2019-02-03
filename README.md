## Padrão Active Record php 

##### O que é
 Active record é um padrão de projeto, ele é uma otima saída para reutilização
 de codigo ao que se refere a ações no banco de dados, como insert, update e 
 delete,
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

#### Como funciona
    As classes que forem usar esse padrão deve herdar de
    Record, e a unica coisa que deve ter é uma constante
    que define qual tabela será usada pela Record
    veja o exemplo :

    ```php
        class User extends Record {
            const TABLENAME = 'user';
        } 
    ```

### Um pouco sobre os metodos magicos do php
    Antes de prosseguir, a classe Record utiliza 
    do metodo magico chamado __set(),
    os metodos magicos do php são utilizados 
    para definir um comportamento para o objeto,
    eles geralmente começam com __ (underline)
    como por exemplo __construct, que será chamado primeiro quando
    o objeto for instaciado.
    O __set() funciona da seguinte forma, quando você tentar acessar 
    um atributo que não está acessivel, ou pq não existe ou pq está privado
    ele será chamado automaticamente

    exemplo :

    ```php 
            class Pessoa {
                private $nome;
                private $idade;

            }
    ```
    ao acessar
    
    ```php 
        $ p = new Pessoa();
        $p->nome = 'teste';
    ```

    um fatal error aconteceria pois nome é um atributo privado
    da classe, e não temos nem um metodo de acesso para o mesmo.

    logo se usarmos o __set($atributo, $valor);
    como primeiro argumento ele pegaria o atributo que tentou acessar
    no nosso caso 'nome' e com segundo ele pegaria o valor, que no nosso
    caso é teste, com isso poderiamos modificar completamente o comportamento de uma classe
    utilizando essa estrategia

    ```php 
            class Pessoa {
                private $dados;
    
                function __set($atributo, $valor) {
                    $this->dados[$atributo] = $valor
                }

            }
    ```
    A seguinte coisa aconteceu aqui, o atributo dados agora é um valor,
    e ao tentarmos fazer $p = new Pessoa()

    ```php 
        $p = new Pessoa();
        $p->nome = 'Moises';
    ```
    ele vai ver que não existe o atributo nome,
    logo o __set() é chamado, passando como valor (nome, Moises)
    e criando uma chave em dados ficando algo como isso
    $dados['nome'] = 'Moises';

    com isso podemos passar varios atributos que ele guardara nesse array como por exemplo
    idade, peso, altura e etc, e para acessesar eses valores o php possui outro metodo
    magico chamado __get();
