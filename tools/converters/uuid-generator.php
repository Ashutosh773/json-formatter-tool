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
            <a href="/json-to-sql">🗄️ JSON → SQL</a>
            <a href="/json-to-yaml">⚙️ JSON → YAML</a>
            <a href="/json-to-xml">🔄 JSON → XML</a>
          </div>

          <div class="dropdown-section">
            <p>Developer</p>
            <a href="/base64">🔐 Base64 Tool</a>
            <a href="/uuid">🆔 UUID Generator</a>
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

<body>


<div class="container">

<h2>UUID Generator (v4)</h2>

<form method="POST">

<label class="label">Number of UUIDs:</label>
<input type="number" name="count" value="<?php echo $_POST['count'] ?? 1; ?>" min="1" max="1000">

<div class="controls">
    <button type="submit" class="btn">Generate</button>
    <button type="button" class="btn" onclick="copyUUID()">Copy</button>
    <button type="button" class="btn" onclick="downloadUUID()">Download</button>
</div>

<textarea id="uuidOutput" readonly><?php
if (!empty($uuidList)) {
    echo implode("\n", $uuidList);
}
?></textarea>

</form>


<?php
// ---------- UUID v4 GENERATOR ----------
function generateUUIDv4() {
    $data = random_bytes(16);

    // Version 4
    $data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
    // Variant
    $data[8] = chr((ord($data[8]) & 0x3f) | 0x80);

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

// Handle request
$uuidList = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = intval($_POST['count'] ?? 1);

    for ($i = 0; $i < $count; $i++) {
        $uuidList[] = generateUUIDv4();
    }
}
?>
</div>
<script>
// Copy UUIDs
function copyUUID() {
    let output = document.getElementById("uuidOutput");
    output.select();
    document.execCommand("copy");
    alert("Copied!");
}

// Download UUIDs
function downloadUUID() {
    let content = document.getElementById("uuidOutput").value;
    let blob = new Blob([content], { type: "text/plain" });
    let a = document.createElement("a");
    a.href = URL.createObjectURL(blob);
    a.download = "uuids.txt";
    a.click();
}
</script>

</body>

<footer>
    <p>© 2026 JSON Formatter & Validator</p>
</footer>
</html>