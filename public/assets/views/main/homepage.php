/* Basic Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    color: #333;
    line-height: 1.6;
    padding: 20px;
}

/* Header styles */
header {
    background: #007bff;
    color: #fff;
    padding: 10px 20px;
    text-align: center;
}

header h1 {
    margin: 0;
}

/* Main content area styling */
main {
    margin-top: 20px;
}

/* Events container */
#upcoming-events {
    margin-top: 20px;
}

.event {
    background: #fff;
    margin-bottom: 10px;
    padding: 10px 20px;
    border-left: 5px solid #007bff;
}

/* Forms and buttons */
input[type="text"], input[type="date"], input[type="time"] {
    width: calc(100% - 22px);
    padding: 10px;
    margin-top: 5px;
}

button {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 20px;
    margin-top: 10px;
    cursor: pointer;
}

button:hover {
    background-color: #218838;
}

/* Responsive adjustments */
@media (max-width: 600px) {
    body {
        padding: 10px;
    }

    header {
        padding: 10px;
    }
}
