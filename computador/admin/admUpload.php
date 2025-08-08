<html>

<head>

</head>

<body>

  <form action="" method="post" enctype="multipart/form-data"></br></br>
    <input type="text" name="nome" placeholder="Nome do produto"></br></br>
	<input type="text" name="preco"  placeholder="preco do produto"></br></br>
	<input type="file" name="arquivo"></br></br>
	<input type="submit" name="enviar"></br></br>
	
  
  </form>
   <?php 
    include_once("conexao.php");
   
    if(isset($_POST['enviar'])){
		if(empty($_POST['nome'])){
			echo "coloque nome do arquivo</br>";
			exit;
		}
		if(empty($_POST['preco'])){
			echo "coloque nome o preco do produto</br>";
			exit;
		}
		if(! empty($_FILES['arquivo']['name'])){
			$nomeArquivo = $_FILES['arquivo']['name'];
			$tipo = $_FILES['arquivo']['type'];
			$nomeTemporario = $_FILES['arquivo']['tmp_name'];
			$tamanho = $_FILES['arquivo']['size'];
			
			$erros = array();
			
			$tamanhoMaximo = 1024 * 1024 * 10;
			
			if($tamanho > $tamanhoMaximo){
				$erros[] = "Arquivo muito grande</br>";
				exit;
			}
			$arquivosPermitidos = ["png","jpg","jpeg"];
			$extensao = pathinfo($nomeArquivo, PATHINFO_EXTENSION);
			if(!in_array($extensao, $arquivosPermitidos )){
				$erros[] = "Extensao nao permitida</br>";
			}
			$typesPermitidos = ["image/png","image/jpg","image/jpeg"];
			if(!in_array($tipo, $typesPermitidos )){
				$erros[] = "Tipo nao permitida</br>";
			}
			if(! empty($erros)){
				foreach($erros as $erro){
					echo $erro;
					exit;
				  }
				}else{
					echo "continua upload</br>";
					$caminho = "uploads/"; 
					if(move_uploaded_file($nomeTemporario, $caminho.$nomeArquivo)){
						echo "Upload feito com sucesso</br>";
						
						$nome = $_POST['nome'];
						$preco = $_POST['preco'];
						
						
						//iserir no banco de dados
						$sql = "INSERT INTO cadprodsb (nome, preco, extensao) VALUES (:nome, :preco, :extensao)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':nome',$nome);
                        $stmt->bindParam(':preco',$preco);
                        $stmt->bindParam(':extensao',$nomeArquivo);
                        $result = $stmt->execute();
   
   if(!$result)
   {
   var_dump($stmt->errorInfo());
   }else{
	  
   }

						
					}else{
						echo "Erro ao enviar</br>";
						exit;
					}
				}
			}
		}
	
   
   ?>
 
</body>

</html>