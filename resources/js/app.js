import './bootstrap';

function showToastMessage(duration) {
    var toastMessage = document.getElementById("toast-message");
    toastMessage.classList.add("show-toast-message");
    setTimeout(function(){ toastMessage.className = toastMessage.classList.remove("show-toast-message"); }, duration);
}
window.showToastMessage = showToastMessage;