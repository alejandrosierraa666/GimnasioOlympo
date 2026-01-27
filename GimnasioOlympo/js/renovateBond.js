let form = document.getElementById('renovateForm')
let renovateDate = document.getElementById('renovateDate')
let renovateCapa = document.getElementById('renovateCapa')
let renovateEerror = document.getElementById('renovateError')
let renovateSelect = document.getElementById('renovateSelect')
form.addEventListener('submit', (e)=>chechDate(e))

function chechDate(e){
    e.preventDefault()
    renovateEerror.style.display = 'none'

    if(!renovateSelect.value || renovateSelect.value === 'none'){
        renovateEerror.style.display = 'block'
        renovateEerror.textContent = 'Debes seleccionar un usuario'
        window.scrollTo(0, renovateCapa.offsetTop - 20)
        return
    }
    
    let currentDate = new Date()
    let selectedDate = new Date(renovateDate.value)

    if(selectedDate <= currentDate){
        renovateEerror.style.display = 'block'
        renovateEerror.textContent = 'La fecha de renovación debe ser posterior a la fecha actual'
        window.scrollTo(0, renovateCapa.offsetTop - 20)

    }else if(!renovateDate.value){

        renovateEerror.style.display = 'block'
        renovateEerror.textContent = 'Debes seleccionar una fecha'
        window.scrollTo(0, renovateCapa.offsetTop - 20)
    }else{
        form.submit()
    }
}