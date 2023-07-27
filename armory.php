<?php
session_start();
include "assets/checks.php";
include "assets/config.php";

if ($_POST["charid"] != null) {
	$charid = $_POST["charid"];
} elseif ($_GET["charid"] != null && $_POST["charid"] == null) {
	$charid = $_GET["charid"];
} else {
	$charid = null;
}

// Load all of the chosen characters Gear ***********************************
if ($charid != null) {

	for ($x = -1; $x <= 18; $x += 1) {
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			exit();
		}
		// Perform Mainhand Item Queries

		//Gets Char inventory Slot Items id
		if ($itemresult = mysqli_query($DB_CH, "SELECT * FROM character_inventory WHERE guid = $charid AND bag = 0 AND slot = $x")) {
			while ($itemrow = mysqli_fetch_assoc($itemresult)) {
				$item_instance = $itemrow["item"];

				// Get instance inventory item id
				if (
					$itemresult = mysqli_query(
						$DB_CH,
						"SELECT * FROM item_instance WHERE guid = $item_instance"
					)
				) {
					while ($itemrow = mysqli_fetch_assoc($itemresult)) {
						$item_id = $itemrow["itemEntry"];

						//Get the Item_Template item and item displayid
						if ($itemresult = mysqli_query($DB_W, "SELECT * FROM item_template WHERE entry = $item_id")) {
							while ($itemrow = mysqli_fetch_assoc($itemresult)) {
								$item_name = $itemrow["name"];
								$item_icon_id = $itemrow["displayid"];

								$url = "https://www.wowhead.com/wotlk/de/item=" . $item_id . "&xml";
								$xml = file_get_contents($url);
								if ($rss = new SimpleXmlElement($xml)) {
									$item_icon = "https://wow.zamimg.com/images/wow/icons/large/" . $rss->item->icon . ".jpg";
								}
								if ($x == 0) {
									$head_id = $item_id;
									$head_name = $item_name;
									$head_icon = $item_icon;
								}
								if ($x == 1) {
									$neck_id = $item_id;
									$neck_name = $item_name;
									$neck_icon = $item_icon;
								}
								if ($x == 2) {
									$shoulder_id = $item_id;
									$shoulder_name = $item_name;
									$shoulder_icon = $item_icon;
								}
								if ($x == 3) {
									$shirt_id = $item_id;
									$shirt_name = $item_name;
									$shirt_icon = $item_icon;
								}
								if ($x == 4) {
									$chest_id = $item_id;
									$chest_name = $item_name;
									$chest_icon = $item_icon;
								}
								if ($x == 5) {
									$waist_id = $item_id;
									$waist_name = $item_name;
									$waist_icon = $item_icon;
								}
								if ($x == 6) {
									$legs_id = $item_id;
									$legs_name = $item_name;
									$legs_icon = $item_icon;
								}
								if ($x == 7) {
									$feet_id = $item_id;
									$feet_name = $item_name;
									$feet_icon = $item_icon;
								}
								if ($x == 8) {
									$wrist_id = $item_id;
									$wrist_name = $item_name;
									$wrist_icon = $item_icon;
								}
								if ($x == 9) {
									$hands_id = $item_id;
									$hands_name = $item_name;
									$hands_icon = $item_icon;
								}
								if ($x == 10) {
									$finger1_id = $item_id;
									$finger1_name = $item_name;
									$finger1_icon = $item_icon;
								}
								if ($x == 11) {
									$finger2_id = $item_id;
									$finger2_name = $item_name;
									$finger2_icon = $item_icon;
								}
								if ($x == 12) {
									$trinket1_id = $item_id;
									$trinket1_name = $item_name;
									$trinket1_icon = $item_icon;
								}
								if ($x == 13) {
									$trinket2_id = $item_id;
									$trinket2_name = $item_name;
									$trinket2_icon = $item_icon;
								}
								if ($x == 14) {
									$back_id = $item_id;
									$back_name = $item_name;
									$back_icon = $item_icon;
								}
								if ($x == 15) {
									$mainhand_id = $item_id;
									$mainhand_name = $item_name;
									$mainhand_icon = $item_icon;
									$mainhand_icon = $item_icon;
								}
								if ($x == 16) {
									$offhand_id = $item_id;
									$offhand_name = $item_name;
									$offhand_icon = $item_icon;
								}
								if ($x == 17) {
									$ranged_id = $item_id;
									$ranged_name = $item_name;
									$ranged_icon = $item_icon;
								}
								if ($x == 18) {
									$tabard_id = $item_id;
									$tabard_name = $item_name;
									$tabard_icon = $item_icon;
								}
							}
						}
					}
				}
			}
		}
	} // for

	if ($stats_result = mysqli_query($DB_CH, "SELECT * FROM characters WHERE guid=" . $charid)) {
		while ($row = mysqli_fetch_assoc($stats_result)) {
			$info_name = $row["name"];
			$info_race = $row["race"];
			$info_gender = $row["gender"];
			$info_class = $row["class"];
			$info_level = $row["level"];
			$money = $row["money"];
			$gold = floor($money / 10000);
			$silver = floor(($money % 10000) / 100);
			$copper = floor(($money % 10000) % 100);
		}
	}
}

?>
<style>
	.stats-bg-image {
		background-image: url("./assets/img/statbg/<?php echo $info_race . "_" . $info_gender . "_" . $info_class; ?>.jpg");
		background-size: 100% 100%;
	}

	.sizeform {
		width: 200px;
	}
</style>

<html>

<head>
	<!-- META -->
	<title>
		<?php echo $title; ?>
	</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="./assets/img/favicon.ico" />

	<!-- CSS -->
	<link rel="stylesheet" href="./assets/css/tailwind.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
	<link rel="stylesheet" href="./assets/css/equipment.css">
	<link rel="stylesheet" href="./assets/css/tooltip.css">
	<script>const whTooltips = { colorLinks: true, iconizeLinks: false, renameLinks: false };</script>
	<script src="https://wow.zamimg.com/widgets/power.js"></script>
</head>

<body>
	<img src="./assets/img/wotlk-bg.jpg" class="bg_img">
	<video autoplay muted loop id="myVideo">
		<source src="./assets/img/wotlk-bg.mp4" type="video/mp4">
	</video>
	<div class="grid h-screen place-items-center">
		<div class="flex justify-center">
			<div class="rounded-lg shadow-lg bg-white max-w-sm dark:bg-slate-800">
				<div class="flex justify-center"><img src="./assets/img/armory-logo-en.png"></div>
				<div class="flex justify-center">
					<div style="white-space: nowrap;color: white;font-weight: bold;">
						<form method="post" action="armory.php">
							<label for="Characters">Choose a Character:&nbsp;</label>
							<select name="charid" id="Characters" style="background: #0000;border: 1px solid;"
								onChange="document.getElementById('container').innerHTML='';submit();">
								<!-- Add Load Character List PHP Here -->
								<?php
								if ($result = mysqli_query($DB_CH, "SELECT * FROM characters ORDER BY name ASC")) {
									while ($row = mysqli_fetch_assoc($result)) {
										echo "<option value=" . $row["guid"] . " " . ($row["guid"] == $charid ? "selected" : "") . ">" . $row["name"] . "</option>";
									}
								}
								mysqli_free_result($result);
								?>
							</select>
						</form>
					</div>
				</div>
				<div class="grid-container center" id="container">
					<div class="grid-item item-head tooltip">
						<?php if ($head_id != null) {
							echo "<a href='" . $linksite . $head_id . "' target='_blank'>";
							echo "<img alt='" . $head_name . "' height='64' src='" . $head_icon . "' style='border-width: 0px' width='64'></a>";
						} ?>
						<span class="tooltiptext">Kopf</span>
					</div>
					<div class="grid-item item-name">
						<div class="grid-container-main">
							<div class="grid-item-main main-item-race tooltip">
								<?php if ($charid != null) {
									echo "<img height=\"64\" src=\"./assets/img/race/" . $info_race . "-" . $info_gender . ".gif\" width=\"64\">";
								} ?>
								<span class="tooltiptext">Rasse</span>
							</div>
							<div class="grid-item-main main-item-name">
								<div class="grid-container-main-info">
									<div class="grid-item-main-info-name">
										<?php echo $info_name; ?>
									</div>
									<div class="grid-item-main-info">
										<?php if ($info_level != null) {
											echo "Level " . $info_level;
										} ?>
									</div>
								</div>
							</div>
							<div class="grid-item-main main-item-class tooltip">
								<?php if ($charid != null) {
									echo "<img height=\"64\" src=\"./assets/img/class/" . $info_class . ".gif\" width=\"64\">";
								} ?>
								<span class="tooltiptext">Klasse</span>
							</div>
						</div>
					</div>
					<div class="grid-item item-hands tooltip">
						<?php if ($hands_id != null) {
							echo "<a href='" . $linksite . $hands_id . "' target='_blank'>";
							echo "<img alt='" . $hands_name . "' height='64' src='" . $hands_icon . "' style='border-width: 0px' width='64'></a>";
						} ?>
						<span class="tooltiptext">Hände</span>
					</div>
					<div class="grid-item item-neck tooltip">
						<?php if ($neck_id != null) {
							echo "<a href='" . $linksite . $neck_id . "' target='_blank'>";
							echo "<img alt='" . $neck_name . "' height='64' src='" . $neck_icon . "' style='border-width: 0px' width='64'></a>";
						} ?>
						<span class="tooltiptext">Hals</span>
					</div>
					<div class="grid-item item-stats stats-bg-image" style="color: white;">Gold:<br>
						<?php echo $gold . "g " . $silver . "s " . $copper . "c"; ?>
					</div>
					<div class="grid-item item-waist tooltip">
						<?php if ($waist_id != null) {
							echo "<a href='" . $linksite . $waist_id . "' target='_blank'>";
							echo "<img alt='" . $waist_name . "' height='64' src='" . $waist_icon . "' style='border-width: 0px' width='64'></a>";
						} ?>
						<span class="tooltiptext">Taille</span>
					</div>
					<div class="grid-item item-shoulders tooltip">
						<?php if ($shoulder_id != null) {
							echo "<a href='" . $linksite . $shoulder_id . "' target='_blank'>";
							echo "<img alt='" . $shoulder_name . "' height='64' src='" . $shoulder_icon . "' style='border-width: 0px' width='64'></a>";
						} ?>
						<span class="tooltiptext">Schulter</span>
					</div>
					<div class="grid-item item-legs tooltip">
						<?php if ($legs_id != null) {
							echo "<a href='" . $linksite . $legs_id . "' target='_blank'>";
							echo "<img alt='" . $legs_name . "' height='64' src='" . $legs_icon . "' style='border-width: 0px' width='64'></a>";
						} ?>
						<span class="tooltiptext">Beine</span>
					</div>
					<div class="grid-item item-back tooltip">
						<?php if ($back_id != null) {
							echo "<a href='" . $linksite . $back_id . "' target='_blank'>";
							echo "<img alt='" . $back_name . "' height='64' src='" . $back_icon . "' style='border-width: 0px' width='64'></a>";
						} ?>
						<span class="tooltiptext">Rücken</span>
					</div>
					<div class="grid-item item-feet tooltip">
						<?php if ($feet_id != null) {
							echo "<a href='" . $linksite . $feet_id . "' target='_blank'>";
							echo "<img alt='" . $feet_name . "' height='64' src='" . $feet_icon . "' style='border-width: 0px' width='64'></a>";
						} ?>
						<span class="tooltiptext">Füsse</span>
					</div>
					<div class="grid-item item-chest tooltip">
						<?php if ($chest_id != null) {
							echo "<a href='" . $linksite . $chest_id . "' target='_blank'>";
							echo "<img alt='" . $chest_name . "' height='64' src='" . $chest_icon . "' style='border-width: 0px' width='64'></a>";
						} ?>
						<span class="tooltiptext">Brust</span>
					</div>
					<div class="grid-item item-finger1 tooltip">
						<?php if ($finger1_id != null) {
							echo "<a href='" . $linksite . $finger1_id . "' target='_blank'>";
							echo "<img alt='" . $finger1_name . "' height='64' src='" . $finger1_icon . "' style='border-width: 0px' width='64'></a>";
						} ?>
						<span class="tooltiptext">Finger 1</span>
					</div>
					<div class="grid-item item-shirt tooltip">
						<?php if ($shirt_id != null) {
							echo "<a href='" . $linksite . $shirt_id . "' target='_blank'>";
							echo "<img alt='" . $shirt_name . "' height='64' src='" . $shirt_icon . "' style='border-width: 0px' width='64'></a>";
						} ?>
						<span class="tooltiptext">Hemd</span>
					</div>
					<div class="grid-item item-finger2 tooltip">
						<?php if ($finger2_id != null) {
							echo "<a href='" . $linksite . $finger2_id . "' target='_blank'>";
							echo "<img alt='" . $finger2_name . "' height='64' src='" . $finger2_icon . "' style='border-width: 0px' width='64'></a>";
						} ?>
						<span class="tooltiptext">Finger 2</span>
					</div>
					<div class="grid-item item-tabard tooltip">
						<?php if ($tabard_id != null) {
							echo "<a href='" . $linksite . $tabard_id . "' target='_blank'>";
							echo "<img alt='" . $tabard_name . "' height='64' src='" . $tabard_icon . "' style='border-width: 0px' width='64'></a>";
						} ?>
						<span class="tooltiptext">Wappenrock</span>
					</div>
					<div class="grid-item item-trinket1 tooltip">
						<?php if ($trinket1_id != null) {
							echo "<a href='" . $linksite . $trinket1_id . "' target='_blank'>";
							echo "<img alt='" . $trinket1_name . "' height='64' src='" . $trinket1_icon . "' style='border-width: 0px' width='64'></a>";
						} ?>
						<span class="tooltiptext">Schmuck 1</span>
					</div>
					<div class="grid-item item-wrists tooltip">
						<?php if ($wrist_id != null) {
							echo "<a href='" . $linksite . $wrist_id . "' target='_blank'>";
							echo "<img alt='" . $wrist_name . "' height='64' src='" . $wrist_icon . "' style='border-width: 0px' width='64'></a>";
						} ?>
						<span class="tooltiptext">Handgelenke</span>
					</div>
					<div class="grid-item item-trinket2 tooltip">
						<?php if ($trinket2_id != null) {
							echo "<a href='" . $linksite . $trinket2_id . "' target='_blank'>";
							echo "<img alt='" . $trinket2_name . "' height='64' src='" . $trinket2_icon . "' style='border-width: 0px' width='64'></a>";
						} ?>
						<span class="tooltiptext">Schmuck 2</span>
					</div>
					<div class="item-leftspace"></div>
					<div class="grid-item item-mainhand tooltip">
						<?php if ($mainhand_id != null) {
							echo "<a href='" . $linksite . $mainhand_id . "' target='_blank'>";
							echo "<img alt='' height='64' src='" . $mainhand_icon . "' style='border-width: 0px' width='64'></a>";
						} ?>
						<span class="tooltiptext">Haupthand</span>
					</div>
					<div class="grid-item item-offhand tooltip">
						<?php if ($offhand_id != null) {
							echo "<a href='" . $linksite . $offhand_id . "' target='_blank'>";
							echo "<img alt='" . $offhand_name . "' height='64' src='" . $offhand_icon . "' style='border-width: 0px' width='64'></a>";
						} ?>
						<span class="tooltiptext">Nebenhand</span>
					</div>
					<div class="item-rightspace"></div>
				</div>
			</div>
		</div>
	</div>
</body>
<?php
mysqli_free_result($itemresult);
mysqli_close($DB_CH);
mysqli_close($DB_W);
?>

</html>