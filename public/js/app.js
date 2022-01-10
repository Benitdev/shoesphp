// back to top
const btnBackToTop = document.querySelector('.back-to-top')
const header = document.querySelector('.header-home-nav')
btnBackToTop.onclick = () => {
  window.scrollTo({top: 0})
}
const handleScroll = () => {
  btnBackToTop.classList.toggle('active', window.scrollY > 200)
  header.classList.toggle('active', window.scrollY > 200)
}
handleScroll()
window.onscroll = handleScroll
// open menu
openMenu = () => {
  let menu = document.querySelector('.menu-overlay')
  let hamburger = document.querySelector('.hamburger')

  menu.classList.toggle('active')
  hamburger.classList.toggle('active')
  setTimeout(() => {
    menuLogin.style.marginTop = '0'
  }, 500)
}
// handle slider
let productIndex = 0;

let productInfos = document.querySelectorAll('.product-info-main')

setTimeout(() => {
  productInfos[productIndex].classList.add('active')
}, 300)

let isSlide = false

slide = () => {
  if (isSlide) return

  isSlide = true
  let currProduct = document.querySelector('.product-info-main.active')
  currProduct.classList.remove('active')
  productIndex = productIndex + 1 == productInfos.length ? 0 : productIndex + 1
  productInfos[productIndex].classList.add('active')

  let listItems = document.querySelectorAll('.slide')
  let reverseItems = Array.from(listItems).slice().reverse()
  let slider = document.querySelector('.slider')

  let currSlide = document.querySelector('.slide.active')
  currSlide.classList.remove('active')

  listItems[productIndex].classList.add('active')
  /* 
    left = reverseItems[0].offsetLeft + 'px'
    height = reverseItems[0].offsetHeight + 'px'
    width = reverseItems[0].offsetWidth + 'px'
    zIndex = reverseItems[0].style.zIndex
  
    reverseItems.forEach((item, index) => {
      if (index < (listItems.length - 1)) {
        item.style.left = reverseItems[index + 1].offsetLeft + 'px'
        item.style.height = reverseItems[index + 1].offsetHeight + 'px'
        item.style.width = reverseItems[index + 1].offsetWidth + 'px'
        item.style.transform = 'unset'
        item.style.opacity = '1'
      }
  
      if (index == (listItems.length - 1)) {
        item.style.transform = 'scale(1.5)'
        item.style.opacity = '0'
        let cln = item.cloneNode(true)
  
        setTimeout(() => {
          
          item.remove()
          cln.style.left = left
          cln.style.height = height
          cln.style.width = width
          cln.style.transform = 'scale(0)'
          slider.appendChild(cln)
  
          isSlide = false
        }, 1000)
      }
    }) */
  setTimeout(() => {

    isSlide = false
  }, 1000)

}

let slideControl = document.querySelector('.slide-control')

slideControl.onclick = () => {
  slide()
}
//  quick view

const images = document.querySelectorAll(".product-list-item img");
const quickView = document.querySelector(".quick-view");
const quickViewImg = document.querySelector(".quick-view-wrap .image img");
const close = document.querySelector(".quick-view .close");
const btnEye = document.querySelectorAll(".product-list-item-hover .eye")
const next = document.querySelector(".control.next");
const prev = document.querySelector(".control.prev");

let currentIndex = 0;

btnEye.forEach((eye, index) => {
  eye.addEventListener("click", () => {
    currentIndex = index;
    showQuickView();
  });
});

function showQuickView() {
  currentIndex == images.length - 1
    ? next.classList.add("hide")
    : next.classList.remove("hide");

  currentIndex == 0
    ? prev.classList.add("hide")
    : prev.classList.remove("hide");

  quickView.classList.add("show");
  quickViewImg.src = images[currentIndex].src;
}

close.addEventListener("click", () => {
  quickView.classList.remove("show");
});

next.addEventListener("click", () => {
  currentIndex++
  showQuickView();
});
prev.addEventListener("click", () => {
  currentIndex--
  showQuickView();
});

// esc click
document.addEventListener("keydown", (e) => {
  if (e.keyCode == 27) quickView.classList.remove("show");
});

// login click
if (document.querySelector('.li-login')) {
  let cdLogin = document.querySelector('.li-login')
  let menuLogin = document.querySelector('.menu-overlay .menu')
  let loginForm = document.querySelector('.login-form')
  let registerForm = document.querySelector('.register-form')

  cdLogin.onclick = () => {
    console.log(menuLogin)
    menuLogin.style.marginTop = 'calc(5rem - 100vh)'
    loginForm.style.visibility = 'visible'
  }
  // register click
  let cdRegister = document.querySelector('.cd-register')
  cdRegister.onclick = () => {
    menuLogin.style.marginTop = 'calc(10rem - 200vh)'
    registerForm.style.visibility = 'visible'
  }
  // exit sign up

  let btnExitSignUp = document.querySelectorAll('.btn-exit')

  btnExitSignUp[0].onclick = () => {
    menuLogin.style.marginTop = '0'
    loginForm.style.visibility = 'hidden'
  }
  btnExitSignUp[1].onclick = () => {
    menuLogin.style.marginTop = 'calc(5rem - 100vh)'
    registerForm.style.visibility = 'hidden'
  }
}
//validator form register
{
  const form = document.querySelector('.form-register')
  const firstname = document.getElementById('reg-firstname')
  const lastname = document.getElementById('reg-lastname')
  const email = document.getElementById('reg-email')
  const phone = document.getElementById('reg-phone')
  const password = document.getElementById('reg-pass')
  const password2 = document.getElementById('confirm-pass')

  // Show input error message
  function showError(input, message) {
    const formControl = input.parentElement
    formControl.className = 'txt-field error'
    const small = formControl.querySelector('small')
    small.innerText = message
  }

  // Show success outline
  function showSuccess(input) {
    const formControl = input.parentElement
    formControl.className = 'txt-field'
    const small = formControl.querySelector('small')
    small.innerText = ''
  }
  // Check email is valid
  function checkEmail(input) {
    const re =
      /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

    if (re.test(input.value.trim())) {
      let txt = $('#reg-email').val()
      $.post("./ajax/checkemail", { un: txt }, function (data) {
        if (data == 1)
          showError(input, 'Email đã tồn tại')
        else
          showSuccess(input)
      })
      return true
    } else {
      showError(input, 'Email không hợp lệ')
    }
  }

  // Check required fields
  function checkRequired(inputArr) {
    let isRequired = false
    inputArr.forEach(function (input) {
      if (input.value.trim() === '') {
        showError(input, `${getFieldName(input)} is required`)
        isRequired = true
      } else {
        showSuccess(input)
      }
    })

    return isRequired
  }

  // Check input length
  function checkLength(input, min, max) {
    if (input.value.length < min) {
      showError(
        input,
        `${getFieldName(input)} phải lớn hơn ${min} kí tự`
      )
    } else if (input.value.length > max) {
      showError(
        input,
        `${getFieldName(input)} phải bé hơn ${max} kí tự`
      )
    } else {
      showSuccess(input)
      return true
    }
  }

  // Check passwords match
  function checkPasswordsMatch(input1, input2) {
    if (input1.value !== input2.value) {
      showError(input2, 'Mật khẩu không khớp')
    }
    else {
      showSuccess(input2)
      return true
    }
  }

  // Get fieldname
  function getFieldName(input) {
    return input.id.charAt(0).toUpperCase() + input.id.slice(1)
  }

  // Event listeners
  email.addEventListener('change', () => {
    checkEmail(email)
  })
  password.addEventListener('change', () => {
    checkLength(password, 6, 25)
  })
  password2.addEventListener('change', () => {
    checkPasswordsMatch(password, password2)
  })

  form.addEventListener('submit', function () {
    if (checkLength(password, 6, 25) && checkEmail(email) && checkPasswordsMatch(password, password2)) {
      let firstname = $('#reg-firstname').val()
      let lastname = $('#reg-lastname').val()
      let email = $('#reg-email').val()
      let phone = $('#reg-phone').val()
      let pass = $('#confirm-pass').val()
      let gender
      $('.btn-radio').each((index, value) => {
        if (value.checked == true)
          gender = value.value
      })

      $.post("./ajax/register", {
        firstname: firstname,
        lastname: lastname,
        email: email,
        phone: phone,
        pass: pass,
        gender: gender
      }, (data) => {
        console.log(data)
        if (data == 1) {
          $('.register-success').addClass('active')
          $('.form-register').css({ 'display': 'none' })
          $('.register').css({ 'background': 'rgba(54, 189, 54, 0.829)' })
        }
      })
    }

  })
}

// ajax check login
$(document).ready(() => {
  //ajax login
  $('.btn-login').click(() => {
    let idLogin = $('#id-login').val()
    let password = $('#pass-login').val()
    if (idLogin != '') {
      $.post("./ajax/login", {
        idlogin: idLogin,
        password: password,
      }, (data) => {
        if (data == 2) {
          location.reload(true)
          // $('.check-login').html(data)
        }
        else
          if (data == 1) {
            $('.check-login').css({ 'opacity': '1' })
            $('.check-login').html('Mật khẩu không đúng!')
            setTimeout(() => {
              $('.check-login').css({ 'opacity': '0' })
            }, 3000)
          }
          else {
            $('.check-login').css({ 'opacity': '1' })
            $('.check-login').html('Tài khoản không tồn tại!')
            setTimeout(() => {
              $('.check-login').css({ 'opacity': '0' })
            }, 3000)
          }
      })
    }
  })

})

$('.product-list-wrap').slick({
  slidesToShow : 4,
  // slidesToScroll: 4,
  Infinity: true,
  autoplay: true,
  autoplaySpeed: 2000,
  // dots: true
  prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-arrow-left"></i></button>',
  nextArrow: '<button type="button" class="slick-next"><i class="fas fa-arrow-right"></i></button>',
})