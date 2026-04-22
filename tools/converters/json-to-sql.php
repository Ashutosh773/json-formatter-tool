<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>JSON to SQL Converter Tool</title>
<meta name="title" content="JSON Formatter & Validator Online Free">
<meta name="description" content="Free online JSON formatter, validator and minifier tool. Beautify JSON instantly with our fast and easy tool.">
<meta name="keywords" content="json formatter, json validator, json beautifier, format json online, json pretty print, json minify, json viewer, free json tool, developer tools">
<meta name="author" content="Ashutosh Shirole">

<meta property="og:title" content="JSON Formatter & Validator">
<meta property="og:description" content="Format, validate and minify JSON online instantly.">
<meta property="og:type" content="website">
<meta name="robots" content="index, follow">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../../css/style.css">
<link rel="icon" href="../../assets/img/search.png">
<link rel="stylesheet" href="../../tools/converters/assets/css/style.css">
<header>
  <nav>
    <h1>JSON Formatter & Validator</h1>
    <ul>
      <li><a href="../../index.html">Home</a></li>
	  <!-- 🔽 TOOLS DROPDOWN -->
      <li class="dropdown">
       <a href="#" class="tools-link">Tools</a>
 
        <div class="dropdown-content">

          <div class="dropdown-section">
            <p>Converters</p>
            <a href="../../tools/converters/json-to-sql.php">🗄️ JSON → SQL</a>
            <a href="../../tools/converters/json-to-yaml.php">⚙️ JSON → YAML</a>
            <a href="../../tools/converters/json-to-xml.php">🔄 JSON → XML</a>
          </div>

          <div class="dropdown-section">
            <p>Developer</p>
            <a href="../../tools/converters/base64-tool.php">🔐 Base64 Tool</a>
            <a href="../../tools/converters/uuid-generator.php">🆔 UUID Generator</a>
          </div>

        </div>
      </li>
	  <li><a href="../../blog/index.html">Blog</a></li>
	  <li><a href="../../about-us.html">About Us</a></li>
      <li><a href="../../contact-us.html">Contact Us</a></li>
      
    </ul>
  </nav>
 </header>
</head>
 <h2>JSON to SQL Converter</h2>

<body>
<div class="container">

<form method="POST">
    
    <div class="tool-box">
        
        <!-- JSON Input -->
        <textarea name="json" placeholder='Enter JSON here...'><?php 
        echo isset($_POST['json']) ? htmlspecialchars($_POST['json']) : '';
        ?></textarea>

        <!-- SQL Output -->
        <textarea class="output" readonly><?php 
        if(isset($sql)) echo $sql;
        ?></textarea>

    </div>

    <!-- Options -->
    <div class="option-box">
        <label class="label">Table Name:</label>
        <input type="text" name="table" value="<?php echo $_POST['table'] ?? 'users'; ?>">
    </div>

    <!-- Buttons -->
    <div class="controls">
        <button class="btn" type="submit">Convert to SQL</button>
        <button class="btn" type="button" onclick="clearAll()">Clear</button>
        <button class="btn" type="button" onclick="copySQL()">Copy SQL</button>
    </div>

</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $jsonInput = $_POST['json'];
    $table = $_POST['table'] ?? 'users';

    $data = json_decode($jsonInput, true);

    if ($data) {

        // Handle single object
        if (isset($data[0])) {
            $rows = $data;
        } else {
            $rows[] = $data;
        }

        $sql = "";

        foreach ($rows as $row) {
            $columns = array_keys($row);
            $values = array_map(function($val) {
                return "'" . addslashes($val) . "'";
            }, array_values($row));

            $sql .= "INSERT INTO $table (" . implode(",", $columns) . ") VALUES (" . implode(",", $values) . ");\n";
        }

        echo "<script>document.querySelector('.output').value = " . json_encode($sql) . ";</script>";

    } else {
        echo "<script>alert('Invalid JSON!');</script>";
    }
}
?>

</div>
<script>
function clearAll() {
    document.querySelectorAll("textarea").forEach(t => t.value = "");
}

function copySQL() {
    let output = document.querySelector(".output");
    output.select();
    document.execCommand("copy");
    alert("Copied to clipboard!");
}
</script>
</body>
<footer>
    <p>© 2026 JSON Formatter & Validator</p>
</footer>
</html>