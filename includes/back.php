<link rel="stylesheet" type="text/css" href="styles/back.css">

<button id="backBtn" class="back-button">
    <i class="fas fa-arrow-left"></i> Back
</button>
<script>
    function goBack() {
        window.history.back(); /* Navigates to the previous page in browser history */
    }

    document.getElementById("backBtn").addEventListener("click", goBack);
</script>