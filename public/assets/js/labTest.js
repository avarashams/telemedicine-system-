document.addEventListener("DOMContentLoaded",()=>{
    const labTests=[
        {
            id: 1,
            name: "Allergy Skin Test",
            price: 399,
            availability: "Saturday to Friday [7:00 pm- 9:00 pm]",
            location: "Mirpur 11 Popular Diagnostic Center"
        },
        {
            id: 2,
            name: "Blood Test",
            price: 800,
            availability: "Sunday to Thursday [8:00 am- 6:00 pm]",
            location: "Apollo Hospital, Bashundhara"
        },
        {
            id: 3,
            name: "Fluid Test",
            price: 600,
            availability: "Sunday to Thursday [9:00 am- 5:00 pm]",
            location: "United Hospital, Gulsan"
        },
        {
            id: 4,
            name: "Blood Test",
            price: 800,
            availability: "Sunday to Thursday [8:00 pm- 6:00 pm]",
            location: "Apollo Hospital, Bashundhara"
        },
        {
            id: 5,
            name: "MRI",
            price: 4000,
            availability: "Sunday to Thursday [8:00 pm- 6:00 pm]",
            location: "United Hospital, Gulsan"
        },
         {
            id: 6,
            name: "Endoscopy",
            price: 3500,
            availability: "Sunday to Thursday [8:00 pm- 6:00 pm]",
            location: "Mirpur 11 Popular Diagnostic Center"
        }  
    ];

    const searchInput = document.getElementById("searchTest");
    const testList=document.getElementById("testList");

    function renderCompact(test){
        return `
            <div class="test-card compact">
                <div>
                    <h4>${test.name}</h4>
                    <p class="location">Location: ${test.location}</p>
                </div>
                <button class="book-btn"> Book Appointment</button>
            </div>
        `;
    }

    function renderDetailed(test){
        return `
            <div class="test-card detailed">
                <div class="header">
                    <h3>${test.name}</h3>
                    <button class="book-btn">Book Apointment</button>
                </div>

                <p><strong>Available:</strong> ${test.availability}</p>
                <p><strong>Fees:</strong> ${test.price}</p>
                <p><strong>Location:</strong> ${test.location}</p>


            </div>
        `;
    }


    function renderTests(tests,detailed=false){
        testList.innerHTML="";

        if(tests.length===0){
            testList.innerHTML = `<p class="no-result">No Tests Found</p>`;
            return;
        }

        tests.forEach(test =>{
            testList.innerHTML += detailed 
            ? renderDetailed(test)
            : renderCompact(test);
        });
    }

searchInput.addEventListener("input",()=>{
    const keyword = searchInput.value.trim().toLowerCase();

    if (keyword === ""){
        renderTests(labTests.slice(0,3));
        return;
    }
    const filtered = labTests.filter(test=>
        test.name.toLowerCase().includes(keyword)
    );
    renderTests(filtered,true);

});
renderTests(labTests.slice(0,3));
});