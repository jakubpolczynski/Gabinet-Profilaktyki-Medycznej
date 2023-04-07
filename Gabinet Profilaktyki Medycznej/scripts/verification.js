function readCookie(name) { 
    var i, c, ca, nameEQ = name + "="; 
    ca = document.cookie.split(';'); 
    for(i=0;i < ca.length;i++) { 
        c = ca[i]; 
        while (c.charAt(0)==' ') { 
            c = c.substring(1,c.length);
        } 
        if (c.indexOf(nameEQ) == 0) { 
            return c.substring(nameEQ.length,c.length); 
        }
    }
    
    return 'error'; 
}

function verifyCookie(name) {
    if (readCookie('username') == 'error')
        window.location.href = '../index.html';
}
function verifyAdmin(name) {
    if(readCookie('username') != 'admin')
        window.location.href = '../index.html';
}