<?php

/**
 * <b>Venda.class:</b>
 * Model por gerenciamento dos dados da tabela anamneses!
 * 
 */

class Venda{
    
    private $Tabela;
    private $Dados;
    private $Result;
    
//** @var PDOStatement*/
    private $Create;
//** @var PDO */
    private $Conn;
    
    /*Obtém conexão do banco de dados */
    public function __construct() {
        $this->Conn = Conn::getConn();
    }
    
    /**
     * <b>novaVenda</b> Executa um cadastro simplificado no banco de dados utilizando prepared statements.
     * Basta informar o nome da tabela e um arrey atribuitivo com nome da coluna e valor!
     * 
     * @param STRING $Tabela = Informe o nome da tabela no banco.
     * @param ARRAY $Dados = Informe um array atribuitivo. (Nome Da coluna => valor).
     */
    
    public function novaVenda($Tabela, array $Dados){
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        
        $this->getSyntax();
        $this->Execute();
    }
    
    /**
     * <b>ExeCreateMulti:</b> Executa um cadastro multiplo no banco de dados utilizando prepared statements.
     * Basta informar o nome da tabela e uma array multidimensional com nome da coluna e valores!
     * 
     * @param STRING $Tabela = Informe o nome da tabela no banco!
     * @param ARRAY $Dados = Informe um array multidimensional. ( [] = key => valor).
     */
    
    public function ExeCreateMulti($Tabela, array $Dados){
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        
        $Fileds = implode(', ', array_keys($this->Dados[0]));
        $Places = null;
        $Inserts = null;
        $Links = count(array_keys($this->Dados[0]));
        
        foreach ($Dados as $ValueMult):
            $Places .= '(';
            $Places .= str_repeat('?,', $Links);
            $Places .= '),';
            
            foreach ($ValueMult as $ValueSingle):
                $Inserts[] = $ValueSingle;
            endforeach;
        endforeach;
        
        $Places = str_replace(',)', ')', $Places);
        $Places = substr($Places, 0, -1);
        $this->Dados = $Inserts;
        
        $this->Create = "INSERT INTO {$this->Tabela} ({$Fileds}) VALUES {$Places}";
        $this->Execute();
    }
    
    /**
     * <b>Obter resultado:<b> Retorna o ID do registro inserido ou FALSE caso nenhum registro seja inserido!
     * @return INT $Variavel = LastInsertId OR FALSE 
     */
    
    public function getResult(){
        return $this->Result;
    }
    
    /**
     * *****METODOS PRIVADOS****
     */
    
    //Obtém o PDO e prepara a query
    private function Connect(){
        $this->Create = $this->Conn->prepare($this->Create);
    }
    
    //Cria a sintaxe da query para Prepared Statments
    private function getSyntax(){
        $Fileds = implode(', ', array_keys($this->Dados));
        $Places = ':' . implode(', :', array_keys($this->Dados));
        $this->Create = "INSERT INTO {$this->Tabela} ({$Fileds}) VALUES ({$Places})";
    }
    
    //Obtém a Conexão e a Syntax, executa a query!
    private function Execute(){
        $this->Connect();
        try{
            $this->Create->execute($this->Dados);
            $this->Result = $this->Conn->lastInsertId();
        } catch (PDOException $e) {
            $this->Result = null;
            Erro("<b>Erro ao cadastrar:</b> {$e->getMessage()}", $e->getCode());
        }
    }
    
}

