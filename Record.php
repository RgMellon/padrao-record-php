<?php

    class Record {

        private $data;
        
        function __set($atributo, $valor) {
            $this->data[$atributo] = $valor;
        }

        
        public function save() {
            $key = implode(',',array_keys($this->data));
            $valor = implode(',', array_values($this->data));
            
            $sql = 'insert into '.$this::TABLENAME.'('.$key.')'.
            ' Values '.'('.$valor.')';
        
            return $sql;
            
        }


    }