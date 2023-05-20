<?

$txt = "Eu sou o sérgio e uso o codeignioter nas aulas de programação avançada em php";
echo $txt.'<br />';
/*
Método word_limiter(string, nmr, caracter a ser mostrado) ->é responsável por retornar
o texto passado como parâmetro com um número
limitado de palavras.*/
$txt_limitado = word_limiter($txt,8,'***');
echo $txt_limitado.'<br />';

/*
Limitar o numero de caracteres usamos o método
character_limiter() que tem os mesmo argumentos
que o word_limiter().*/
$txt_limitado_char = character_limiter($txt,15,'///');
echo $txt_limitado_char.'<br />';

/*
	Remoção de carateres especiais.
Quando é necessário montar uma URL, é necessário que a mesma não possua caracteres especiais(acentuação).
Usamos o método convert_accented_characters() que recebe apenas como argumento o texto a processar.
	*/
$txt_a = "Olá eu sou o Sérgio e tenho no pc  bolso";
$txt_acc = convert_accented_characters($txt_a);
echo $txt_acc.'<br />';	
/*
	Censurar palavras. Usamos o método word_censor() -> localiza conjuntos de palavras numa string e substitui por uma expressao. Tem 3 argumento
		1.A string com o texto a ser verificado
		2.O array com a lista de censuras
		3.Palavra usada na substituição, por omissão  ‘#’
*/
$txt_cen = "É muito básico usar o codeigniter";
$array_cen = array('fácil', 'Codeigniter');
$txt_w_cen = word_censor($txt_cen,$array_cen);
echo $txt_w_cen.'<br />';
?>