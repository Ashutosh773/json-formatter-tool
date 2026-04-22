<?php
// ---------- HANDLE REQUEST FIRST ----------
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

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Base64 Encode / Decode Tool</title>

<meta name="description" content="Encode and decode Base64 online free. Fast and secure Base64 tool.">
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

<h2>Base64 Encode / Decode Tool</h2>

<form method="POST">

<!-- INPUT -->
<textarea name="input" id="inputText" placeholder="Enter text or Base64 here..."><?php echo htmlspecialchars($_POST['input'] ?? ''); ?></textarea>

<!-- BUTTONS -->
<div class="controls">
    <button class="btn" type="submit" name="action" value="encode">Encode</button>
    <button class="btn" type="submit" name="action" value="decode">Decode</button>
    <button class="btn" type="button" onclick="clearAll()">Clear</button>
    <button class="btn" type="button" onclick="copyOutput()">Copy</button>
    <button class="btn" type="button" onclick="downloadOutput()">Download</button>
</div>

<!-- OUTPUT -->
<textarea class="output" id="outputText" readonly><?php echo htmlspecialchars($output); ?></textarea>

<div class="status"><?php echo $status; ?></div>

</form>

</div>

<!-- SCRIPT -->
<script>

// Clear
function clearAll() {
    document.getElementById("inputText").value = "";
    document.getElementById("outputText").value = "";
}

// Copy
function copyOutput() {
    let output = document.getElementById("outputText");
    output.select();
    document.execCommand("copy");
    alert("Copied!");
}

// Download
function downloadOutput() {
    let content = document.getElementById("outputText").value;
    let blob = new Blob([content], { type: "text/plain" });
    let a = document.createElement("a");
    a.href = URL.createObjectURL(blob);
    a.download = "base64-output.txt";
    a.click();
}

// Live validation
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

<!-- FOOTER -->
<footer>
    <p>© 2026 JSON Formatter & Validator</p>
</footer>

</body>
</html>