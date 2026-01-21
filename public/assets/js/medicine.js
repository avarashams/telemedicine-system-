document.addEventListener("DOMContentLoaded",() =>{

    const cart ={};

    const medicines= [
        {name: "Napa 500mg", price:10},
        {name: "Fexo 120mg", price:12},
        {name: "paracetamol", price:5},
        {name: "Omeprazole", price:10},
        {name: "Multivitamin", price:22},
        {name: "MaxOmega", price:3.4},
        {name: "Antazol", price:20},
        {name: "Sq-Mysetin", price:36},
    ];

    const searchInput = document.getElementById("searchMedicine");
    const medicineList = document.getElementById("medicineList");
    const totalPrice_ = document.getElementById("totalPrice");
    const purchasedSummary = document.getElementById("purchasedSummary");
    const addToCartBtn = document.querySelector(".add_to_cart");
    

    function renderMedicines(list){
        medicineList.innerHTML="";

        if(list.length===0){
            medicineList.innerHTML=`<p class="no-result"> No medicines found</p>`;
            updateTotal();
            return;
        }
        list.forEach(med =>{
            const item = document.createElement("div");
            item.classList.add("item");

            item.dataset.price = med.price;
            item.dataset.name =med.name;
            const qty = cart[med.name] || 0;
            item.innerHTML= `
            <div class = "info">
                <h4>${med.name}</h4>
                <span class="price"> tk${med.price} /tablet</span>
            </div>
            <div class="quantity">
                <button class="btnMinus">-</button>
                <span class="qty">0</span>
                <button class="btnPlus">+</button>
            </div>
            `;
            medicineList.appendChild(item);
        });
        attachEvents();
        updateTotal();
    }

   function attachEvents() {
        const items = document.querySelectorAll(".item");

        items.forEach(item => {
            const minusBtn = item.querySelector(".btnMinus");
            const plusBtn = item.querySelector(".btnPlus");
            const qtySpan = item.querySelector(".qty");

            const name = item.dataset.name;

            minusBtn.addEventListener("click", () => {
                if (cart[name] > 0) {
                    cart[name]--;
                    qtySpan.innerText = cart[name];
                    updateTotal();
                }
            });

            plusBtn.addEventListener("click", () => {
                cart[name] = (cart[name] || 0) + 1;
                qtySpan.innerText = cart[name];
                updateTotal();
            });
        });
    }


    function updateTotal() {
        let total = 0;

        for (let med of medicines) {
            const qty = cart[med.name] || 0;
            total += qty * med.price;
        }

        totalPrice_.innerText = total.toFixed(2);
    }

    searchInput.addEventListener("input", () => {
        const keyword = searchInput.value.trim().toLowerCase();
        const filtered = medicines.filter(med =>
            med.name.toLowerCase().includes(keyword)
        );
        renderMedicines(filtered);
    });

    addToCartBtn.addEventListener("click", () => {
        purchasedSummary.innerHTML = "<h3>Purchased Items:</h3>";

        let hasItems = false;

        for (let med of medicines) {
            const qty = cart[med.name] || 0;
            if (qty > 0) {
                hasItems = true;
                const subTotal = (qty * med.price).toFixed(2);
                purchasedSummary.innerHTML +=
                    `<p>${med.name} x${qty} = tk${subTotal}</p>`;
            }
        }

        if (!hasItems) {
            purchasedSummary.innerHTML += `<p>No items added</p>`;
        }
    });
    renderMedicines(medicines);
});