<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>JSON Formatter & Validator</title>
<meta name="title" content="JSON Formatter & Validator Online Free">
<meta name="description" content="Free online JSON formatter, validator and minifier tool. Beautify JSON instantly with our fast and easy tool.">
<meta name="keywords" content="json formatter, json validator, json beautifier, format json online, json pretty print, json minify, json viewer, free json tool, developer tools">
<meta name="author" content="Ashutosh Shirole">

<meta property="og:title" content="JSON Formatter & Validator">
<meta property="og:description" content="Format, validate and minify JSON online instantly.">
<meta property="og:type" content="website">
<meta name="robots" content="index, follow">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../blog/asset/css/style.css">
<link rel="icon" href="../assets/img/search.png">

 <!-- AdSense Auto Ads -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2892380346318715"
     crossorigin="anonymous"></script>

<script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7HRX8W7ZV8"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7HRX8W7ZV8');
</script>	 
<header>
  <nav>
    <h1>JSON Formatter & Validator</h1>
    <ul>
      <li><a href="../index.html">Home </a></li>
	  	  <!-- 🔽 TOOLS DROPDOWN -->
      <li class="dropdown">
       <a href="#" class="tools-link">Tools</a>
 
        <div class="dropdown-content">

          <div class="dropdown-section">
            <p>Converters</p>
            <a href="../tools/converters/json-to-sql.php">🗄️ JSON → SQL</a>
            <a href="../tools/converters/json-to-yaml.php">⚙️ JSON → YAML</a>
            <a href="../tools/converters/json-to-xml.php">🔄 JSON → XML</a>
          </div>

          <div class="dropdown-section">
            <p>Developer</p>
            <a href="../tools/converters/base64-tool.php">🔐 Base64 Tool</a>
            <a href="../tools/converters/uuid-generator.php">🆔 UUID Generator</a>
          </div>

        </div>
      </li>
	  <li><a href="../blog/index.html">Blog</a></li>
      <li><a href="../about-us.html">About Us</a></li>
      <li><a href="../contact-us.html">Contact Us</a></li>
      
    </ul>
  </nav>
</header>
	 
</head>

<?php

// Get slug from URL
$slug = $_GET['slug'] ?? '';


$posts = [

    "json-formatter-guide" => [
        "title" => "What is JSON Formatter? Complete Guide",
        "date" => "April 2026",
        "read_time" => "5 min read",
        "content" => "
            <p>A JSON Formatter is a tool that converts raw JSON into a clean, readable format.</p>

            <h2>Why Use JSON Formatter?</h2>
            <ul>
                <li>Improves readability</li>
                <li>Helps debug APIs</li>
                <li>Fixes formatting issues</li>
            </ul>

            <h2>Example</h2>
            <pre>{\"name\":\"Ashutosh\",\"age\":25}</pre>

            <p>Formatted Output:</p>

            <pre>{
  \"name\": \"Ashutosh\",
  \"age\": 25
}</pre>
        "
    ],

    "json-validator-guide" => [
        "title" => "JSON Validator Guide",
        "date" => "April 2026",
        "read_time" => "4 min read",
        "content" => "
            <p>A JSON Validator checks whether your JSON is valid or not.</p>

            <h2>Common Errors</h2>
            <ul>
                <li>Missing commas</li>
                <li>Invalid quotes</li>
                <li>Wrong structure</li>
            </ul>

            <h2>Tip</h2>
            <p>Always validate API responses before using them.</p>
        "
    ],

    "json-vs-xml" => [
        "title" => "JSON vs XML",
        "date" => "April 2026",
        "read_time" => "6 min read",
        "content" => "
            <p>JSON and XML are both data formats, but JSON is lightweight and faster.</p>

            <h2>Key Differences</h2>
            <ul>
                <li>JSON is faster</li>
                <li>XML is more verbose</li>
                <li>JSON is widely used in APIs</li>
            </ul>
        "
    ]

];

// Check if post exists
if (array_key_exists($slug, $posts)) {

    $post = $posts[$slug];
?>

<div class="post-container">

    <h1><?php echo $post['title']; ?></h1>

    <p class="meta">
        📅 <?php echo $post['date']; ?> • ⏱ <?php echo $post['read_time']; ?>
    </p>

    <div class="post-content">
        <?php echo $post['content']; ?>
    </div>

</div>

<?php
} else {
    echo "<h2 style='text-align:center;'>❌ 404 - Post Not Found</h2>";
}

?>
<footer>
    <p>© 2026 JSON Formatter & Validator</p>
</footer>