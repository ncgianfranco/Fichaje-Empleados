function setCurrentTime(modalId){
    // Dado el id de un popup, actualiza la hora de su span.check-time
    var fechaActual = new Date();
    var horaActual = fechaActual.getHours() + ':' + (fechaActual.getMinutes() < 10 ? '0' : '') + fechaActual.getMinutes();
    var modal = document.getElementById(modalId);
    var checkTimeSpan = modal.querySelectorAll(".check-time")[0];
    checkTimeSpan.innerText=horaActual + "h";
}

