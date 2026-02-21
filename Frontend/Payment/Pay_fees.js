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

function togglePre() {
    let checkBox = document.getElementById("preDue")
    let onlypayment = document.getElementById("OnlyPayment")
    let predueSection = document.getElementById("predueSection")
    if (checkBox.checked) {
        predueSection.classList.remove("d-none");     
        onlypayment.style.display = "none";
        predueSection.classList.add("d-flex", "justify-content-between", "align-items-center");
    } else {
        predueSection.classList.add("d-none");        
        onlypayment.style.display = "";
        predueSection.classList.remove("d-flex", "justify-content-between", "align-items-center");
    }
}
