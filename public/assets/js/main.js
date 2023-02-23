function addProduct()
{
    document.getElementById("product-add-btn")
    {
        location.href = "/addproduct"
    }
}

function saveProduct() {
    let dataForSend = {}

    let inputs = Array.from(document.querySelectorAll("#product-form input"))

    inputs = inputs.filter(i => i.value)

    inputs.forEach(i => dataForSend[i.id] = i.value)
    dataForSend["product_type"] = document.querySelector("#productType").value

    $.ajax({
        type: "POST",
        url: "addproduct",
        data: dataForSend,
    }).done(function () {
        let inputs = Array.from(document.querySelectorAll("#product-form input"))
        // inputs.map(p => p.value = "")
        for(let index in inputs) {
            inputs[index].value = ""
        }

        // location.href = "/"
        console.log(dataForSend)
    })
}

function cancel()
{
    document.getElementById("product-cancel-btn")
    {
        location.href = "/"
    }
}

function typeSwitcher()
{
    let productsInput = Array.from(document.querySelectorAll(".products input"))
    for (let index in productsInput) productsInput[index].value = ""

    let dvd = $(".dvd-container")
    let furniture = $(".furniture-container")
    let book = $(".book-container")

    let typeValue = document.querySelector("#productType").value

    if (typeValue === "dvd") dvd.css("display", "block")
    else dvd.css("display", "none")

    if (typeValue === "furniture") furniture.css("display", "block")
    else furniture.css("display", "none")

    if (typeValue === "book") book.css("display", "block")
    else book.css("display", "none")
}

function deleteProduct()
{
    //todo
}
