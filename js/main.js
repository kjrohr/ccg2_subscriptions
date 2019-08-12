document.addEventListener('DOMContentLoaded', () => {

    let expired = document.getElementsByClassName("status");
    for (let i =0; i < expired.length; i++) {
        expired[i].parentElement.classList.remove("row");
        expired[i].parentElement.classList.add("expired");
    }


});