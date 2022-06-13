
let formSugar = document.getElementById('formSugar');
let formMeal = document.getElementById('formMealTime');
if(formSugar){
    formSugar.addEventListener('show.bs.collapse', event => {
        formMeal.classList.remove('show');
    })
}
if(formMeal){
    formMeal.addEventListener('show.bs.collapse', event => {
        formSugar.classList.remove('show');
    })
}

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl, {
        container: document.querySelector('#tooltipContainer')
    });
})
