const emailContainer = document.querySelector('.login-content')
const submitEmail = document.querySelector('.btn-submit')
const emailError = document.querySelector('.login-error')


submitEmail.addEventListener('click', (e)=>{
e.preventDefault()

if(document.querySelector('#email').value==''){
    error(emailError, "Email field can not be empty")
    return
}
fetch('/Login_web/login1.php', {
    method:'POST',
    body: new FormData(document.querySelector('.login-form'))
})
.then(res => res.json())
.then(data=>{
    console.log(data)

    if(data.status=='success'){
        otpContainer.style.display='block'
        emailContainer.style.display='none'
    }
    else
    error(emailError, "You are not registered with us")
})
window.location.replace("/Login_web/otp.php")
})


    function error(span, msg){
        span.textContent = msg
        span.style.color='red'
        setTimeout(()=>{span.textContent=""}, 3000)
    }