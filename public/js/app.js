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
  console.log(productIndex)
  productInfos[productIndex].classList.add('active')
  
  let listItems = document.querySelectorAll('.slide')
  let reverseItems = Array.from(listItems).slice().reverse()
  let slider = document.querySelector('.slider')

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
  })

}

let slideControl = document.querySelector('.slide-control')

slideControl.onclick = () => {
  slide()
}