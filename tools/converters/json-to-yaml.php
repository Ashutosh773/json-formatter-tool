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
 <h2>JSON to YAML Converter</h2>

<body>
<div class="container">

<form method="POST">

<div class="tool-box">
    <!-- JSON Input -->
    <textarea name="json" id="jsonInput" placeholder="Enter JSON here..."><?php echo htmlspecialchars($_POST['json'] ?? ''); ?></textarea>

    <!-- YAML Output -->
    <textarea class="output" id="yamlOutput" readonly><?php echo htmlspecialchars($output); ?></textarea>
</div>

<div class="controls">
    <button type="submit" class="btn">Convert to YAML</button>
    <button type="button" class="btn" onclick="clearAll()">Clear</button>
    <button type="button" class="btn" onclick="copyYAML()">Copy YAML</button>
    <button type="button" class="btn" onclick="downloadYAML()">Download</button>
</div>

<div class="status"><?php echo $status; ?></div>

</form>
<?php
// ---------- PHP YAML FUNCTION ----------
function jsonToYaml($data, $indent = 0) {
    $yaml = '';
    $spaces = str_repeat("  ", $indent);

    foreach ($data as $key => $value) {

        // Numeric array (list)
        if (is_numeric($key)) {
            $yaml .= $spaces . "- ";
            if (is_array($value)) {
                $yaml .= "\n" . jsonToYaml($value, $indent + 1);
            } else {
                $yaml .= formatYamlValue($value) . "\n";
            }
        } else {
            if (is_array($value)) {
                $yaml .= $spaces . $key . ":\n";
                $yaml .= jsonToYaml($value, $indent + 1);
            } else {
                $yaml .= $spaces . $key . ": " . formatYamlValue($value) . "\n";
            }
        }
    }
    return $yaml;
}

function formatYamlValue($value) {
    if (is_bool($value)) return $value ? "true" : "false";
    if (is_numeric($value)) return $value;
    return '"' . addslashes($value) . '"';
}

// ---------- HANDLE REQUEST ----------
$output = "";
$status = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jsonInput = $_POST['json'] ?? '';
    $data = json_decode($jsonInput, true);

    if ($data !== null) {
        $output = jsonToYaml($data);
        $status = "Valid JSON ✅";
    } else {
        $status = "Invalid JSON ❌";
    }
}
?>
</div>
<script>
// Clear all
function clearAll() {
    document.getElementById("jsonInput").value = "";
    document.getElementById("yamlOutput").value = "";
}

// Copy YAML
function copyYAML() {
    let output = document.getElementById("yamlOutput");
    output.select();
    document.execCommand("copy");
    alert("Copied!");
}

// Download YAML
function downloadYAML() {
    let content = document.getElementById("yamlOutput").value;
    let blob = new Blob([content], { type: "text/yaml" });
    let a = document.createElement("a");
    a.href = URL.createObjectURL(blob);
    a.download = "output.yaml";
    a.click();
}

// Optional: Auto convert (basic)
document.getElementById("jsonInput").addEventListener("input", function() {
    try {
        JSON.parse(this.value);
        // Optional visual validation
        this.style.borderColor = "green";
    } catch {
        this.style.borderColor = "red";
    }
});
</script>

</body>

<footer>
    <p>© 2026 JSON Formatter & Validator</p>
</footer>
</html>