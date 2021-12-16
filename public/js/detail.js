// handle product detail images
{
	let listDivImg = document.querySelectorAll('.sub-image div')
	let next = document.querySelector('.next')
	let prev = document.querySelector('.prev')
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
	/* next.addEventListener('click', () => {
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
	 */

}
// ajax handle cart
if (document.querySelector('.cart-session')) {
	let listItemCart = [...document.querySelectorAll('.item-wrap')]

	let btnDelCart = document.querySelectorAll('.btn-del-cart')
	let idRowCart = document.querySelectorAll('.id-cart')
	let total = document.querySelectorAll('.total')
	let fee = document.querySelector('.fee')

	let productNumber = document.querySelector('.product-number')
	let totalOrder = document.querySelector('.product-total')
	let sumTotal = document.querySelector('.total-order')
	btnDelCart.forEach((value, index) => {
		value.onclick = () => {
			let id = idRowCart[index].value
			$.post('./ajax/delcart', { id: id }, () => {
				listItemCart[index].remove()
				listItemCart.splice(index, 1)
				productNumber.innerText = `Tạm tính (${listItemCart.length} sản phẩm): `
			})
			changeTotalOrder()

		}
	})

	let btnDec = document.querySelectorAll('.btn-dec')
	let btnInc = document.querySelectorAll('.btn-inc')
	let inputQuantity = document.querySelectorAll('#quantity')

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
					listItemCart[index].remove()
					listItemCart.splice(index, 1)
					productNumber.innerText = `Tạm tính (${listItemCart.length} sản phẩm): `
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
			total[index].innerText = `${data} d`
		})
	}

	let changeTotalOrder = () => {
		$.post('./ajax/totalOrder', {}, (data) => {
			let dt = JSON.parse(data)
			totalOrder.innerText = `${dt[0]} d`
			fee.innerText = `${dt[1]} d`
			sumTotal.innerText = `Tổng tiền: ${dt[2]} d`

		})
	}

	productNumber.innerText = `Tạm tính (${listItemCart.length} sản phẩm): `
	changeTotalOrder()
}

// filter type product
{
	let typeProduct = document.querySelectorAll('.product-type p')
	let listProduct = document.querySelectorAll('.product-list a')

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

					itemProduct.classList.add('hide')
				}
			})
		}
	})
}

// filter sida bar
{
	let colorFilter = document.querySelector('.color-filter .title')

	console.log(colorFilter)
	colorFilter.onclick = () => {
		document.querySelector('.colors-wrap').classList.toggle('active')
		colorFilter.querySelector('i').classList.toggle('rotate180')
	}

	let hideFilter = document.querySelector('.hide-filters')
	hideFilter.onclick = () => {
		document.querySelector('.product-filter').classList.toggle('hide-filter')
	}
}


