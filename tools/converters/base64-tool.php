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

<h2>Base64 Encode / Decode Tool</h2>

<form method="POST">

<!-- Input -->
<textarea name="input" id="inputText" placeholder="Enter text or Base64 here..."><?php echo htmlspecialchars($_POST['input'] ?? ''); ?></textarea>

<!-- Buttons -->
<div class="controls">
    <button class="btn" type="submit" name="action" value="encode">Encode</button>
    <button class="btn" type="submit" name="action" value="decode">Decode</button>
    <button class="btn" type="button" onclick="clearAll()">Clear</button>
    <button class="btn" type="button" onclick="copyOutput()">Copy Output</button>
    <button class="btn" type="button" onclick="downloadOutput()">Download</button>
</div>

<!-- Output -->
<textarea class="output" id="outputText" readonly><?php echo htmlspecialchars($output); ?></textarea>

<div class="status"><?php echo $status; ?></div>

</form>


<?php
$output = "";
$status = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $input = $_POST['input'] ?? '';
    $action = $_POST['action'] ?? 'encode';

    if ($action === 'encode') {
        $output = base64_encode($input);
        $status = "Encoded successfully ✅";
    } else {
        $decoded = base64_decode($input, true);

        if ($decoded !== false) {
            $output = $decoded;
            $status = "Decoded successfully ✅";
        } else {
            $status = "Invalid Base64 string ❌";
        }
    }
}
?>
</div>

<script>
// Clear fields
function clearAll() {
    document.getElementById("inputText").value = "";
    document.getElementById("outputText").value = "";
}

// Copy output
function copyOutput() {
    let output = document.getElementById("outputText");
    output.select();
    document.execCommand("copy");
    alert("Copied!");
}

// Download output
function downloadOutput() {
    let content = document.getElementById("outputText").value;
    let blob = new Blob([content], { type: "text/plain" });
    let a = document.createElement("a");
    a.href = URL.createObjectURL(blob);
    a.download = "base64-output.txt";
    a.click();
}

// Optional validation highlight
document.getElementById("inputText").addEventListener("input", function() {
    let val = this.value.trim();
    if (!val) {
        this.style.borderColor = "#ccc";
        return;
    }
    try {
        atob(val);
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