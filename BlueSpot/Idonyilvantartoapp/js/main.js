// Define UI Vars
const newEvent = document.querySelector('#newEvent')
const modalId = document.querySelector('#newEventModal')
const modalContainer = document.querySelector('.modal-container')
const closeBtn = document.querySelector('.close-btn')
const cancelBtn = document.querySelector('#cancel')



// Load all event listeners
loadEventListeners();

// Load all event listeners func
function loadEventListeners() {
    newEvent.addEventListener('click', openModal)
    closeBtn.addEventListener('click', closeModal)
    cancelBtn.addEventListener('click', closeModal)

}


function openModal() {
    modalId.classList.add("display")
    modalContainer.classList.add('display')
}

function closeModal(e) {
    modalId.classList.remove("display")
    modalContainer.classList.remove('display')
    
}

