const addCartItem = function(itemIndex) {
    const item = document.querySelectorAll('.productCards')[itemIndex];
    const itemName = item.querySelector('h5').textContent;
    const itemPrice = item.querySelector('.price').getAttribute('data-price'); // get the price 
  

      // Create an object with the cart item data
  const cartItemData = {
    name: itemName,
    price: itemPrice
  };

  // Retrieve existing cart data from local storage or initialize an empty array
  const existingCartData = JSON.parse(localStorage.getItem('cart')) || [];

  // Add the current cart item data to the existing cart data
  existingCartData.push(cartItemData);

  // Store the updated cart data in local storage
  localStorage.setItem('cart', JSON.stringify(existingCartData));
    //li cart
    const cartItem = document.createElement('li');
    const itemText = document.createTextNode(`${itemName} - ${itemPrice}`);
    cartItem.style.listStyle = 'none';
    cartItem.style.fontFamily = 'Calibri';

    
    // del btn on each item
    const deleteButton = document.createElement('button');
    deleteButton.innerHTML = '<i class="fa fa-trash"></i>';
    //style
    deleteButton.style.border = "none";
    deleteButton.style.marginLeft = '20px';
    deleteButton.style.color = 'rgb(3, 22, 87)';
    deleteButton.style.background = 'none';
    
    deleteButton.addEventListener('click', function() {
      cartItem.remove();
      const total = document.querySelector('#total');
      const totalPrice = Number(total.textContent.slice(13)) - parseFloat(itemPrice);
      total.textContent = `Total Price: ${totalPrice.toFixed(2)}`;
    });
  
    cartItem.appendChild(itemText);
    cartItem.appendChild(deleteButton);
    document.querySelector('#cart').appendChild(cartItem);
  
    // total
    const total = document.querySelector('#total');
    const totalPrice = Number(total.textContent.slice(13)) + parseFloat(itemPrice);
    total.textContent = `Total Price: ${totalPrice.toFixed(2)}`;
    total.style.fontSize ='18px';
    total.style.fontWeight = 'bold';
};
//   buttons
  const buttons = document.querySelectorAll('.addCart');
  buttons.forEach((button, index) => {
    button.addEventListener('click', () => addCartItem(index));
    button.addEventListener('click', () => alert("Successfully! Add to Cart"))
  });