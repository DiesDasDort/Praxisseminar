function setWorkspaceDropdown() {

    var select = document.getElementById("D1"),
        opt1 = document.createElement("option");
        opt2 = document.createElement("option");
        opt3 = document.createElement("option");

    opt1.value="value";
    opt1.textContent="Spinnen Angst";
    select.appendChild(opt1);

    opt2.value="value";
    opt2.textContent="No Homo Angst";
    select.appendChild(opt2);

    opt3.value="value";
    opt3.textContent="Wimmer Hass";
    select.appendChild(opt3);
}
