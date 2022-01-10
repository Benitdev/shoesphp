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
				filterTitle.style.background = 'unset'
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

/* if (document.querySelector('.checkout-section')) {
	let body = document.querySelector('.checkout-section')
	let header = document.querySelector('.header-product')
	let bar = document.querySelector('.checkout-stage')
	let container = document.querySelector('.container')
	let scroll = 70

	window.addEventListener('scroll', () => {
		console.log(window.scrollY)
		if (window.scrollY > scroll) {
			scroll = window.scrollY
			header.style.transform = 'translateY(-100%)'
			bar.style.position = 'fixed'
			bar.style.transform = 'translateY(0%)'
			// container.style.marginTop = '6rem'
			
		} else {
			header.style.transform = 'translateY(0)'
			scroll = window.scrollY > 70 ? window.scrollY : 70
			bar.style.transform= 'translateY(80%)'
			if (window.scrollY <= 0) {
				bar.style.transform = 'translateY(0)'
				bar.style.position = 'unset'
				// container.style.marginTop = '0rem'

		
			}
		}
	})

}
 */
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
totalSubCart.innerText = `${Number(window.localStorage.getItem('totalSubCart')).toLocaleString('vi-VN', {
	style: 'currency',
	currency: 'VND'
})}`
console.log(Number(window.localStorage.getItem('totalSubCart')).toLocaleString('vi-VN', {
	style: 'currency',
	currency: 'VND'
}))
totalItemSubCart.forEach((item) => {
	item.innerHTML = `${Number(item.innerHTML).toLocaleString('vi-VN', {
		style: 'currency',
		currency: 'VND'
	})}`
})

let coupon
let listItemCart = [...document.querySelectorAll('.item-wrap')]
console.log(listItemCart)

btnDelSubCart.forEach((item, index) => {
	item.onclick = () => {
		let id = idRowSubCart[index].value
		$.post('./ajax/delcart', { id: id }, () => {
			itemSubCart[index].remove()
			listItemCart[index].remove()
			document.querySelector('.cart-count').innerText = --countItemCart
		})
		changeTotalOrder()

	}
})

let inputQuantity = document.querySelectorAll('.quantity-item-cart')

let changeTotalOrder = (index = '') => {
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
		window.localStorage.setItem('total', total + dt[1])
		window.localStorage.setItem('totalSubCart', dt[2])

		totalSubCart.innerText = Number(dt[2]).toLocaleString('vi-VN', {
			style: 'currency',
			currency: 'VND'
		})
		
		if (listItemCart) {
			
			document.querySelector('.product-number').innerText = `Tạm tính (${countItemCart} sản phẩm): `
			document.querySelector('.product-total').innerText = `${Number(dt[0]).toLocaleString('vi-VN', {
				style: 'currency',
				currency: 'VND'
			})}`

			document.querySelector('.fee').innerText = `${Number(dt[1]).toLocaleString('vi-VN', {
				style: 'currency',
				currency: 'VND'
			})}`
			document.querySelector('.total-order').innerText = `Tổng tiền: ${Number(total + dt[1]).toLocaleString('vi-VN', {
				style: 'currency',
				currency: 'VND'
			})}`
		}

		if (index !== '') {
			console.log(index)
			document.querySelectorAll('.quantity-subcart')[index].innerText = `x ${inputQuantity[index].value}`
		}
	})
}
let couponId = 0
// ajax handle cart
if (document.querySelector('.cart-section')) {

	window.localStorage.setItem('coupon', '')

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
				// productNumber.innerText = `Tạm tính (${--countItemCart} sản phẩm): `
				document.querySelector('.cart-count').innerText = --countItemCart
				itemSubCart[index].remove()
			})
			changeTotalOrder()
		}
	})

	let btnDec = document.querySelectorAll('.btn-dec')
	let btnInc = document.querySelectorAll('.btn-inc')

	btnInc.forEach((value, index) => {
		let id = idRowCart[index].value
		value.onclick = () => {
			inputQuantity[index].value++
			ajaxChangeQuantity(id, inputQuantity[index].value, index)
			changeTotalOrder(index)
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
					// productNumber.innerText = `Tạm tính (${--countItemCart} sản phẩm): `
					document.querySelector('.cart-count').innerText = --countItemCart
					itemSubCart[index].remove()
				})
			}
			changeTotalOrder(index)
		}

	})

	inputQuantity.forEach((value, index) => {
		let id = idRowCart[index].value
		value.onchange = () => {
			ajaxChangeQuantity(id, value.value, index)
			// productNumber.innerText = `Tạm tính (${listItemCart.length} sản phẩm): `
			changeTotalOrder(index)
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
	window.localStorage.setItem('coupon', '')
	couponForm.addEventListener('submit', () => {
		messCoupon.style.display = 'block'
		$.post('./ajax/checkCoupon', { code: couponCode.value }, (data) => {
			coupon = JSON.parse(data)
			couponId = coupon[2]
			window.localStorage.setItem('coupon', coupon[2])
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

// filter sida bar
if (document.querySelector('.color-filter .title')) {

	let currType, start, end
	let filterSlug = document.querySelector('.product-href-wrap')
	const filterItemSlug = document.createElement('div')
	const filterPrice = document.createElement('div')

	let typeProduct = document.querySelectorAll('.product-type p')
	let listProduct = document.querySelectorAll('.product-list a')
	console.log(listProduct)
	typeProduct.forEach((item) => {
		item.onclick = () => {
			let typeActive = document.querySelector('.product-type p.active')
			if (typeActive)
				typeActive.classList.remove('active')
			item.classList.add('active')
			/* listProduct.forEach((itemProduct) => {
				console.log(itemProduct)
				if (itemProduct.querySelector('.desc').innerText.trim().includes(item.innerText)) {
					itemProduct.classList.remove('hide')
				}
				else {

					itemProduct.classList.add('hide')
				}
			}) */
			currType = item.innerText

			// const filterItemSlug = document.createElement('div')
			filterItemSlug.className = `filter-slug ${currType}`
			filterItemSlug.innerHTML = `${currType} <i class="fas fa-times close"></i>`


			filterSlug.append(filterItemSlug)

			filterItemSlug.querySelector('i').onclick = () => {
				filterItemSlug.remove()
				item.classList.remove('active')
				currType = ''
				$.post('./ajax/filter', { start, end }, data => {
					// console.log(data)
					document.querySelector('.product-list').innerHTML = data
				})
			}
			$.post('./ajax/filter', { start, end, type: currType }, data => {
				// console.log(data)
				document.querySelector('.product-list').innerHTML = data
			})
		}
	})
	//filter price
	$("#slider-range").slider({
		orientation: "horizontal",
		min: 1000000,
		max: 10000000,
		range: true,
		step: 10000,
		values: [1000000, 10000000],
		slide: function (event, ui) {
			$("#amount").val(Number(ui.values[0]).toLocaleString('vi-VN', {
				style: 'currency',
				currency: 'VND'
			}) + ' - ' + Number(ui.values[1]).toLocaleString('vi-VN', {
				style: 'currency',
				currency: 'VND'
			}));
			$('#start-price').val(ui.values[0])
			$('#end-price').val(ui.values[1])
		}
	})
	$("#amount").val(Number($("#slider-range").slider("values", 0)).toLocaleString('vi-VN', {
		style: 'currency',
		currency: 'VND'
	}) + ' - ' +
		Number($("#slider-range").slider("values", 1)).toLocaleString('vi-VN', {
			style: 'currency',
			currency: 'VND'
		}));


	const formPrice = document.querySelector('.filter-price')

	formPrice.addEventListener('submit', () => {
		start = formPrice.querySelector('#start-price').value
		end = formPrice.querySelector('#end-price').value

		filterPrice.className = `filter-slug price`
		filterPrice.innerHTML = `${Number(start).toLocaleString('vi-VN', {
			style: 'currency',
			currency: 'VND'
		})} - ${Number(end).toLocaleString('vi-VN', {
			style: 'currency',
			currency: 'VND'
		})}<i class="fas fa-times close"></i>`

		filterSlug.append(filterPrice)
		filterPrice.querySelector('i').onclick = () => {
			$("#slider-range").slider({
				orientation: "horizontal",
				min: 1000000,
				max: 10000000,
				range: true,
				step: 10000,
				values: [1000000, 10000000],
				slide: function (event, ui) {
					$("#amount").val(Number(ui.values[0]).toLocaleString('vi-VN', {
						style: 'currency',
						currency: 'VND'
					}) + ' - ' + Number(ui.values[1]).toLocaleString('vi-VN', {
						style: 'currency',
						currency: 'VND'
					}));
					$('#start-price').val(ui.values[0])
					$('#end-price').val(ui.values[1])
				}
			})
			$("#amount").val(Number($("#slider-range").slider("values", 0)).toLocaleString('vi-VN', {
				style: 'currency',
				currency: 'VND'
			}) + ' - ' +
				Number($("#slider-range").slider("values", 1)).toLocaleString('vi-VN', {
					style: 'currency',
					currency: 'VND'
				}));

			$.post('./ajax/filter', { type: currType }, data => {
				// console.log(data)
				filterPrice.remove()
				document.querySelector('.product-list').innerHTML = data
			})
		}

		$.post('./ajax/filter', { start, end, type: currType }, data => {
			// console.log(data)
			document.querySelector('.product-list').innerHTML = data
		})
	})
	//filter color
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
console.log(window.localStorage.getItem('coupon'))	
if (document.querySelector('.checkout-section')) {
	// road stage
	const btnStage = document.querySelectorAll('.stage')
	const road = document.querySelectorAll('.checkout-road span')
	// const btnStageActive = document.querySelectorAll('.stage.active')
	const checkoutMain = document.querySelector('.checkout-main')


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
	const selectStreet = document.querySelector('#checkout-address')
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

		const btnSubmitAddress = document.querySelector('.address-form form')
		const btnSubmitPayment = document.querySelector('.payment-form form')

		let checkoutPhone, checkoutAddress

		btnSubmitAddress.addEventListener('submit', () => {
			checkoutMain.style.marginLeft = '-100%'
			road[1].classList.add('active')
			setTimeout(() => {
				btnStage[2].classList.add('active')
				reStage()
			}, 500)
			checkoutPhone = document.querySelector('#checkout-phone').value
			checkoutAddress = `${selectStreet.value}, ${selectWard.options[selectWard.selectedIndex].text}, ${selectDistrict.options[selectDistrict.selectedIndex].text}, ${selectProvince.options[selectProvince.selectedIndex].text}`
			document.querySelector('.ship-to p').innerText = checkoutAddress
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

			method = 'Thanh toán khi nhận hàng'

			let subtotal = window.localStorage.getItem('subtotal')
			let total = window.localStorage.getItem('total')
			$.post("./ajax/insertOrder", {
				subtotal,
				couponId: window.localStorage.getItem('coupon'),
				total,
				method,
				checkoutPhone,
				address: checkoutAddress
			}, (data) => {
				let dt = JSON.parse(data)
				if (dt[0]) {

					checkoutMain.style.marginLeft = '-200%'
					road[2].classList.add('active')
					setTimeout(() => {
						btnStage[3].classList.add('active')
						reStage()
					}, 500)

					let checkoutProducts = document.querySelectorAll('.item-wrap')
					checkoutProducts.forEach((item) => {
						let productId = item.querySelector('.id-cart').value
						let productQuantity = item.querySelector('.quantity-product').innerText
						let productTotal = item.querySelector('.total').innerText

						productQuantity = productQuantity.split(' ')
						productQuantity = productQuantity[1]

						productTotal = productTotal.substring(0, productTotal.length - 2)
						productTotal = productTotal.split(',')
						productTotal = productTotal.reduce((rs, item) => rs + item)

						$.post("./ajax/insertOrderDetail", {
							orderId: dt[1].id,
							productId,
							productQuantity,
							productTotal
						}, data => {
							if (data) {
								$.post('./ajax/delcart', {
									id: productId
								})
							}
						})

					})

				}


			})
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

	let couponValue = Number(window.localStorage.getItem('subtotal') - Number(window.localStorage.getItem('total')) + Number(window.localStorage.getItem('fee')))

	coupon.querySelector('div').innerText = `${couponValue.toLocaleString('vi-VN', {
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

//ajax search product 
{
	const searchInput = document.querySelector('.search-box input')
	const searchItems = document.querySelector('.result-search')
	const itemsWrap = searchItems.querySelector('.item-search-wrap')

	const searchBox = document.querySelector('.search-box')
	searchBox.addEventListener('mouseover', () => {
		searchBox.classList.add('hover')
	})

	searchBox.addEventListener('mouseout', () => {
		if (searchInput.value == '') {
			searchBox.classList.remove('hover')
			closeSearch.style.display = 'none'

		}

	})
	const closeSearch = document.querySelector('.btn-close-search ')
	closeSearch.addEventListener('click', () => {
		searchItems.classList.remove('active')
		searchInput.value = ''
	})
	searchInput.addEventListener('keyup', () => {
		searchItems.classList.toggle('active', searchInput.value !== '')
		closeSearch.style.display = 'block'
		document.querySelector('.search-value').innerText = searchInput.value
		$.post('./ajax/search', { value: searchInput.value }, data => {
			itemsWrap.innerHTML = data

			const formatPrice = itemsWrap.querySelectorAll('.price')
			console.log(data)
			formatPrice.forEach(item => {
				item.innerText = Number(item.innerText).toLocaleString('vi-VN', {
					style: 'currency',
					currency: 'VND'
				})
			})

			if (!itemsWrap.querySelector('.product-list-item'))
				itemsWrap.innerText = 'Không có sản phẩm'
		})

	})
}
if (document.querySelector('.product-detail')) {
	$('.product-list-wrap').slick({
		slidesToShow : 3,
		// slidesToScroll: 4,
		Infinity: true,
		autoplay: true,
		autoplaySpeed: 2000,
		// dots: true
		prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-arrow-left"></i></button>',
		nextArrow: '<button type="button" class="slick-next"><i class="fas fa-arrow-right"></i></button>',
	  })

	const formComment = document.querySelector('.enter-comment')
	const viewComment = document.querySelector('.user-comment')
	const productId = formComment.querySelector('#product-id').value
	
	formComment.addEventListener('submit', () => {

		let ratings = document.getElementsByName('rating')
		let content = formComment.querySelector('#content-comment').value
		ratings.forEach(item => {
			if (item.checked)
				rating = item.value
		})

		console.log(rating)
		$.post('./ajax/insertComment', {
			productId,
			rating,
			content
		}, data => {
				loadComments()
				formComment.querySelector('#content-comment').value = ''
			
		})
	})

	loadComments()
	//load comment
	function loadComments() {
		$.post('./ajax/getComments', {
			productId
		}, data => {
			// console.log(data)
			viewComment.innerHTML = data
			
			const commentWrap = viewComment.querySelectorAll('.comment-wrap')
			// console.log(commentWrap)
			let ratingOverview = [0, 0, 0, 0, 0]
			commentWrap.forEach(item => {
				let star = item.querySelector('.numberofstar').value
				ratingOverview[Math.floor(star/2) - 1]++
			})
	
			const ratingFilter = document.querySelectorAll('.rating-filter-item')
			ratingFilter.forEach((item, index) => {
				if (index > 0)
					item.innerText = `${index} Sao (${ratingOverview[index - 1]})`
				item.onclick = () => {
					console.log(item.innerText[0])
					commentWrap.forEach(comment => {
						let star = comment.querySelector('.numberofstar').value
						if (Math.floor(star/2) != item.innerText[0]) {
							if (item.innerText[0] == 'T')
								comment.classList.remove('hide')
							else
								comment.classList.add('hide')
						}
						else
							comment.classList.remove('hide')
				
					})
				}
			})
		})	
		//get rating
		const rating = document.querySelectorAll('.product-info .rating-star-title input')
		const ratingOverview = document.querySelectorAll('.view-comments .rating-star-title input')
	
		$.post('./ajax/getRating', {productId}, data => {
			let dt = JSON.parse(data)
			if (dt.rating) {
				let average = dt.rating / dt.count;
		
				for(let i = rating.length - 1; i>=0; i--) {
					if (rating[i].value >= average) {
						rating[i].checked = true
						ratingOverview[i].checked = true
						break			
					}
				}
				
				document.querySelector('.rating-average').innerText = (average / 2).toFixed(1)
				document.querySelector('.rating-average-overview').innerHTML = `<span>${(average/2).toFixed(1)}</span> Trên 5`
			} 
			else {
				document.querySelector('.rating-average').innerText = 0
				document.querySelector('.rating-average-overview').innerHTML = `<span>0</span> Trên 5`
			}
			
			document.querySelector('.rating-quantity').innerText = `(${dt.count} Đánh giá)`
			document.querySelector('.post-comments h1 span').innerText = `(${dt.count} Đánh giá)`
		
			
		})
	}


}

if (document.querySelector('.user-section')) {
	const orderFilter = document.querySelectorAll('.order-categories-filter')
	const orderMain = document.querySelector('.order-main')
	$.post('./ajax/getCountOrderStatus', {}, data => {
		let dt = JSON.parse(data)
		orderFilter.forEach((item, index) => {
			item.querySelector('span').innerText = `(${dt[index] ? dt[index].count : 0})`
			dt[index] ? item.style.color = 'red': '';

			item.onclick = () => {
				$.post('./ajax/getOrderItem', {status: index}, data => {
					// console.log(data)
					orderMain.innerHTML = data
					const orderItem = orderMain.querySelectorAll('.order-item-wrap')

					orderItem.forEach(item => {
						const subtotal = item.querySelector('.subtotal')
						const total = item.querySelector('.total')
						subtotal.innerText = Number(subtotal.innerText).toLocaleString('vi-VN', {
							style: 'currency',
							currency: 'VND'
						})
						total.innerText = Number(total.innerText).toLocaleString('vi-VN', {
							style: 'currency',
							currency: 'VND'
						})

						const orderId = item.querySelector('.order-id span').innerText
						item.onclick = () => {
							document.querySelector('.order-detail-overlay').classList.add('active')
							$.post('./ajax/getOrderDetail', {orderId}, data => {
								document.querySelector('.order-id-title').innerText = `Mã đơn hàng: ${orderId}`
								const itemWrap = document.querySelector('.order-detail-item-wrap')

								itemWrap.innerHTML = data
							
							})
						}

					})
				})
			}
		})
	})

}

