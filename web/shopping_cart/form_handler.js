/**
 * Created by Frank on 5/14/2017.
 */
function updateCart(){
    var numItemsText = document.getElementById("cart_items");

    var spinner1 = document.getElementById("spinner1").value;
    var spinner2 = document.getElementById("spinner2").value;
    var spinner3 = document.getElementById("spinner3").value;
    var spinner4 = document.getElementById("spinner4").value;
    var spinner5 = document.getElementById("spinner5").value;
    var spinner6 = document.getElementById("spinner6").value;

    var numItems = Number(spinner1) + Number(spinner2) + Number(spinner3) + Number(spinner4) + Number(spinner5)
        + Number(spinner6);

    numItemsText.innerHTML = " Cart " + numItems;
}