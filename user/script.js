function sortProducts(order) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "shop.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            document.getElementById('product_list').innerHTML = xhr.responseText;
        }
    };
    xhr.send("order=" + order);
}

function filterProducts(type) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "shop.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            document.getElementById('product_list').innerHTML = xhr.responseText;
        }
    };
    xhr.send("product_type=" + type);
}

function updateCart() {
    // Send AJAX request to update cart contents
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "change.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Update cart contents after successful update
            document.getElementById('container_cart').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

function updateQuantity(productId, newQuantity) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "change_quantity.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Optionally, you can handle the response here
            console.log(xhr.responseText);
            // After updating quantity, you might want to update the cart contents
            updateCart();
        }
    };
    xhr.send("product_id=" + productId + "&new_quantity=" + newQuantity);
}


function removeProduct(productId) {
    // Send AJAX request to remove product from cart
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "change.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Update cart after successful removal
            updateCart();
        }
    };
    xhr.send("remove_product_id=" + productId);
}

var cartVisible = false;
var profileVisible = false;

function toggleCart() {
    const container = document.getElementById('content-wrapper');
    if (cartVisible) {
        // Close the cart
        container.style.display = 'none';
        cartVisible = false;
    } else {
        // Show the cart
        showCart();
        // Ensure profile is hidden when cart is shown
        hideProfile();
    }
}

function showCart() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var container = document.getElementById("content-wrapper");
            container.innerHTML = this.responseText;
            container.style.display = "block";
            cartVisible = true;

            // Hide profile if it's visible
            if (profileVisible) {
                hideProfile();
            }
        }
    };
    xhttp.open("GET", "change.php", true);
    xhttp.send();
}

function toggleProfile() {
    const container = document.getElementById('content-wrapper');
    if (profileVisible) {
        // Close the profile
        hideProfile();
    } else {
        // Show the profile
        showProfile();
        // Ensure cart is hidden when profile is shown
        hideCart();
    }
}

function showProfile() {
    const container = document.getElementById('content-wrapper');

    // Fetch profile.php content
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            container.innerHTML = this.responseText;
            container.style.display = 'block';
        }
    };
    xhttp.open("GET", "profile.php", true);
    xhttp.send();

    profileVisible = true;
}

function hideProfile() {
    const container = document.getElementById('content-wrapper');
    container.style.display = 'none';
    profileVisible = false;
}

function hideCart() {
    const container = document.getElementById('content-wrapper');
    container.style.display = 'none';
    cartVisible = false;
}



function calculateTotalSubtotal(cartTotal, isChecked) {
    var total = parseFloat(document.getElementById('total').textContent);
    
    // Calculate the new total based on checkbox state
    if (isChecked) {
        total += cartTotal; // Perform addition if checked
    } else {
        total -= cartTotal; // Perform subtraction if unchecked
    }
    
    // Ensure total is always positive
    if (total < 0) {
        total = 0;
    }
    
    // Update the total in the #total span
    document.getElementById('total').textContent = total.toFixed(2);
}

// Select all elements with the "i" tag and store them in a NodeList called "stars"
function handleStarRating(event) {
    const stars = document.querySelectorAll(".star_rating i");
  
    // Loop through the "stars" NodeList
    stars.forEach((star, index1) => {
      // Add an event listener that runs a function when the "click" event is triggered
      star.addEventListener("click", () => {
        // Loop through the "stars" NodeList Again
        stars.forEach((star, index2) => {
          // Add the "active" class to the clicked star and any stars with a lower index
          // and remove the "active" class from any stars with a higher index
          index1 >= index2 ? star.classList.add("active") : star.classList.remove("active");
        });
      });
    });
  }

  function validateForm() {
    var radios = document.getElementsByName("rate");
    var checked = false;
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            checked = true;
            break;
        }
    }
    if (!checked) {
        alert("Please select a rating out of 5.");
        return false;
    }
    return true;
}