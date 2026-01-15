        function toggleExtra() {
    let checkBox = document.getElementById("addMore");
    let extraSection = document.getElementById("extraSection");
    if (checkBox.checked) {
        extraSection.classList.remove("d-none");     // show
        extraSection.classList.add("d-flex", "justify-content-between", "align-items-center");
    } else {
        extraSection.classList.add("d-none");        // hide
        extraSection.classList.remove("d-flex", "justify-content-between", "align-items-center");
    }
}
  