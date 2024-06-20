function notificationMesssageNew(user, message) {
    const messagealertsend = document.getElementById('messagealertsend');
    
    const divelement = document.createElement('div');

    divelement.innerHTML = '<b>' + user + ':</b> '  + message;
    divelement.classList.add('alert', 'alert-dark');
    divelement.setAttribute('role', 'alert');
    messagealertsend.appendChild(divelement);

    setTimeout(function() {
        divelement.remove();
    }, 4000);
    console.log(user + ': ' + message);
}