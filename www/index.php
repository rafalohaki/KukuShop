<?php
	include ('config/main.php');
	include ('config/mysql.php');
	require_once('parts/header.php');
?>

<div class="row">
	<div class="col-md-8 col-md-push-4">
		<div class="panel panel-primary">
			<div class="panel-heading"><h3 class="panel-title"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>  Usługi możliwe do zakupienia</h3></div>
			<div class="panel-body">
			  <ul class="nav nav-pills">
				<?php
			  		include_once ('config/mysql.php');
			  		
					$sql = "SELECT * FROM servers";
					$result = $conn->query($sql);
			  		
					if ($result->num_rows > 0) {
						$num = 0;
						while($row = $result->fetch_assoc()) {
							if($num == 0){
								echo('<li class="active"><a data-toggle="pill" href="#'.$row['server_id'].'">'.$row['nazwa'].'</a></li>');	
								$num++;
							}else{
								echo('<li><a data-toggle="pill" href="#'.$row['server_id'].'">'.$row['nazwa'].'</a></li>');	
							}
						}
					 }else{
						 echo('Brak serwerów w bazie danych.');
					 }
			  		
				?>
			  </ul>
			  
			  <div class="tab-content" id="uslugi">	
				  <?php	
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						
						$num = 0;
						
						while($row = $result->fetch_assoc()) {
							echo('
							
								<div id="'.$row['server_id'].'" class="tab-pane fade in');
								
								if($num == 0){
									echo(' active');
									$num++;
								}
								
								echo('">
									<h2>'.$row['nazwa'].'</h2>
									
									<div class="row">
										<div class="col-md-6">
											<div class="thumbnail">
												<img src="http://fireland.pl/images/svip.jpg" alt="VIP na 30 dni" id="lista_img_uslug">
												<div class="caption">
													<h3>VIP na 30 dni</h3>
													<p>Ta ranga obowiązuje na wszystkich serwerach w sieci.</p>
													<p><span class="btn btn-info">Cena SMS: <b>11.07zł</b></span> <a id="kupuje" href="#" class="btn btn-success" role="button">Kup teraz!</a></p>
												</div>
											</div>
										</div>
										<div class="col-md-6">//TO-DO - dynamiczne usługi</div>
									</div>
								</div>

							
							');
						}
					}else{
						echo('Brak serwerów w bazie danych.');
					}
				    ?>
			  </div>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-md-pull-8">
		
		<!- SERWERY >
		
		<div class="panel panel-primary">
			<div class="panel-heading"><h3 class="panel-title"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>  Statystyki</h3></div>
			<div class="panel-body">
			  <?php
					include "utils/status.php";
					
					$result = $conn->query($sql);
					
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo $row['nazwa'];
							if(getStatus($row['ip'], $row['port_query']) == 1){
								echo(' <span class="label label-success" id="statusek"> Online</span><br>');
							}else{
								echo(' <span class="label label-danger" id="statusek"> Offline</span><br>');
							}
					    } 
					 }else{
						 echo('Brak serwerów w bazie danych.');
					 }
				//	SkyBlock<br>
				//	<span class="label label-danger">Offline</span>
				?>
			</div>
		</div>
		
		<!- OSTATNIE ZAKUPY >
		
		<div class="panel panel-primary">
			<div class="panel-heading"><h3 class="panel-title"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>  Ostatnie zakupy</h3></div>
			<div class="panel-body">
				<?php
					
			  		include_once ('config/mysql.php');
			  		
					$sql = "SELECT * FROM logi LIMIT 30";
					$result = $conn->query($sql);
			  		
					if ($result->num_rows > 0) {
						$num = 0;
						while($row = $result->fetch_assoc()) {
							echo('
								<a class="tooltips" href="#"><img src="https://minotar.net/avatar/'.$row['nick'].'/37.png"><span>Gracz: '.$row['nick'].'<br>Usługa: '.$row['usluga'].'<br>Serwer: '.$row['nazwa_serwera'].'<br>Data: N/A</span></a>
							');
						}
					 }else{
						 echo('Brak zakupionych usług.');
					 }
					
				?>
			</div>
		</div>
		
		
	</div>
</div>
<?php
	require_once('parts/footer.php');
?>