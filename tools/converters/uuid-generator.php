<?php
// ---------- UUID GENERATION ----------
function generateUUIDv4() {
    $data = random_bytes(16);

    // Version 4
    $data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
    // Variant
    $data[8] = chr((ord($data[8]) & 0x3f) | 0x80);

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

// ---------- HANDLE REQUEST ----------
$uuidList = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = intval($_POST['count'] ?? 1);

    // Limit for safety
    if ($count < 1) $count = 1;
    if ($count > 1000) $count = 1000;

    for ($i = 0; $i < $count; $i++) {
        $uuidList[] = generateUUIDv4();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>UUID Generator (v4)</title>

<meta name="description" content="Generate UUID v4 online free. Create multiple unique IDs instantly.">
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

<h2>UUID Generator (v4)</h2>

<form method="POST">

<label class="label">Number of UUIDs:</label>
<input type="number" name="count" 
       value="<?php echo htmlspecialchars($_POST['count'] ?? 1); ?>" 
       min="1" max="1000">

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

</div>

<!-- SCRIPT -->
<script>

// Copy
function copyUUID() {
    let output = document.getElementById("uuidOutput");
    output.select();
    document.execCommand("copy");
    alert("Copied!");
}

// Download
function downloadUUID() {
    let content = document.getElementById("uuidOutput").value;
    let blob = new Blob([content], { type: "text/plain" });
    let a = document.createElement("a");
    a.href = URL.createObjectURL(blob);
    a.download = "uuids.txt";
    a.click();
}

</script>

<!-- FOOTER -->
<footer>
    <p>© 2026 JSON Formatter & Validator</p>
</footer>

</body>
</html>