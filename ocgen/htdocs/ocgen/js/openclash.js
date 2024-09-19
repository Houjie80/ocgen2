// Membuat fungsi yang akan ditampilkan sebagai output
function displayOutput(output, elementId) {
    var element = document.getElementById(elementId);
    element.innerHTML = output;
}

// Menjalankan fungsi check_clash_status secara otomatis setiap satu detik
setInterval(function() {
    // Membuat request ke api.php untuk check_clash_status
    var xhrClash = new XMLHttpRequest();
    xhrClash.open("POST", "api.php", true);
    xhrClash.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhrClash.onreadystatechange = function() {
        if (xhrClash.readyState === 4 && xhrClash.status === 200) {
            // Mengambil response dari api.php
            var responseClash = JSON.parse(xhrClash.responseText);
            
            // Menampilkan output berdasarkan response
            displayOutput(responseClash.data.clash ? '<em><b class="clash-status">Running</b></em>' : '<em><b style="color:red">Not Running</b></em>', 'clash_status');
        }
    };

    // Mengatur data yang akan dikirim dalam request
    var requestDataClash = {
        action: 'check_clash_status'
    };

    xhrClash.send(JSON.stringify(requestDataClash));

    // Membuat request ke api.php untuk check_uptime_status
    var xhrUptime = new XMLHttpRequest();
    xhrUptime.open("POST", "api.php", true);
    xhrUptime.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhrUptime.onreadystatechange = function() {
        if (xhrUptime.readyState === 4 && xhrUptime.status === 200) {
            // Mengambil response dari api.php
            var responseUptime = JSON.parse(xhrUptime.responseText);
            
            // Menampilkan output asli dari response
            displayOutput(responseUptime.data.uptime, 'uptime');
        }
    };

    // Mengatur data yang akan dikirim dalam request
    var requestDataUptime = {
        action: 'check_uptime_status'
    };

    xhrUptime.send(JSON.stringify(requestDataUptime));
}, 1000);
