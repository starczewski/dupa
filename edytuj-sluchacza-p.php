<?php include_once('config.php');
	include_once('upload.php');
	  if(empty($_SESSION['name'])) : 
      header("Location: login.php");
      else :

if(isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){
	$row	=	$db->getAllRecords('sluchacze left join przydziel on przydziel.sluchacze_id = sluchacze.id','*',' AND przydziel.id="'.$_REQUEST['editId'].'"');
	$query = "select * from sluchacze_wojur;";
	$sluchacze_wojur = $db->getRecFrmQry($query);
	$query = "select * from firmy;";
	$firmy = $db->getRecFrmQry($query);
}

if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	if($imie==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=im&editId='.$_REQUEST['editId']);
		exit;
	}elseif($nazwisko==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=na&editId='.$_REQUEST['editId']);
		exit;
	}
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
	$update	=	$db->update('sluchacze',$data,array('id'=>$editId));
	
	$dat	=	array(
					'kosztszk'=>$kosztszk,
					'kosztegz'=>$kosztegz,
					'kosztwpis'=>$kosztwpis,
					'kosztnoc'=>$kosztnoc,
					'kosztwyz'=>$kosztwyz,
					'certyfikat'=>$certyfikat,
					);			
	$update	=	$db->update('przydziel',$dat,array('id'=>$editId));

		if($update){
		header('location: lista-sluchaczy.php?Id='.$row[0]['szkolenia_id']);
		exit;
	}else{
		header('location: lista-sluchaczy.php?Id='.$row[0]['szkolenia_id']);
		exit;
	}
}
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
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	
		 <div class="wrapper">
            <!-- Sidebar Holder -->
		<?php include 'menu.php';?>

            <!-- Page Content Holder -->
            <div id="content">
		<?php include 'header.php';?>

		<h1>Szkolenia</h1>
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
		}
		?>
		<div class="card">
			<div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Edytuj słuchacza</strong> 
			<a href='javascript:history.back(1);' class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-backward"></i> Wróć</a>
			</div>
			<div class="card-body">
				
				<div class="col-sm-6">
					<h5 class="card-title">Pola z <span class="text-danger">*</span> są wymagane!</h5>
					<form method="post" enctype="multipart/form-data">

						<div class="form-group">
							<label>Płeć <span class="text-danger">*</span></label>
						<br>
						<?php
						if($row[0]['plec'] == 'm')
{	
	echo '<input type="radio" name="plec" id="plec" value="k"> Kobieta<br>'; 
    echo '<input type="radio" name="plec" id="plec" value="m" checked="checked"> Mężczyzna';
    
}
else {
	echo '<input type="radio" name="plec" id="plec" value="k" checked="checked"> Kobieta<br>';
    echo '<input type="radio" name="plec" id="plec" value="m"> Mężczyzna';
    
}
?>
						</div>

						<div class="form-group">
							<label>Imię <span class="text-danger">*</span></label>
							<input type="text" name="imie" id="imie" class="form-control" value="<?php echo $row[0]['imie']; ?>" placeholder="Wpisz imię" required>
						</div>
						
						<div class="form-group">
							<label>Nazwisko <span class="text-danger">*</span></label>
							<input type="text" name="nazwisko" id="nazwisko" class="form-control" value="<?php echo $row[0]['nazwisko']; ?>" placeholder="Wpisz nazwisko" required>
						</div>
						
						<div class="form-group">
						<label>Województwo <span class="text-danger"></span></label>
							<select name="wojur" id="wojur" class="form-control">
								<option selected value>Wybierz województwo</option>
							<?php 
								foreach ($sluchacze_wojur as $sluchacze_w) {
									if ($sluchacze_w['id'] == $row[0]['wojur']) {
										echo "<option selected='selected' value='".$sluchacze_w['id']."'>".$sluchacze_w['woj']."</option>";
									} else {
										echo "<option value='".$sluchacze_w['id']."'>".$sluchacze_w['woj']."</option>";
									}
								}
							?>
							</select>
						</div>
						<div class="form-group">
							<label>Miejsce urodzenia <span class="text-danger"></span></label>
							<input type="text" name="miejsceur" id="miejsceur" class="form-control" value="<?php echo $row[0]['miejsceur']; ?>" placeholder="Wpisz miejsce urodzenia">
						</div>
						
						<div class="form-group">
							<label>Data urodzenia <span class="text-danger"></span></label>
							<input type="date" name="dataur" id="dataur" class="form-control" value="<?php echo $row[0]['dataur']; ?>" placeholder="Wpisz date urodzenia">
						</div>
						
						<div class="form-group">
							<label>PESEL <span class="text-danger"></span></label>
							<input type="text" name="pesel" id="pesel" class="form-control" value="<?php echo $row[0]['pesel']; ?>" placeholder="Wpisz PESEL">
						</div>

						<div class="form-group">
							<label>Adres zamieszkania <span class="text-danger"></span></label>
							<input type="text" name="adreszam" id="adreszam" class="form-control" value="<?php echo $row[0]['adreszam']; ?>" placeholder="Wpisz adres zamieszkania">
						</div>
						
						<div class="form-group">
						<label>Firma <span class="text-danger"></span></label>
							<select name="firma" id="firma" class="form-control">
								<option selected value>Wybierz firmę lub zaznacz tą opcję jeżeli to osoba prywatna</option>
							<?php 
								foreach ($firmy as $firm) {
									if ($firm['id'] == $row[0]['firma']) {
										echo "<option selected='selected' value='".$firm['id']."'>".$firm['nazwa']."</option>";
									} else {
										echo "<option value='".$firm['id']."'>".$firm['nazwa']."</option>";
									}
								}
							?>
							</select>
						</div>

						<div class="form-group">
							<label>Nr telefonu <span class="text-danger"></span></label>
							<input type="text" name="nrtelefonu" id="nrtelefonu" class="form-control" value="<?php echo $row[0]['nrtelefonu']; ?>" placeholder="Wpisz numer telefonu">
						</div>

						<div class="form-group">
							<label>E-mail <span class="text-danger"></span></label>
							<input type="email" name="email" id="email" class="form-control" value="<?php echo $row[0]['email']; ?>" placeholder="Wpisz e-mail">
						</div>

						<div class="form-group">

							<label>Koszt szkolenia [zł]<span class="text-danger"></span></label>

							<input type="number" name="kosztszk" id="kosztszk" class="form-control" value="<?php echo $row[0]['kosztszk']; ?>" placeholder="Wpisz koszt szkolenia"> 

						</div>	

						<div class="form-group">

							<label>Koszt egzaminu [zł]<span class="text-danger"></span></label>

							<input type="number" name="kosztegz" id="kosztegz" class="form-control" value="<?php echo $row[0]['kosztegz']; ?>" placeholder="Wpisz koszt egzaminu"> 

						</div>	

						<div class="form-group">

							<label>Koszt wpisowego [zł]<span class="text-danger"></span></label>

							<input type="number" name="kosztwpis" id="kosztwpis" class="form-control" value="<?php echo $row[0]['kosztwpis']; ?>" placeholder="Wpisz koszt wpisowego"> 

						</div>	
						
						<div class="form-group">

							<label>Koszt noclegu [zł]<span class="text-danger"></span></label>

							<input type="number" name="kosztnoc" id="kosztnoc" class="form-control" value="<?php echo $row[0]['kosztnoc']; ?>" placeholder="Wpisz koszt noclegu">

						</div>	

						<div class="form-group">

							<label>Koszt wyżywienia [zł]<span class="text-danger"></span></label>

							<input type="number" name="kosztwyz" id="kosztwyz" class="form-control" value="<?php echo $row[0]['kosztwyz']; ?>" placeholder="Wpisz koszt wyżywienia">

						</div>

						<div class="form-group">

							<label>Nr certyfikatu<span class="text-danger"></span></label>

							<input type="text" name="certyfikat" id="certyfikat" class="form-control" value="<?php echo $row[0]['certyfikat']; ?>" placeholder="Wpisz nr certyfikatu">

						</div>	


						<div class="form-group">
							<input type="hidden" name="editId" id="editId" value="<?php echo $_REQUEST['editId']?>">
							<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-edit"></i> Zaktualizuj</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
     <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
             });
         </script>
</body>
</html>
 <?php endif; ?>