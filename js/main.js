document.addEventListener('DOMContentLoaded', () => {

    // Variables captured from the dom
    let expired = document.getElementsByClassName("status");
    let firstName = document.getElementById("firstName");
    let lastName = document.getElementById("lastName");
    let addForm = document.forms["addForm"];

    console.log(addForm);



    // For the index, this colors the rows red
    for (let i =0; i < expired.length; i++) {
        expired[i].parentElement.classList.remove("row");
        expired[i].parentElement.classList.add("expired");
    }
    

    // Validation for text inputs

});

