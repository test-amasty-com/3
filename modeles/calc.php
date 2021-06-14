<?
if(empty($_POST)){
	header ('Location:../');
}
$str 			= '<div class="ans_text">{ANSWER}</div>';
if(empty($_POST['nom'])){
	echo str_replace('{ANSWER}','Не заполнили поле <strong>Номинал</strong>',$str);
	die();
}
if(empty($_POST['sum'])){
	echo str_replace('{ANSWER}','Не заполнили поле <strong>СУММА</strong>',$str);
	die();
}
if($_POST['sum']<0){
	echo str_replace('{ANSWER}','Сумма может быть только положительной',$str);
	die();
}
if(substr_count($_POST['sum'],'.')>0 || substr_count($_POST['sum'],',')>0){
	echo str_replace('{ANSWER}','Сумма может быть только целой, без дробной части',$str);
	die();
}
$_POST['nom'] 	= str_replace('.',',',$_POST['nom']);
$_POST['nom'] 	= str_replace(' ','',$_POST['nom']);
$table 			= '<table class="ans_text">{ANSWER}</table>'; 
$nom 			= explode(',', $_POST['nom']);//делаем массив номиналов
$summ			= intval($_POST['sum']);//нужная сумма
$end 			= false;//чтобы проверить получилось или нет, также выход из цикла
$kup 			= array();//массив купюр
$min_kup 		= min($nom);//минимальная купюра
$summ_tmp 		= $summ;//временная сумма для цикла
$i				= 0;
rsort($nom);
while (!$end){
	$p = $summ_tmp % $nom[$i];//остаток от деления
	$count_kup = ($summ_tmp - $p) / $nom[$i];
	$kup[$i] = $count_kup;
	$summ_tmp = $p;
	$i++;
	if($p==0) $end = true;
	if($p < $min_kup && $p != 0) break;
}
if($end){
	asort($nom);
	$answer='<thead><tr><td>Номинал</td><td>Количество</td></thead>';
	foreach ($nom as $key => $mykup){
		$answer.='<tr><td>'.$mykup.'</td><td>'.(isset($kup[$key]) ? $kup[$key] : '0').'</td.</tr>';
	}
	print(str_replace('{ANSWER}',$answer,$table));
	
}else{
	$summ1 = $summ - $p;
	$summ2 = $summ1 + $min_kup;
	$answer = '<div style="padding:5px">Неверная сумма. Выберите '.$summ1.' или '. $summ2.'.</div>';
	print(str_replace('{ANSWER}',$answer,$str));
}
?>