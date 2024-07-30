<?php
	require_once 'header.php';
?>
	<style>

	.image {
	    position:relative;
	}

	.text {
	    left: 0;
	    position:absolute;
	    text-align:center;
	    top: 200px;
	    width: 100%;
	    font-size:50px;
	    color:white;
	    background-color:#38cce2;
	    text-shadow: 2px 2px 5px blue;
	}
	</style>
	<div class="row">
		<div class="col-md-12">
		<img src="assets/images/welcome.jpg" class="image" width="100%" height="100%" style="border-radius: 4px;">
			<p class="text">Myanmar Public Administration Network</p>
		</div>
	</div>
<?php
	echo "<div class='row'>";
	if(isset($_SESSION["user"])) {
		$user = $_SESSION["user"];
		$email = "mymail@gmail.com";
		$status = "I am a developer";
		$imgPath = 'assets/images/'.$user.'.jpg';
		if (!file_exists($imgPath)) {
		    $imgPath = 'assets/images/defaultProfile.png';
		}
		echo <<<_END
			<div class="col-md-3">
				<div class="panel panel-info width-300px height-300px">
					<div class="panel-heading"><b>Profile</b></div>
					<div class="panel-body">
						<img src="$imgPath" alt="default profile" class="img-profile"/>
						<p><span class="glyphicon glyphicon-user"/>&nbsp $user</p>
						<p><span class="glyphicon glyphicon-envelope"/>&nbsp $email</p>
						<p><span class="glyphicon glyphicon-info-sign"/>&nbsp $status</p>
					</div>
				</div>
			</div>
		<div class="col-md-9">
			<div class="panel panel-dark width-300px">
				<div class="panel-heading bg-black"><b>Indicators</b></div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-4 col-sm-4">
							<a href="ForeginDirectInvestMM.php">
							<img src="assets/images/ForeginDirectInvest.png" alt="ForeginDirectInvest" class="img-indicator"/>
							Foreign direct investment, net inflows (BoP, current US$)
							</a>
							<br><br>
						</div>
						<div class="col-md-4 col-sm-4">
							<a href="AccessToElectricityMM.php">
							<img src="assets/images/AccessToElectricity.png" alt="AccessToElectricity" class="img-indicator"/>
							Access To Electricity (% of population)
							</a>
							<br><br>
						</div>
						<div class="col-md-4 col-sm-4">
							<a href="ImportsGoodsServicesMM.php">
							<img src="assets/images/ImportsGoodsServices.png" alt="ImportsGoodsServices" class="img-indicator"/>
							Imports of goods and services (% of GDP)
							</a>
							<br><br>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-4 col-sm-4">
							<a href="CO2EmiMM.php">
							<img src="assets/images/CO2Emi.png" alt="CO2Emi" class="img-indicator"/>
							CO2 emissions (kt)
							</a>
							<br><br>
						</div>
						<div class="col-md-4 col-sm-4">
							<a href="FuelExportsMM.php">
							<img src="assets/images/FuelExports.png" alt="FuelExports" class="img-indicator"/>
							Fuel exports (% of merchandise exports)
							</a>
							<br><br>
						</div>
						<div class="col-md-4 col-sm-4">
							<a href="OresAndMetalsExportsMM.php">
							<img src="assets/images/OresAndMetalsExports.png" alt="OresAndMetalsExports" class="img-indicator"/>
							Ores and metals exports (% of merchandise exports)
							</a>
							<br><br>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-4 col-sm-4">
							<a href="IndustryMM.php">
							<img src="assets/images/Industry.png" alt="Industry" class="img-indicator"/>
							Industry (including construction), value added (% of GDP)
							</a>
							<br><br>
						</div>
						<div class="col-md-4 col-sm-4">
							<a href="TotalNRRMM.php">
							<img src="assets/images/TotalNRR.png" alt="TotalNRR" class="img-indicator"/>
							Total natural resources rents (% of GDP)
							</a>
							<br><br>
						</div>
						<div class="col-md-4 col-sm-4">
							<a href="PopulatoinGrowthMM.php">
							<img src="assets/images/PopulatoinGrowth.png" alt="PopulatoinGrowth" class="img-indicator"/>
							Population Growth (annual %)
							</a>
							<br><br>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-4 col-sm-4">
							<a href="ExternalDebtStockMM.php">
							<img src="assets/images/ExternalDebtStock.png" alt="ExternalDebtStock" class="img-indicator"/>
							External debt stocks, total (DOD, current US$)
							</a>
							<br><br>
						</div>
						<div class="col-md-4 col-sm-4">
							<a href="GDPCurrentUsMM.php">
							<img src="assets/images/GDPCurrentUs.png" alt="GDPCurrentUs" class="img-indicator"/>
							GDP (current US$)
							</a>
							<br><br>
						</div>
						<div class="col-md-4 col-sm-4">
							<a href="UnemployeementToMM.php">
							<img src="assets/images/UnemployeementTo.png" alt="UnemployeementTo" class="img-indicator"/>
							Unemployment, total (% of total labor force) (modeled ILO estimate)
							</a>
							<br><br>
						</div>
					</div>
				</div>
			</div>
		</div>
_END;
	}
	else {
	echo <<<_END
		<div class="col-md-12 col-sm-12">
_END;
	echo <<<_END
		
			<div class="panel panel-dark width-300px">
				<div class="panel-heading bg-black"><b>Indicators</b></div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-3 col-sm-3">
							<a href="ForeginDirectInvestMM.php">
							<img src="assets/images/ForeginDirectInvest.png" alt="ForeginDirectInvest" class="img-indicator"/>
							Foreign direct investment, net inflows (BoP, current US$)
							</a>
							<br><br>
						</div>
						<div class="col-md-3 col-sm-3">
							<a href="AccessToElectricityMM.php">
							<img src="assets/images/AccessToElectricity.png" alt="AccessToElectricity" class="img-indicator"/>
							Access To Electricity (% of population)
							</a>
							<br><br>
						</div>
						<div class="col-md-3 col-sm-3">
							<a href="ImportsGoodsServicesMM.php">
							<img src="assets/images/ImportsGoodsServices.png" alt="ImportsGoodsServices" class="img-indicator"/>
							Imports of goods and services (% of GDP)
							</a>
							<br><br>
						</div>
						<div class="col-md-3 col-sm-3">
							<a href="CO2EmiMM.php">
							<img src="assets/images/CO2Emi.png" alt="CO2Emi" class="img-indicator"/>
							CO2 emissions (kt)
							</a>
							<br><br>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-3 col-sm-3">
							<a href="FuelExportsMM.php">
							<img src="assets/images/FuelExports.png" alt="FuelExports" class="img-indicator"/>
							Fuel exports (% of merchandise exports)
							</a>
							<br><br>
						</div>
						<div class="col-md-3 col-sm-3">
							<a href="OresAndMetalsExportsMM.php">
							<img src="assets/images/OresAndMetalsExports.png" alt="OresAndMetalsExports" class="img-indicator"/>
							Ores and metals exports (% of merchandise exports)
							</a>
							<br><br>
						</div>
						<div class="col-md-3 col-sm-3">
							<a href="IndustryMM.php">
							<img src="assets/images/Industry.png" alt="Industry" class="img-indicator"/>
							Industry (including construction), value added (% of GDP)
							</a>
							<br><br>
						</div>
						<div class="col-md-3 col-sm-3">
							<a href="TotalNRRMM.php">
							<img src="assets/images/TotalNRR.png" alt="TotalNRR" class="img-indicator"/>
							Total natural resources rents (% of GDP)
							</a>
							<br><br>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-3 col-sm-3">
							<a href="PopulatoinGrowthMM.php">
							<img src="assets/images/PopulatoinGrowth.png" alt="PopulatoinGrowth" class="img-indicator"/>
							Population Growth (annual %)
							</a>
							<br><br>
						</div>
						<div class="col-md-3 col-sm-3">
							<a href="ExternalDebtStockMM.php">
							<img src="assets/images/ExternalDebtStock.png" alt="ExternalDebtStock" class="img-indicator"/>
							External debt stocks, total (DOD, current US$)
							</a>
							<br><br>
						</div>
						<div class="col-md-3 col-sm-3">
							<a href="GDPCurrentUsMM.php">
							<img src="assets/images/GDPCurrentUs.png" alt="GDPCurrentUs" class="img-indicator"/>
							GDP (current US$)
							</a>
							<br><br>
						</div>
						<div class="col-md-3 col-sm-3">
							<a href="UnemployeementToMM.php">
							<img src="assets/images/UnemployeementTo.png" alt="UnemployeementTo" class="img-indicator"/>
							Unemployment, total (% of total labor force) (modeled ILO estimate)
							</a>
							<br><br>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--<div class="col-md-3 col-sm-3">
			<div class="panel panel-info width-300px">
				<div class="panel-heading"><b>Today News</b></div>
				<div class="panel-body">
					<img src="assets/images/id1.png" alt="default profile" class="img-indicator1"/> <br> <br>
					<img src="assets/images/id1.png" alt="default profile" class="img-indicator1"/> <br> <br>
					<img src="assets/images/id1.png" alt="default profile" class="img-indicator1"/> <br> <br>
				</div>
			</div>
		</div>-->
_END;
	}
	require_once 'footer.php';
?>