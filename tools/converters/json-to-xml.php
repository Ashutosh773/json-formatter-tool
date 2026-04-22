<?php
// ---------- HANDLE REQUEST FIRST ----------
$output = "";
$status = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $jsonInput = $_POST['json'] ?? '';
    $data = json_decode($jsonInput, true);

    if ($data !== null) {

        $xml = new SimpleXMLElement('<?xml version="1.0"?><root></root>');
        arrayToXml($data, $xml);

        $output = $xml->asXML();
        $status = "Valid JSON ✅";

    } else {
        $status = "Invalid JSON ❌";
    }
}

// ---------- JSON TO XML FUNCTION ----------
function arrayToXml($data, &$xml) {
    foreach ($data as $key => $value) {

        // Fix numeric keys
        if (is_numeric($key)) {
            $key = "item";
        }

        // Clean invalid XML tag names
        $key = preg_replace('/[^a-zA-Z0-9_\-]/', '', $key);

        if (is_array($value)) {
            $subnode = $xml->addChild($key);
            arrayToXml($value, $subnode);
        } else {
            $xml->addChild($key, htmlspecialchars($value));
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>JSON to XML Converter Tool</title>

<meta name="description" content="Convert JSON to XML online free. Fast and easy XML generator tool.">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../../css/style.css">
<link rel="stylesheet" href="../../tools/converters/assets/css/style.css">
<link rel="icon" href="../../assets/img/search.png">

</head>

<body>

<!-- HEADER -->
<header>
<nav>
    <h1>JSON Tools</h1>
    <ul>
        <li><a href="../../index.html">Home</a></li>

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

<!-- MAIN -->
<div class="container">

<h2>JSON to XML Converter</h2>

<form method="POST">

<div class="tool-box">

<!-- JSON INPUT -->
<textarea name="json" id="jsonInput" placeholder="Enter JSON here..."><?php echo htmlspecialchars($_POST['json'] ?? ''); ?></textarea>

<!-- XML OUTPUT -->
<textarea class="output" id="xmlOutput" readonly><?php echo htmlspecialchars($output); ?></textarea>

</div>

<div class="controls">
    <button type="submit" class="btn">Convert to XML</button>
    <button type="button" class="btn" onclick="clearAll()">Clear</button>
    <button type="button" class="btn" onclick="copyXML()">Copy</button>
    <button type="button" class="btn" onclick="downloadXML()">Download</button>
</div>

<div class="status"><?php echo $status; ?></div>

</form>

</div>

<!-- SCRIPT -->
<script>

// Clear
function clearAll() {
    document.getElementById("jsonInput").value = "";
    document.getElementById("xmlOutput").value = "";
}

// Copy
function copyXML() {
    let output = document.getElementById("xmlOutput");
    output.select();
    document.execCommand("copy");
    alert("Copied!");
}

// Download
function downloadXML() {
    let content = document.getElementById("xmlOutput").value;
    let blob = new Blob([content], { type: "application/xml" });
    let a = document.createElement("a");
    a.href = URL.createObjectURL(blob);
    a.download = "output.xml";
    a.click();
}

// Live JSON validation
document.getElementById("jsonInput").addEventListener("input", function() {
    try {
        JSON.parse(this.value);
        this.style.borderColor = "green";
    } catch {
        this.style.borderColor = "red";
    }
});

</script>

<!-- FOOTER -->
<footer>
    <p>© 2026 JSON Formatter & Validator</p>
</footer>

</body>
</html>