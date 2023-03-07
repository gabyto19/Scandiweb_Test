function addProduct()
{
    $("#product-add-btn")
    {
        location.href = "/addproduct"
    }
}

function cancel()
{
    $("#product-cancel-btn")
    {
        location.href = "/"
    }
}

function typeSwitcher()
{
    let dvd = $(".dvd-container")
    let furniture = $(".furniture-container")
    let book = $(".book-container")
    let typeValue = $("#productType").val()

    if (typeValue === "Dvd") dvd.show()
    else dvd.hide()

    if (typeValue === "Furniture") furniture.show()
    else furniture.hide()

    if (typeValue === "Book") book.show()
    else book.hide()
}

function deleteProduct()
{
    let ids = []
    let checkboxes = Array.from($(".delete-checkbox"))

    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            ids.push(checkbox.value)
        }
    })

    // checkboxes.forEach(checkbox => checkbox.checked && ids.push(checkbox.value))

    if (ids.length > 0) {
        $.ajax({
            type: "POST",
            url: "massdelete",
            data: {
                ids: ids
            },
        }).then((resp) => {
            console.log("massdelete then", resp)
            location.reload()
        }).catch((err) => {
            console.log("massdelete catch", err)
        })
    }
}

function postedData(){
    let postData = {}
    let mainInputs = Array.from($(".product-inputs input"))
    let productType = $("#productType").val()
    let productInputs = Array.from($(`#${productType} input`))

    let total = [...mainInputs, ...productInputs]
    postData["product_type"] = productType
    total.forEach(i => postData[i.id] = i.value )

    $.ajax({
        type: "POST",
        url: "addproduct",
        data: postData,
    }).then(() => {
        location.href = "/"
    }).catch((err) => {
        let errors = JSON.parse(err.responseText)
        let myDiv = $("<div class='error'>")
        let myUl = $("<ul>")

        errors.forEach(err => {
            let myLi = $("<li>").text(err)
            myUl.append(myLi)
        })

        // clear old error message
        $(".error").remove()
        myDiv.append(myUl)
        $(".product-inputs").before(myDiv)
    })
}