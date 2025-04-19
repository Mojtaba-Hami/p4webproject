let timers = {};

function startTimer(computerId) {
    const duration = document.getElementById(`duration-${computerId}`).value * 60;
    let remaining = duration;
    
    timers[computerId] = setInterval(() => {
        remaining--;
        document.getElementById(`timer-${computerId}`).textContent = 
            new Date(remaining * 1000).toISOString().substr(11, 8);
        
        if(remaining <= 0) clearInterval(timers[computerId]);
    }, 1000);
}

function stopTimer(computerId) {
    clearInterval(timers[computerId]);
    // ارسال درخواست Ajax برای ذخیره اطلاعات
}