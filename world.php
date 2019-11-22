<?php
header("Access-Control-Allow-Origin:*");
$host = getenv('IP');
$username = 'Sabie0498';
$password = '$1nG/_3n/_uv1n1t';
$dbname = 'world';
$country = $_GET['country'];


//Create connection
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4",$username,$password);

//Check connection
$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>

<!--sanitization done in js file-->
<?php if(isset($_GET['country']) && !isset($_GET['context'])):?>
<?php

$stmt2 = $conn->queryfetchAll(PDO::FETCH_ASSOC);
?>
<table style="width:100%">
	<tr>
		<th>Name</th>
		<th>Continent</th>
		<th>Independence</th>
		<th>Head of State</th>
	</tr>
	<?php foreach ($contents as $row):?>
	<tr>
		<td><?=$row['name']?></td>
		<td><?=$row['continent']?></td>
		<td><?=$row['independence_year']?></td>
		<td><?=$row['head_of_state']?></td>
	</tr>
	<?php endforeach;?>
</table>

<?php endif;?>
<?php if(isset($_GET['context'])&& !empty($_GET['country'])):?>
<?php

$stmt2 = $conn->prepare("SELECT code FROM countries WHERE name = :name");
$area = filter_input(INPUT_GET, 'country', FILTER_SANITIZE_SPECIAL_CHARS);

$stmt2->bindParam(':name', $area, PDO::PARAM_STR);

$stmt2->execute();
$locale = $stmt2->fetch(PDO::FETCH_ASSOC);
$city = $locale['code'];

$stmt3 = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities INNER JOIN countries ON cities.country_code=countries.code WHERE cities.country_code = '$city'");

$destination = $stmt3->fetchAll(PDO::FETCH_ASSOC);
?>

<table style="width:100%">
	<tr>
		<th>Name</th>
		<th>District</th>
		<th>Population</th>
	</tr>
	<?php foreach ($destination as $row):?>
	<tr>
		<td><?=$row['name']?></td>
		<td><?=$row['district']?></td>
		<td><?=$row['population']?></td>
	</tr>
	<?php endforeach;?>
</table>
<?php endif;?>