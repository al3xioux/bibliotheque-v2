function generercode() {
    var code = Math.random().toString(36).slice(2, 7);
    document.getElementById("code").value = "" + code + "";
}

