document.getElementById("submitButton").addEventListener("click", function() {
    var name = document.getElementById("nameInput").value;
    if(name != "") {
        document.getElementById("nameForm").submit();
    }
});