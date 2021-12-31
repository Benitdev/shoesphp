// on scroll
if (document.querySelector('.product-filter')) {
	let header = document.querySelector('.header-product')
	let filterTitle = document.querySelector('.product-filter-title')
	let sidebar = document.querySelector('.product-sidebar')
	let wrapper = document.querySelector('.wrapper')
	let scroll = 70
	window.addEventListener('scroll', () => {
		console.log(window.scrollY)
		if (window.scrollY > scroll + 1) {
			header.style.transform = 'translateY(-100%)'
			scroll = window.scrollY
			filterTitle.style.position = 'fixed'
			filterTitle.style.inset = '0'
			filterTitle.style.background = 'white'
			filterTitle.style.padding = '0 6rem'
			filterTitle.style.transform = 'translateY(0)'
			sidebar.style.marginTop = '0'
		} else {
			header.style.transform = 'translateY(0)'
			scroll = window.scrollY > 80 ? window.scrollY : 80
			filterTitle.style.transform = 'translateY(125%)'
			sidebar.style.marginTop = '5rem'
			if (scroll <= 80) {
				filterTitle.style.position = 'unset'
				filterTitle.style.transform = 'translateY(0)'
				filterTitle.style.padding = '1rem 0'
				sidebar.style.marginTop = '0'
			}
		}
		if (window.scrollY > wrapper.offsetHeight - 700)
			// console.log('cc')
			sidebar.style.transform = `translateY(${-(window.scrollY - (wrapper.offsetHeight - 700))}px)`
		else
			sidebar.style.transform = `translateY(0)`

	})
}

// handle product detail images
if (document.querySelector('.fa-chevron-right')) {
	let listDivImg = document.querySelectorAll('.sub-image div')
	let next = document.querySelector('.fa-chevron-right')
	let prev = document.querySelector('.fa-chevron-left')
	let imgWrap = document.querySelector('.main-image img')

	let currentIndex = 0

	if (imgWrap !== null)
		setCurrent(currentIndex)
	function setCurrent(index) {
		currentIndex = index
		imgWrap.src = listDivImg[currentIndex].querySelector('img').src

		// remove all active img
		listDivImg.forEach((item) => {
			item.classList.remove('active')
		})

		// set active
		listDivImg[currentIndex].classList.add('active')
	}

	listDivImg.forEach((img, index) => {
		img.addEventListener('click', (e) => {
			setCurrent(index)
		})
	})
	next.addEventListener('click', () => {
		if (currentIndex == listDivImg.length - 1) {
			currentIndex = 0
		} else currentIndex++

		setCurrent(currentIndex)
	})

	prev.addEventListener('click', () => {
		if (currentIndex == 0) currentIndex = listDivImg.length - 1
		else currentIndex--

		setCurrent(currentIndex)
	})

	//zoom image
	const zoomer = document.querySelector('.main-image')
	const result = document.querySelector('.main-image .result')

	const size = 4

	imgWrap.addEventListener('mousemove', function (e) {
		result.classList.remove('hide')

		let x = (e.offsetX / this.offsetWidth) * 90
		let y = (e.offsetY / this.offsetHeight) * 90

		// move result
		let posX = e.pageX - zoomer.offsetLeft
		let posY = e.pageY - zoomer.offsetTop

		result.style.cssText = `
				background-image: url(${this.src});
				background-size: ${this.width * size}px ${this.height * size}px;
				background-position : ${x}% ${y}%;
				left: ${posX}px;
				top: ${posY}px;
			`
	})

	imgWrap.addEventListener('mouseleave', function (e) {
		result.style = ``
		result.classList.add('hide')
	})




}

// ajax handle subcart
const itemSubCart = [...document.querySelectorAll('.subcart-item-wrap .cart-item')]
const totalSubCart = document.querySelector('.subcart-item-wrap .total-cart')
const totalItemSubCart = document.querySelectorAll('.subcart-item-wrap .total-item')
const btnDelSubCart = document.querySelectorAll('#del-subcart')
const idRowSubCart = document.querySelectorAll('.id-subcart')
let countItemCart = itemSubCart.length
/* totalSubCart.innerText = `${Number(window.localStorage.getItem('totalSubCart')).toLocaleString('vi-VN', {
	style: 'currency',
	currency: 'VND'
})}` */

totalItemSubCart.forEach((item) => {
	item.innerHTML = `${Number(item.innerHTML).toLocaleString('vi-VN', {
		style: 'currency',
		currency: 'VND'
	})}`
})


btnDelSubCart.forEach((item, index) => {
	item.onclick = () => {
		let id = idRowSubCart[index].value
		$.post('./ajax/delcart', { id: id }, () => {
			itemSubCart[index].style.display = 'none'
			document.querySelector('.cart-count').innerText = --countItemCart
		})
		$.post('./ajax/totalOrder', {}, (data) => {
			let dt = JSON.parse(data)
			let total = dt[0]
			if (total > 0)
				if (coupon !== undefined) {
					if (coupon[0] == 1)
						total *= coupon[1] / 100
					else
						if (coupon[0] == 2)
							total -= coupon[1]
				}
			window.localStorage.setItem('subtotal', dt[0])
			window.localStorage.setItem('fee', dt[1])
			window.localStorage.setItem('total', total - dt[1])
			totalSubCart.innerText = Number(dt[0]).toLocaleString('vi-VN', {
				style: 'currency',
				currency: 'VND'
			})

			if (document.querySelectorAll('.item-wrap')) {
				document.querySelectorAll('.item-wrap')[index].remove()
				document.querySelector('.product-number').innerText = `Tạm tính (${countItemCart} sản phẩm): `
				document.querySelector('.product-total').innerText = `${Number(dt[0]).toLocaleString('vi-VN', {
					style: 'currency',
					currency: 'VND'
				})}`

				document.querySelector('.fee').innerText = `${Number(dt[1]).toLocaleString('vi-VN', {
					style: 'currency',
					currency: 'VND'
				})}`
				document.querySelector('.total-order').innerText = `Tổng tiền: ${Number(total - dt[1]).toLocaleString('vi-VN', {
					style: 'currency',
					currency: 'VND'
				})}`
			}
		})

	}
})
// ajax handle cart
if (document.querySelector('.cart-section')) {

	window.localStorage.setItem('coupon', '')

	let listItemCart = [...document.querySelectorAll('.item-wrap')]
	let idRowCart = document.querySelectorAll('.id-cart')
	let total = document.querySelectorAll('.total')
	let btnDelCart = document.querySelectorAll('.btn-del-cart')

	let productNumber = document.querySelector('.product-number')
	let totalOrder = document.querySelector('.product-total')
	let fee = document.querySelector('.fee')
	let sumTotal = document.querySelector('.total-order')

	total.forEach((item) => {
		item.innerText = Number(item.innerText).toLocaleString('vi-VN', {
			style: 'currency',
			currency: 'VND'
		})
	})
	btnDelCart.forEach((value, index) => {
		value.onclick = () => {
			let id = idRowCart[index].value
			$.post('./ajax/delcart', { id: id }, () => {
				listItemCart[index].style.display = 'none'
				productNumber.innerText = `Tạm tính (${--countItemCart} sản phẩm): `
				document.querySelector('.cart-count').innerText = countItemCart
				itemSubCart[index].remove()
			})
			changeTotalOrder()
		}
	})

	let btnDec = document.querySelectorAll('.btn-dec')
	let btnInc = document.querySelectorAll('.btn-inc')
	let inputQuantity = document.querySelectorAll('.quantity-item-cart')

	btnInc.forEach((value, index) => {
		let id = idRowCart[index].value
		value.onclick = () => {
			inputQuantity[index].value++
			ajaxChangeQuantity(id, inputQuantity[index].value, index)
			changeTotalOrder()
		}

	})

	btnDec.forEach((value, index) => {
		let id = idRowCart[index].value
		value.onclick = () => {
			if (inputQuantity[index].value > 1) {
				inputQuantity[index].value--
				ajaxChangeQuantity(id, inputQuantity[index].value, index)
			}
			else {
				$.post('./ajax/delcart', { id: id }, () => {
					listItemCart[index].style.display = 'none'
					productNumber.innerText = `Tạm tính (${--countItemCart} sản phẩm): `
					document.querySelector('.cart-count').innerText = countItemCart
					itemSubCart[index].remove()
				})
			}
			changeTotalOrder()
		}

	})

	inputQuantity.forEach((value, index) => {
		let id = idRowCart[index].value
		value.onchange = () => {
			ajaxChangeQuantity(id, value.value, index)
			productNumber.innerText = `Tạm tính (${listItemCart.length} sản phẩm): `
			changeTotalOrder()
		}
	})
	let ajaxChangeQuantity = (id, quantity, index) => {
		$.post('./ajax/changeQuantityCart', { id: id, quantity: quantity }, (data) => {
			total[index].innerText = `${Number(data).toLocaleString('vi-VN', {
				style: 'currency',
				currency: 'VND'
			})}`
			totalItemSubCart[index].innerText = `${Number(data).toLocaleString('vi-VN', {
				style: 'currency',
				currency: 'VND'
			})}`
		})
	}

	let coupon
	let changeTotalOrder = () => {
		$.post('./ajax/totalOrder', {}, (data) => {
			console.log(data)
			let dt = JSON.parse(data)
			let total = dt[0]
			if (total > 0)
				if (coupon !== undefined) {
					if (coupon[0] == 1)
						total *= coupon[1] / 100
					else
						if (coupon[0] == 2)
							total -= coupon[1]
				}
			window.localStorage.setItem('subtotal', dt[0])
			window.localStorage.setItem('fee', dt[1])
			window.localStorage.setItem('total', total - dt[1])
			window.localStorage.setItem('totalSubCart', dt[2])
			totalOrder.innerText = `${Number(dt[0]).toLocaleString('vi-VN', {
				style: 'currency',
				currency: 'VND'
			})}`
			fee.innerText = `${Number(dt[1]).toLocaleString('vi-VN', {
				style: 'currency',
				currency: 'VND'
			})}`
			sumTotal.innerText = `Tổng tiền: ${Number(total - dt[1]).toLocaleString('vi-VN', {
				style: 'currency',
				currency: 'VND'
			})}`

			totalSubCart.innerText = `${Number(dt[2]).toLocaleString('vi-VN', {
				style: 'currency',
				currency: 'VND'
			})}`
		})
	}

	changeTotalOrder()

	idRowCart.forEach((value) => {
		value.addEventListener('input', () => {
			if (value.checked) {
				$.post('./ajax/selectCart', { id: value.value }, (data) => {
					changeTotalOrder()
				})
			} else
				$.post('./ajax/unSelectCart', { id: value.value }, (data) => {
					changeTotalOrder()
				})
		})
	})

	const couponForm = document.querySelector('.discount-input')
	const couponCode = couponForm.querySelector('input')
	const messCoupon = document.querySelector('.discount small')
	couponForm.addEventListener('submit', () => {
		messCoupon.style.display = 'block'
		$.post('./ajax/checkCoupon', { code: couponCode.value }, (data) => {
			coupon = JSON.parse(data)
			if (coupon[0] == 1) {
				messCoupon.innerText = `Bạn được giảm ${coupon[1]}%`
			} else
				if (coupon[0] == 2) {
					messCoupon.innerText = `Bạn được giảm ${Number(coupon[1]).toLocaleString('vi-VN', {
						style: 'currency',
						currency: 'VND'
					})}`
				} else
					if (coupon[0] == 3) {
						messCoupon.innerText = 'Mã giảm giá đã hết hạn!'
						setTimeout(() => {
							messCoupon.style.display = 'none'
						}, 5000)
					} else {
						messCoupon.innerText = 'Mã giảm giá không tồn tại!'
						setTimeout(() => {
							messCoupon.style.display = 'none'
						}, 5000)
					}

		})
		changeTotalOrder()
	})

}

// filter type product
{
	let typeProduct = document.querySelectorAll('.product-type p')
	let listProduct = document.querySelectorAll('.product-list a')
	console.log(listProduct)
	typeProduct.forEach((item) => {
		item.onclick = () => {
			let typeActive = document.querySelector('.product-type p.active')
			if (typeActive)
				typeActive.classList.remove('active')
			item.classList.add('active')
			listProduct.forEach((itemProduct) => {
				if (itemProduct.querySelector('.desc').innerText.trim().includes(item.innerText)) {
					itemProduct.classList.remove('hide')
				}
				else {

					console.log(itemProduct)
					itemProduct.classList.add('hide')
				}
			})
		}
	})
}

// filter sida bar
if (document.querySelector('.color-filter .title')) {
	let colorFilter = document.querySelector('.color-filter .title')
	colorFilter.onclick = () => {
		document.querySelector('.colors-wrap').classList.toggle('active')
		colorFilter.querySelector('i').classList.toggle('rotate180')
	}

	let hideFilter = document.querySelector('.hide-filters')
	hideFilter.onclick = () => {
		document.querySelector('.product-filter').classList.toggle('hide-filter')
	}
}

//check out
if (document.querySelector('.checkout-section')) {
	// road stage
	const btnStage = document.querySelectorAll('.stage')
	const road = document.querySelectorAll('.checkout-road span')
	// const btnStageActive = document.querySelectorAll('.stage.active')

	let reStage = () => {
		btnStage.forEach((button, index) => {
			if (index < document.querySelectorAll('.stage.active').length) {
				button.style.cursor = 'pointer'
				button.onclick = () => {
					if (index !== 0) checkoutMain.style.marginLeft = `-${index - 1}00%`
					// button.classList.toggle('active')
					// road[index - 1].classList.toggle('active')
				}
			}
		})
	}

	reStage()
	//load address
	const selectProvince = document.querySelector('#province')
	const selectDistrict = document.querySelector('#district')
	const selectWard = document.querySelector('#ward')
	const selectStreet = document.querySelector('#reg-address')
	if (selectProvince) {

		selectProvince.onchange = () => {
	
			$.post('./ajax/getDistrict', { id: selectProvince.selectedIndex }, (data) => {
				let districts = JSON.parse(data)
				selectDistrict.innerHTML = districts.map((value) =>
					`<option value=${value.id}> ${value._name} </option>`
				)
				if (selectDistrict.value)
					$.post('./ajax/getWard', { id: selectDistrict.value }, (data) => {
						let wards = JSON.parse(data)
						selectWard.innerHTML = wards.map((value) =>
							`<option> ${value._name} </option>`
						)
					})
				else
					selectWard.innerHTML = ''
			})
	
	
			selectDistrict.onchange = () => {
	
				$.post('./ajax/getWard', { id: selectDistrict.value }, (data) => {
					let wards = JSON.parse(data)
					selectWard.innerHTML = wards.map((value) =>
						`<option> ${value._name} </option>`
					)
				})
			}
		}
		
			// submi address
		
			const checkoutMain = document.querySelector('.checkout-main')
			const btnSubmitAddress = document.querySelector('.address-form form')
			const btnSubmitPayment = document.querySelector('.payment-form form')
		
			btnSubmitAddress.addEventListener('submit', () => {
				checkoutMain.style.marginLeft = '-100%'
				road[1].classList.add('active')
				setTimeout(() => {
					btnStage[2].classList.add('active')
					reStage()
				}, 500)
				console.log('cc')
				document.querySelector('.ship-to p').innerText = `${selectStreet.value}, ${selectWard.options[selectWard.selectedIndex].text}, ${selectDistrict.options[selectDistrict.selectedIndex].text}, ${selectProvince.options[selectProvince.selectedIndex].text}`
			})
		
			// change method
			const cardInfo = document.querySelector('.card-info')
			const checkoutMethod = document.querySelectorAll('.method')
			checkoutMethod.forEach((btn, index) => {
		
				btn.onclick = () => {
					document.querySelector('.method.active').classList.remove('active')
					btn.classList.add('active')
					if (index === 1)
						cardInfo.style.display = 'none'
					else
						cardInfo.style.display = 'block'
		
				}
			})
		
			//submit checkout payment
			btnSubmitPayment.addEventListener('submit', () => {
				checkoutMain.style.marginLeft = '-200%'
				road[2].classList.add('active')
				setTimeout(() => {
					btnStage[3].classList.add('active')
					reStage()
				}, 500)
			})
	}

	//show total cart
	const subtotal = document.querySelector('.total-wrap .subtotal')
	const fee = document.querySelector('.total-wrap .fee')
	const coupon = document.querySelector('.total-wrap .coupon')
	const total = document.querySelector('.total-wrap .total')

	subtotal.querySelector('div').innerText = `${Number(window.localStorage.getItem('subtotal')).toLocaleString('vi-VN', {
		style: 'currency',
		currency: 'VND'
	})}`

	fee.querySelector('div').innerText = `${Number(window.localStorage.getItem('fee')).toLocaleString('vi-VN', {
		style: 'currency',
		currency: 'VND'
	})}`

	coupon.querySelector('div').innerText = `${Number(window.localStorage.getItem('subtotal') - window.localStorage.getItem('total') - window.localStorage.getItem('fee')).toLocaleString('vi-VN', {
		style: 'currency',
		currency: 'VND'
	})}`

	total.querySelector('div').innerText = `${Number(window.localStorage.getItem('total')).toLocaleString('vi-VN', {
		style: 'currency',
		currency: 'VND'
	})}`
}

//login-overlay 
if (document.querySelector('.user-icon')) {

	const btnUser = document.querySelector('.user-icon')
	const loginOverlay = document.querySelector('.login-overlay-product')
	const btnExit = document.querySelectorAll('.btn-exit')
	const cdRegister = document.querySelector('.cd-register')
	btnUser.onclick = () => {
		document.querySelector('.login-overlay').classList.toggle('active')
	}
	cdRegister.onclick = () => {
		loginOverlay.style.marginTop = '-100vh'
	}
	btnExit[0].onclick = () => {
		document.querySelector('.login-overlay').classList.remove('active')
	}
	btnExit[1].onclick = () => {
		loginOverlay.style.marginTop = '0'
	}

	//validator form
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

	// ajax check register
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
}
