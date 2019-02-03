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
    Antes de prosseguir, a classe Record utiliza do metodo magico chamado __set(),
    os metodos magicos do php são utilizados para definir um comportamento para o objeto,
    eles geralmente começam com __ (underline) como por exemplo __construct, que será chamado primeiro quando o objeto for instaciado.
    O __set() funciona da seguinte forma, quando você tentar acessar um atributo que não está acessivel, ou pq não existe ou pq está privado ele será chamado automaticamente

    exemplo

```php 
    class Pessoa {
        private $nome;
        private $idade;

    }
```
    ao acessar
    
```php 
    $p = new Pessoa();
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

#### Voltando para a classe Record

```php
    class Record {

        private $dados;
        
        function __set($atributo, $valor) {
            $this->dados[$atributo] = $valor;
        }

        
        public function save() {
            $key = implode(',',array_keys($this->dados));
            $valor = implode(',', array_values($this->dados));
            
            $sql = 'insert into '.$this::TABLENAME.'('.$key.')'.
            ' Values '.'('.$valor.')';
        
            // Aqui se excuta a query
            
        }


    }
```
Como vimos anteriormente, usamos o metodo magico __set();
assim temos aquele array de dados, sendo a chave a coluna do banco
e o valor o valor que será gravado nessa coluna, então usamos as funções
array_keys para pegar a chave e o array_values para pegar o valor, dando implode
para transformar o array em string, 
e veja também que usamos   "$this::TABLENAME" que é o nome da tabela definida na classe
filha.

Agora fica simples, se quisermos fazer outra classe que possua o comportamento
de gravar no banco, é só fazer essa classe herdar de Record
e definindo nela mesmo o nome da tabela, e no final fazer algo assim 

```php
    $c = new Categoria();
    $c->nome;
    $c->tipo;
    $c->save();
```

pronto! sem retrabalho e sem rescrever codigo. Tudo funcionara perfeitamente!


#### OBS 
Com isso sua aplicação ficara um pouco parecida como frameworks famosos, como laravel por exemplo
faz para guardar os ados, usando uma estrutura limpa e totalmente reutilizável

#### Créditos 
    Para o aprendizado, foi consultado o ótimo livro de php
    do Pablo Dall'Oglio, php : Programando com orientação a objetos