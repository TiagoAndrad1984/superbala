<?php
$userAgent = $_SERVER['HTTP_USER_AGENT'];

if (preg_match('/(android|iphone|ipad|mobile|blackberry|windows phone)/i', $userAgent)) {
  // Dispositivo móvel
  echo "Você está acessando pelo celular.";
  // Adicione aqui o código para dispositivos móveis
} else {
  // Computador
  echo "Você está acessando pelo computador.";
  // Adicione aqui o código para computadores
  header('Location: computador/superBalaPc.php');
}
?>