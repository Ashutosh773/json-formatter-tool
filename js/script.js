function formatJSON() {
    let input = document.getElementById("jsonInput").value;
    let output = document.getElementById("output");

    try {
        let obj = JSON.parse(input);
        output.textContent = JSON.stringify(obj, null, 4);
        output.style.color = "lightgreen";
    } catch (e) {
        output.textContent = "Invalid JSON: " + e.message;
        output.style.color = "red";
    }
}

function validateJSON() {
    let input = document.getElementById("jsonInput").value;
    let output = document.getElementById("output");

    try {
        JSON.parse(input);
        output.textContent = "✅ Valid JSON";
        output.style.color = "lightgreen";
    } catch (e) {
        output.textContent = "❌ Invalid JSON: " + e.message;
        output.style.color = "red";
    }
}

function clearJSON() {
    document.getElementById("jsonInput").value = "";
    document.getElementById("output").textContent = "";
}

function copyJSON() {
    let text = document.getElementById("output").textContent;
    navigator.clipboard.writeText(text);
    alert("Copied!");
}

