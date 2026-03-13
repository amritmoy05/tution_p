const $ = id => document.getElementById(id);
const show = (id, v) => $(id).style.display = v;

function toggleExtra(){
    show("extraSection", $("addMoreCheck").checked ? "flex" : "none");
}

function togglePre(){
    const c = $("preDue").checked;

    show("predueSection", c ? "flex" : "none");
    show("addMore", c ? "none" : "");
    show("preDueMainBox", c ? "none" : "");
    show("OnlyPayment", c ? "none" : "");

    if(c){
        $("addMoreCheck").checked = false;
        $("PreDueMainCheck").checked = false;
        show("extraSection","none");
        show("PreDueMain","none");
    }
}

function togglePreMonth(){
    const c = $("PreDueMainCheck").checked;

    show("addMore", c ? "none" : "");
    show("preDueBox", c ? "none" : "");
    show("PreDueMain", c ? "flex" : "none");
}