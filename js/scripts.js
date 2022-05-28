
let formSugar = document.getElementById('formSugar');
let formMeal = document.getElementById('formMealTime');
formSugar.addEventListener('show.bs.collapse', event => {
    formMeal.classList.remove('show');
})
formMeal.addEventListener('show.bs.collapse', event => {
    formSugar.classList.remove('show');
})