<?php

class Upload{
    //$_FILE[]
    private $file;

    //Tipo mymes
    private $mimeTypes;

    //Tamanho máximo do arquivo em Byter
    private $maxSize;

    //Diretório de publicação
    private $path;

    //Nome do arquivo gerado
    private $fileName;

    /**
     * Método construtor
     *
     * @param  array $file $_FILES['yourFile']
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;

        $this->mimeTypes = [
            'text/plain',
            'image/jpeg',
            'image/png'
        ];

        $this->maxSize = 2097152*5; //2MB

        //$this->path = 'imagens/';
    }

    /**
     * Método responsável por enviar o arquivo para o servidor
     *
     * @param  bool $rename
     * @return int
     */
    public function upload($nomeArquivo)
    {
        $validate = $this->validate();

        if ($validate < 0)
             return $validate;  
            //$this->fileName = uniqid() . '.jpg';
		$this->fileName = $nomeArquivo;

        if (!is_dir($this->path))
            mkdir($this->path, true);

        if (!move_uploaded_file(
            $this->file['tmp_name'],
            $this->path . $this->fileName
        ))
            return -3;

        return 1;
    }

    /**
     * Retorna o nome do arquivo
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->fileName;
    }

    /**
     * Verifica se o arquivo que estamos subindo é válido
     *
     * @return int
     */
    public function validate()
    {
        $fileType = mime_content_type($this->file['tmp_name']);

        if (!in_array($fileType, $this->mimeTypes))
            return -1; //Tipo Inválido

        if ($this->file['size'] > $this->maxSize)
            return -2; //Arquivo muito grandee

        return 1;
    }

    /**
     * Retorna uma mensagem a partir do seu código
     *
     * @param  int $code
     * @return string
     */
    public function getMessage(int $code = null)
    {
        switch ($code) {
            case 1:
                return 'Arquivo enviado com sucesso.';
                break;

            case -1:
                return 'O tipo de arquivo é inválido.';
                break;

            case -2:
                return 'O tamanho do arquivo é maior do que o permitido.';
                break;

            case -3:
                return 'Houve um erro ao tentar subir o arquivo.';
                break;
        }
    }
    public function setPath($caminho){
        $this->path =$caminho;
    }
}