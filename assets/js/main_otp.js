
const otpContainer = document.querySelector('.otp-content')
const submitOtp = document.querySelector('.btn-otp-submit')
const otpError = document.querySelector('.otp-error')

// submit OTP eventlisterner logic

submitOtp.addEventListener('click', (e)=>{
    e.preventDefault()
    console.log('submit otp')
    if(document.querySelector('#otp').value==''){
        error(otpError, "OTP field can not be empty")
        return
    }
    
    fetch('/Login_web/login1.php', {
        method:'POST',
        body: new FormData(document.querySelector('.otp-form'))
    })
    .then((response) => response.json())
    .then(data=>{
        if(data.status =='success'){
           window.location.replace("/Login_web/home.php")
        }
        else
        error(otpError, "Incorrect OTP provided")
    })
    
    })

    function error(span, msg){
        span.textContent = msg
        span.style.color='red'
        setTimeout(()=>{span.textContent=""}, 3000)
    }

    
 	