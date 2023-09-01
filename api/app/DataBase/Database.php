<?php
    /*
        Classe responsável por gerir a conexão com o banco de dados
        Essa classe fará uma ponte entre o sistema e o banco de dados utilizando PDO
        A classe fará a abstração e atuará como Query Builder
        O conceito de Query Builder permite que o dev execute as função SQL sem escrever linhas de código SQL
        Uma classe irá abstrair a escrita SQL e fará a escrita para o dev
        O dev somente enviará os dados que serão executados
        Na classe Database será definidas as credênciais de acesso ao DB e algumas informações variáveis
    */

    namespace App\DataBase;

    use \PDO;
    use \PDOException;

    class Database {
        /**
         * Host de conexão com o banco de dados
         * @var string
         */
        const HOST = 'localhost';
        /**
         * Nome do banco de dados
         * @var string
         */
        const NAME = 'empresa';
        /**
         * Usuário do banco de dados
         * @var string
         */
        const USER = 'root';
        /**
         * Senha do banco de dados
         * @var string
         */
        const PASS = '';

        /**
         * Nome da tabela a ser manipulada
         * @var string
         */
        private $table;
        /**
         * Instância de conexão ao banco de dados
         * @var PDO
         */
        private $connection; // É a instância de PDO (grupo de classes que irão ajudar a conectar ao banco de dados MySQL) Uma vantagem do PDO é a facilidade da troca do banco de dados a ser trabalhado, pois precisa de somente um ajuste

        // Dentro da classe DataBase, precisamos definir qual tabela será manipulada. Para isso adicionaremos uma classe construtor
        // Em seguida, precisamos instanciar criando a conexão. Para isso, usaremos o método setConnection, dentro do construtor

        /**
         * Define a tabela a ser manipulada e instancia a conexão
         * @param string
         */
        function __construct($table = null) {
            $this->table = $table;
            $this->setConnection();
        }
        /**
         * Método responsável por criar uma conexão com o banco de dados (definindo uma instância de PDO)
         */
        private function setConnection() {
            // O try / catch faz uma manipulação segura do BD, pois consegue tratar os erros que o sistema pode mostrar
            // PDOException $e serve para gerenciar as exceções
            try {
                $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER, self::PASS);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); // Se ocorrer um erro em uma query, será retornada uma exception travando o sistema através de erro fatal
            }catch(PDOException $e){
                die('ERROR: '.$e->getMessage());
                // alert('Oh não! Parece que tivemos um problema. Por favor, aguarde uns instantes e tente novamente');
            }
        }
        /**
         * Método responsável por executar as queries dentro do banco de dados
         * @param string $query
         * @param array $params
         * @return PDOStatement
         */
        public function execute($query, $params=[]) {
            try{
                $statement = $this->connection->prepare($query); // Gera uma instância que verificará onde há binds que precisam ser substituídos
                $statement->execute($params);
                return $statement;
            }catch(PDOException $e){
                die('ERROR: '.$e->getMessage());
                // alert('Oh não! Parece que tivemos um problema. Por favor, aguarde uns instantes e tente novamente');
            }
        }
        /**
         * Método responsável por inserir dados no banco de dados
         * @param array $dados [ field => value ]
         * @return integer ID inserido
         */
        public function insert($dados) {
            // DADOS DA QUERY
            $fields = array_keys($dados); // Retorna todas as chaves
            $binds = array_pad([],count($fields), '?'); // Delimita o array com a quantidade de itens presente em $fields. Se não puder, adiciona campos com ? 

            // MONTA A QUERY
            $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';

            // EXECUTA O INSERT
            $this->execute($query,array_values($dados));

            // RETORNA O ID INSERIDO
            return $this->connection->lastInsertId();
        } // O PDO verifica se os dados são seguros para serem inseridos na tabela
        /**
         * Método responsável por executar uma consulta no banco de dados
         * @param string $where
         * @param string $order
         * @param string $limit
         * @param string $fields
         * @return PDOStatement 
         */
        public function select($where = null, $order = null, $limit = null, $fields = '*') {
            // Os parâmetos estão nulos, pois talvez não sejam declarados (são opcionais)

            //DADOS DA QUERY
            /*
                Se a variável não estiver vazia, ela receberá um comando SLQ que corresponda à sua utilidade mais seu respectivo valor
                Se não, receberá ''
            */
            $where = !empty($where) ? 'WHERE '.$where : '';
            $order = !empty($order) ? 'ORDER BY '.$order : '';
            $limit = !empty($limit) ? 'LIMIT '.$limit : '';

            // MONTA A QUERY
            $query='SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

            // EXECUTA A QUERY
            return $this->execute($query);
        }
        /**
         * Método responsável por executar atualizações no banco de dados
         * @param string $where
         * @param array [ field => value ]
         * @return boolean
         */
        public function update($where,$dados) {
            // DADOS DA QUERY
            $fields = array_keys($dados);

            // MONTA A QUERY
            $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;

            // EXECUTA A QUERY
            $this->execute($query,array_values($dados));

            // RETORNA SUCESSO
            return true;
        }
        /**
         * Método responsável por excluir um dado do banco de dados
         * @return boolean
         */
        public function delete($where) {
            // MONTA A QUERY
            $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

            // EXECUTA A QUERY
            $this->execute($query);

            // RETORNA SUCESSO
            return true;
        }
    }