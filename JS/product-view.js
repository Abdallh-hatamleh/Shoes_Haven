let featuredImg = document.getElementById('featured-image');
let smallImgs = document.getElementsByClassName('small-Img');
// alert('ggggggggg');
// console.log("gii");

smallImgs[0].addEventListener('click', () => {
    featuredImg.src = smallImgs[0].src;
    smallImgs[0].classList.add('sm-card')
    smallImgs[1].classList.remove('sm-card')
    smallImgs[2].classList.remove('sm-card')
})
smallImgs[1].addEventListener('click', () => {
    featuredImg.src = smallImgs[1].src;
    smallImgs[0].classList.remove('sm-card')
    smallImgs[1].classList.add('sm-card')
    smallImgs[2].classList.remove('sm-card')
})
smallImgs[2].addEventListener('click', () => {
    featuredImg.src = smallImgs[2].src;
    smallImgs[0].classList.remove('sm-card')
    smallImgs[1].classList.remove('sm-card')
    smallImgs[2].classList.add('sm-card')
})
