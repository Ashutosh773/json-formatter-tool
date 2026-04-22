<?php
// ---------- HANDLE REQUEST FIRST ----------
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

// ---------- YAML FUNCTIONS ----------
function jsonToYaml($data, $indent = 0) {
    $yaml = '';
    $spaces = str_repeat("  ", $indent);

    foreach ($data as $key => $value) {

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
    if ($value === null) return "null";
    return '"' . addslashes($value) . '"';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>JSON to YAML Converter Tool</title>

<meta name="description" content="Convert JSON to YAML online free. Fast and easy YAML generator tool.">
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

<h2>JSON to YAML Converter</h2>

<form method="POST">

<div class="tool-box">

<!-- JSON INPUT -->
<textarea name="json" id="jsonInput" placeholder="Enter JSON here..."><?php echo htmlspecialchars($_POST['json'] ?? ''); ?></textarea>

<!-- YAML OUTPUT -->
<textarea class="output" id="yamlOutput" readonly><?php echo htmlspecialchars($output); ?></textarea>

</div>

<div class="controls">
    <button type="submit" class="btn">Convert to YAML</button>
    <button type="button" class="btn" onclick="clearAll()">Clear</button>
    <button type="button" class="btn" onclick="copyYAML()">Copy</button>
    <button type="button" class="btn" onclick="downloadYAML()">Download</button>
</div>

<div class="status"><?php echo $status; ?></div>

</form>
</div>

<!-- SCRIPT -->
<script>

// Clear
function clearAll() {
    document.getElementById("jsonInput").value = "";
    document.getElementById("yamlOutput").value = "";
}

// Copy
function copyYAML() {
    let output = document.getElementById("yamlOutput");
    output.select();
    document.execCommand("copy");
    alert("Copied!");
}

// Download
function downloadYAML() {
    let content = document.getElementById("yamlOutput").value;
    let blob = new Blob([content], { type: "text/yaml" });
    let a = document.createElement("a");
    a.href = URL.createObjectURL(blob);
    a.download = "output.yaml";
    a.click();
}

// Live validation
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