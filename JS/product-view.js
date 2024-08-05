let featuredImg = document.getElementById('featured-image');
let smallImgs = document.getElementsByClassName('small-Img');

smallImgs[0].addEventListener('click', () => {
    featuredImg.setAttribute.src = smallImgs[0].getAttribute.src;
    smallImgs[0].classList.add('sm-card')
    smallImgs[1].classList.remove('sm-card')
    smallImgs[2].classList.remove('sm-card')
})
smallImgs[1].addEventListener('click', () => {
    featuredImg.setAttribute.src = smallImgs[1].getAttribute.src;
    smallImgs[0].classList.remove('sm-card')
    smallImgs[1].classList.add('sm-card')
    smallImgs[2].classList.remove('sm-card')
})
smallImgs[2].addEventListener('click', () => {
    featuredImg.setAttribute.src = smallImgs[2].getAttribute.src;
    smallImgs[0].classList.remove('sm-card')
    smallImgs[1].classList.remove('sm-card')
    smallImgs[2].classList.add('sm-card')
})
