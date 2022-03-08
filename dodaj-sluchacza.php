<?php 
include_once('config.php');
	  if(empty($_SESSION['name'])) : 
      header("Location: login.php");
      else :

if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	if($imie==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=im');
		exit;
	}elseif($nazwisko==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=na');
		exit;	
	}else{
		$userCount	=	$db->getQueryCount('sluchacze','id');
		if($userCount[0]['total']<100000){
			$data	=	array(
							'plec'=>$plec,
							'imie'=>$imie,
							'nazwisko'=>$nazwisko,
							'wojur'=>$wojur,
							'miejsceur'=>$miejsceur,
							'dataur'=>$dataur,
							'pesel'=>$pesel,
							'adreszam'=>$adreszam,
							'firma'=>$firma,
							'nrtelefonu'=>$nrtelefonu,
							'email'=>$email,
						);
			
			$insert	=	$db->insert('sluchacze',$data);
			$last_id = $db->lastInsertId();
					
		$user	=	$db->getQueryCount('przydziel','id');
		if($user[0]['total']<100000){
			$dat	=	array(
							'szkolenia_id'=>$_GET['Id'],
							'sluchacze_id'=>$last_id,
							'kosztszk'=>$kosztszk,
							'kosztegz'=>$kosztegz,
							'kosztwpis'=>$kosztwpis,
							'kosztnoc'=>$kosztnoc,
							'kosztwyz'=>$kosztwyz,
						);			
			$insert	=	$db->insert('przydziel',$dat);
			if($insert){
				header('location:lista-sluchaczy.php?Id='.$_GET['Id']);
				exit;
			}else{
				header('location:lista-sluchaczy.php?msg=rna');
				exit;
			
			}
		}else{
			header('location:'.$_SERVER['PHP_SELF'].'?msg=dsd');
			exit;
		
	
}
}
}
}
	
	$query = "select * from sluchacze;";
	$sluchacz = $db->getRecFrmQry($query);

if(isset($_REQUEST['sub']) and $_REQUEST['sub']!=""){
	extract($_REQUEST);
		
		$userCount	=	$db->getQueryCount('przydziel','id');
		if($userCount[0]['total']<100000){
			$data	=	array(
							'szkolenia_id'=>$_GET['Id'],
							'sluchacze_id'=>$sluchacze_id,
							'kosztszk'=>$kosztszk,
							'kosztegz'=>$kosztegz,
							'kosztwpis'=>$kosztwpis,
							'kosztnoc'=>$kosztnoc,
							'kosztwyz'=>$kosztwyz,
						);
			$insert	=	$db->insert('przydziel',$data);
			if($insert){
				header('location:lista-sluchaczy.php?Id='.$_GET['Id']);
				exit;
			}else{
				header('location:lista-sluchaczy.php?msg=rna');
				exit;
			}
		}else{
			header('location:'.$_SERVER['PHP_SELF'].'?msg=dsd');
			exit;
		}
	
}
if(isset($_REQUEST['submition']) and $_REQUEST['submition']!=""){
	extract($_REQUEST);
	if($imie==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=im');
		exit;
	}elseif($nazwisko==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=na');
		exit;	
	}else{
		$userCount	=	$db->getQueryCount('sluchacze','id');
		if($userCount[0]['total']<100000){
			$data	=	array(
							'plec'=>$plec,
							'imie'=>$imie,
							'nazwisko'=>$nazwisko,
							'wojur'=>$wojur,
							'miejsceur'=>$miejsceur,
							'dataur'=>$dataur,
							'pesel'=>$pesel,
							'adreszam'=>$adreszam,
							'firma'=>$firma,
							'nrtelefonu'=>$nrtelefonu,
							'email'=>$email,
						);
			
			$insert	=	$db->insert('sluchacze',$data);
			$last_id = $db->lastInsertId();
					
		$user	=	$db->getQueryCount('przydziel','id');
		if($user[0]['total']<100000){
			$dat	=	array(
							'szkolenia_id'=>$_GET['Id'],
							'sluchacze_id'=>$last_id,
							'kosztszk'=>$kosztszk,
							'kosztegz'=>$kosztegz,
							'kosztwpis'=>$kosztwpis,
							'kosztnoc'=>$kosztnoc,
							'kosztwyz'=>$kosztwyz,
						);		
			$insert	=	$db->insert('przydziel',$dat);	
						
			$users	=	$db->getQueryCount('firmy','id');
		if($users[0]['total']<100000){
			$da	=	array(
							'nazwa'=>$nazwa,
							'opis'=>$opis,
							'nip'=>$nip,
							'kod_pocztowy'=>$kod_pocztowy,
							'miasto'=>$miasto,
							'ulica'=>$ulica,
							'nr_telefonu'=>$nr_telefonu,
							'email'=>$email,
							'www'=>$www,
						);			
					
			$insert	=	$db->insert('firmy',$da);
			if($insert){
				header('location:lista-sluchaczy.php?Id='.$_GET['Id']);
				exit;
			}else{
				header('location:lista-sluchaczy.php?msg=rna');
				exit;
			
			}
		}else{
			header('location:'.$_SERVER['PHP_SELF'].'?msg=dsd');
			exit;
		
	
}
}
}
}
?>

<?php
	$user = $db->getAllRecords('szkolenia left join rodzaj_szkolen on szkolenia.nazwa = rodzaj_szkolen.id','*','AND szkolenia.id = '.$_GET['Id'],'');
	$query = "select * from sluchacze_wojur;";
	$sluchacze_wojur = $db->getRecFrmQry($query);
	?>
	<?php
	
	$query = "select * from firmy;";
	$firm = $db->getRecFrmQry($query);
	?>

<!doctype html>

<html lang="pl-PL">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>BSB - Szkolenia</title>
	
	<link rel="shortcut icon" href="images/fav.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="css/style.css">
	<style>
			/** Start: to style navigation tab **/
			.nav {
			  margin-bottom: 18px;
			  margin-left: 0;
			  list-style: none;
			}

			.nav > li > a {
			  display: block;
			}
			
			.nav-tabs{
			  *zoom: 1;
			}

			.nav-tabs:before,
			.nav-tabs:after {
			  display: table;
			  content: "";
			}

			.nav-tabs:after {
			  clear: both;
			}

			.nav-tabs > li {
			  float: left;
			}

			.nav-tabs > li > a {
			  padding-right: 12px;
			  padding-left: 12px;
			  margin-right: 2px;
			  line-height: 14px;
			}

			.nav-tabs {
			  border-bottom: 1px solid #ddd;
			}

			.nav-tabs > li {
			  margin-bottom: -1px;
			}

			.nav-tabs > li > a {
			  padding-top: 8px;
			  padding-bottom: 8px;
			  line-height: 18px;
			  border: 1px solid transparent;
			  -webkit-border-radius: 4px 4px 0 0;
				 -moz-border-radius: 4px 4px 0 0;
					  border-radius: 4px 4px 0 0;
			}

			.nav-tabs > li > a:hover {
			  border-color: #eeeeee #eeeeee #dddddd;
			}

			.nav-tabs > .active > a,
			.nav-tabs > .active > a:hover {
			  color: #555555;
			  cursor: default;
			  background-color: #ffffff;
			  border: 1px solid #ddd;
			  border-bottom-color: transparent;
			}
			
			li {
			  line-height: 18px;
			}
			
			.tab-content.active{
				display: block;
			}
			
			.tab-content.hide{
				display: none;
			}
			
			
			/** End: to style navigation tab **/
		</style>

<style> 
            #leftbox {
                float:left; 
                width:45%;
                
            }
			#middlebox {
                float:left; 
                width:10%;
                
            }
            #rightbox{
                float:right;
                width:45%;
                
            }
        </style> 
			<script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.js"></script>
</head>
<body>

		 <div class="wrapper">
            <!-- Sidebar Holder -->
		<?php include 'menu.php';?>

            <!-- Page Content Holder -->
            <div id="content">
		<?php include 'header.php';?>

		<h2>Szkolenia - <strong><?php echo $user[0]['nrszkolenia'];?> - <?php echo $user[0]['nazwa'];?></strong> </h2>

		<?php

	if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="da"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Data is mandatory field!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ti"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Time is mandatory field!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ty"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Type is mandatory field!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="de"){
			
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Description is mandatory field!</div>';
			
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="se"){
			
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Serviceman is mandatory field!</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ras"){

			echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record added successfully!</div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Record not added <strong>Please try again!</strong></div>';

		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="dsd"){

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Please delete a user and then try again <strong>We set limit for security reasons!</strong></div>';

		}

		?>


	
	
		<div class="card">

						<div class="card-header"> <label>Dodaj słuchacza do szkolenia <span class="text-danger"></span></label>
							<a href='javascript:history.back(1);' class="float-right btn-secondary btn-sm"><i class="fa fa-fw fa-backward"></i> Wróć</a>
						</div>

			<div class="card-body">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab1">Dodaj słuchacza z bazy</a>
				</li>
				<li>
					<a href="#tab2">Dodaj nowego słuchacza</a>
				</li>
				<li>
					<a href="#tab3">Dodaj nowego słuchacza i firmę</a>
				</li>
			</ul>	
				
					
						
						<section id="tab1" class="tab-content active">
						<form method="post" enctype="multipart/form-data">
						<div class="col-sm-4">
							<div class="input-group">
								<label>Słuchacz<span class="text-danger"></span></label>
								<select name="sluchacze_id" id="sluchacze_id" class="form-control" required>
									<option selected value></option>
								<?php 
									foreach ($sluchacz as $sluchacze) {
										echo "<option value='".$sluchacze['id']."'>".$sluchacze['imie']." ".$sluchacze['nazwisko']." - ".$sluchacze['pesel']."</option>";
									}
								?>
								</select>
						</div>
									<br>		
						<div class="form-group">

							<label>Koszt szkolenia [zł]<span class="text-danger"></span></label>

							<input type="number" name="kosztszk" id="kosztszk" value="0" class="form-control" placeholder="Wpisz koszt szkolenia"> 

						</div>	
						
						<div class="form-group">

							<label>Koszt egzaminu [zł]<span class="text-danger"></span></label>

							<input type="number" name="kosztegz" id="kosztegz" value="0" class="form-control" placeholder="Wpisz koszt egzaminu"> 

						</div>	
						
						<div class="form-group">

							<label>Koszt wpisowego [zł]<span class="text-danger"></span></label>

							<input type="number" name="kosztwpis" id="kosztwpis" value="0" class="form-control" placeholder="Wpisz koszt wpisowego"> 

						</div>	
						
						<div class="form-group">

							<label>Koszt noclegu [zł]<span class="text-danger"></span></label>

							<input type="number" name="kosztnoc" id="kosztnoc" value="0" class="form-control" placeholder="Wpisz koszt noclegu">

						</div>	
						
						<div class="form-group">

							<label>Koszt wyżywienia [zł]<span class="text-danger"></span></label>

							<input type="number" name="kosztwyz" id="kosztwyz" value="0" class="form-control" placeholder="Wpisz koszt wyżywienia">

						</div>	
					
										<div class="form-group">
											<span class="input-group-btn">
												<button type="submit" name="sub" value="sub" id="sub" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Dodaj</button>
											</span>
										</div>
						</form>
						</section>
								
						
				

				
			<section id="tab2" class="tab-content hide">
				<div class="col-sm-4">
				<div class="card-body">
					
					<form method="post" enctype="multipart/form-data">

					
					<div class="form-group">

							<label>Firma <span class="text-danger"></span></label>
		
							<select name="firma" id="firma" class="form-control" style="width: 100%;">
								<option value >Wybierz firmę</option>
							<?php 
								foreach ($firm as $firmy) {
									echo "<option value='".$firmy['id']."'>".$firmy['nazwa']."</option>";
								}
							?>
							</select>
							<div style="float:right;text-align:right;"><a href="dodaj-firme.php">Dodaj nową firmę</a></div>
						</div>			

						<div class="form-group">

							<label>Płeć <span class="text-danger">*</span></label>
<br>
							<input type="radio" name="plec" id="plec"  value="k" placeholder="Wpisz nazwisko" required> Kobieta
							<br>
							<input type="radio" name="plec" id="plec"  value="m" placeholder="Wpisz nazwisko" required> Mężczyzna
						</div>

						<div class="form-group">

							<label>Imię <span class="text-danger">*</span></label>

							<input type="text" name="imie" id="imie" class="form-control" placeholder="Wpisz imię" required>

						</div>

						<div class="form-group">

							<label>Nazwisko <span class="text-danger">*</span></label>

							<input type="text" name="nazwisko" id="nazwisko" class="form-control" placeholder="Wpisz nazwisko" required> 

						</div>
						
						<div class="form-group">

							<label>Województwo <span class="text-danger"></span></label>
		
							<select name="wojur" id="wojur" class="form-control">
								<option selected value>Wybierz województwo</option>
							<?php 
								foreach ($sluchacze_wojur as $sluchacze_w) {
									echo "<option value='".$sluchacze_w['id']."'>".$sluchacze_w['woj']."</option>";
								}
							?>
							</select>

						</div>

						<div class="form-group">

							<label>Miejsce urodzenia <span class="text-danger"></span></label>

							<input type="text" name="miejsceur" id="miejsceur" class="form-control" placeholder="Wpisz miejsce urodzenia">

						</div>
						
						<div class="form-group">

							<label>Data urodzenia <span class="text-danger"></span></label>

							<input type="date" name="dataur" id="dataur" class="form-control" placeholder="Wpisz date urodzenia">

						</div>
						
						<div class="form-group">

							<label>PESEL <span class="text-danger"></span></label>

							<input type="text" name="pesel" id="pesel" class="form-control" placeholder="Wpisz PESEL">

						</div>

						<div class="form-group">

							<label>Adres zamieszkania <span class="text-danger"></span></label>

							<input type="text" name="adreszam" id="adreszam" class="form-control" placeholder="Wpisz adres zamieszkania">

						</div>

						
						<div class="form-group">

							<label>Nr telefonu <span class="text-danger"></span></label>

							<input type="text" name="nrtelefonu" id="nrtelefonu" class="form-control" placeholder="Wpisz numer telefonu">

						</div>		

						<div class="form-group">

							<label>E-mail <span class="text-danger"></span></label>

							<input type="email" name="email" id="email" class="form-control" placeholder="Wpisz email">

						</div>	

						<div class="form-group">

							<label>Koszt szkolenia [zł]<span class="text-danger"></span></label>

							<input type="number" name="kosztszk" id="kosztszk" value="0" class="form-control" placeholder="Wpisz koszt szkolenia"> 

						</div>	

						<div class="form-group">

							<label>Koszt egzaminu [zł]<span class="text-danger"></span></label>

							<input type="number" name="kosztegz" id="kosztegz" value="0" class="form-control" placeholder="Wpisz koszt egzaminu"> 

						</div>	

						<div class="form-group">

							<label>Koszt wpisowego [zł]<span class="text-danger"></span></label>

							<input type="number" name="kosztwpis" id="kosztwpis" value="0" class="form-control" placeholder="Wpisz koszt wpisowego"> 

						</div>	
						
						<div class="form-group">

							<label>Koszt noclegu [zł]<span class="text-danger"></span></label>

							<input type="number" name="kosztnoc" id="kosztnoc" value="0" class="form-control" placeholder="Wpisz koszt noclegu">

						</div>	

						<div class="form-group">

							<label>Koszt wyżywienia [zł]<span class="text-danger"></span></label>

							<input type="number" name="kosztwyz" id="kosztwyz" value="0" class="form-control" placeholder="Wpisz koszt wyżywienia">

						</div>	

						<div class="form-group">

							<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Dodaj</button>

						</div>

					</form>
					</section>


                 <section id="tab3" class="tab-content hide">
				<div class="col-sm-6">
				<div class="card-body">
					
					<form method="post" enctype="multipart/form-data">		
					<div id = "leftbox">
						<div class="form-group">

							<label>Płeć <span class="text-danger">*</span></label>
<br>
							<input type="radio" name="plec" id="plec"  value="k" placeholder="Wpisz nazwisko" required> Kobieta
							<br>
							<input type="radio" name="plec" id="plec"  value="m" placeholder="Wpisz nazwisko" required> Mężczyzna
						</div>

						<div class="form-group">

							<label>Imię <span class="text-danger">*</span></label>

							<input type="text" name="imie" id="imie" class="form-control" placeholder="Wpisz imię" required>

						</div>

						<div class="form-group">

							<label>Nazwisko <span class="text-danger">*</span></label>

							<input type="text" name="nazwisko" id="nazwisko" class="form-control" placeholder="Wpisz nazwisko" required> 

						</div>
						
						<div class="form-group">

							<label>Województwo <span class="text-danger"></span></label>
		
							<select name="wojur" id="wojur" class="form-control">
								<option selected value>Wybierz województwo</option>
							<?php 
								foreach ($sluchacze_wojur as $sluchacze_w) {
									echo "<option value='".$sluchacze_w['id']."'>".$sluchacze_w['woj']."</option>";
								}
							?>
							</select>

						</div>

						<div class="form-group">

							<label>Miejsce urodzenia <span class="text-danger"></span></label>

							<input type="text" name="miejsceur" id="miejsceur" class="form-control" placeholder="Wpisz miejsce urodzenia">

						</div>
						
						<div class="form-group">

							<label>Data urodzenia <span class="text-danger"></span></label>

							<input type="date" name="dataur" id="dataur" class="form-control" placeholder="Wpisz date urodzenia">

						</div>
						
						<div class="form-group">

							<label>PESEL <span class="text-danger"></span></label>

							<input type="text" name="pesel" id="pesel" class="form-control" placeholder="Wpisz PESEL">

						</div>

						<div class="form-group">

							<label>Adres zamieszkania <span class="text-danger"></span></label>

							<input type="text" name="adreszam" id="adreszam" class="form-control" placeholder="Wpisz adres zamieszkania">

						</div>

						
						<div class="form-group">

							<label>Nr telefonu <span class="text-danger"></span></label>

							<input type="text" name="nrtelefonu" id="nrtelefonu" class="form-control" placeholder="Wpisz numer telefonu">

						</div>		

						<div class="form-group">

							<label>E-mail <span class="text-danger"></span></label>

							<input type="email" name="email" id="email" class="form-control" placeholder="Wpisz email">

						</div>	

						<div class="form-group">

							<label>Koszt szkolenia [zł]<span class="text-danger"></span></label>

							<input type="number" name="kosztszk" id="kosztszk" value="0" class="form-control" placeholder="Wpisz koszt szkolenia"> 

						</div>	

						<div class="form-group">

							<label>Koszt egzaminu [zł]<span class="text-danger"></span></label>

							<input type="number" name="kosztegz" id="kosztegz" value="0" class="form-control" placeholder="Wpisz koszt egzaminu"> 

						</div>	

						<div class="form-group">

							<label>Koszt wpisowego [zł]<span class="text-danger"></span></label>

							<input type="number" name="kosztwpis" id="kosztwpis" value="0" class="form-control" placeholder="Wpisz koszt wpisowego"> 

						</div>	
						
						<div class="form-group">

							<label>Koszt noclegu [zł]<span class="text-danger"></span></label>

							<input type="number" name="kosztnoc" id="kosztnoc" value="0" class="form-control" placeholder="Wpisz koszt noclegu">

						</div>	

						<div class="form-group">

							<label>Koszt wyżywienia [zł]<span class="text-danger"></span></label>

							<input type="number" name="kosztwyz" id="kosztwyz" value="0" class="form-control" placeholder="Wpisz koszt wyżywienia">

						</div>	
							</div>
							<div id = "middlebox"></div>
							<div id = "rightbox">
						<div class="form-group">

							<label>Nazwa firmy <span class="text-danger">*</span></label>

							<input type="text" name="nazwa" id="nazwa" class="form-control" placeholder="Wpisz nazwę firmy" required>

						</div>
						
						<div class="form-group">

							<label>NIP firmy <span class="text-danger"></span></label>

							<input type="text" pattern=".{10}|.{13}" name="nip" id="username" class="form-control" placeholder="Wpisz NIP">
							<div id="usernameLoading"></div>
							<div id="usernameResult"></div>
						</div>
						
						<div class="form-group">

							<label>Opis <span class="text-danger"></span></label>

							<input type="text" name="opis" id="opis" class="form-control" placeholder="Wpisz opis">

						</div>
						
						<div class="form-group">

							<label>Kod pocztowy<span class="text-danger">*</span></label>

							<input type="text" name="kod_pocztowy" id="kod_pocztowy" class="form-control" placeholder="Wpisz kod pocztowy" required>

						</div>

						<div class="form-group">

							<label>Miasto<span class="text-danger">*</span></label>

							<input type="text" name="miasto" id="miasto" class="form-control" placeholder="Wpisz miasto">

						</div>

						<div class="form-group">

							<label>Ulica <span class="text-danger">*</span></label>

							<input type="text" name="ulica" id="ulica" class="form-control" placeholder="Wpisz adres" required>

						</div>
						
						<div class="form-group">

							<label>E-mail <span class="text-danger"></span></label>

							<input type="email" name="email" id="email" class="form-control" placeholder="Wpisz e-mail">

						</div>	
						
						<div class="form-group">

							<label>Nr telefonu <span class="text-danger"></span></label>

							<input type="text" name="nr_telefonu" id="nr_telefonu" class="form-control" placeholder="Wpisz numer telefonu">

						</div>
						
						<div class="form-group">

							<label>Strona www <span class="text-danger"></span></label>

							<input type="text" name="www" id="www" class="form-control" placeholder="Wpisz adres www" >

						</div> 
							<div class="form-group">

							<button type="submit" name="submition" value="submition" id="submition" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Dodaj</button>

						</div>
					</div>



					</form>
					</section>
</div>
</div>				
				</div>

				</div>
</div>
	
			</div>
			
			
		</div>

	</div>

							

							<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js"></script>
	<script>
			$(document).ready(function() {
				$('.nav-tabs > li > a').click(function(event){
					event.preventDefault();//stop browser to take action for clicked anchor
					
					//get displaying tab content jQuery selector
					var active_tab_selector = $('.nav-tabs > li.active > a').attr('href');					
					
					//find actived navigation and remove 'active' css
					var actived_nav = $('.nav-tabs > li.active');
					actived_nav.removeClass('active');
					
					//add 'active' css into clicked navigation
					$(this).parents('li').addClass('active');
					
					//hide displaying tab content
					$(active_tab_selector).removeClass('active');
					$(active_tab_selector).addClass('hide');
					
					//show target tab content
					var target_tab_selector = $(this).attr('href');
					$(target_tab_selector).removeClass('hide');
					$(target_tab_selector).addClass('active');
				});
			});
	</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/jquery.caret/0.1/jquery.caret.js"></script>
	<script src="https://www.solodev.com/_/assets/phone/jquery.mobilePhoneNumber.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
	<script>
		$(document).ready(function() {
		jQuery(function($){
			  var input = $('[type=tel]')
			  input.mobilePhoneNumber({allowPhoneWithoutPrefix: '+1'});
			  input.bind('country.mobilePhoneNumber', function(e, country) {
				$('.country').text(country || '')
			  })
			 });
		});
	</script>
 <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
             });
         </script>
    <script>
  $('.expandContent').click(function(){
        $('.showMe').slideToggle('slow');
    });
</script>

    	<script>$(document).ready(function() {
    $('#firma').select2({
		placeholder: 'Wybierz firmę',
		allowClear: true
	});
	$('#firma').val('<?php echo $row[0]['firma']?>');
	$('#firma').trigger('change');

	$('#sluchacze_id').select2({
		placeholder: 'Wyszukaj słuchacza',
		allowClear: true
	});
	$('#sluchacze_id').val('<?php echo $row[0]['imie']?> <?php echo $row[0]['nazwisko']?>');
	$('#sluchacze_id').trigger('change');
});</script>

</body>

</html>
 <?php endif; ?>