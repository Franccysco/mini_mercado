<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GerarCrachas
{
  private $modeloCracha;
  private $imagemParticipante;
  private $nomeCracha;
  private $equipe;
  private $circulo;
  private $crachaGerado;
  private $pathModeloCracha;
  private $pathImgParticipante;
  

  public function geraCracha()
  {
    //$this->redimensionaImagemPartcipante();
    $this->circle_imagem_participante();
    
    $this->redimensionaModeloCracha();
    $this->adicionaImagemParticipanteNoModelo();
    $this->adicionaInformacoes();
    
    $this->salvarCracha();
    // var_dump("qio2"); die;
    // var_dump("asdsd: ",$this->crachaGerado);
    return $this->crachaGerado;
  }

  public function redimensionaModeloCracha()
  {
    $this->modeloCracha = imagecreatefrompng($this->pathModeloCracha);
    $altura = 450;//453; //aproximadamente 10cm
    $largura = 300;//302; //aproximadamente 8cm
    $largura_original = imagesx($this->modeloCracha);
    $altura_original = imagesy($this->modeloCracha);
    /**
     * Aqui é feito o redimensiaonamento da imagem sem perder a sua resolução.
     */
    $nova_largura = $largura ? $largura : floor(($largura_original / $altura_original) * $altura);
    $nova_altura = $altura ? $altura : floor(($altura_original / $largura_original) * $largura);

    $imagem_redimensionada = imagecreatetruecolor($nova_largura, $nova_altura);
    imagecopyresampled($imagem_redimensionada, $this->modeloCracha, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_original, $altura_original);
    $this->modeloCracha = $imagem_redimensionada;
  }

 /* public function redimensionaImagemPartcipante()
  {
    $this->imagemParticipante = imagecreatefrompng($this->pathImgParticipante);
    
    $altura = 156; 
    $largura = 156; 
    $largura_original = imagesx($this->imagemParticipante);
    $altura_original = imagesy($this->imagemParticipante);
    /**
     * Aqui é feito o redimensiaonamento da imagem sem perder a sua resolução.
     /
    $nova_largura = $largura ? $largura : floor(($largura_original / $altura_original) * $altura);
    $nova_altura = $altura ? $altura : floor(($altura_original / $largura_original) * $largura);

    $imagem_redimensionada = imagecreatetruecolor($nova_largura, $nova_altura);
    imagealphablending($this->imagemParticipante, false);
    imagecopyresampled($imagem_redimensionada, $this->imagemParticipante, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_original, $altura_original);
    $this->imagemParticipante = $imagem_redimensionada;

     //Create masking
     $mask = imagecreatetruecolor($largura, $altura);

     $transparent = imagecolorallocate($mask, 255, 0, 255);
     imagecolortransparent($mask, $transparent);
 
 
     $red = imagecolorallocate($mask, 255, 0, 255);
 
     imagefill($this->imagemParticipante, 0, 0, $red);
     imagefill($this->imagemParticipante, $largura - 1, 0, $red);
     imagefill($this->imagemParticipante, 0, $largura - 1, $red);
     imagefill($this->imagemParticipante, $largura - 1, $altura - 1, $red);
     imagecolortransparent($this->imagemParticipante, $red);
    
     imageantialias($this->imagemParticipante, true);


    /* Defina a cor do canto preto como transparente
    imagecolortransparent($this->imagemParticipante, imagecolorallocate($this->imagemParticipante, 0, 0, 0));

    // Aplique o antialiasing à imagem this->imagemParticipante
    imageantialias($this->imagemParticipante, true);

    // Crie uma máscara para a imagem this->imagemParticipante
    $mascara = imagecreatetruecolor($largura, $altura);
    $fundo_vermelho = imagecolorallocate($mascara, 255, 0, 0);
    imagefill($mascara, 0, 0, $fundo_vermelho);

    // Copie a imagem this->imagemParticipante para a máscara
    imagecopyresampled($mascara, $this->imagemParticipante, 0, 0, 0, 0, $largura, $altura, imagesx($this->imagemParticipante), imagesy($this->imagemParticipante));/


  } */

  public function circle_imagem_participante()
  {
   
    $imagem_original = imagecreatefromstring(file_get_contents($this->pathImgParticipante));
    $width = imagesx($imagem_original);
    $heigth = imagesy($imagem_original);

    $newWidth = 158;//150; verificar os números floats
    $newHeigth = 158;//150;

    $this->imagemParticipante = imagecreatetruecolor($newWidth, $newHeigth);
    imagealphablending($this->imagemParticipante, false);
    imagecopyresampled($this->imagemParticipante, $imagem_original, 0, 0, 0, 0, $newWidth, $newHeigth, $width, $heigth);

    //Create masking
    $mask = imagecreatetruecolor($newWidth, $newHeigth);

    $transparent = imagecolorallocate($mask, 255, 0, 255);
    imagecolortransparent($mask, $transparent);

    imagefilledellipse($mask, $newWidth / 2, $newHeigth / 2, $newWidth, $newHeigth, $transparent);

    $red = imagecolorallocate($mask, 255, 0, 255);
    imagecopymerge($this->imagemParticipante, $mask, 0, 0, 0, 0, $newWidth, $newHeigth, 100);

    imagefill($this->imagemParticipante, 0, 0, $red);
    imagefill($this->imagemParticipante, $newWidth - 1, 0, $red);
    imagefill($this->imagemParticipante, 0, $newHeigth - 1, $red);
    imagefill($this->imagemParticipante, $newWidth - 1, $newHeigth - 1, $red);
    imagecolortransparent($this->imagemParticipante, $red);
    imageantialias($this->imagemParticipante, true);
  }


  public function adicionaImagemParticipanteNoModelo()
  {
    //LARGURAS PARA CALCULO DE POSICOES
    $nova_largura = imagesx($this->modeloCracha);
    $nova_altura = imagesy($this->modeloCracha);

    $width = imagesx($this->imagemParticipante);
    $heigth = imagesy($this->imagemParticipante);

    $la = ($nova_largura / 2) - ($width / 2);
    $alt = ($nova_altura / 2) - ($heigth / 2);

    imagecopymerge($this->modeloCracha, $this->imagemParticipante, (int)$la, (int)$alt-70, 0, 0, $width, $heigth, 100);
    
  }


  public function adicionaInformacoes()
  {

    //LARGURAS PARA CALCULO DE POSICOES
    $largura_imagem = imagesx($this->modeloCracha);
    $altura_imagem = imagesy($this->modeloCracha);

    
    $hex = $this->equipe == "ENCONTRISTAS" ? $this->retornaRGBPorEquipe($this->circulo) : $this->retornaRGBPorEquipe($this->equipe);
    // var_dump( $this->retornaRGBPorEquipe($this->circulo)); 
    sscanf($hex, "#%02x%02x%02x", $r, $g, $b);
    $cor = imagecolorallocate($this->modeloCracha, $r, $g, $b);
    $fonte = './assets/fonts/Ruda-Black.ttf';
    $tamanhoFonte = 16;

    // Obtém as dimensões do texto
    $caixaTexto = imagettfbbox($tamanhoFonte, 0, $fonte, strtoupper($this->nomeCracha));
    $larguraTexto = $caixaTexto[2] - $caixaTexto[0];
    $alturaTexto = $caixaTexto[1] - $caixaTexto[7];

    // Calcula a posição do texto no centro da imagem
    $x = ($largura_imagem - $larguraTexto) / 2;
    $y = ($altura_imagem - $alturaTexto) / 2;

    imagettftext($this->modeloCracha, $tamanhoFonte, 0, (int)$x, (int)$y + 48, $cor, $fonte, strtoupper($this->nomeCracha));
    
  }

  private function salvarCracha()
  {
    $path = "./assets/uploads/crachas/" . $this->equipe;
    $link_imagem = "assets/uploads/crachas/" . $this->equipe;
    if (!is_dir($path))
      mkdir($path, 0777, $recursive = true);

    $nome_salvar = $this->removeEspacoAcentos($this->nomeCracha);
    
    header('Content-type: image/png');
    ob_start();
    imagepng($this->modeloCracha);
    $contents = ob_get_clean();
    file_put_contents($path . "/" . $nome_salvar . ".png", $contents);
    imagedestroy($this->modeloCracha);
    imagedestroy($this->imagemParticipante);
    $link = base_url($link_imagem . "/" . $nome_salvar . ".png");
    $this->setNomeCracha($link);
    
  }

  public function salvarCracha2()
{
    try {
        $path = "./assets/uploads/crachas/" . $this->equipe;
        $link_imagem = "assets/uploads/crachas/" . $this->equipe;

        if (!is_dir($path)) {
            if (!mkdir($path, 0777, $recursive = true)) {
                throw new Exception('Falha ao criar diretório para crachás.');
            }
        }

        $nome_salvar = $this->removeEspacoAcentos($this->nomeCracha);
        var_dump($this->modeloCracha); die;
        // Certifique-se de que $this->modeloCracha é uma imagem válida antes de continuar.
        if (!is_resource($this->modeloCracha) || get_resource_type($this->modeloCracha) !== 'gd') {
            throw new Exception('O objeto $this->modeloCracha não é uma imagem válida.');
        }

        ob_start();
        if (!imagepng($this->modeloCracha)) {
            throw new Exception('Erro ao gerar a imagem PNG do crachá.');
        }
        $contents = ob_get_clean();

        if (!file_put_contents($path . "/" . $nome_salvar . ".png", $contents)) {
            throw new Exception('Erro ao salvar a imagem do crachá no arquivo.');
        }

        imagedestroy($this->modeloCracha);
        imagedestroy($this->imagemParticipante);

        $link = base_url($link_imagem . "/" . $nome_salvar . ".png");
        $this->setNomeCracha($link);
    } catch (Exception $e) {
        echo 'Erro durante a geração de crachá: ',  $e->getMessage(), "\n";
    }
}

  public function removeEspacoAcentos($string)
  {
    $nome_sem_espacos = str_replace(' ', '', $string);
    $nome_sem_acentos = preg_replace('/[áàãâä]/u', 'a', $nome_sem_espacos);
    $nome_sem_acentos = preg_replace('/[éèêë]/u', 'e', $nome_sem_acentos);
    $nome_sem_acentos = preg_replace('/[íìîï]/u', 'i', $nome_sem_acentos);
    $nome_sem_acentos = preg_replace('/[óòõôö]/u', 'o', $nome_sem_acentos);
    $nome_sem_acentos = preg_replace('/[úùûü]/u', 'u', $nome_sem_acentos);
    $nome_sem_acentos = preg_replace('/[ç]/u', 'c', $nome_sem_acentos);
    return $nome_sem_acentos;
  }

  public function retornaRGBPorEquipe($corEquipe)
  {
    $coresHex = array(
      "SECRETARIA" => "#FF3131",
      "COZINHA" => "#DDB100",
      "CAFEZINHO" => "#9BC280",
      "COMPRAS" => "#FF914D",
      "GARÇOM" => "#6000AB",
      "SALA" => "#8C52FF",//"#FFDE59", //"#FFFF00",
      "MINI-MERCADO" => "#45DDFF",
      "LITURGIA" => "#F10E82",
      "VIGILIA" => "#B40000",
      "EXTERNA" => "#0097B2",
      "CIRCULO" => "#008037",
      "ORDEM E LIMPEZA" => "#95E4A8",
      "COORDENAÇÃO GERAL" => "#FFFF00",
      "VERMELHO" => "#FF3131",
      "VERDE" => "#87CB28",
      "ROSA" => "#E61F93",
      "AZUL" => "#0000FF",
      "LARANJA" => "#FFA500",
      "AMARELO" => "#FFFF00"
    );
    return $coresHex[$corEquipe];
  }

  public function wsetPathModeloCracha($pathModeloCracha)
  {
    $this->pathModeloCracha = $pathModeloCracha;
  }

  public function setPathImgParticipante($pathImgParticipante)
  {
    $this->pathImgParticipante = $pathImgParticipante;
  }

  public function setCrachaGerado($crachaGerado)
  {
    $this->crachaGerado = $crachaGerado;
  }

  public function setNomeCracha($nomeCracha)
  {
    $this->nomeCracha = $nomeCracha;
  }

  public function setEquipe($equipe)
  {
    $this->equipe = $equipe;
  }

  public function setCirculo($circulo){
    $this->circulo = $circulo;
  }
}
