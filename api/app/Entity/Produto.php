<?php

    namespace App\Entity;

    use App\DataBase\Database;
    use \PDO;

    class Produto {
        /**
         * Identificador único do produto 
         * @var integer
         */
        public $id;
        /**
         * Nome do produto
         * @var string
         */
        public $nome;
        /**
         * Número de série do produto
         * @var integer
         */
        public $numero_de_serie;
        /**
         * Descrição do produto
         * @var string
         */
        public $descricao;
        /**
         * Quantidade do produto em estoque
         * @var integer
         */
        public $quantidade;
        /**
         * Método para cadastrar um novo produto
         * @return boolean
         */
        public function cadastrar() {
            // Inserir o produto no banco de dados
            $objetoDatabase = new Database('produtos');
            $this->id = $objetoDatabase->insert([
                'nome'              => $this->nome,
                'numero_de_serie'   => $this->numero_de_serie,
                'descricao'         => $this->descricao,
                'quantidade'        => $this->quantidade
            ]); // Query Builder para montar um comando de INSERT do SQL para executar na tabela produtos
            // Retornar sucesso
            return true;
        }
        /**
         * Método responsável por atualizar um produto no banco de dados
         * @return boolean
         */
        public function atualizar() {
            return (new Database('produtos'))->update('id ='.$this->id,[
                'nome'              => $this->nome,
                'numero_de_serie'   => $this->numero_de_serie,
                'descricao'         => $this->descricao,
                'quantidade'        => $this->quantidade
            ]);
        }
        /**
         * Método responsável por excluir um produto do banco de dados
         * @return boolean
         */
        public function excluir() {
            return (new Database('produtos'))->delete('id ='.$this->id);
        }
        /**
         * Método responsável por obter os produtos do banco de dados
         * @param string $where
         * @param string $order
         * @param string $limit
         * @return array
         */
        public static function getProdutos($where = null, $order = null, $limit = null) {
            // Os parâmetros acima criarão as cláusulas dentro do sistema para que a consulta seja exata
            return (new Database('produtos'))->select($where,$order,$limit)->fetchAll(PDO::FETCH_CLASS,self::class);
            /*
                fetchAll() pega tudo e transforma em um array
                PDO::FETCH_CLASS define que o tipo de array que será montado pelo fetchAll() é de classe / objetos
                self::class define o tipo de objeto que é o da própria classe (que é o Produto)
            */
        }
        /**
         * Método responsável por buscar um produto específico pelo seu respectivo ID
         * @param integer $id
         * @return Produto
         */
        public static function getSomenteUmProduto($id) {
            return (new Database('produtos'))->select('id = '.$id)->fetchObject(self::class);
            /*
                fetchObject() pega somente uma posição
                Com self::class ele retorna como objeto
            */
        }
    }