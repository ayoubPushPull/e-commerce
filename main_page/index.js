//la function ready
function ready() {
    //supprimer produit
    var removeCartButtons = document.getElementsByClassName('cart_remove')
    console.log(removeCartButtons)
    for (var i = 0; i < removeCartButtons.length; i++) {
        var button = removeCartButtons[i]
        button.addEventListener('click', removeCartItem)
    }


    //quantity change
    var quantityInputs = document.getElementsByClassName('cart_quantite')
    for (var i = 0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i];
        input.addEventListener('change', quantityChanged);
    }
    //ajouter au Chariot
    var addCart = document.getElementsByClassName('add-cart');
    for (var i = 0; i < addCart.length; i++) {
        var button = addCart[i];
        button.addEventListener('click', addCartClicked);
    }
    //buy button work
    document.getElementsByClassName('btn_buy')[0].addEventListener('click', buyButtonClicked);
}
//buy button function
function buyButtonClicked() {
    alert('your order is placed');
    var cartContent = document.getElementsByClassName('cart_content')[0];
    while (cartContent.hasChildNodes()) {
        cartContent.removeChild(cartContent.firstChild);
    }
    updatetotal();
}

//supprimer produit function
function removeCartItem(event) {
    var buttonClicked = event.target
    buttonClicked.parentElement.remove()
    updatetotal();
}
//quantite change function
function quantityChanged(event) {
    var input = event.target;
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1;
    }
    updatetotal();
}
//ajouter to chariot function
function addCartClicked(event) {
    var button = event.target;
    var shopProducts = button.parentElement;
    var title = shopProducts.getElementsByClassName('product_title')[0].innerText;
    var prix = shopProducts.getElementsByClassName('prix')[0].innerText;
    var productImg = shopProducts.getElementsByClassName('product_img')[0].src;
    console.log(title, prix, productImg);
    addProductToCart(title, prix, productImg);
    updatetotal();
}


function addProductToCart(title, prix, productImg) {
    var cartShopBox = document.createElement("div");
    cartShopBox.classList.add('cart_box')
    var cartItems = document.getElementsByClassName('cart_content')[0];
    var cartItemsNames = cartItems.getElementsByClassName('cart_product_title');
    for (var i = 0; i < cartItemsNames.length; i++) {
        if (cartItemsNames[i].innerText == title) {
            alert("You have already add this item to cart");
            return;
        }
    }

    var cartBoxContent = `<img src="${productImg}" alt="" class="cart_img">
                        <div class="detail_box">
                            <div class="cart_product_title">${title}</div>
                            <div class="cart_price">${prix}</div>
                            <input type="number" id="a" value="1" class="cart_quantite">
                        </div>
                        <!--remove cart-->
                        <i class='bx bxs-trash-alt cart_remove'></i>`
    cartShopBox.innerHTML = cartBoxContent;
    cartItems.append(cartShopBox);
    document.getElementById('a').onChange = function() {
        alert('hhh');
    }

    cartShopBox.getElementsByClassName('cart_remove')[0].addEventListener('click', removeCartItem)
    cartShopBox.getElementsByClassName('cart_quantite')[0].addEventListener('change', quantityChanged)
}
//update total
function updatetotal() {
    var cartContent = document.getElementsByClassName('cart_content')[0];
    var cartBoxes = cartContent.getElementsByClassName('cart_box');
    var total = 0;
    for (var i = 0; i < cartBoxes.length; i++) {
        var cartBox = cartBoxes[i];
        var priceElement = cartBox.getElementsByClassName('cart_price')[0];
        var quantityElement = cartBox.getElementsByClassName('cart_quantite')[0];
        var price = parseFloat(priceElement.innerText.replace("$", ""));
        var quantity = quantityElement.value;
        total = total + (price * quantity);
    }
    //si le prix contien des petites changes
    total = Math.round(total * 100) / 100;
    document.getElementsByClassName('total_prix')[0].innerText = '$' + total;
}